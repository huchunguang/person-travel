<div id="container">
	<div style="width: 850px;">
		<div id="eleaveforprintingdetails">
		<img src="{{ asset('storage/global/logo-printing.jpg') }}" alt="logo" class="logo-default">'
			<table width="100%" border="0" class="table table-condensed" style="font-size: 16px;">
				<thead>
					<tr style="background-color: gray; color: white">
						<th colspan="6" style="color: white">Trip Request</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td align="right" style="width: 150px; font-weight: bold">Ref #:</td>
						<td colspan="2" align="left">{{$trip->reference_id}}</td>
						<td></td>
						<td align="right" style="width: 150px; font-weight: bold">Date Printed:</td>
						<td align="left" style="width: 100px; white-space: nowrap;">{{date("Y-m-d H:i:s")}}</td>
					</tr>
					<tr>
						<td align="right" style="font-weight: bold">Request For:</td>
						<td colspan="2" align="left">{{ $applicantUser->FirstName }} {{ $applicantUser->LastName }}-{{ $applicantUser->UserName }}</td>
						<td></td>
						<td align="right" style="font-weight: bold">Date Submitted:</td>
						<td align="left" style="white-space: nowrap;">{{$trip->created_at}}</td>
					</tr>
					<tr>
						<td align="right" style="font-weight: bold">Destination:</td>
						<td colspan="2" align="left">@if(count($destination)>0) @foreach($destination as $item) {{$item['Country']}}, @endforeach @endif</td>
						<td></td>
						<td align="right" style="font-weight: bold">Site:</td>
						<td align="left" style="white-space: nowrap;">{{ $userObjMdl->site()->first()['Site'] }}</td>
					</tr>
					<tr>
						<td align="right" style="font-weight: bold">Leave Type:</td>
						<td colspan="2" align="left">International Trip</td>
						<td></td>
						<td align="right" style="font-weight: bold">Project Code:</td>
						<td align="left" style="white-space: nowrap;">{{$trip->wbsCode()->first()['wbs_code']}}</td>
					</tr>
					<tr>
						<td align="right" style="font-weight: bold">Start Date:</td>
						<td colspan="2" align="left">{{$trip->daterange_from}}</td>
						<td></td>
						<td align="right" style="font-weight: bold">End Date:</td>
						<td align="left" style="white-space: nowrap;">{{$trip->daterange_to}}</td>
					</tr>
					<tr>
						<td align="right" style="font-weight: bold">Cost Center:</td>
						<td colspan="2" align="left">{{$costCenterCode}}</td>
						<td></td>
						<td align="right" style="font-weight: bold">Status:</td>
						<td align="left" style="white-space: nowrap;">{{$trip->status}}</td>
					</tr>
					<tr>
						<td align="right" style="font-weight: bold">Extra Comments:</td>
						<td colspan="2" align="left">{{$trip['extra_comment']}}</td>
						<td></td>
						<td align="right" style="font-weight: bold">Purpose Of Travel:</td>
						<td align="left" style="white-space: nowrap;">{{$trip->purpose_desc}}</td>
					</tr>
					<tr>
						<td align="right" style="font-weight: bold">Advance Amount:</td>
						<td colspan="2" align="left">{{$trip->advance_amount}}</td>
						<td></td>
						<td align="right" style="font-weight: bold">Amount Currency:</td>
						<td align="left" style="white-space: nowrap;">@foreach($currencyList as $currencyItem) @if($currencyItem['CurrencyID']==$trip->amount_currency) {{$currencyItem['Currency']}} @else {{$currencyItem['Currency']}} @endif @endforeach</td>
					</tr>
					<tr>
						<td align="right" valign="top" style="font-weight: bold">Department Approver:</td>
						<td colspan="3" valign="top" style="white-space: pre-wrap" align="justify">{{ $approver->LastName }} {{ $approver->FirstName }}</td>
						<td align="right" valign="top" style="font-weight: bold">Overseas Approver:</td>
						<td align="left" valign="top" style="white-space: nowrap;">{{ $overseas_approver->LastName }} {{ $overseas_approver->FirstName }}</td>
					</tr>
				</tbody>
			</table>
			<table width="100%" border="0" class="table" style="font-size: 16px;">
				<thead>
					<tr style="background-color: gray; color: white">
						<th colspan="3" style="color: white">Flight Itinerary</th>
					</tr>
				</thead>
				<tbody>
					<table border="1">
						<thead>
							<tr>
								<td class="text-center text-danger">Date</td>
								<td class="text-center text-danger">From</td>
								<td class="text-center text-danger">To</td>
								<td class="text-center text-danger">Airline/Train</td>
								<td class="text-center text-danger">ETD</td>
								<td class="text-center text-danger">ETA</td>
								<td class="text-center text-danger">Class Fight</td>
								<td class="text-center text-danger">Visa?</td>
							</tr>
						</thead>
						<tbody>
							@if(count($flightData)>0) @foreach($flightData as $flightItem)
							<tr>
								<td>{{$flightItem['flight_date']}}</td>
								<td>{{$flightItem['flight_from']}}</td>
								<td>{{$flightItem['flight_to']}}</td>
								<td>@if($flightItem['airline_or_train']=='1') Airline {{$flightItem['air_code']}} @elseif($flightItem['airline_or_train']=='0') Train @endif</td>
								<td>{{$flightItem['etd_time']}}</td>
								<td>{{$flightItem['eta_time']}}</td>
								<td>{{$flightItem['class_flight']}}</td>
								<td>@if($flightItem['is_visa']=='1') YES @elseif($flightItem['is_visa']=='0') NO @endif</td>
							</tr>
							@endforeach @endif
						</tbody>
					</table>
					<table>
						<tr>
							<td align="right" style="width: 150px; font-weight: bold"></td>
							<td colspan="2" align="left"></td>
						</tr>
					</table>
				</tbody>
			</table>
			<table width="100%" border="0" class="table" style="font-size: 16px;">
				<thead>
					<tr style="background-color: gray; color: white">
						<th colspan="3" style="color: white">Estimated Expenses</th>
					</tr>
				</thead>
				<tbody>
					<table border="1" width="100%">
						<thead>
							<tr class="info">
								<td class="text-center"></td>
								<td class="text-center">Employee Annual Budget</td>
								<td class="text-center">Employee YTD Expenses</td>
								<td class="text-center">Available Amount</td>
								<td class="text-center">Required Budget for this Trip</td>
							</tr>
						</thead>
						<tbody>
							@if(count($estimateExpenses)>0) @foreach($estimateExpenses as $item)
							<tr>
								<td class="text-center">{{$item['estimate_type']}} Travel</td>
								<td>{{$item['employee_annual_budget']}}</td>
								<td>{{$item['employee_ytd_expenses']}}</td>
								<td>{{$item['available_amount']}}</td>
								<td>{{$item['required_amount']}}</td>
							</tr>
							@endforeach @endif
						</tbody>
					</table>
					<table>
						<tr>
							<td align="right" style="width: 150px; font-weight: bold"></td>
							<td colspan="2" align="left"></td>
						</tr>
					</table>
				</tbody>
			</table>
			<table width="100%" border="0" class="table" style="font-size: 16px;">
				<thead>
					<tr style="background-color: gray; color: white">
						<th colspan="3" style="color: white">Hotel Accommodation</th>
					</tr>
				</thead>
				<tbody>
					<table border="1" width="100%">
						<thead>
							<tr class="info">
								<td class="text-center">Hotel Name</td>
								<td class="text-center">Check-in Date</td>
								<td class="text-center">Check-out Date</td>
								<td class="text-center">Rate</td>
							</tr>
						</thead>
						<tbody>
							@if(count($hotelData)) @foreach($hotelData as $hotelItem)
							<tr>
								<td>{{$hotelItem['hotel_name']}}</td>
								<td>{{$hotelItem['checkin_date']}}</td>
								<td>{{$hotelItem['checkout_date']}}</td>
								<td>{{$hotelItem['rate']}}</td>
							</tr>
							@endforeach @endif
						</tbody>
					</table>
					<table>
						<tr>
							<td align="right" style="width: 150px; font-weight: bold"></td>
							<td colspan="2" align="left"></td>
						</tr>
					</table>
				</tbody>
			</table>
			<table width="100%" border="0" class="table" style="font-size: 16px;">
				<thead>
					<tr style="background-color: gray; color: white">
						<th colspan="5" style="color: white"></th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td align="right" style="width: 150px; font-weight: bold">Approver Comments:</td>
						<td align="right">{{ $trip->approver_comment }}</td>
					
					</tr>
					
				</tbody>
			</table>
		</div>
		<!-- Table Div -->
	</div>
	<!-- Jumbotron -->
</div>