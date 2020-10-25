<?php 
    //constant variable uses throughout the php scripts
    // DEFINE('DB_USER', 'root');
    // DEFINE('DB_PASS', '');
    // DEFINE('DB_HOST', 'localhost');
    // DEFINE('DB_NAME', 'fep');
    define('BASE_URL', 'https://localhost/fep/');
    
    // fb defines
    define('FB_APP_ID', '719611568906304');
    define('FB_APP_SECRET', '8949e698eabb33ce24ee04ef4f7c6789');
    define('FB_REDIRECT_URI_REG', BASE_URL.'index.php/?page=register&registerBy=facebook');
    define('FB_REDIRECT_URI_SIGN', BASE_URL.'index.php/?page=signIn&signInBy=facebook');
	define('FB_GRAPH_VERSION', 'v8.0' ); // facebook graph version
	define('FB_GRAPH_DOMAIN', 'https://graph.facebook.com/' ); // base domain for api
    define('FB_APP_STATE', 'fepSignup');//verify state

    //LinkedIn API
    define('LI_CLIENT_ID', '770rgs4favjvpm');
    define('LI_CLIENT_SECRET', 'aJ2SKRLJ39ur2nRg');
    define('LI_REDIRECT_URI', BASE_URL.'index.php/?page=linkedinLogin');
    
    //Google API
    define('G_CLIENT_ID', '694832865050-98h9qvmvptukjps9ilsibcqn05ar3q2e.apps.googleusercontent.com');
    define('G_CLIENT_SECRET', 'qSMzeV0pPyoNFEIl6SatEyFE');
    define('G_REDIRECT_URI_REG', BASE_URL.'index.php/?page=register&registerBy=google');
    define('G_REDIRECT_URI_SIGN', BASE_URL.'index.php/?page=signIn&signInBy=google');


?>
