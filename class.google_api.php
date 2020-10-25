<?php 
require_once('./vendor/autoload.php');

class GoogleAPI{

    private $gClient;

    public function __construct(){
        // Creating a google client object
        $this->gClient = new Google_Client();

        
        //Setting credentials
        $this->gClient->setClientId(G_CLIENT_ID);
        $this->gClient->setClientSecret(G_CLIENT_SECRET);


        //scopes defined
        $this->gClient->addScope("email");
        $this->gClient->addScope("profile");
    }
    public function getGClient(){
        
        return $this->gClient;
    }
    //fucntion returns google auth URL
    public function getGoogleAuthUrl($redirectUrl = ''){
        
        //call back URL
        $this->gClient->setRedirectUri($redirectUrl);

        $link = $this->gClient->createAuthUrl();
        
        return $link;
    }
    public function getAccessToken($code = ''){

        $accessToken = null;

        if (isset($code)){
            $token = $this->gClient->fetchAccessTokenWithAuthCode($code);
            $this->gClient->setAccessToken($token['access_token']);
            $accessToken = $token['access_token'];
        }
        return $accessToken;
    }
    //gets user email and name from code
    public function getUserInfoByCode($code = ''){

        $result = [];

        if (isset($code)){

            $accessToken = $this->getAccessToken($code);

            if (isset($accessToken)){
                
                // get profile info
                $google_oauth = new Google_Service_Oauth2($this->gClient);
                $google_account_info = $google_oauth->userinfo->get();
                $result['email'] =  $google_account_info->email;
                $result['name'] =  $google_account_info->name;

            }
        }

        return $result;
    }



}


?>