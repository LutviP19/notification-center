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
            if (hash_equals($hmac, $calcmac)) {
                $output = $original_plaintext;
            }
        }

        return $output;
    }

    static function encrypt($message)
    {
        if (OPENSSL_VERSION_NUMBER <= 268443727) {
            throw new RuntimeException('OpenSSL Version too old, vulnerability to Heartbleed');
        }

        //$iv_size        = openssl_cipher_iv_length(AES_METHOD);
        $iv = env('OPENSSL_SECRET_IV');
        $ciphertext = openssl_encrypt($message, AES_METHOD, env('OPENSSL_SECRET_KEY'), OPENSSL_RAW_DATA, $iv);
        $ciphertext_hex = bin2hex($ciphertext);
        $iv_hex = bin2hex($iv);
        return "$iv_hex:$ciphertext_hex";
    }

    static function decrypt($ciphered)
    {
        //$iv_size    = openssl_cipher_iv_length("AES-128-CBC");
        $data = explode(":", $ciphered);
        $iv = hex2bin($data[0]);
        $ciphertext = hex2bin($data[1]);
        return openssl_decrypt($ciphertext, "AES-128-CBC", env('OPENSSL_SECRET_KEY'), OPENSSL_RAW_DATA, $iv);
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
