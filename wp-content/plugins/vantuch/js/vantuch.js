/**
 * Created by marek on 12/13/2015.
 */

/** Facebook */
(function(d, s, id) {
    if (!d.getElementById('fb-page-post')) return;

    var js, fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id)) return;
    js = d.createElement(s); js.id = id;
    js.src = "//connect.facebook.net/cs_CZ/sdk.js#xfbml=1&version=v2.5";
    fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));