<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLayananTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('requests', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('service_id');
            $table->string('title',200);
            $table->text('business_need');
            $table->text('business_benefit');
            $table->text('attachment');
            $table->text('detail')->nullable();
            $table->string('ticket',100);
            $table->unsignedInteger('user_id');
            $table->unsignedInteger('stage_id');
            $table->timestamps();
        });

        Schema::create('statuses', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name',100);
            $table->timestamps();
        });

        Schema::create('services', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name',100);
            $table->timestamps();
        });

        Schema::create('stages', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name',100);
            $table->timestamps();
        });

        Schema::create('incidents', function (Blueprint $table) {
            $table->increments('id');
            $table->text('description');
            $table->text('impact');
            $table->unsignedInteger('user_id');
            $table->unsignedInteger('stage_id');
            $table->timestamps();
        });

        Schema::create('request_approvals', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('request_id');
            $table->unsignedInteger('user_id');
            $table->unsignedInteger('status_id');
            $table->timestamps();
        });

        Schema::create('incident_approvals', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('incident_id');
            $table->unsignedInteger('user_id');
            $table->unsignedInteger('status_id');
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
        Schema::dropIfExists('requests');
        Schema::dropIfExists('services');
        Schema::dropIfExists('incidents');
        Schema::dropIfExists('statuses');
        Schema::dropIfExists('stages');
        Schema::dropIfExists('request_approvals');
        Schema::dropIfExists('incident_approvals');
    }
}
