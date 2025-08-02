<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    public $timestamps = false;
    protected $fillable = ['name'];

    public function companies() {
        return $this->hasMany(Company::class);
    }

    public function tenantCompanies() {
        return $this->hasMany(TenantCompany::class);
    }
}

