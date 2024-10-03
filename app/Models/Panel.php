<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Permission\Traits\HasRoles;

class Panel extends Authenticatable
{
    use Notifiable,SoftDeletes,HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',

'monday',
'tuesday',
'wednesday',
'thursday',
'friday',
'saturday',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */


    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */


    public static function createRecord($obj)
    {
        return self::create($obj);
    }

    public static function updateRecord($obj, $id)
    {
        return self::where('id', '=', $id)->updateOrCreate($obj);
    }


}
