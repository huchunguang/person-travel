<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

class RenameTableOvetimeShiftToOvertimeShifts extends Migration
{

	/**
	 * Run the migrations.
	 * 
	 * @return void
	 */
	public function up()
	{
		Schema::rename('ovetime_shifts', 'overtime_shifts');
	}

	/**
	 * Reverse the migrations.
	 * 
	 * @return void
	 */
	public function down()
	{
		//
	}
}
