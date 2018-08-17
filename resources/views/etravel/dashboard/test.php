<i class="glyphicon glyphicon-arrow-right"></i>
									<div style="display: inline-block;">
										<lable style="width:20px;background-color:#337ab7;border-radius:50%;border:2px solid #337ab7;background-clip:content-box;padding:1px;"> {{ isset($staffTripList['pending'])?sprintf('%02d',count($staffTripList['pending'])):'00' }} </label>
									
									</div>
									<div style="display: inline-block;">
										<a class="accordion-toggle" href="staff/travellist?status=pending" style="color: white;"> Pending For My Approval</a>
									</div>