<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePermissionFilters extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('permission_filters', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('group_id');
            $table->enum('type', ['alliance', 'corporation', 'user']);
            $table->bigInteger('type_id');
            $table->boolean('inverse');
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
        Schema::dropIfExists('permission_filters');
    }
}
