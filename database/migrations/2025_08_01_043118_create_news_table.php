<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNewsTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('news', function (Blueprint $table) {
            $table->id(); // sama dengan `id INT(11) NOT NULL PRIMARY KEY AUTO_INCREMENT`
            $table->string('title', 255);
            $table->text('content');
            $table->string('image', 255)->nullable();
            $table->timestamp('created_at')->nullable()->useCurrent();
            $table->timestamp('updated_at')->nullable()->useCurrent()->useCurrentOnUpdate();
            $table->unsignedBigInteger('created_by_company_id')->nullable();
            $table->unsignedBigInteger('created_by_tenant_id')->nullable();

        });
    }

    public function down(): void
    {
        Schema::dropIfExists('news');
    }
}
