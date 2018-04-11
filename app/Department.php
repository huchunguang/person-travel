<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Department extends Model {

	//
    protected $table = 'department';
    public function approver()
    {
        return $this->hasOne('App\Department_approver','DepartmentID','DepartmentID');
    }
}
