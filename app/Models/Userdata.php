<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Notifications\Notifiable;
use stdClass;

class Userdata extends Model
{
    use HasFactory, Notifiable;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'userdatas';
    protected $fillable = [
        'user_id',
        'phone_number',
        'provider',
        'number_type',
    ];

    /* public function setUserIdAttribute($value)
    {

    }

    public function getUserIdAttribute($value)
    {

    }*/

    /**
     * @param stdClass $userdata
     * @return array
     */
    public static function formatNotificationData(stdClass $userdata)
    {
        $user_id = Auth::id();

        return [
            'user_id' => $user_id,
            'phone_number' => $userdata->phone_number,
            'provider' => $userdata->provider,
            'number_type' => $userdata->number_type,
        ];
    }
}
