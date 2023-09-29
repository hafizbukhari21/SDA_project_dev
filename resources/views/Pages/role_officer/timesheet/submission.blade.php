@extends('Layouts.mainLayout')

@section('generalContent')
<div class="container-fluid">
    <div class="col-lg-12">
        <div class="card shadow w-100 h-100 " >
            
            <div class="card-body" style=" overflow:scroll">
                <div class="d-flex justify-content-between">
                    <div class="">
                        <h1 class="h5 text-gray-900 mb-4">Submit List</h1>
                    </div>
                   
                  
                </div>
                <div class="table-responsive">
                    <table class="table table-bordered " id="tableTimesheetSubmit" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Title</th>
                                <th>Message</th>
                                <th>Status Submit</th>
                                <th>Submit Date</th>
                                <th>Approval Date</th>
                                <th>Attemp</th>
                                <th>Action</th>
                                
                                
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>Title</th>
                                <th>Message</th>
                                <th>Status Submit</th>
                                <th>Submit Date</th>
                                <th>Approval Date</th>
                                <th>Attemp</th>
                                <th>Action</th>
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

@include('Components.Timesheet.Officer.SubmitTimesheetModal')

@endsection
@section("jsScript")
{{-- <script src="{{ asset('js/Helper/createProject.js') }}"></script> --}}
<script src="{{ asset('js/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('js/datatables/dataTables.bootstrap4.min.js') }}"></script>
<script src="//cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
<script src="//cdn.datatables.net/1.12.1/js/dataTables.bootstrap4.min.js"></script>
<script src="//cdn.datatables.net/buttons/2.2.3/js/dataTables.buttons.min.js"></script>
<script>
    const mySubmitListUrl ="{{route('submission.timesheet.get')}}"
    const ShowTableUnApprove_var= `{{route('show.unApprove.myTimesheet')}}`

</script>
<script src="{{ asset('js/Page/Timesheet/timesheetSubmitList.js') }}"></script>
<script src="{{ asset('js/Page/Timesheet/timesheetGeneral.js') }}"></script>


<script>
        let tableTimesheetApproval = null


      function UpdateTimesheetApproval(uuid){
            let url = ParseRoute_SingleVar("{{route('detail.get.myOfficer',':uuid')}}",uuid,":uuid")
        $.ajax({
            type: "get",
            url ,
            success: function (response) {
                console.log(response)
                $("#titleApprove").html(response.title);
                $("#statusApprove").html(response.status_submit);
                $("#submittedDateApprove").html(response.submitDate);
                $("#attempApprove").html(response.attemp);
                $("#officerApprove").html(response.user.name);
            }
        });
        $('#tableTimesheetApprovalOfficerDetail').DataTable()

        if(!tableTimesheetApproval) tableTimesheetApproval = GeneratedTableTimesheetApproval(url)
        else tableTimesheetApproval.ajax.url(url).load()
    }

    function UpdateTimesheetApprovalOfficer(uuid){
        UpdateTimesheetApproval(uuid)
    }

    $("#tableTimesheetApprovalOfficer tbody").on("click", "td.dt-control", function () {
    let tr = $(this).closest('tr')
    let row = tableTimesheetApproval.row(tr)
    DatatableExpandable({tr,row,format:format(row.data())})

})
</script>

@endsection

@section('css')
@endsection