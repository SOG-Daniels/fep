<?php
    // helper.php defines functions that can be used throughout the application 
    // for example encrpt will be used to encrpt sensative data in the class.interface.php
    // by which decrypt will be used in the index.php to decrpt $_GET encrypted Data

    //Encrypts data
    function encrypt($string){ 
        
        // Use OpenSSl Encryption method 
        $iv_length = openssl_cipher_iv_length(CIPHER_TYPE); 
        
        // Use openssl_encrypt() function to encrypt the data 
        $encryption = openssl_encrypt($string, CIPHER_TYPE, CIPHER_KEY, CIPHER_OPTIONS, ENCRYPTION_IV); 

        return base64_encode($encryption);
    } 
    //Decrypts encrypted data
    function decrypt($hash){ 

        // Use openssl_decrypt() function to decrypt the data 
        $data = openssl_decrypt (base64_decode($hash), CIPHER_TYPE, CIPHER_KEY, CIPHER_OPTIONS, DECRYPTION_IV); 

        return $data;
    }
    
?>