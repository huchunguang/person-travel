var selected=[];
var TableDatatablesRowreorder = function () {


    var overTimeRequestList = function () {
        var table = $('#TblOvertimeList');
        var status = $('input[name="status"]').val();
        var oTable = table.dataTable({
        	"rowId":"id",
        	"serverSide": true,
        	"processing": true,
        	"ajax" : {
    			"url" : "/overtime/index/"+status,
    			"type" : "POST"
    		},
    		"columns": [
                { "data": "id" },
                { "data": "reference_id" },
                { "data": "start_date" },
                { "data": "position" },
                { "data": "end_date" },
                { "data": "head_count" },
                { "data": "shift" },
                { "data": "rate" },
                { "data": "hours" },
                { "data": "reason" },
                { "data": "created_at" },
                { "data": "remark" },
            ],
            "columnDefs": [
                {
                    "targets": [ 8,10 ],
                    "visible": false,
                    "orderable": false
                },
                {
                	"targets": [0],
                	"visible": false,
                },
                {
                	"targets": [3,6,7,9],
                	"orderable": false,
                },
               
                {
                    "targets": [1],
//                    "visible": false,
                    "render": function ( data, type, row ) {
                        return  '<a href="/overtime/'+row.id+'" class="overtimeDetail" target="_blank">'+data+'</a>';
                    },
                },
                
            ],
            // Internationalisation. For more info refer to http://datatables.net/manual/i18n
            "language": {
                "aria": {
                    "sortAscending": ": activate to sort column ascending",
                    "sortDescending": ": activate to sort column descending"
                },
                "emptyTable": "No data available in table",
                "info": "Showing _START_ to _END_ of _TOTAL_ entries",
                "infoEmpty": "No entries found",
                "infoFiltered": "(filtered1 from _MAX_ total entries)",
                "lengthMenu": "_MENU_ entries",
                "search": "Search:",
                "zeroRecords": "No matching records found"
            },

            // Or you can use remote translation file
            //"language": {
            //   url: '//cdn.datatables.net/plug-ins/3cfcc339e89/i18n/Portuguese.json'
            //},

            buttons: [
//                { extend: 'excel', className: 'btn default' },
//                { extend: 'print', className: 'btn default' },
//                { extend: 'pdf', className: 'btn default' },
            ],

            // setup colreorder extension: http://datatables.net/extensions/colreorder/
            colReorder: {
                reorderCallback: function () {
                    console.log( 'callback' );
                }
            },

            // setup rowreorder extension: http://datatables.net/extensions/rowreorder/
//            rowReorder: {
//
//            },
            "rowCallback": function( row, data ) {
                if ( $.inArray(data.id, selected) !== -1 ) {
                    $(row).addClass('selected');
                }
            },
            "order": [
                [1, 'asc']
            ],
            
            "lengthMenu": [
                [5, 10, 15, 20],
                [5, 10, 15, 20] // change per page values here
            ],
            // set the initial value
            "pageLength": 10,

            "dom": "<'row' <'col-md-12'B>><'row'<'col-md-6 col-sm-12'l>r><'table-scrollable't><'row'<'col-md-5 col-sm-12'i><'col-md-7 col-sm-12'p>>", // horizobtal scrollable datatable

            // Uncomment below line("dom" parameter) to fix the dropdown overflow issue in the datatable cells. The default datatable layout
            // setup uses scrollable div(table-scrollable) with overflow:auto to enable vertical scroll(see: assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js). 
            // So when dropdowns used the scrollable div should be removed. 
            //"dom": "<'row' <'col-md-12'T>><'row'<'col-md-6 col-sm-12'l><'col-md-6 col-sm-12'f>r>t<'row'<'col-md-5 col-sm-12'i><'col-md-7 col-sm-12'p>>",
        });
    };
    
    var ApprovalOvertimeList=function(){
        var table = $('#TblApprovalOvertimeList');
        var status = $('input[name="status"]').val();
        
        var oTable = table.dataTable({
        	"rowId":"id",
        	"serverSide": true,
        	"processing": true,
        	"ajax" : {
    			"url" : "/overtime/approval/"+status,
    			"type" : "POST"
    		},
    		"columns": [
                { "data": "id" },
                { "data": "" },
                { "data": "reference_id" },
                { "data": "start_date" },
                { "data": "position" },
                { "data": "end_date" },
                { "data": "head_count" },
                { "data": "shift" },
                { "data": "rate" },
                { "data": "hours" },
                { "data": "reason" },
                { "data": "created_at" },
                { "data": "remark" },
            ],
            "columnDefs": [
                {
                    "targets": [ 10 ],
                    "visible": false,
                    "orderable": false
                },
                {
                	"targets": [0],
                	"visible": false,
                },
                {
                	"targets": [1,4,7,8],
                	"orderable": false,
                },
                {
                    "targets": [2],
//                    "visible": false,
                    "render": function ( data, type, row ) {
                        return  '<a href="/overtime/'+row.id+'" class="overtimeDetail" target="_blank">'+data+'</a>';
                    },
                },
                {
                    "targets": [1],
//                    "visible": false,
                    "render": function ( data, type, row ) {
                        return  '<label class="mt-checkbox mt-checkbox-single mt-checkbox-outline"><input type="checkbox" class="checkboxes" name="chk_overtime_id[]" value="'+row.id+'" /><span></span></label>';
                    },
                },
                
            ],
            // Internationalisation. For more info refer to http://datatables.net/manual/i18n
            "language": {
                "aria": {
                    "sortAscending": ": activate to sort column ascending",
                    "sortDescending": ": activate to sort column descending"
                },
                "emptyTable": "No data available in table",
                "info": "Showing _START_ to _END_ of _TOTAL_ entries",
                "infoEmpty": "No entries found",
                "infoFiltered": "(filtered1 from _MAX_ total entries)",
                "lengthMenu": "_MENU_ entries",
                "search": "Search:",
                "zeroRecords": "No matching records found"
            },

            // Or you can use remote translation file
            //"language": {
            //   url: '//cdn.datatables.net/plug-ins/3cfcc339e89/i18n/Portuguese.json'
            //},

            buttons: [
//                { extend: 'excel', className: 'btn default' },
//                { extend: 'print', className: 'btn default' },
//                { extend: 'pdf', className: 'btn default' },
            ],

            // setup colreorder extension: http://datatables.net/extensions/colreorder/
            colReorder: {
                reorderCallback: function () {
                    console.log( 'callback' );
                }
            },

            // setup rowreorder extension: http://datatables.net/extensions/rowreorder/
//            rowReorder: {
//
//            },
            "rowCallback": function( row, data ) {
                if ( $.inArray(data.id, selected) !== -1 ) {
                    $(row).addClass('selected');
                }
            },
//            "order": [
//                [0, 'asc']
//            ],
            
            "lengthMenu": [
                [5, 10, 15, 20],
                [5, 10, 15, 20] // change per page values here
            ],
            // set the initial value
            "pageLength": 10,

            "dom": "<'row' <'col-md-12'B>><'row'<'col-md-6 col-sm-12'l>r><'table-scrollable't><'row'<'col-md-5 col-sm-12'i><'col-md-7 col-sm-12'p>>", // horizobtal scrollable datatable

            // Uncomment below line("dom" parameter) to fix the dropdown overflow issue in the datatable cells. The default datatable layout
            // setup uses scrollable div(table-scrollable) with overflow:auto to enable vertical scroll(see: assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js). 
            // So when dropdowns used the scrollable div should be removed. 
            //"dom": "<'row' <'col-md-12'T>><'row'<'col-md-6 col-sm-12'l><'col-md-6 col-sm-12'f>r>t<'row'<'col-md-5 col-sm-12'i><'col-md-7 col-sm-12'p>>",
        });
    }; 
    
    var staffOvertimeList=function(){

        var table = $('#staffOvertimeList');
        var status = $('input[name="status"]').val();
        
        var oTable = table.dataTable({
        	"rowId":"id",
        	"serverSide": true,
        	"processing": true,
        	"ajax" : {
    			"url" : "/overtime/approval/"+status,
    			"type" : "POST"
    		},
    		"columns": [
                { "data": "id" },
                { "data": "reference_id" },
                { "data": "start_date" },
                { "data": "position" },
                { "data": "end_date" },
                { "data": "head_count" },
                { "data": "shift" },
                { "data": "rate" },
                { "data": "hours" },
                { "data": "reason" },
                { "data": "created_at" },
                { "data": "remark" },
            ],
            "columnDefs": [
                {
                    "targets": [ 0,8,10 ],
                    "visible": false,
                },
                {
                	"targets": [3,6,7,8],
                	"orderable": false,
                },
               
                {
                    "targets": [1],
//                    "visible": false,
                    "render": function ( data, type, row ) {
                        return  '<a href="/overtime/'+row.id+'" class="overtimeDetail" target="_blank">'+data+'</a>';
                    },
                },
             
                
            ],
            // Internationalisation. For more info refer to http://datatables.net/manual/i18n
            "language": {
                "aria": {
                    "sortAscending": ": activate to sort column ascending",
                    "sortDescending": ": activate to sort column descending"
                },
                "emptyTable": "No data available in table",
                "info": "Showing _START_ to _END_ of _TOTAL_ entries",
                "infoEmpty": "No entries found",
                "infoFiltered": "(filtered1 from _MAX_ total entries)",
                "lengthMenu": "_MENU_ entries",
                "search": "Search:",
                "zeroRecords": "No matching records found"
            },

            // Or you can use remote translation file
            //"language": {
            //   url: '//cdn.datatables.net/plug-ins/3cfcc339e89/i18n/Portuguese.json'
            //},

            buttons: [
//                { extend: 'excel', className: 'btn default' },
//                { extend: 'print', className: 'btn default' },
//                { extend: 'pdf', className: 'btn default' },
            ],

            // setup colreorder extension: http://datatables.net/extensions/colreorder/
            colReorder: {
                reorderCallback: function () {
                    console.log( 'callback' );
                }
            },

            // setup rowreorder extension: http://datatables.net/extensions/rowreorder/
//            rowReorder: {
//
//            },
            "rowCallback": function( row, data ) {
                if ( $.inArray(data.id, selected) !== -1 ) {
                    $(row).addClass('selected');
                }
            },
            "order": [
                [1, 'asc']
            ],
            
            "lengthMenu": [
                [5, 10, 15, 20],
                [5, 10, 15, 20] // change per page values here
            ],
            // set the initial value
            "pageLength": 10,

            "dom": "<'row' <'col-md-12'B>><'row'<'col-md-6 col-sm-12'l>r><'table-scrollable't><'row'<'col-md-5 col-sm-12'i><'col-md-7 col-sm-12'p>>", // horizobtal scrollable datatable

            // Uncomment below line("dom" parameter) to fix the dropdown overflow issue in the datatable cells. The default datatable layout
            // setup uses scrollable div(table-scrollable) with overflow:auto to enable vertical scroll(see: assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js). 
            // So when dropdowns used the scrollable div should be removed. 
            //"dom": "<'row' <'col-md-12'T>><'row'<'col-md-6 col-sm-12'l><'col-md-6 col-sm-12'f>r>t<'row'<'col-md-5 col-sm-12'i><'col-md-7 col-sm-12'p>>",
        });
    
    };
    return {

        //main function to initiate the module
        init: function () {

            if (!jQuery().dataTable) {
                return;
            }

            overTimeRequestList();
            ApprovalOvertimeList();
            staffOvertimeList();

        }

    };

}();

