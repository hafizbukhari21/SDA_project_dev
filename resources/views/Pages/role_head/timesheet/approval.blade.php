@extends('Layouts.mainLayout')

@section('generalContent')
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="row">
        <div class="col-xl-12 col-lg-12">
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div
                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between" id="timelineHeader">
                    <h6 class="m-0 font-weight-bold text-primary">Timesheet Approval </h6>  
                </div>
                <!-- Card Body -->
                <div class="card-body ">
                <div class="row">
                     <div class="form-group col-xl-6 col-lg-12">
                            
                        <select class="form-control" id="selectOfficer" name="pic_id" aria-label="Default select example">
                        </select>

                    </div>
                    <div>
                        <div class="table-responsive">
                            <table class="table table-bordered " id="tableTimesheet" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th></th>
                                        <th>Title</th>
                                        <th>Status</th>
                                        <th>Date</th>
                                        <th>Start</th>
                                        <th>Finish</th>
                                        <th>Request</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th></th>
                                        <th>Title</th>
                                    
                                        <th>Status</th>
                                        <th>Date</th>
                                        <th>Start</th>
                                        <th>Finish</th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                 
                                  
                                </tbody>
                            </table>
                        </div> 
                    </div>

                    
                    
                </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section("jsScript")
<script>


    $(document).ready(function () {
        $.ajax({
            type: "get",
            url: "{{route('get.myofficer.timesheet')}}",
            success: function (response) {
                MappingSelectOption({
                        default:"Select Officer",
                        element:document.querySelector("#selectOfficer"),
                        data : response.map(e => ({id:e.user.id, name:`${e.user.name} - ${e.user.email}`}))
                    })
            }
        });
    });




</script>
@endsection
    

@section('css')
@endsection