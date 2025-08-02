<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    protected $table = 'news';
    protected $fillable = ['title', 'content', 'image', 'created_by_tenant_id'];

    public function pic() {
        return $this->belongsTo(TenantCompany::class, 'image');
    }

    public function creator() {
        return $this->belongsTo(TenantCompany::class, 'created_by');
    }
}

