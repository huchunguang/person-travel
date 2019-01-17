@extends("etravel.layout.main") 


@section("content")
<!-- BEGIN CONTENT BODY -->
<!-- BEGIN PAGE HEAD-->

<!-- END PAGE HEAD-->
<!-- BEGIN PAGE CONTENT BODY -->
<div class="page-content">
    <div class="container">
        
        <div class="page-content-inner">
            <div class="row">
                <div class="col-md-12">
                    <div class="portlet box light">
                        
                        <div class="portlet-body form">
                            <object data="{{$pdf_file}}" type="application/pdf" width="100%" height="600px">
                                <param name="view" value="fitW" />
                                <p>It appears you don't have a PDF plugin for this browser.
                                    No worries... you can <a href="{{$pdf_file}}">click here to
                                        download the PDF file.</a></p>
                            </object> 
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
