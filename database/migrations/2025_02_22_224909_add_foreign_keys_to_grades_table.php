<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysTogradesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::table('grades', function (Blueprint $table) {
            $table->unsignedBigInteger('enrollment_id')->change();
            $table->foreign('enrollment_id')->references('id')->on('enrollments')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

        Schema::table('grades', function (Blueprint $table) {
            $table->dropForeign(['enrollment_id']);
        });
    }
}