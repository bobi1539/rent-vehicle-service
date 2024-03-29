<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string("name")->nullable(false);
            $table->string("description")->nullable();
            $table->unsignedBigInteger("created_by");
            $table->string("created_by_name")->nullable();
            $table->unsignedBigInteger("updated_by");
            $table->string("updated_by_name")->nullable();
            $table->boolean("is_deleted")->nullable(false)->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('categories');
    }
};
