<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Sanctum\HasApiTokens;

class Employees extends Authenticatable
{
    use HasApiTokens, HasFactory;

    protected $table = 'employees';

    protected $fillable = ['name', 'email', 'password', 'tenant_company_id', 'role_id'];

    protected $hidden = ['password'];

    public function tenantCompany()
    {
        return $this->belongsTo(TenantCompany::class);
    }
}


