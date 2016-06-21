<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('dotenv_path')->default('/');
            $table->boolean('active')->default(true);
            $table->string('dotenv_name')->default('.env');
            $table->string('dotenv_staging')->default('.env-staging');
            $table->string('dotenv_draft')->default('.env-temp');
            $table->string('dotenv_backup')->default('.env-backup');
            $table->dateTime('published_at')->nullable();
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
        Schema::drop('projects');
    }
}
