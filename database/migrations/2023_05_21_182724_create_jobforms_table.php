<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJobformsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jobforms', function (Blueprint $table) {
            $table->id();
            $table->string('photo')->nullable();
            $table->string('resume')->nullable();    
            $table->string('name')->nullable();
            $table->string('contact_number')->nullable();
            $table->string('date_of_birth')->nullable();
            $table->string('address')->nullable();
            $table->string('postal_code')->nullable();
            $table->integer('country_id')->nullable();
            $table->string('country_name')->nullable();
            $table->integer('state_id')->nullable();
            $table->string('state_name')->nullable();
            $table->integer('city_id')->nullable();
            $table->string('city_name')->nullable();
            $table->string('gender')->nullable();
            $table->string('marital_status')->nullable();
            $table->string('work_experience')->nullable();
            $table->string('company_name')->nullable();
            $table->string('designation')->nullable();
            $table->string('duration_from')->nullable();
            $table->string('duration_upto')->nullable();
            $table->integer('user_id')->nullable();
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
        Schema::dropIfExists('jobforms');
    }
}
