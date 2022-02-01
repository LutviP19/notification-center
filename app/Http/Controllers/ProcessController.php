<?php

namespace App\Http\Controllers;

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

        $output = array_merge($validated, [
            //'enkripsi' => Helpers::encrypt_decrypt('decrypt',$request->enkripsi)
        ]);

        return response()->json($output);
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

        return response()->json($data);
    }
}
