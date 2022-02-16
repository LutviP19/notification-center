<?php

namespace App\Http\Controllers;

use App\Events\UserEvent;
use App\Helpers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use stdClass;

class TestController extends Controller
{
    public function hit(Request $request)
    {
        $usetdata = new stdClass();
        $usetdata->phone_number = $request->phone_number;
        $usetdata->provider = $request->provider;
        $usetdata->number_type = $request->number_type;

        event(new UserEvent($usetdata));
        //event(new NotificationEvent($request->phone_number ?: 'Monika'));
        return $usetdata;
    }

    public function form()
    {
        return view('form');
    }

    public function crypto(Request $request)
    {
        /*$data = "hello! this is a test!";
        $method = 'aes-256-cbc';
        $key = '59b6ab46d379b89d794c87b74a511fbd59b6ab46d379b89d794c87b74a511fbd';
        $iv = '0aaff094b6dc29742cc98a4bac8bc8f9';

        $e = openssl_encrypt( $data, $method, hex2bin( $key ), 0, hex2bin( $iv ));

        echo 'Ciphertext: [', bin2hex( base64_decode( $e )), "]<br>\n";
        echo 'Key:        [', $key, "]<br>\n";
        echo 'Cleartext:  [', openssl_decrypt( $e, $method, hex2bin( $key ), 0, hex2bin( $iv )), "]<br>\n";

// Test with openssl on the command line as well, just to be sure!
        file_put_contents( 'clear.txt', $data );

        $exec = "openssl enc -$method -e -in clear.txt -out encrypted.txt -base64 -nosalt -K $key -iv $iv";
        exec ($exec);
        $out = file_get_contents( 'encrypted.txt' );
        echo 'Ciphertext: [', bin2hex( base64_decode(trim($out))), "]<br>\n";*/


        $plain_txt = "0812-8888-7777";
        $enc_txt = env('OPENSSL_SECRET_KEY');
        echo "Plain Text =" . $plain_txt . "\n<br>";
        //echo "Enc Text =" . $enc_txt . "\n<br>";

        $encrypted_txt = Helpers::encrypt_decrypt_js('encrypt', $plain_txt);
        echo "Encrypted Text = " . $encrypted_txt . "\n<br>";

        $decrypted_txt = Helpers::encrypt_decrypt_js('decrypt', $encrypted_txt);
        echo "Decrypted Text =" . $decrypted_txt . "\n<br>";

        $decrypted_txt2 = hex2bin($enc_txt);
        echo "Decrypted ENV Text =" . $decrypted_txt2 . "\n<br>";

        if ($decrypted_txt === $plain_txt)
            echo "SUCCESS";
    }

    public function enkripsi(Request $request)
    {
        $plain_txt = "0812-8888-7777";
        //$enc_txt = "Cq/wlLbcKXQsyYpLrIvI+dWYLd6f3+AmC12mhqCRs1CLHapCq8tzjozxT7lAkicZYp/PnRtJHFDxM1YgcGp5Jg==";
        //$enc_txt = "0aaff094b6dc29742cc98a4bac8bc8f9:629fcf9d1b491c50f1335620706a7926";
        $enc_txt = "629fcf9d1b491c50f1335620706a7926";
        echo "Plain Text =" . $plain_txt . "\n<br>";
        echo "Enc Text =" . $enc_txt . "\n<br>";

        $encrypted_txt = Helpers::encrypt($plain_txt);
        echo "Encrypted Text = " . $encrypted_txt . "\n<br>";

        $decrypted_txt = Helpers::decrypt($encrypted_txt);
        echo "Decrypted Text =" . $decrypted_txt . "\n<br>";

        $decrypted_txt2 = Helpers::decrypt($enc_txt);
        echo "Decrypted Enc Text =" . $decrypted_txt2 . "\n<br>";

        if ($decrypted_txt === $plain_txt)
            echo "SUCCESS";
    }

    public function auto(Request $request)
    {
        $data = [];
        for ($i = 0; $i < 500; ++$i) {
            $number = Helpers::numberPrefixes[array_rand(Helpers::numberPrefixes)] . Helpers::randomNumberSequence();
            $data[] = [
                'user_id' => Auth::id(),
                'providers' => Helpers::setProvider($number),
                'phone_number' => $number,
                'number_type' => Helpers::ganjilGenap($number),
            ];
        }

        dump($data);
    }
}
