<?php
use App\Costcenter;
use App\User;
?>
@extends("etravel.layout.main") 
@section("content")
	<div class="container">
	<script src="{{asset('js/etravel/trip/index.js')}}"></script>
	
        @include("etravel.layout.pagebar")

        <!-- BEGIN PAGE CONTENT INNER -->
        <div class="page-content-inner">

            <div class="inbox">
            		
                <div class="row">
                    <div class="col-md-3">
                        <div class="portlet box light">
                            <div class="portlet-body">
                                <button class="btn default btn-block" type="button" data-target="#newTravel" data-toggle="modal" ><i class="fa fa-minus-circle"></i> New Travel Request </button>
                                <hr>
                                @if($status == 'all')
                                <a class="btn green btn-block btn-outline active" href="?status"> All </a>
                                @else
                                <a class="btn green btn-block btn-outline" href="?status"> All </a>
                                @endif
                                @if($status == 'pending')
                                <a class="btn green btn-block btn-outline active" href="?status=pending"> Pending </a>
                                @else
                                <a class="btn green btn-block btn-outline" href="?status=pending"> Pending </a>
                                @endif
                                @if($status == 'partly-approved')
                                <a class="btn green btn-block btn-outline active" href="?status=partly-approved"> Partly Approved </a>
                                @else
                                <a class="btn green btn-block btn-outline " href="?status=partly-approved"> Partly Approved </a>
                                @endif
                                @if($status == 'approved')
                                <a class="btn green btn-block btn-outline active" href="?status=approved"> Approved </a>
                                @else
                                <a class="btn green btn-block btn-outline " href="?status=approved"> Approved </a>
                                @endif
                                @if($status == 'approved')
                                <a class="btn green btn-block btn-outline active" href="?status=cancelled"> Cancelled </a>
                                @else
                                <a class="btn green btn-block btn-outline " href="?status=cancelled"> Cancelled </a>
                                @endif
                                @if($status == 'rejected')
                                <a class="btn green btn-block btn-outline active" href="?status=rejected"> Rejected </a>
                                @else
                                <a class="btn green btn-block btn-outline " href="?status=rejected"> Rejected </a>
                                @endif
                                
                            </div>
                        </div>
                    </div>

                    <div class="col-md-9">
                        <div class="portlet box light">
                            <div class="portlet-body">
                            		
                                <div class="row inbox">
                                    <div class="col-md-12 table-responsive">
                                        <h3>{{ strtoupper($status) }}</h3>
                                        <table id="tblMyList" class="table table-condensed table-hover sortable">
                                            <thead class="btn-primary roundborder" >
                                                <tr>
                                                    <th colspan="1" style="text-align: left" class="nosort" data-sortcolumn="0" data-sortkey="0-0">Search:</th>
                                                    <th colspan="2"><input id="txtReferenceSearch" type="text" placeholder="Search by Date #" style="color: #666; width: 100%;"></th>		
                                                    <th colspan="2"><input id="txtEmployeeSearch" type="text" placeholder="Search by Cost Center" style="color: #666; width: 100%;"></th>
                                                    <th colspan="5"></th>
                                                </tr>
                                                	<tr>
												<th style="width: 30px;text-align: center">＃</th>
												<th>Date</th>
												<th>Time</th>
												<th>Cost Center</th>
												<th>Trip Type</th>
												<th>Status</th>
												<th>Approver Comment</th>
												<th>View</th>
											</tr>
                                            </thead>
                                            <tbody>
                                            	@if (count($tripList) >0 )
                                            
												@foreach($tripList as $item)
													<tr class='rowhover'>
														<td>{{ $item['trip_id'] }}</td>
														<td>{{ $item['daterange_from'] }}</td>
														<td>{{ $item['daterange_to'] }}</td>
														<td><?php echo Costcenter::find($item['cost_center_id'])['CostCenterCode'];?></td>
														<td>
															@if($item['trip_type']=='1')
															International
															@elseif($item['trip_type']=='2')
															Domestic
															@endif
														</td>
														<td>{{ $item['status'] }}</td>
														<td>{{ $item['approver_comment'] }}</td>
														<td>
															@if($item['trip_type']=='1')
															<a href="/etravel/tripnationallist/{{ $item['trip_id'] }}">
															@elseif($item['trip_type']=='2')
															<a href="/etravel/tripdemosticlist/{{ $item['trip_id'] }}">
															@endif
																@if($item['status']=='pending')
																<span class="glyphicon glyphicon-hand-right" style="color: green"></span>
																@elseif($item['status']=='approved')
																<span class="fa fa-check-circle-o" style="color: green"></span>
																@elseif($item['status']=='rejected')
																<span class="glyphicon glyphicon-thumbs-down" style="color: red"></span>
																@elseif($item['status']=='cancelled')
																<span class="fa fa-exclamation-triangle" style="color: black"></span>
																@elseif($item['status']=='partly-approved')
																<span class="glyphicon glyphicon-check" style="color: yellow"></span>
																@endif
															</a>
														</td>
												</tr>
												@endforeach
											@else
											<tr >
												<td align="center" colspan="8" style="color:red" data-value=" No records found."> No records found.</td>
											</tr>
											@endif
                                            </tbody>
                                            <tfoot>
                                                <tr class="btn-primary roundborder">
                                                    <th style="text-align:right">Total Transactions Applied:</th>
                                                    <th style="text-align:center">{{ $tripList->total() }}</th>
                                                    <th colspan="5"></th>
                                                    <th style="text-align:center"></th>
                                                </tr>
                                               
                                            </tfoot>
                                        </table>
                      
										<?php echo $tripList->render();?>
                                    </div>
                                </div>  
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@include('etravel.modal.newTravel')
@endsection
