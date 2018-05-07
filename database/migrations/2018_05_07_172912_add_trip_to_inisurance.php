<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

class AddTripToInisurance extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('trip_insurances',function(Blueprint $table){
			$table->integer('trip_id')->after('id');
			$table->string('insurance_type','10')->default('')->after('id');
// 			$table->string('elationship',250)->nullable()->change();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('trip_insurances',function(Blueprint $table){
			$table->dropColumn('trip_id');
// 			$table->string('elationship')->change();
		});
	}

}
