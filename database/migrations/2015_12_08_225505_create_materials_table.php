<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMaterialsTable extends Migration
{

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		// Create the `Materials` table
		Schema::create('materials', function (Blueprint $table) {
			$table->engine = 'InnoDB';
			$table->increments('id')->unsigned();
			$table->unsignedInteger('user_id')->nullable();
			$table->foreign('user_id')->references('id')->on('users')->onDelete('set null');
			$table->string('title')->nullable();
			$table->string('slug')->nullable();
			$table->text('target_language')->nullable();
			$table->text('objective')->nullable();
			$table->tinyInteger('time_needed_prep')->nullable();
			$table->tinyInteger('time_needed_class')->nullable();
			$table->text('materials')->nullable();
			$table->text('procedure_before')->nullable();
			$table->text('procedure_in')->nullable();
			$table->text('follow_up')->nullable();
			$table->text('variations')->nullable();
			$table->text('tips')->nullable();
			$table->text('notes')->nullable();
			$table->timestamps();
            $table->softDeletes();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('materials');
	}

}