jQuery(document).ready(function() {
	
	TableDatatablesRowreorder.init();
	$('#TblOvertimeList tbody').on('click', 'tr', function () {
        var id = this.id;
        var index = $.inArray(id, selected);
        if ( index === -1 ) {
            selected.push( id );
        } else {
            selected.splice( index, 1 );
        }
 
        $(this).toggleClass('selected');
    } );
	
	// Setup - add a text input to each footer cell
    $('#TblOvertimeList tfoot th').each( function () {
        var title = $(this).text();
        $(this).html( '<input type="text" placeholder="Search '+title+'" />' );
    } );
 
    // DataTable
    var TblOvertimeList = $('#TblOvertimeList').DataTable();
 
    // Apply the search
    TblOvertimeList.columns().every( function () {
        var that = this;
 
        $( 'input', this.footer() ).on( 'keyup change', function () {
            if ( that.search() !== this.value ) {
                that.search( this.value ).draw();
            }
        } );
    } );
    
    //TblApprovalOvertimeList
    
    $('#TblApprovalOvertimeList tbody').on('click', 'tr', function () {
        var id = this.id;
        var index = $.inArray(id, selected);
        if ( index === -1 ) {
            selected.push( id );
        } else {
            selected.splice( index, 1 );
        }
 
        $(this).toggleClass('selected');
    } );
	
	// Setup - add a text input to each footer cell
    $('#TblApprovalOvertimeList tfoot th:gt(0)').each( function () {
        var title = $(this).text();
        $(this).html( '<input type="text" placeholder="Search '+title+'" />' );
    } );
 
    // DataTable
    var TblApprovalOvertimeList = $('#TblApprovalOvertimeList').DataTable();
 
    // Apply the search
    TblApprovalOvertimeList.columns().every( function () {
        var that = this;
 
        $( 'input', this.footer() ).on( 'keyup change', function () {
            if ( that.search() !== this.value ) {
                that.search( this.value ).draw();
            }
        } );
    } );
    //
    var TblApprovalWrapper = jQuery('#TblApprovalOvertimeList_wrapper');
    TblApprovalWrapper.find('.group-checkable').change(function () {
        var set = jQuery(this).attr("data-set");
        var checked = jQuery(this).is(":checked");
        jQuery(set).each(function () {
            if (checked) {
                $(this).prop("checked", true);
                $(this).parents('tr').addClass("active");
            } else {
                $(this).prop("checked", false);
                $(this).parents('tr').removeClass("active");
            }
        });
    });

    TblApprovalWrapper.on('change', 'tbody tr .checkboxes', function () {
        $(this).parents('tr').toggleClass("active");
    });
    
    $('#downloadFile').on('click',function(){
    	window.location.href='/download?filename='+$(this).data('filename');
    });


    $('#approveBtn').on('click',function(){
    	$('#overtime_approval').submit();
    });

    $('#rejectBtn').on('click',function(){
    	$('#overtime_approval').attr('action','/overtime/reject');
    	$('#overtime_approval').submit();
    });
    
    //staffOvertimeList
    
    $('#staffOvertimeList tbody').on('click', 'tr', function () {
        var id = this.id;
        var index = $.inArray(id, selected);
        if ( index === -1 ) {
            selected.push( id );
        } else {
            selected.splice( index, 1 );
        }
 
        $(this).toggleClass('selected');
    } );
	
	// Setup - add a text input to each footer cell
    $('#staffOvertimeList tfoot th').each( function () {
        var title = $(this).text();
        $(this).html( '<input type="text" placeholder="Search '+title+'" />' );
    } );
 
    // DataTable
    var staffOvertimeList = $('#staffOvertimeList').DataTable();
 
    // Apply the search
    staffOvertimeList.columns().every( function () {
        var that = this;
 
        $( 'input', this.footer() ).on( 'keyup change', function () {
            if ( that.search() !== this.value ) {
                that.search( this.value ).draw();
            }
        } );
    } );
    
    
});

