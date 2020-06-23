<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAttendancesTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('attendances', function (Blueprint $table) {
			$table->id();
			$table->timestamp('date')->nullable();
			$table->boolean('is_sign_in')->nullable();
			$table->foreignId('user_id')->nullable();
			$table->boolean('is_processed');
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
		Schema::dropIfExists('attendances');
	}
}