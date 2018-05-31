<?php
namespace App\Http\Apis\Classes;
use GuzzleHttp\Client;
use phpDocumentor\Reflection\Types\Array_;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Support\Facades\Log;

//author: vicS
//API token generator and validator

class EhotelApi 
{
    private $secret = "01234567689000secret000Arkema000EHOTEL000api0002018";
    private $publicKey = "c9e0fd8c388502dbddb903cab42550f6206b2f435f1bda49230c8d9567749805";
    private $araw = null;
    private $genToken = null;
    private $baseURI = null;
    private $apiURL = "http://aspa-eovertime-qual.ic.corp.local/controllers/api.php";


	public function __construct($dateParam=null){
	$this->araw = ( isset($dateParam) )? $dateParam : date("YmdHis");
	$this->baseURI = "http://" . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];
	}

	public function getDate(){
	return $this->araw; 	
	}

	public function generate(){
	$this->genToken = hash_hmac("sha256", $this->publicKey.'|'.$this->araw, $this->secret).'|'.$this->araw;	
	}
 	
 	public function displayToken(){
	 return (isset($this->genToken))? $this->genToken : 0;
 	}

    public function getbaseURI(){
    return $this->baseURI;
    }

    public function formulateGetRequest(){
    return $this->apiURL.'?ehToken='.$this->genToken;
    }

    /////////////////////////////////
	public function validate($token){	
	$res = explode("|", $token);	
	$param = hash_hmac("sha256", $this->publicKey.'|'.$res[1], $this->secret).'|'.$res[1];
	return ($param == $token)? true : false;
	}
	/////////////////////////////////
	/**
	 * @desc get the list of hotel from ehotel application
	 * @param array $params
	 * @return mixed
	 */
	public function getHotelList($params=array())
	{
		$res=[
			[
				'id'=>15,
				'name'=>'V hotel',
				'country_id'=>23,
				'country'=>'Singapore',
				'city'=>'Singapore',
			],
			[
				'id'=>16,
				'name'=>'red hotel',
				'country_id'=>23,
				'country'=>'Singapore',
				'city'=>'Singapore',
			],
		];
		$res=collect($res)->groupBy('country')->toArray();
// 		dd($res);
		$arr=$res;
		foreach ($res as $key=>$value){
			foreach ($value as $k=>$v){
				if (isset($v['city'])) {
					$value[$v['city']][]=$v;
					$arr[$key][$v['city']][]=$v;
					unset($arr[$key][$k]);
				}
				unset($value[$k]);
			}
		}
		return $arr;
		
		$query_arr = [];
		$this->generate();
		$query_arr['ehToken']=$this->genToken;
		try {
			$client= new Client();
			$response = $client->get($this->apiURL,['query'=>array_merge($query_arr,$params)]);
			if ($response->getStatusCode()=='200'){
				$res = $response->json();
				$res=collect($res)->groupBy('country')->toArray();
				$arr=$res;
				foreach ($res as $key=>$value){
					echo '<hr />';print_r($value);
					foreach ($value as $k=>$v){
						if (isset($v['city'])) {
							$value[$v['city']][]=$v;
							$arr[$key][$v['city']][]=$v;
							unset($arr[$key][$k]);
						}
						
						unset($value[$k]);
					}
				}
// 				dd($arr);
				return $res;
			}
			
		} catch (RequestException $e) {
			if ($e->hasResponse()) {
				
				Log::error('Ehotel Api Request Error:'.$e->getResponse());
			}
		}
		
		
	}
}