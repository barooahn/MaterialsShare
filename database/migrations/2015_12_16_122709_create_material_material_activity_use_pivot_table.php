<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMaterialMaterialActivityUsePivotTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('material_material_activity_use', function (Blueprint $table) {
            $table->integer('activity_use_id')->unsigned()->index();
            $table->foreign('activity_use_id')->references('id')->on('material_activity_uses')->onDelete('cascade');
            $table->integer('material_id')->unsigned()->index();
            $table->foreign('material_id')->references('id')->on('materials')->onDelete('cascade');
            $table->primary(['activity_use_id', 'material_id'],'activity_use_id_material_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('material_material_activity_use');
    }
}
