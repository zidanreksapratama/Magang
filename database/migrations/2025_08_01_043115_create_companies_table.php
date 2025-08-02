<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('companies', function (Blueprint $table) {
            $table->smallIncrements('id'); 
            $table->string('name', 30);
            $table->string('email', 50)->unique();
            $table->string('password', 60); 
            $table->tinyInteger('role_id')->unsigned(); 
            $table->smallInteger('parent_company_id')->unsigned()->nullable();
            $table->timestamp('created_at')->useCurrent();

            $table->foreign('role_id')->references('id')->on('roles');
            $table->foreign('parent_company_id')->references('id')->on('companies');
        });
    }

    public function down(): void {
        Schema::dropIfExists('companies');
    }
};



