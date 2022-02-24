<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Helpers;
use Illuminate\Support\Str;
use App\Http\Requests\StoreSaveRequest;
use App\Http\Requests\StoreAutoRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Userdata;
use App\Events\ProcessUserdataEvent;
use App\Events\ProcessAutoUserdataEvent;

class ProcessController extends Controller
{
    public function save(StoreSaveRequest $request)
    {
        // Retrieve the validated input data...
        $validated = $request->validated();

        $number = Helpers::encrypt_decrypt_js('decrypt', $request->phone_number);

        // Modify std phone number
        $number = Str::replace('+62', '0', $number);
        $ignored = ["-", " "];
        $number = str_replace($ignored, "", $number);
        $data = [
            //'user_id' => Helpers::encrypt_decrypt_js('encrypt', Auth::id()),         
            //'phone_number' => $request->phone_number,
            'user_id' => Auth::id(),
            'phone_number' => $number,
            'provider' => Helpers::setProvider($number),
            'number_type' => Helpers::ganjilGenap($number),
        ];

        $userdata = new Userdata();
        $userdata->user_id = $data['user_id'];
        $userdata->phone_number = $data['phone_number'];
        $userdata->provider = $data['provider'];
        $userdata->number_type = $data['number_type'];
        $userdata->save();


        ProcessUserdataEvent::dispatch($userdata);
        $userdata->user_id = Helpers::encrypt_decrypt_js('encrypt', $data['user_id']);
        $userdata->phone_number = Helpers::encrypt_decrypt_js('encrypt', $data['phone_number']);
        return response()->json($userdata);
    }

    public function auto(StoreAutoRequest $request)
    {
        // Retrieve the validated input data...
        $validated = $request->validated();

        $data = [];
        for ($i = 0; $i < $request->total; ++$i) {
            $number = Helpers::numberPrefixes[array_rand(Helpers::numberPrefixes)] . Helpers::randomNumberSequence();
            $data[] = [
                //'user_id' => Helpers::encrypt_decrypt_js('encrypt', Auth::id()),                
                //'phone_number' => Helpers::encrypt_decrypt_js('decrypt', $number),
                'user_id' => Auth::id(),
                'phone_number' => $number,
                'provider' => Helpers::setProvider($number),                
                'number_type' => Helpers::ganjilGenap($number),
            ];
        }

        $userdata = [];
        foreach($data as $row) {
            $userdata[] = Userdata::create($row);
        }
        event(new ProcessAutoUserdataEvent($userdata));

        $auto = collect($data)->map(function ($item, $key) {
            $item['user_id'] = Helpers::encrypt_decrypt_js('encrypt', $item['user_id']);
            $item['phone_number'] = Helpers::encrypt_decrypt_js('encrypt', $item['phone_number']);

            return $item;
        });
        return response()->json($auto->all());
    }
}
