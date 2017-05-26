<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFileReportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('file_reports', function (Blueprint $table) {
            $table->increments('id');
            $table->uuid('uuid')->unique();
            $table->unsignedInteger('file_id');
            $table->unsignedInteger('user_id')->nullable()->default(null);
            $table->string('name', 50)->nullable()->default(null);
            $table->string('email', 100)->nullable()->default(null);
            $table->enum('status', [
                'pending',
                'processing',
                'deleted',
                'rejected',
            ])->default('pending');
            $table->text('message');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('file_reports');
    }
}
