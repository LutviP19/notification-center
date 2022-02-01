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

    public function enkripsi(Request $request)
    {
        $plain_txt = "0812-8888-7777";
        $enc_txt = "33313538366562623330346230326164:c87b059e65a4f88dc0576176640406a8";
        echo "Plain Text =" . $plain_txt . "\n<br>";
        echo "Enc Text =" . $enc_txt . "\n<br>";

        $encrypted_txt = Helpers::encrypt_decrypt('encrypt', $plain_txt);
        echo "Encrypted Text = " . $encrypted_txt . "\n<br>";

        $decrypted_txt = Helpers::encrypt_decrypt('decrypt', $encrypted_txt);
        echo "Decrypted Text =" . $decrypted_txt . "\n<br>";

        $decrypted_txt2 = Helpers::encrypt_decrypt('decrypt', $enc_txt);
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
