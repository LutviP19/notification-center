<?php

namespace App;

class Helpers
{

    public function __construct()
    {
        //
    }

    /**
     * @param null $action
     * @param string $plaintext
     * @return string|null
     */
    static function encrypt_decrypt($action, $plaintext)
    {
        $output = null;
        $key = env('OPENSSL_SECRET_KEY');
        $ivlen = openssl_cipher_iv_length($cipher = "AES-128-CBC");

        if ($action == 'encrypt') {
            $iv = env('OPENSSL_SECRET_IV');  // max length 16 characters
            $ciphertext_raw = openssl_encrypt($plaintext, $cipher, $key, $options = OPENSSL_RAW_DATA, $iv);
            $hmac = hash_hmac('sha256', $ciphertext_raw, $key, $as_binary = true);
            $output = base64_encode($iv . $hmac . $ciphertext_raw);
        } else if ($action == 'decrypt') {
            $c = base64_decode($plaintext);
            $iv = substr($c, 0, $ivlen);
            $hmac = substr($c, $ivlen, $sha2len = 32);
            $ciphertext_raw = substr($c, $ivlen + $sha2len);
            $original_plaintext = openssl_decrypt($ciphertext_raw, $cipher, $key, $options = OPENSSL_RAW_DATA, $iv);
            $calcmac = hash_hmac('sha256', $ciphertext_raw, $key, $as_binary = true);
            if (hash_equals($hmac, $calcmac))
            {
                $output = $original_plaintext;
            }
        }

        return $output;
    }

}
