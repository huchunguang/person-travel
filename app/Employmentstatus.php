<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Employmentstatus extends Model {
	
	protected $table = 'employmentstatus';
	
	protected $primaryKey = 'EmploymentStatusID';
	
	protected $hidden = array (
		
	);
	protected $guarded = [
		
		''
	];
	
}
