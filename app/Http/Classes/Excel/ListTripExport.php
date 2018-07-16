<?php namespace App\Http\Classes\Excel;

use Maatwebsite\Excel\Files\NewExcelFile;
use Request;

class ListTripExport extends NewExcelFile
{
	/**
	 * {@inheritDoc}
	 * @see \Maatwebsite\Excel\Files\NewExcelFile::getFilename()
	 */
	public function getFilename()
	{
		$country_id = Request::input('country_id');
		$site_id = Request::input('site_id');
		$company_id = Request::input('company_id');
		return 'HR-List-Report-' . $country_id . $site_id . $company_id;
	}

	
}

