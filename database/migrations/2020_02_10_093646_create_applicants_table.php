<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateApplicantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('applicants', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->integer('age');
            $table->string('educational_attainment');
            $table->string('undergraduate_year_level')->nullable();
            $table->string('city');
            $table->string('recent_job_experience')->nullable()->default('N/A');
            $table->string('company')->nullable()->default('N/A');
            $table->string('years_of_work_experience');
            $table->string('resume_file');
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
        Schema::dropIfExists('applicants');
    }
}
