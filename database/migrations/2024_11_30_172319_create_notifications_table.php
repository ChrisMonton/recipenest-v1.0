<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNotificationsTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('notifications', function (Blueprint $table) {
            // Using a UUID as primary key is the default in Laravel.
            $table->uuid('id')->primary();

            // The type of the notification, e.g., App\Notifications\SomeNotification.
            $table->string('type');

            // Polymorphic relationship fields: notifiable_type and notifiable_id,
            // which indicate the model that receives the notification (usually your User).
            $table->morphs('notifiable');

            // A text column to store a JSON representation of your notification data.
            $table->text('data');

            // An optional timestamp to indicate when a notification was read.
            $table->timestamp('read_at')->nullable();

            // Timestamps for when the notification was created/updated.
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('notifications');
    }
}
