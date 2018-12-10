<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSmsirlaravelLogTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('smsirlaravel_logs', function (Blueprint $table) {
			$table->increments('id');
			$table->string('from',100)->nullable();
			$table->string('to',100)->nullable();
			$table->string('message',500)->nullable();
			$table->boolean('status')->nullable();
			$table->string('response',500)->nullable();
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
		Schema::dropIfExists('smsirlaravel_logs');
	}
}
