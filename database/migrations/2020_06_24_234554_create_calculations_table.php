<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCalculationsTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('calculations', function (Blueprint $table) {
			$table->id();
			$table->date('date');
			$table->unsignedInteger('work_time');
			$table->unsignedInteger('absence_time');
			$table->unsignedInteger('defective_time');
			$table->foreignId('user_id');
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
		Schema::dropIfExists('calculations');
	}
}