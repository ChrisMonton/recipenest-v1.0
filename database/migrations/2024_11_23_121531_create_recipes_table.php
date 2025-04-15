<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('recipes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('category')->default('food');
            $table->string('title', 100);
            $table->string('short_description', 500)->default('Short Description');
            $table->text('full_description');
            $table->text('ingredients');
            $table->text('instructions');
            $table->string('image');
            $table->integer('total_time')->default(1);
            $table->string('total_time_unit')->default('minutes')->comment('minutes,hours,days');
            $table->timestamp('publish_date')->useCurrent();
            $table->tinyInteger('featured')->default(0)->comment('1=featured,0=notfeatured');
            $table->tinyInteger('public')->default('1');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('recipes');
    }
};
