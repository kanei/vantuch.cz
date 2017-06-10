<?php defined( 'ABSPATH' ) OR die( 'This script cannot be accessed directly.' );
/**
 * Handle interactions with the http://app.schemaapp,com server
 *
 * @author Mark van Berkel
 */
class SchemaServer {
    
    const EDITOR = "https://app.schemaapp.com/editor";
    const FETCH = "/cache/fetch";
    const ACTIVATE = "/service/activate.json";
    
    private $options;
    private $resource;
    private $server;
    
    public function __construct($uri = "") {
        $this->options = get_option('schema_option_name');    

        if ( !empty($uri ) ) {
            $this->resource = $uri;            
        } elseif (is_front_page() && is_home() || is_front_page()) {
            $this->resource = get_site_url() . '/';
        } elseif (is_tax() || is_post_type_archive()) {
            $this->resource = 'http' . 
                (null !== filter_input(INPUT_SERVER, 'HTTPS') ? 's' : '') . 
                '://' . 
                filter_input(INPUT_SERVER, 'HTTP_HOST') . 
                filter_input(INPUT_SERVER, 'REQUEST_URI');
        } else { 
            $this->resource = get_permalink();            
        }

        $subDomain = ( substr($_SERVER['SERVER_NAME'], 0, 3) === "dev" ) ? "dev" : "";
        $this->server = $this->getProtocol($_SERVER) . "://api$subDomain.hunchmanifest.com";

    }
    
        /**
         * Get Resource JSON_LD content
         * 
         * @param type $uri
         * @return string
         */
        public function getResource($uri = "", $pretty = false) {

                // Check if the GRAPH URI is set
                if (empty($this->options['graph_uri']))
                        return "";

                $resource = "";
                if (strcmp($uri, "") !== 0) {
                        $resource = $uri;
                } elseif (strcmp($this->resource, "") !== 0) {
                        $resource = $this->resource;
                } else {
                        return "";
                }


                $TransientId = 'HunchSchema-Markup-' . md5($resource);
                $Transient = get_transient($TransientId);
                if ($Transient !== false) {
                        return $Transient;
                }

                // Try to use CURL first, otherwise try file_get_contents
                if ( function_exists('curl_version') ) {
                        $api = $this->readLink($resource);
                        $curl = curl_init();
                        curl_setopt($curl, CURLOPT_URL, $api);
                        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
                        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
                        curl_setopt($curl, CURLOPT_TIMEOUT, 5);
                        $schemadata = curl_exec($curl);

                        if (curl_exec($curl) !== false) {
                                // Check for empty result, HTTP Response Code 204 is legit, no custom data
                                if (empty($schemadata) || $schemadata === "null") {
                                        $schemadata = "";
                                } elseif ($pretty && strnatcmp(phpversion(), '5.4.0') >= 0) {
                                        $schemaObj = json_decode($schemadata);
                                        $schemadata = json_encode($schemaObj, JSON_PRETTY_PRINT);
                                }
                                
                                set_transient($TransientId, $schemadata, 86400);                               
                        } else {
                                $schemadata = "";
                        }
                        curl_close($curl);
                } else {
                        $ctx = stream_context_create(array(
                            'http' => array(
                                'method' => "GET",
                                'timeout' => 5,
                            )
                        ));
                        // Process API, get results
                        if (false !== ($schemadata = @file_get_contents($api, false, $ctx))) {
                                // Check for empty result, HTTP Response Code 204 is legit, no custom data
                                if (empty($schemadata) || $schemadata === "null") {
                                    $schemadata = "";
                                } elseif ( $pretty && strnatcmp(phpversion(), '5.4.0') >= 0) {
                                    $schemaObj = json_decode($schemadata);
                                    $schemadata = json_encode($schemaObj, JSON_PRETTY_PRINT);
                                }
                                
                                set_transient( $TransientId, $schemadata, 86400 );                                
                        } else {
                            // error happened
                            $schemadata = "";
                        }
                }

                return $schemadata;
        }
    
    /**
     * Get the Link to Update a Resource that exists
     * 
     * @param type $uri
     * @return string
     */
    protected function readLink($uri = "") {        
        $uri = ( $uri !== "" ) ? $uri : $this->resource;
        
        $link = $this->server . 
                    self::FETCH . 
                    "?resource=" . $uri . 
                    "&graph=" . $this->options['graph_uri'];
        
        return $link;        
    }
    
    /**
     * Get the Link to Update a Resource that exists
     * 
     * @param type $uri
     * @return string
     */
    public function updateLink() {               
        $link = self::EDITOR . "?resource=" . $this->resource;
        return $link;
    }
    
    /**
     * Get the link to create a new resource
     * 
     * @param type $uri
     * @return string
     */
    public function createLink() {
        $link = self::EDITOR . "?create=" . $this->resource;        
        return $link;
    }
        
    /**
     * Get HTTP or HTTPS protocol of website
     * @param type $s
     * @return string
     */
    private function getProtocol($s) {
        $ssl = (!empty($s['HTTPS']) && $s['HTTPS'] == 'on') ? true : false;
        $sp = strtolower($s['SERVER_PROTOCOL']);
        $protocol = substr($sp, 0, strpos($sp, '/')) . (($ssl) ? 's' : '');
        return $protocol;
    }

    /**
     * Activate Licenses, sends license key to Hunch Servers to confirm purchase 
     * 
     * @param type $params
     */
    public function activateLicense($params) {

        $api = $this->server . self::ACTIVATE;
        
        // Call the custom API.
        $response = wp_remote_post( $api, array(
            'timeout'   => 15,
            'sslverify' => false,
            'body'      => $params
        ));
        $response_code =  wp_remote_retrieve_response_code( $response );

        // decode the license data
        $license_data = json_decode( wp_remote_retrieve_body( $response ) );
        
        if ( in_array($response_code, array(200, 201) ) ) {
            return array(true, $license_data);
        } else {
            return array(false, $license_data);
        }

    }

}
