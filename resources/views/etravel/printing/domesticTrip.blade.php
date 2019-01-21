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
						<td align="right" style="font-weight: bold">Site:</td>
						<td colspan="2" align="left">{{ $userObjMdl->site()->first()['Site'] }}</td>
						<td></td>
						<td align="right" style="font-weight: bold">Department:</td>
						<td align="left" style="white-space: nowrap;">{{$department}}</td>
					</tr>
					<tr>
						<td align="right" style="font-weight: bold">Leave Type:</td>
						<td colspan="2" align="left">Domestic Trip</td>
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
						<td align="right" style="font-weight: bold">Advance Amount:</td>
						<td colspan="2" align="left">{{$trip->advance_amount}}</td>
						<td></td>
						<td align="right" style="font-weight: bold">Amount Currency:</td>
						<td align="left" style="white-space: nowrap;">@foreach($currencyList as $currencyItem) @if($currencyItem['CurrencyID']==$trip->amount_currency) {{$currencyItem['Currency']}} @else {{$currencyItem['Currency']}} @endif @endforeach</td>
					</tr>
					<tr>
						<td align="right" style="font-weight: bold">Extra Comments:</td>
						<td colspan="2" align="left">{{$trip['extra_comment']}}</td>
						<td></td>
						<td align="right" style="font-weight: bold">Department Approver:</td>
						<td align="left" style="white-space: nowrap;">{{ $approver->LastName }} {{ $approver->FirstName }}</td>
					</tr>
					
					
				</tbody>
			</table>
			<table width="100%" border="0" class="table" style="font-size: 16px;">
				<thead>
					<tr style="background-color: gray; color: white">
						<th colspan="3" style="color: white">Itinerary</th>
					</tr>
				</thead>
				<tbody>
					<table border="1">
					
															<thead>
																<tr class="info">
																	<td class="text-center">Date</td>
																	<td class="text-center">Time</td>
																	<td class="text-center">Location</td>
																	<td class="text-center">Company Name</td>
																	<td class="text-center">Contact Name</td>
																	<td class="text-center">Purpose of Visit Category</td>
																	<td class="text-center">Purpose of Visit Description</td>
																	<td class="text-center">Estimated Travel Cost</td>
																	<td class="text-center">Estimated Entertainment Cost</td>
																	<td class="text-center">Details</td> @if($trip->status == 'pending' && $trip->department_approver == Auth::user()->UserID )
																	<td class="text-center text-danger">Approved?</td> @elseif($trip->status == 'approved' || $trip->status=='partly-approved')
																	<td class="text-center">Approved?</td> @endif
																</tr>
															</thead>
															<tbody>
																@foreach($demosticInfo as $item)
																<tr id="trOne">
																	<td>{{ $item['datetime_date'] }}</td>
																	<td>{{ $item['datetime_time'] }}</td>
																	<td>{{ $item['location'] }}</td>
																	<td>{{ $item['customer_name'] }}</td>
																	<td>{{ $item['contact_name'] }}</td>
																	<td>{{ $item->visitPurpose()->first()['purpose_catgory'] }}</td>
																	<td data-toggle="tooltip" title="{{$item['purpose_desc']}}">{{ str_limit($item['purpose_desc'],10) }}</td>
																	<td>{{ $item['travel_cost'] }}</td>
																	<td>{{ $item['entertain_cost'] }}</td>
																	<td>{{ $item['entertain_detail'] }}</td> @if($trip->status == 'pending' && $trip->department_approver == Auth::user()->UserID)
																	<td>@if($item['is_approved'] == '0') <input type="hidden" name="id[]" value="{{$item['id']}}" />
																		<div class="input-group">
																			<div class="icheck-inline">
																				<label class="">
																					<div class="icheckbox_minimal-grey" style="position: relative;">
																						<input type="checkbox" class="icheck domesticIcheck" name="is_approve_{{$item['id']}}" style="position: absolute; opacity: 0;" checked>
																						<ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;"></ins>
																					</div>
																					YES
																				</label>
																			</div>
																		</div> @elseif($item['is_approved']== '1') YES @endif
																	</td> @endif @if($trip->status=='approved' || $trip->status=='partly-approved')
																	<td>@if($item['is_approved']==1) YES @elseif($item['is_approved']==0) NO @endif</td> @endif
																</tr>
																@endforeach
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