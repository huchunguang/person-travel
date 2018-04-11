<?php
namespace App\Http\Controllers\Etravel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\Department_approver;

class TripController extends Controller
{
    /**
     * @brief create trip 
     */
    public function create(Request $requset) 
    {
        $userName = $requset->get('userName');
        $userProfile= User::with('costcenter','department','site')->where('UserName',$userName)->first()->toArray();
        return view('/etravel/trip/create')->with('userProfile',$userProfile);
    }
    /**
     * @brief create demostic trip
     * @param Request $requset
     * @return \Illuminate\View\View
     */
    public function demosticCreate(Request $requset) 
    {
        $departmentFilter = array();
        $userName = $requset->get('userName');
        $userProfile = User::with('costcenter','department','site')->where('UserName',$userName)->first()->toArray();
//         dd($userProfile);
        if (!empty($userProfile)) 
        {
            $departmentFilter['SiteID'] = $userProfile['SiteID'];
            $departmentFilter['DepartmentID'] = $userProfile['DepartmentID'];
            $departmentFilter['CompanyID'] = $userProfile['CompanyID'];
            $approvers = Department_approver::where($departmentFilter)->first(['Approver1'])->toArray();
            $userIds = explode(',',$approvers['Approver1']);
            $approvers = User::whereIn('UserID',$userIds)->get()->toArray();
        }
//         dd($approvers);
        return view('/etravel/trip/demosticCreate')->with('userProfile',$userProfile)->with('approvers',$approvers);
    }
    /**
     *@brief currently user trip info list
     */
    public function index(Request $request)
    {
        return view();
    }
     
}