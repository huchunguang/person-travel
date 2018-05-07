<table class="table table-bordered">
													<thead>
														<tr class="info">
															<td class="text-center">Hotel Name</td>
															<td class="text-center">Check-in Date</td>
															<td class="text-center">Check-out Date</td>
															<td class="text-center">Rate</td>
														</tr>
													</thead>
													<tbody>
													@foreach($hotelData as $hotelItem)
														<tr>
															<input type="hidden" name="hotel_id" value="{{$hotelItem['accomodate_id']}}"/>
															<td><input type="text" name="hotel_name[]" id="" value="{{$hotelItem['hotel_name']}}"/></td>
															<td>
																<div class="col-md-8">
																	<input type="text" id="" name="checkin_date[]" value="{{$hotelItem['checkin_date']}}"
																		class="form-control singleDatePicker"> <i
																		class="glyphicon glyphicon-calendar fa fa-calendar"
																		style="position: absolute; bottom: 10px; right: 24px; top: auto; cursor: pointer;"></i>
																</div>
	
															</td>
															<td>
																<div class="col-md-8"
																	style="position: relative;">
																	<input type="text" id="" name="checkout_date[]" value="{{$hotelItem['checkout_date']}}"
																		class="form-control singleDatePicker"> <i
																		class="glyphicon glyphicon-calendar fa fa-calendar"
																		style="position: absolute; bottom: 10px; right: 24px; top: auto; cursor: pointer;"></i>

																</div>
															</td>
															<td><input type="text" name="rate[]" id="" value="{{$hotelItem['rate']}}"/></td>
														
														</tr>
													@endforeach
													</tbody>
												</table>
												
												
												
												
												
												
												
												
												
												
												
												
												
												
												
												<div class="col-md-9">
                                                                                        		<select name="foods[]" class="form-control select2-multiple" multiple>
                                                                                            		<option value="salad" <?php if(in_array('salad', $trip->hotel_prefer['foods'])){echo 'selected';}?>>salad</option>
                                                                                                	<option value="hamburger" <?php if(in_array('hamburger', $trip->hotel_prefer['foods'])){echo 'selected';}?>>hamburger</option>
																							</select>	                                                                                               										
                                                                                        </div>
												
																						
														<div class="row">
														<div class="col-md-6">
                                                                                    
														</div>
														</div>
														<div class="form-group">
                                                                                        <label class="control-label col-md-3">Food:</label>
                                                                                        
                                                                                    </div>
														