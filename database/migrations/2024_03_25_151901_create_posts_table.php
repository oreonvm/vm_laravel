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
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->string('title', 100);
            $table->string('slug')->unique()->nullable();
            $table->mediumText('content')->nullable(false);
            //  $table->bigInteger('category_id')->unsigned();
            $table->foreignId('category_id')->nullable()->constrained()->cascadeOnUpdate()->cascadeOnDelete();
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->nullable(false);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::create('posts', function (Blueprint $table) {
            // $table->id();
            // $table->string('title', 100);
            // $table->string('slug')->unique()->nullable();
            // $table->foreignId('category_id')->nullable()->constrained()->cascadeOnUpdate()->cascadeOnDelete();
            // $table->mediumText('content')->nullable($value = false);;
            // $table->timestamp('created_at')->useCurrent();
            // $table->timestamp('updated_at', false);
        });
    }
};
