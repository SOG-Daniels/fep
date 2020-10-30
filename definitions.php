<?php 
    //constant variable uses throughout the php scripts
    define('DB_USER', 'root');
    define('DB_PASS', '');
    define('DB_HOST', 'localhost');
    define('DB_NAME', 'fepbelize');

    // define('BASE_URL', 'https://femaleentrepreneurs.bz/fep/');
    define('BASE_URL', 'https://localhost/fep/');
    
    // fb defines
    define('FB_APP_ID', '719611568906304');
    define('FB_APP_SECRET', '8949e698eabb33ce24ee04ef4f7c6789');
    define('FB_REDIRECT_URI_REG', BASE_URL.'index.php/?page=register&registerBy=facebook');
    define('FB_REDIRECT_URI_SIGN', BASE_URL.'index.php/?page=signIn&signInBy=facebook');
	define('FB_GRAPH_VERSION', 'v8.0' ); // facebook graph version
	define('FB_GRAPH_DOMAIN', 'https://graph.facebook.com/' ); // base domain for api
    define('FB_APP_STATE', 'fepSignup');//verify state

    //LinkedIn API - NOT USED 
    // define('LI_CLIENT_ID', '770rgs4favjvpm');
    // define('LI_CLIENT_SECRET', 'aJ2SKRLJ39ur2nRg');
    // define('LI_REDIRECT_URI', BASE_URL.'index.php/?page=linkedinLogin');
    
    //Google API
    define('G_CLIENT_ID', '694832865050-98h9qvmvptukjps9ilsibcqn05ar3q2e.apps.googleusercontent.com');
    define('G_CLIENT_SECRET', 'qSMzeV0pPyoNFEIl6SatEyFE');
    define('G_REDIRECT_URI_REG', BASE_URL.'index.php/?page=register&registerBy=google');
    define('G_REDIRECT_URI_SIGN', BASE_URL.'index.php/?page=signIn&signInBy=google');

    //Encryption 
    define ('CIPHER_TYPE', 'AES-128-CTR');// Store the cipher method 
    define ('CIPHER_KEY','H45@#T3p&GP$%d6@_ptr_D@4MUagfsH');// Store the encryption key 
    define ('CIPHER_OPTIONS', 0);
    define ('ENCRYPTION_IV','7145432623623413');// Non-NULL Initialization Vector for encryption 
    define ('DECRYPTION_IV','7145432623623413');// Non-NULL Initialization Vector for decryption 
    // 1234567891011121

    //GOOGLE recaptcha
    define ('RECAPTCHA_SITE_KEY', '6LdEydsZAAAAALftKWNkhrAi6cv301CXjM4WivvV');
    define ('RECAPTCHA_SITE_SECRET', '6LdEydsZAAAAAIhaus2epSGOzP45ZjCBPti9lZdB');

    //FEP domain email 
    define('EMAIL_SENDER_NAME', 'Female Entrepreneurs Belize');
    define('EMAIL_SENDER', 'beltraide.software.developer@gmail.com');//noreply@femaleentrepreneurs.bz');
    define('EMAIL_SENDER_PASS', 'cgjwpvmobzidmmbk');//'B37tr41d3D3v');//'*FC8VV7p5$PEXp@');
    
    //Unit email incharge of FEP
    define('EMAIL_RECEIVER', 'beltraide.software.developer@gmail.com');

?>
