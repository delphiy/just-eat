<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Cashier\Billable;

class User extends Authenticatable
{
    use HasFactory, Notifiable, Billable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function basket()
    {
        return $this->hasMany(Basket::class);
    }

    public function getBasketTotal()
    {
        return $this->basket->sum(function ($item) {
            return $item->qty * $item->price;
        });
    }

    public function permissions()
    {
        return $this->hasManyThrough(
            Permission::class,
            UserPermission::class,
            'user_id',
            'id',
            'id',
            'permission_id'
        );
    }

    public function hasPermission($permission)
    {
        return in_array($permission, $this->permissions->pluck('name')->toArray()); //is rule in user permission
    }

}
