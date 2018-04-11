<?php
namespace App\Http\Controllers\Etravel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request) 
    {
        return view('/etravel/dashboard/index');
    }
    public function unknownUser(Request $request) 
    {
        
        return view('/etravel/dashboard/unknownUser')->with('userName',$request->input('userName'));
    }
}