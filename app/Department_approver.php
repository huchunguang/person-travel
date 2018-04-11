<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Department_approver extends Model {

	//
    public function approverWithUserinfo() 
    {
        return $this->hasMany('App\User','UserID','Approver1');
    }
}
