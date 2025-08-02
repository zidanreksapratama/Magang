<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('employees', function (Blueprint $table) {
            $table->mediumIncrements('id'); 
            $table->string('name', 30);
            $table->string('email', 50)->unique();
            $table->string('password', 60);
            $table->tinyInteger('role_id')->unsigned();
            $table->smallInteger('tenant_company_id')->unsigned();
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();

            $table->foreign('role_id')->references('id')->on('roles');
            $table->foreign('tenant_company_id')->references('id')->on('tenant_companies');
        });
    }

    public function down(): void {
        Schema::dropIfExists('employees');
    }
};


