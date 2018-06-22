<?php
use Carbon\Carbon;
?>
@extends("etravel.layout.main") @section("content")
<div class="container">
	@include("etravel.layout.pagebar")
	<div class="page-content-inner">
		<div class="row">
			<div class="col-md-12">
                    <div class="portlet box blue-steel">
                        <div class="portlet-title">
                            <div class="caption"></div>
                            <div class="tools">
                                <a href="" class="collapse" data-original-title="" title=""> </a>
                            </div>
                        </div>
                        
                        <div class="portlet-body form" style="display: block;">
                            <form class="form-horizontal pt20" role="form" id="FormDelegation" method="POST" action="{{url('delegate/store')}}">
								<input type="hidden" name="_token" value="{{csrf_token()}}"/>
								<input type="hidden" name="delegationId" value="{{session('delegationId')}}"/>
                                <div class="form-body row">
                                    <div class="col-md-8 col-md-offset-1">
                                        <div class="form-group form-md-line-input">
                                            <label for="country_id" class="col-md-4 control-label">Country</label>
                                            <div class="col-md-8">
                                            	
											<select id="country_id" name="country_id" class="form-control input-sm select2">
												<option value=""></option> 
												@foreach($countryList as $countryItem) 
													@if(($CountryAssignedID && $CountryAssignedID==$countryItem['CountryID']) || (old('country_id')==$countryItem['CountryID']))
													<option value="{{$countryItem['CountryID']}}" selected>{{$countryItem['Country']}}</option>
													@else
													<option value="{{$countryItem['CountryID']}}">{{$countryItem['Country']}}</option>
													@endif
												@endforeach
											</select>
										
                                            </div>
                                        </div>
                                        <div class="form-group form-md-line-input">
                                            <label for="site_id" class="col-md-4 control-label">Site</label>
                                            <div class="col-md-8">
                                            
											<select id="site_id" name="site_id" class="form-control input-sm select2">
												<option value=""></option> 
												@foreach($siteList as $siteItem) 
													@if($SiteID==$siteItem['SiteID'] && !old('site_id'))
													<option value="{{$siteItem['SiteID']}}" selected>{{$siteItem['Site']}}</option>
													@elseif(old('site_id')==$siteItem['SiteID'])
													<option value="{{$siteItem['SiteID']}}" selected>{{$siteItem['Site']}}</option>
													@else
													<option value="{{$siteItem['SiteID']}}">{{$siteItem['Site']}}</option>
													@endif 
												@endforeach
											</select>
										
                                            </div>
                                        </div>

                                        <div class="form-group form-md-line-input">
                                            <label for="manager_id" class="col-md-4 control-label">Manager / Approver</label>
                                            <div class="col-md-8">
                                            	<select id="manager_id" name="ManagerID" class="form-control input-sm select2">
                                            	<option value=""></option> 
												@foreach($userListBySite as $userItem) 
													@if(!old('ManagerID') && Auth::user()->UserID==$userItem['UserID'])
													<option value="{{$userItem['UserID']}}" selected>{{$userItem['LastName']}} {{$userItem['FirstName']}}</option>
													@elseif(old('ManagerID')==$userItem['UserID'])
													<option value="{{$userItem['UserID']}}" selected>{{$userItem['LastName']}} {{$userItem['FirstName']}}</option>
													@else
													<option value="{{$userItem['UserID']}}">{{$userItem['LastName']}} {{$userItem['FirstName']}}</option>
													@endif 
												@endforeach
                                            	</select>
                                            </div>
                                        </div>
                                        
                                        <div class="form-group form-md-line-input">
                                            <label for="delegate_id" class="col-md-4 control-label">Delegated Approver</label>
                                            <div class="col-md-8">
                                            	<select class="form-control js-data-example-ajax" name="ManagerDelegationID" id="delegate_id">
                                            		@if(isset($delegateUser->FirstName))
                                            			<option value="{{$delegateUser->UserID}}">{{$delegateUser->LastName}} {{$delegateUser->FirstName}}</option>
                                            		@endif
                                            	</select>
                                            </div>
                                        </div>
                                        
                                        <div class="form-group form-md-line-input">
                                            <label for="start_date" class="col-md-4 control-label">Start Date</label>
                                            <div class="col-md-8">
                                            	
												<input type="text" name="DelegationStartDate" value="{{old('DelegationStartDate')}}"
													class="form-control singleDatePicker leave-date" > <i
													class="glyphicon glyphicon-calendar fa fa-calendar"
													style="position: absolute; bottom: 10px; right: 10px; top: auto; cursor: pointer;"></i>
											
                                            </div>
                                        </div>
                                        
                                        <div class="form-group form-md-line-input">
                                            <label for="end_date" class="col-md-4 control-label">End Date</label>
                                            <div class="col-md-8">
                                            	
												<input type="text" name="DelegationEndDate" value="{{old('DelegationEndDate')}}"
													class="form-control singleDatePicker leave-date" > <i
													class="glyphicon glyphicon-calendar fa fa-calendar"
													style="position: absolute; bottom: 10px; right: 10px; top: auto; cursor: pointer;"></i>
											
                                            </div>
                                        </div>
                                        <div class="form-group form-md-line-input">
                                            <div class="col-md-offset-4 col-md-4">
                                                <div class="md-checkbox-list">
                                                
                                                                        <div class="icheck-inline">
                                                                            <label class="">
																		<div class="icheckbox_minimal-grey"
																			style="position: relative;">
																			@if(old('EnableDelegation'))
																			<input type="checkbox" class="icheck" name="EnableDelegation" style="position: absolute; opacity: 0;" value="1" checked>
																			@else
																			<input type="checkbox" class="icheck" name="EnableDelegation" style="position: absolute; opacity: 0;" value="1">
																			@endif
																			<ins class="iCheck-helper"
																				style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;"></ins>
																		</div>Enable Delegation
																	</label>
                                                                        </div>
                                                         
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                            

                                <div class="row form-actions text-right">
								<div id="btnLeaveControl">
									<button id="delegateEdit" type="button" accesskey="I"
										class="btn yellow-casablanca">
										<i class="fa fa-pencil"></i> Ed<u>i</u>t
									</button>
									<button id="delegateSave" disabled="" type="button"
										accesskey="S" class="btn green-jungle">
										<i class="fa fa-save"></i> <u>E</u>xecute
									</button>
<!-- 									<button id="delegateCancel" type="button" accesskey="C" -->
<!-- 										class="btn default"> -->
<!-- 										<i class="fa fa-share"></i> C<u>a</u>ncel -->
<!-- 									</button> -->
								</div>
							</div>
                          </form>
                        </div>
                        
                    </div>
                </div>
		</div>
	</div>
</div>
<script src="{{asset('js/etravel/delegate/index.js')}}"></script>
@endsection
