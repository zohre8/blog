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
        Schema::table('posts', function (Blueprint $table) {
            $table->string('slug');
            $table->string('meta_description')->nullable();
            $table->string('meta_title')->nullable();
            $table->unsignedInteger('user_id');
            $table->unsignedInteger('photo_id');
            $table->unsignedInteger('category_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('photo_id')->references('id')->on('photos');
            $table->foreign('category_id')->references('id')->on('categories');
            $table->boolean('is_published')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('posts', function (Blueprint $table) {
            $table->dropColumn('slug');
            $table->dropColumn('meta_description');
            $table->dropColumn('meta_title');
            $table->dropColumn('user_id');
            $table->dropColumn('photo_id');
            $table->dropColumn('category_id');
            $table->dropColumn('is_published');
        });
    }
};
