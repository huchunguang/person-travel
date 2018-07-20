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
                { "data": "reference_id" },
                { "data": "start_date" },
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
                    "targets": [ 1,8,10 ],
                    "visible": false,
                    "orderable": false
                },
                {
                	"targets": [0],
//                	"visible": false,
                },
                {
                    "targets": [ 1 ,2],
//                    "visible": false,
                    "render": function ( data, type, row ) {
                        return  '<a href="/overtime/'+row.id+'" class="overtimeDetail">'+data+'</a>';
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
            rowReorder: {

            },
            "rowCallback": function( row, data ) {
                if ( $.inArray(data.id, selected) !== -1 ) {
                    $(row).addClass('selected');
                }
            },
            "order": [
                [0, 'asc']
            ],
            
            "lengthMenu": [
                [5, 10, 15, 20, -1],
                [5, 10, 15, 20, "All"] // change per page values here
            ],
            // set the initial value
            "pageLength": 10,

            "dom": "<'row' <'col-md-12'B>><'row'<'col-md-6 col-sm-12'l>r><'table-scrollable't><'row'<'col-md-5 col-sm-12'i><'col-md-7 col-sm-12'p>>", // horizobtal scrollable datatable

            // Uncomment below line("dom" parameter) to fix the dropdown overflow issue in the datatable cells. The default datatable layout
            // setup uses scrollable div(table-scrollable) with overflow:auto to enable vertical scroll(see: assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js). 
            // So when dropdowns used the scrollable div should be removed. 
            //"dom": "<'row' <'col-md-12'T>><'row'<'col-md-6 col-sm-12'l><'col-md-6 col-sm-12'f>r>t<'row'<'col-md-5 col-sm-12'i><'col-md-7 col-sm-12'p>>",
        });
    }

    return {

        //main function to initiate the module
        init: function () {

            if (!jQuery().dataTable) {
                return;
            }

            overTimeRequestList();

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
    var table = $('#TblOvertimeList').DataTable();
 
    // Apply the search
    table.columns().every( function () {
        var that = this;
 
        $( 'input', this.footer() ).on( 'keyup change', function () {
            if ( that.search() !== this.value ) {
                that.search( this.value ).draw();
            }
        } );
    } );
    $('.overtimeDetail').on('click',function(){
    	alert(123);
    });
});

