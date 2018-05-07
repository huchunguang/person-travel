<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTripInsurancesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('trip_insurances', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('nominee_name',100);
			$table->string('passport_fullname',50);
			$table->string('nric_no',50);
			$table->string('nric_num',50);
			$table->string('elationship');
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
		Schema::drop('trip_insurances');
	}

}
