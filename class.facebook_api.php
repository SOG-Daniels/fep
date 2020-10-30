<?php 
require_once('./vendor/autoload.php');

// Include required libraries
use Facebook\Facebook;
use Facebook\Exceptions\FacebookResponseException;
use Facebook\Exceptions\FacebookSDKException;

class FacebookAPI{

    private $fb;

    public function __contruct(){
        
        // Call Facebook API
        $this->fb = new Facebook(array(
            'app_id' => FB_APP_ID,
            'app_secret' => FB_SECRET_KEY,
            'default_graph_version' => 'v5.0',
        ));

    }
	/**
	 * Make call to facebook endpoint
	 *
	 * @param string $endpoint make call to this enpoint
	 * @param array $params array keys are the variable names required by the endpoint
	 *
	 * @return array $response
	 */
	function makeFacebookApiCall( $endpoint, $params ) {
		// open curl call, set endpoint and other curl params
		$ch = curl_init();
		curl_setopt( $ch, CURLOPT_URL, $endpoint . '?' . http_build_query( $params ) );
		curl_setopt( $ch, CURLOPT_RETURNTRANSFER, TRUE );
		curl_setopt( $ch, CURLOPT_SSL_VERIFYPEER, FALSE );

		// get curl response, json decode it, and close curl
		$fbResponse = curl_exec( $ch );
		$fbResponse = json_decode( $fbResponse, TRUE );
		curl_close( $ch ); 

		return array( // return response data
			'endpoint' => $endpoint,
			'params' => $params,
			'has_errors' => isset( $fbResponse['error'] ) ? TRUE : FALSE, // boolean for if an error occured
			'error_message' => isset( $fbResponse['error'] ) ? $fbResponse['error']['message'] : '', // error message
			'fb_response' => $fbResponse // actual response from the call
		);
	}

	/**
	 * Get facebook api login url that will take the user to facebook and present them with login dialog
	 *
	 * Endpoint: https://www.facebook.com/{fb-graph-api-version}/dialog/oauth?client_id={app-id}&redirect_uri={redirect-uri}&state={state}&scope={scope}&auth_type={auth-type}
	 *
	 * @param void
	 *
	 * @return string
	 */    
    public function getFacebookLoginUrl($redirectUrl = ''){
        
        
        $endPoint = 'https://www.facebook.com/v8.0/dialog/oauth';

        $params = array(
            'client_id' => FB_APP_ID,
            'redirect_uri' => $redirectUrl,
            'state' => FB_APP_STATE,
            'scope' => 'email',
            'auth_type' => 'rerequest'
        );

        

        return $endPoint . '?' . http_build_query($params);
    }
	/**
	 * Get an access token with the code from facebook
	 *
	 * Endpoint https://graph.facebook.com/{fb-graph-version}/oauth/access_token?client_id{app-id}&client_secret={app-secret}&redirect_uri={redirect_uri}&code={code}
	 *
	 * @param string $code
	 *
	 * @return array $response
	 */
	function getAccessTokenWithCode( $code , $redirectUrl) {
		// endpoint for getting an access token with code
		$endpoint = FB_GRAPH_DOMAIN . FB_GRAPH_VERSION . '/oauth/access_token';

		$params = array( // params for the endpoint
			'client_id' => FB_APP_ID,
			'client_secret' => FB_APP_SECRET,
			'redirect_uri' => $redirectUrl,
			'code' => $code
		);

		// make the api call
		return $this->makeFacebookApiCall( $endpoint, $params );
	}
	/**
	 * Get a users facebook info
	 *
	 * Endpoint https://graph.facebook.com/me?fields={fields}&access_token={access-token}
	 *
	 * @param string $accessToken
	 *
	 * @return array $response
	 */
	function getFacebookUserInfo( $accessToken ) {
		// endpoint for getting a users facebook info
		$endpoint = FB_GRAPH_DOMAIN . 'me';

		$params = array( // params for the endpoint
			'fields' => 'first_name,last_name,email,picture.type(large),birthday',
			'access_token' => $accessToken
		);

		// make the api call
		return $this->makeFacebookApiCall( $endpoint, $params );
    }
	/**
	 * Try and log a user in with facebook
	 *
	 * @param array $get contains the url $_GET variables from the redirect uri after user authenticates with facebook
	 *
	 * @return array $response
	 */
	function tryAndLoginWithFacebook( $get , $redirectUrl) {
		
		// assume fail
		$status = 'fail';
		$message = '';

		// reset session vars
		$result['fb_access_token'] = array();
		$result['fb_user_info'] = array();
		// $_SESSION['fb_access_token'] = array();
		// $_SESSION['fb_user_info'] = array();

		if ( isset( $get['error'] ) ) { // error comming from facebook GET vars
			$message = $get['error_description'];
		} else { // no error in facebook GET vars
			// get an access token with the code facebook sent us
			$accessTokenInfo = $this->getAccessTokenWithCode( $get['code'], $redirectUrl);

			if ( $accessTokenInfo['has_errors'] ) { // there was an error getting an access token with the code
				$message = $accessTokenInfo['error_message'];
			} else { // we have access token! :D
				// set access token in the session
				$result['fb_access_token'] = $accessTokenInfo['fb_response']['access_token'];

				// get facebook user info with the access token
				$fbUserInfo = $this->getFacebookUserInfo( $result['fb_access_token'] );

				if ( !$fbUserInfo['has_errors'] && !empty( $fbUserInfo['fb_response']['id'] ) && !empty( $fbUserInfo['fb_response']['email'] ) ) { // facebook gave us the users id/email
					// 	all good!
					$status = 'ok';

					// save user info to session
					$result['fb_user_info'] = $fbUserInfo['fb_response'];
					
				} else {
					$message = 'Invalid creds';
				}
			}
		}

		$result['status'] = $status;
		$result['message'] = $message;

		return $result;
	}

}


?>