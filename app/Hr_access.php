<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Hr_access extends Model {

	protected $table='hr_access';
	protected $primaryKey='HRAccessID';
// 	public function getSiteIDsAttribute($value)
// 	{
// 		$site_id_arr=!str_contains($value, ',')?$value:explode(',', $value);
// 		return $site_id_arr?:[];
// 	}
	public function user()
	{
		return $this->hasOne('App\User','UserID','HRID');
	}
	public static function CompanyList($user_id)
	{
		$str='';
		$static = new static;
		$res=$static->where(['HRID'=>$user_id])->get(['CompanyIDs']);
		foreach ($res as $item)
		{
			$str.=$item['CompanyIDs'].',';
		}
		$res=explode(',', trim($str,','));
// 		dd($res);
		return $res?:[]; 
	}
	public static function SiteIDs($user_id) 
	{
		$str='';
		$static=new static;
		$m_sites=$static->where(['HRID'=>$user_id])->get(['SiteIDs']);
		foreach ($m_sites as $item)
		{
			$str.=$item['SiteIDs'].',';
		}
		$m_sites=explode(',', trim($str,','));
		return $m_sites?:[];
	}	
}
