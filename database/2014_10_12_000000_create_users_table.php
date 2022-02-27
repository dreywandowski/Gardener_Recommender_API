<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;


class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('fullname');
            $table->string('email')->unique();
            $table->string('location');
            $table->string('country');
            $table->boolean('is_customer');
            $table->string('assigned_gardener');
            $table->string('assigned_customer');
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();

        });

        // self-referencing foreign keys for assigning gardeners and customers
       // Schema::table('users', function (Blueprint $table)
        //{
           // $table->foreign('assigned_gardener')->references('fullname')->on('users')->onUpdate('cascade')->onDelete('cascade');
            //$table->foreign('assigned_customer')->references('fullname')->on('users')->onUpdate('cascade')->onDelete('cascade');
        //});
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
