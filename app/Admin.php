<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model as Eloquent;
use App\Notifications\ResetPassword as ResetPasswordNotification;

class Admin extends Authenticatable
{
    use Notifiable;

    protected $dates = [
    'created_at',
    'updated_at',
    'birthday',
    'card_build_at',
    'card_expire_at',
    'work_at'
    ];

    public function role(){
        return $this->BelongsTo(Role::class);
    } 

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
    'role_id',
    'email',
    'password',
    'title',
    'firstname',
    'lastname',
    'card_id',
    'card_build_at',
    'card_expire_at',
    'gender',
    'birthday',
    'tel',
    'address',
    'work_at'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
    'password', 'remember_token',
    ];

    public function sendPasswordResetNotification($token)
    {
        // Your your own implementation.
        $this->notify(new ResetPasswordNotification($token));
    }
}
