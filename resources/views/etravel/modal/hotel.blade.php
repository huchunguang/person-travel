<div class="modal fade" id="hotelList" role="dialog" aria-labelledby="hotelList" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">
					<span aria-hidden="true">&times;</span><span class="sr-only">Close</span>
				</button>
				<h4 class="modal-title">Hotel List</h4>
			</div>
			<div class="modal-body">
				<div id="jstree">
					<!-- in this example the tree is populated from inline HTML -->
					<ul>
						@foreach($hotelList as $key=>$value)
						<li>{{$key}}
							<ul>
							@foreach($value as  $k=>$v)
								<li>{{$k}}
									<ul>
										@foreach($v as $k1=>$v1)
										<li id="{{$v1['id']}}" data-id="{{$v1['id']}}" data-standard-rate="{{$v1['standard']}}" data-deluxe-rate="{{$v1['deluxe']}}" data-executive-rate="{{$v1['executive']}}" data-superior-rate="{{$v1['superior']}}">{{$v1['name']}}</li>
										@endforeach
									</ul>
								</li>
							@endforeach
							</ul>
						</li>
						@endforeach
					</ul>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				<button type="button" class="btn btn-primary" data-dismiss="modal">Save</button>
			</div>
		</div>
	</div>
</div>
<script>
$(function () {
	$.jstree.defaults.core.themes.icons = false;
	$.jstree.defaults.core.multiple = false;
	$.jstree.defaults.core.themes.dots = false;
    // 6 create an instance when the DOM is ready
    $('#jstree').jstree();
    // 7 bind to events triggered on the tree
    $('#jstree').on("changed.jstree", function (e, obj) {
        
      var dataObj=obj.node.data;
      var standardStr=""+dataObj.standardRate+"(standard)";
      var deluxeStr=""+dataObj.deluxeRate+"(deluxe)";
      var executiveStr=""+dataObj.executiveRate+"(executive)";
      var superiorStr=""+dataObj.superiorRate+"(superior)";
      var $rate=$('.modal #rate');
      $rate.empty().append("<option value='"+standardStr+"'>"+standardStr+"</option><option value='"+deluxeStr+"'>"+deluxeStr+"</option><option value='"+executiveStr+"'>"+executiveStr+"</option><option value='"+superiorStr+"'>"+superiorStr+"</option>");
  	  $rate.prop('disabled',false);
      $('.modal input[name="hotel_id[]"]').val(obj.node.id);
      $('.modal input[name="hotel_name[]"]').val(obj.node.text);
    });
    
  });
</script>