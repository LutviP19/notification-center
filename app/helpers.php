<?php

namespace App;

use Illuminate\Support\Str;
use RuntimeException;

class Helpers
{
    const providers = [
        'telkomsel' => ['0811', '0812', '0813', '0821', '0852'],
        'xl' => ['0817', '0818', '0819'],
        'tri' => ['0895', '0896', '0897']
    ];

    const numberPrefixes = ['0811', '0812', '0813', '0821', '0852', '0817', '0818', '0819', '0895', '0896', '0897'];

    public function __construct()
    {
        //
    }

    /**
     * @param null $action
     * @param string $plaintext
     * @return string|null
     */
    static function encrypt_decrypt_js($action, $plaintext)
    {
        $output = null;
        $key = env('OPENSSL_SECRET_KEY');
        $iv = env('OPENSSL_SECRET_IV');
        $method = env('OPENSSL_AES_METHOD_JS');

        if ($action == 'encrypt') {
            $e = openssl_encrypt( $plaintext, $method, hex2bin( $key ), 0, hex2bin( $iv ));
            $output = bin2hex( base64_decode( $e ));
        }
        else if ($action == 'decrypt') {
            $e = base64_encode(hex2bin($plaintext));
            $output = openssl_decrypt( $e, $method, hex2bin( $key ), 0, hex2bin( $iv ));
        }

        return $output;
    }

    static function encrypt($message)
    {
        if (OPENSSL_VERSION_NUMBER <= 268443727) {
            throw new RuntimeException('OpenSSL Version too old, vulnerability to Heartbleed');
        }

        //$iv_size        = openssl_cipher_iv_length(AES_METHOD);
        $iv = hex2bin( env('OPENSSL_SECRET_IV'));
        $ciphertext = openssl_encrypt($message, env('OPENSSL_AES_METHOD'), hex2bin( env('OPENSSL_SECRET_KEY')), OPENSSL_RAW_DATA, $iv);
        $ciphertext_hex = bin2hex($ciphertext);
        $iv_hex = bin2hex($iv);
        //return "$iv_hex:$ciphertext_hex";
        return $ciphertext_hex;


        /*$key = hex2bin( env('OPENSSL_SECRET_KEY'));
        $cipher = env('OPENSSL_AES_METHOD');
        $iv = hex2bin( env('OPENSSL_SECRET_IV'));  // max length 16 characters
        $ciphertext_raw = openssl_encrypt($message, $cipher, $key, $options = OPENSSL_RAW_DATA, $iv);
        $hmac = hash_hmac('sha256', $ciphertext_raw, $key, $as_binary = true);

        return base64_encode($iv . $hmac . $ciphertext_raw);*/
    }

    static function decrypt($ciphered)
    {
        $ivlen = openssl_cipher_iv_length($cipher = env('OPENSSL_AES_METHOD'));
        $c = hex2bin($ciphered);
        $iv = hex2bin( env('OPENSSL_SECRET_IV'));
        //$data = explode(":", $ciphered);
        //$iv = hex2bin($data[0]);
        //$ciphertext = hex2bin($data[1]);
        return openssl_decrypt($c, env('OPENSSL_AES_METHOD'), hex2bin( env('OPENSSL_SECRET_KEY')), OPENSSL_RAW_DATA, $iv);


        /*$output = null;
        $ivlen = openssl_cipher_iv_length($cipher = env('OPENSSL_AES_METHOD'));
        $key = hex2bin( env('OPENSSL_SECRET_KEY'));
        $c = base64_decode($ciphered);
        $iv = substr($c, 0, $ivlen);
        $hmac = substr($c, $ivlen, $sha2len = 32);
        $ciphertext_raw = substr($c, $ivlen + $sha2len);
        $original_plaintext = openssl_decrypt($ciphertext_raw, $cipher, $key, $options = OPENSSL_RAW_DATA, $iv);
        $calcmac = hash_hmac('sha256', $ciphertext_raw, $key, $as_binary = true);
        if (hash_equals($hmac, $calcmac)) {
            $output = $original_plaintext;
        }

        return $output;*/
    }

    static function randomNumberSequence($requiredLength = 7, $highestDigit = 8)
    {
        $sequence = '';
        for ($i = 0; $i < $requiredLength; ++$i) {
            $sequence .= mt_rand(0, $highestDigit);
        }
        return $sequence;
    }

    static function ganjilGenap($number = false)
    {
        if ($number) {
            $akhiran = (int)substr($number, -1);
            return ($akhiran % 2 == 0) ? 'genap' : 'ganjil';
        }

        return null;
    }

    static function setProvider($number = false)
    {

        if ($number) {
            switch ($number) {
                case Str::of($number)->contains(['0811', '0812', '0813', '0821', '0852']):
                    $providers = 'telkomsel';
                    break;
                case Str::of($number)->contains(['0817', '0818', '0819']):
                    $providers = 'xl';
                    break;
                case Str::of($number)->contains(['0895', '0896', '0897']):
                    $providers = 'tri';
                    break;
                default:
                    $providers = 'undefined';
            }

            return $providers;
        }

        return null;
    }
}
