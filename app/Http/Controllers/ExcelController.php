<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Maatwebsite;
use App\Http\Classes\Excel\ListTripExport;
use App\Country;
use App\Site;
use App\Company;
use App\Trip;
use App\Repositories\TripRepository;
use App\Http\Traits\parseSearchFilter;

class ExcelController extends Controller 
{
	use parseSearchFilter;
	public function __construct(TripRepository $trip) 
	{
		$this->trip= $trip;
		$this->middleware('checkUser');
	}
	public function exportTripList(ListTripExport $excel,Request $request)
	{
		$searchFilter = $this->prepareSearchFilter($request);
// 		dd($searchFilter);
		$baseFilter = array_except($searchFilter, ['daterange_from','daterange_to']);
		$betweenFilter = [$searchFilter['daterange_from'],$searchFilter['daterange_to']];
		$cellData = Trip::where($baseFilter)->whereBetween('daterange_from',$betweenFilter)->whereBetween('daterange_to',$betweenFilter)->get();
// 		dd($cellData);
		$country = isset($request->country_id) ? Country::find($request->country_id)->Country : '';
		$site = isset($request->site_id) ? Site::find($request->site_id)->Site : 'ALL SITES';
		$company = isset($request->company_id) ? Company::find($request->company_id)->CompanyName : 'ALL COMPANIES';
		
		$excel->sheet('HR Report List', function ($sheet) use ($cellData, $country, $site, $company) {
			// $sheet->rows($cellData);
			$sheet->cell('A1', function ($cell) {
				$cell->setValue('HUMAN RESOURCE ETRAVEL DOCUMENT LIST')
					->setFontWeight('bold')
					->setFontSize(16);
			});
			$sheet->cell('A2', function ($cell) {
				$cell->setValue('Country:');
			});
			$sheet->cell('A3', function ($cell) {
				$cell->setValue('Site:');
			});
			$sheet->cell('A4', function ($cell) {
				$cell->setValue('Company:');
			});
			$sheet->cell('B2', function ($cell) use ($country) {
				$cell->setValue($country);
			});
			$sheet->cell('B3', function ($cell) use ($site) {
				$cell->setValue($site);
			});
			$sheet->cell('B4', function ($cell) use ($company) {
				$cell->setValue($company);
			});
			$sheet->cell('A5', function ($cell) {
				$cell->setValue('Reference #');
			});
			$sheet->cell('B5', function ($cell) {
				$cell->setValue('DateSubmitted');
			});
			$sheet->cell('C5', function ($cell) {
				$cell->setValue('Employee');
			});
			$sheet->cell('D5', function ($cell) {
				$cell->setValue('TravelType');
			});
			$sheet->cell('E5', function ($cell) {
				$cell->setValue('Start Travel');
			});
			$sheet->cell('F5', function ($cell) {
				$cell->setValue('End Travel');
			});
			$sheet->cell('G5', function ($cell) {
				$cell->setValue('Total Days')
					->setAlignment('center');
			});
			$sheet->cell('H5', function ($cell) {
				$cell->setValue('Remarks')
					->setAlignment('center');
			});
			$sheet->cell('I5', function ($cell) {
				$cell->setValue('Destination');
			});
			$sheet->cell('J5', function ($cell) {
				$cell->setValue('Status');
			});
			$sheet->cell('A5:J5', function ($cells) {
				$cells->setBackground('#3385ff')
					->setFontColor('#ffffff')
					->setFontWeight('bold');
			});
			$sheet->setWidth(array ( 
				
				'A' => 15, // Reference #
				'B' => 30, // DateSubmitted
				'C' => 30, // Employee
				'D' => 30, // TravelType
				'E' => 30, // Start Travel
				'F' => 15, // End Travel
				'G' => 15, // Days to Apply
				'H' => 30, // Remarks
				'I' => 30, // Destination
				'J' => 20, // Status
			));
			$sheet->setAutoSize(array ( 
				
				'C',
			));
			$sheet->setAutoFilter('A5:J5');//Auto Filter
			$counter = 6; // Starts on Row 6 after the detailed header
			for ($i = 0; $i < count($cellData); $i ++) {
				$sheet->cell("A$counter", function ($cell) use ($cellData, $i) {
					$cell->setValue($cellData[$i]['reference_id']);
				});
				$sheet->cell("B$counter", function ($cell) use ($cellData, $i) {
					$cell->setValue($cellData[$i]['created_at']);
				});
				$sheet->cell("C$counter", function ($cell) use ($cellData, $i) {
					$cell->setValue($this->trip->getUser($cellData[$i]));
				});
				$sheet->cell("D$counter", function ($cell) use ($cellData, $i) {
					$cell->setValue($this->trip->getTravelType($cellData[$i]));
				});
				$sheet->cell("E$counter", function ($cell) use ($cellData, $i) {
					$cell->setValue($cellData[$i]['daterange_from']);
				});
				$sheet->cell("F$counter", function ($cell) use ($cellData, $i) {
					$cell->setValue($cellData[$i]['daterange_to']);
				});
				$sheet->cell("G$counter", function ($cell) use ($cellData, $i) {
					$cell->setValue($this->trip->getDaysToApply($cellData[$i]))
						->setAlignment('center');
				});
				$sheet->setColumnFormat(array ( 
					
					"G$counter" => '#,##0.00'
				));
				$sheet->cell("H$counter", function ($cell) use ($cellData, $i) {
					$cell->setValue($cellData[$i]['extra_comment']);
				});
				$sheet->cell("I$counter", function ($cell) use ($cellData, $i) {
					$cell->setValue($this->trip->getTripDst($cellData[$i]));
				});
				$sheet->cell("J$counter", function ($cell) use ($cellData, $i) {
					$cell->setValue($cellData[$i]['status']);
				});
				$counter ++;
			}
			$sheet->cell("A$counter:J$counter", function ($cells) {
				$cells->setBackground('#3385ff')
					->setFontColor('#ffffff')
					->setFontWeight('bold');
				;
			});
			$sheet->cell("B$counter", function ($cell) use ($cellData) {
				$cell->setValue("Total User[s]: " . count($cellData));
			});
			$sheet->cell("D$counter", function ($cell) {
				$cell->setValue("Export Generated as of " . date('F j, Y h:i:s A'));
			});
		})
			->export('xls');
	}

}
