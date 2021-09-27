<?php

namespace App\Models\Tenancy;

use App\Models\Tenancy\Permission as TenancyPermission;
use App\Models\Tenancy\Role as TenancyRole;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Contracts\Permission;
use Spatie\Permission\Contracts\Role;
use Spatie\Permission\Traits\HasRoles;
use Tenancy\Affects\Connections\Support\Traits\OnTenant;

class User extends Authenticatable
{
    use HasFactory, OnTenant, HasApiTokens, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * @return string
     */
    public function guardName(): string
    {
        return 'tenancy';
    }

    /**
     * @return Role
     */
    public function getRoleClass(): Role
    {
        if (!isset($this->roleClass)) {
            $this->roleClass = app(TenancyRole::class);
        }

        return $this->roleClass;
    }

    /**
     * @return Permission
     */
    public function getPermissionClass(): Permission
    {
        if (!isset($this->permissionClass)) {
            $this->permissionClass = app(TenancyPermission::class);
        }

        return $this->permissionClass;
    }
}
