<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Helpers;
use App\Http\Requests\StoreSaveRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProcessController extends Controller
{
    public function save(StoreSaveRequest $request)
    {
        // Retrieve the validated input data...
        $validated = $request->validated();

        $number = Helpers::encrypt_decrypt_js('decrypt', $request->phone_number);
        $output = array_merge($validated, [
            'phone_number' => $number,
            'number_type' => Helpers::ganjilGenap($number),
            'providers' => Helpers::setProvider($number),
        ]);

        $data = [
            'user_id' => Auth::id(),
            'providers' => Helpers::setProvider($number),
            'phone_number' => $request->phone_number,
            'number_type' => Helpers::ganjilGenap($number),
        ];

        return response()->json($data);
    }

    public function auto(Request $request)
    {
        $data = [];
        for ($i = 0; $i < 500; ++$i) {
            $number = Helpers::numberPrefixes[array_rand(Helpers::numberPrefixes)] . Helpers::randomNumberSequence();
            $data[] = [
                'user_id' => Auth::id(),
                'providers' => Helpers::setProvider($number),
                'phone_number' => Helpers::encrypt_decrypt_js('encrypt', $number),
                'number_type' => Helpers::ganjilGenap($number),
            ];
        }

        return response()->json($data);
    }
}
