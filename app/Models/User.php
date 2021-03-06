<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Support\Facades\Storage;

class User extends Authenticatable
{
    const ENABLE = TRUE;
    const DISABLED = FALSE;
    const SUPERADMIN = 1;

    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function setPasswordAttribute($password)
    {
        $this->attributes['password'] = bcrypt($password);
    }

    public function getUserName()
    {
        return ucfirst($this->name);
    }

    public function getUserProfile()
    {
        return !empty($user->avatar) ? asset(Storage::url($operator->avatar)) : asset('images/avatar.png');;
    }

    public function CreatedBy()
    {
        return ($this->parent_id == '0' || $this->parent_id == '1') ? $this->id : $this->parent_id;
    }

    public function isAdmin()
    {
        return $this->parent_id == 0 && $this->is_active == 1;
    }

    public function isUser()
    {
        return $this->parent_id == 1 && $this->is_active == 1;
    }

    public function operatorPermission()
    {
        $shop_owner_permissions = array(
            ["name" => "Edit Profile"],
            ["name" => "Change Password"],
            ["name" => "Manage Manual Order"],
            ["name" => "Manage Order"],
            ["name" => "Edit Order"],
            ["name" => "Print Order"],
            ["name" => 'Manage Customer'],
            ["name" => "Edit Customer"],
            ["name" => "Create Customer"],
        );
        return $shop_owner_permissions;
    }

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
