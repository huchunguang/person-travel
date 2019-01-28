<div id="workflowModal" class="modal fade bs-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg" >
        <div class="modal-content">
        <div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">
					<span aria-hidden="true">&times;</span>
					<span class="sr-only">Close</span>
				</button>
				<h4 class="modal-title text-primary bold">WorkFlow for Ref #: {{$trip->reference_id}}</h4>
			</div>
            <div class="modal-body">
                <div class="scroller" style="height: 400px;" data-always-visible="1" data-rail-visible="0">
                    <table class="table table-hover table-light">
                        <thead>
                            <tr>
                                <th style="text-align: left">Date Time</th>
                                <th style="text-align: left">Message</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($workflowInfo as $item)
                            <tr>
                            <td>{{$item['time']}}</td>
                            <td>{{$item['message']}}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>