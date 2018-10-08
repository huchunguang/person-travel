<?php
namespace App\Http\Controllers\Etravel\Admin;

use App\Http\Controllers\Controller;
use App\Contacts\SystemVariable;
use App\Site;
use App\Hr_access;
use App\Finance_optimization;
use App\Company_site;
use App\Company;
use Illuminate\Database\Eloquent\Collection;
use App\User;
class AdminController extends Controller
{
	/**
	 * @desc constructor dependency 
	 * @param SystemVariable $system
	 */
	public function __construct(SystemVariable $system)
	{
		$this->system=$system;
	}
	
	/**
	 * @param integer $country_id
	 * @param array $columns
	 * @return array
	 */
	public function siteListHRSecurity($country_id=null,$columns=['SiteID','Site']) 
	{
		$return=[];
		$user_id=$this->system->user_id;
		$country_id=$country_id?:$this->system->CountryAssignedID;
		$m_sites=Hr_access::SiteIDs($user_id);
		$user_type=$this->system->UserTypeID;
		dd($user_type);
		switch ($user_type){
			//Super Admin
			case '1':
				$return = Site::where(['CountryID'=>$country_id])->get($columns);
				break;
			//Get the COnfigured Accessibility from tbl_hr_access
			case '5':
				$return = Site::where(['CountryID'=>$country_id])->whereIn('SiteID',$m_sites)->get($columns);
				break;
		}
		if ($user_type=='6'){
			$finance_arr = Finance_optimization::find($user_id,['FinanceTypeID','SiteIDs']);
			if ($finance_arr['FinanceTypeID']=='1'){
				$return = Site::where(['CountryID'=>$country_id])->orderBy('Site')->get($columns);
			}else{
				$return = Site::where(['CountryID'=>$country_id])->wheren('SiteID',explode(',', $finance_arr['SiteIDs']))->orderBy('Site')->get($columns);
			}		
		}
		return $return;
	}
	
	/**
	 * @param integer $site_id
	 * @param array $columns
	 * @return array
	 */
	public function getCompanyListHRSecurity($site_id=null,$columns=array('*')) 
	{
		$return = [];
		$site_id=$site_id?:$this->system->getSiteId();
		$user_id=$this->system->UserID;
		$user_type=$this->system->UserTypeID;
		if ($user_type=='1'){
			$return=Company_site::with('company')->where(['SiteID'=>$site_id])->get($columns);
		}elseif ($user_type=='5'){
			$m_companyids=Hr_access::CompanyList($user_id);
			$return=Company_site::with('company')->where(['SiteID'=>$site_id])->whereIn('CompanyID',$m_companyids)->get($columns);
		}
		return $return;
	}
	
	/**
	 * @param integer $site_id
	 * @param integer $company_id
	 * @return Collection
	 */
	public function getDepByCompanySite($site_id=null,$company_id=null)
	{
		$return = [];
		$site_id=$site_id?:$this->system->SiteID;
		$company_id=$company_id?:$this->system->CompanyID;
		$return = Company::find($company_id)->department()->where(['SiteID'=>$site_id])->get();
		return $return;
	}
	public function getDepByUserId(User $user)
	{
		$site_id=$user->SiteID;
		$company_id=$user->CompanyID;
		$return =$this->getDepByCompanySite($site_id,$company_id)->each(function($item,$key)use($user){
			if ($item['DepartmentID']==$user->DepartmentID){
				$item['selected']=1;
			}
		});
		
// 		dd($return);
		return response()->json($return);
	}
	
}