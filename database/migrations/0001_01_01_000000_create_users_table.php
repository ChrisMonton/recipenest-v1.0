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
        // Create the users table with additional profile columns
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('first_name'); // First name of the user
            $table->string('surname');    // Last name of the user
            // $table->string('name'); // Optional: removed since we are using first_name and surname
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');

            // Additional fields for user profile
            $table->string('phone')->nullable();
            $table->date('date_of_birth')->nullable();
            $table->enum('role', ['user', 'chef'])->default('user');

            // Additional profile columns
            $table->text('bio')->nullable();               // For a short biography
            $table->string('profile_picture')->nullable(); // For storing the filename/path to the profile image
            $table->string('specialties')->nullable();       // For a comma-separated list (or description) of specialties (e.g., frying, bbq, vegies)

            $table->rememberToken();
            $table->timestamps();
        });

        // Create the password_reset_tokens table
        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });

        // Create the sessions table
        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });

        Schema::create('followers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('followed_id');
            $table->unsignedBigInteger('follower_id');
            $table->timestamps();

            $table->foreign('followed_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('follower_id')->references('id')->on('users')->onDelete('cascade');
            $table->unique(['followed_id', 'follower_id']);
        });



    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('sessions');
        Schema::dropIfExists('followers');

    }
};
