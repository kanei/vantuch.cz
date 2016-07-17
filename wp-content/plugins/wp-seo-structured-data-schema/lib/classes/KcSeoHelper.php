<?php

if(!class_exists('KcSeoSettings')):

    class KcSeoHelper
    {
        function verifyNonce( ){
            $nonce = !empty($_REQUEST['_kcseo_nonce']) ? $_REQUEST['_kcseo_nonce'] : null;
            if( !wp_verify_nonce( $nonce, $this->nonceText() ) ) return false;
            return true;
        }

        function nonceText(){
            return "kcseo_nonce_secret_text";
        }


        function isValidBase64($string){
            $decoded = base64_decode($string, true);
            // Check if there is no invalid character in string
            if (!preg_match('/^[a-zA-Z0-9\/\r\n+]*={0,2}$/', $string)) return false;

            // Decode the string in strict mode and send the response
            if(!base64_decode($string, true)) return false;

            // Encode and compare it to original one
            if(base64_encode($decoded) != $string) return false;

            return true;
        }


        function kcSeoPostTypes(){
            $post_types =  get_post_types(
                array(
                    '_builtin' => true
                )
            );
            $exclude = array( 'attachment', 'revision', 'nav_menu_item' );
            foreach($exclude as $ex){
                unset($post_types[$ex]);
            }
            return $post_types;
        }
    }

endif;