<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Sanctum\HasApiTokens;

class TenantCompany extends Authenticatable
{
    use HasApiTokens, HasFactory;

    public $timestamps = false; 

    protected $fillable = [
        'name',
        'email',
        'password',
        'address',
        'company_id',
        'role_id'
    ];
    

    protected $hidden = ['password'];

    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function company()
    {
        return $this->belongsTo(Company::class);
    }
}
