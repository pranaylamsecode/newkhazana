<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Permission\Traits\HasRoles;

class Category extends Authenticatable
{
    use Notifiable,SoftDeletes,HasRoles;

    protected $table = 'category';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'desc',
        'start_time',
        'end_time',
        'status'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
   /*  protected $hidden = [
        'password',
        'remember_token',
    ]; */

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    /* protected $casts = [
        'email_verified_at' => 'datetime',
        'two_factor_expires_at' => 'datetime',
    ]; */

    public static function createRecord($obj)
    {
        return self::create($obj);
    }

    public static function updateRecord($obj, $id)
    {
        return self::where('id', '=', $id)->updateOrCreate($obj);
    }


}
