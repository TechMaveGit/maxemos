<?php
namespace App\Libraries;
define('OPENSSL_CIPHER_NAME', 'aes-128-cbc');
define('CIPHER_KEY_LEN', 16);//128 bits

class AesCipher {
    private static function fixKey($key) {

        if (strlen($key) < CIPHER_KEY_LEN) {
            //0 pad to len 16
            return str_pad("$key", CIPHER_KEY_LEN, "0");
        }

        if (strlen($key) > CIPHER_KEY_LEN) {
            //truncate to 16 bytes
            return substr($key, 0, CIPHER_KEY_LEN);
        }
        return $key;
    }

    static function getIV() {
        $iv = openssl_random_pseudo_bytes(openssl_cipher_iv_length(OPENSSL_CIPHER_NAME));
        return $iv;
    }

    /**
     * Encrypt data using AES Cipher (CBC) with 128 bit key
     *
     * @param type $key - key should be 16 bytes long (128 bits)
     * @param type $iv - initialization vector
     * @param type $data - data to encrypt
     * @return encrypted data in base64 encoding with "iv" attached at end after a colon":"
     */

    static function encrypt($key, $iv, $data) {
        $key=hash ( 'sha512' , $key,false );
        $key=substr($key,0,16);
        $encodedEncryptedData = base64_encode(openssl_encrypt($data, OPENSSL_CIPHER_NAME,
        AesCipher::fixKey($key), OPENSSL_RAW_DATA, $iv));
        $encodedIV = base64_encode($iv);
        $encryptedPayload = $encodedEncryptedData.":".$encodedIV;
        return $encryptedPayload;
    }

    /**
     * Decrypt data using AES Cipher (CBC) with 128 bit key
     *
     * @param type $key - key should be 16 bytes long (128 bits)
     * @param type $data - data to be decrypted in base64 encoding with iv attached at the end after a colon":"
    * @return decrypted data
    */
    static function decrypt($key, $data) {
        $key = hash('sha512',$key,false );
        $key = substr($key,0,16);
        $parts = explode(':', $data); //Separate Encrypted data from iv.
        $encrypted = $parts[0];
        $iv = $parts[1];
        $decryptedData = openssl_decrypt(base64_decode($encrypted),OPENSSL_CIPHER_NAME,
        AesCipher::fixKey($key), OPENSSL_RAW_DATA, base64_decode($iv));
        return $decryptedData;
    }
};

// generating random IV string
// $iv = AesCipher::getIV();

// calling the encrypt method by passing token/password (provided by AuthBridge), iv, json data(required to be encrypted)
// $encrypted = AesCipher::encrypt('Auth@135',$iv,
// '{"transID":"13","docType":"2","docNumber":"dbvpk2018f"}');
// echo "Encrypted Data => ".$encrypted; // Print Encrypted Data
// calling the decrypt method by passing token and encrypted data (required to be decrypted)
//{"responseData":"+ccqKkdH7TyoDKFc5P6kXZaUO/XMCNFxNMumnmReFH8kpDtPsxpi/P5Dp58dETuk7yvYoPXn2ll1T8w4xD9IdSXTr5DxQG01Sf7765lzcAN46ZbTT4zU434Bpf8UrZmkWkfybHpfyx4J7TkA0znuuKE51YlG/w/6qmfTDTFWUsv0Qb3PhWw9MhzYTLx7H92fZGRhkAY4ED5KJpoNbnjnOmnJvBy8tXYFEmyUeIQmSKGySPyA6ULTyc37lN7kYrwRVvwWpH0e9BJ6mtUdKSzaww==:FGSovFZgllN/kMkWBznhog=="}
// $decrypted = AesCipher::decrypt('Auth@135', 'p+BMtr/uhnLAUvkm4eQm2qA+AlpCnKa0LD81JDejSfcNPyc1a2S9GPntn7lkAjkBr1efEbKTIy2gycjBY2Y8V5RnXGWmMipbMyDRI0L2kahSHCqc1NdG3+n6nrLksPmNRZBz4xGaZAtANWY1TgIRXVxBIgvz53zveSzqTHIFvfpElvaukDpEPuvjt6tJvTy2O0Y7Y2r8OveRz60PW1nZTc+ok7IUBhqYMmP73SgDnXMikyJDHqp/6zqxSbm2xiXDHwfU/X/Xqh1zPBZuv/X5Ag==:goQZIydXBERsc1oQK1b7bw==');
// echo "Encrypted Data => ".base64_decode($decrypted); // Print Decrypted Data
// var_dump(json_decode($decrypted));
// exit();
?>
