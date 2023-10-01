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
    const removeActivityFromSubmitUrl = "{{route('submission.timesheet.delete')}}"
    const deletedSubmittedFormUrl = "{{route('submission.timesheet.delete.submittedForm')}}"

</script>
<script src="{{ asset('js/Page/Timesheet/timesheetSubmitList.js') }}"></script>
<script src="{{ asset('js/Page/Timesheet/timesheetGeneral.js') }}"></script>


<script>
        let tableTimesheetApproval = null
        let  GenerateTableTimesheetSubmit_table = null

    $(document).ready(function () {
        GenerateTableTimesheetSubmit_table =  GenerateTableTimesheetSubmit()

    });

      function UpdateTimesheetApproval(uuid){
            let url = ParseRoute_SingleVar("{{route('detail.get.myOfficer',':uuid')}}",uuid,":uuid")
        $.ajax({
            type: "get",
            url ,
            success: function (response) {
                console.log(response)
                $("#titleApprove").html(response.title);
                $("#statusApprove").html(convertSubmitStatus(response.status_submit).badgeH5);
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

    $("#tableTimesheetApprovalOfficer tbody").on("click", "td.dt-control", function ()      {
        let tr = $(this).closest('tr')
        let row = tableTimesheetApproval.row(tr)
        DatatableExpandable({tr,row,format:format(row.data())})
    })

    function DeleteTimesheetApprovalOfficer(uuid){
        PreAjax()
        $.ajax({
            type: "post",
            url: deletedSubmittedFormUrl,
            data: {uuid},

            success: function (response) {
                console.log(response)
                Alertify({
                            message:"Berhasil Menghapus Form Submit",
                            duration:5
                        })
                    GenerateTableTimesheetSubmit_table.ajax.reload()
                }, 
                error:function(error){
                    console.log(error)
                    AlertifyFailed({
                        message:"Format tidak sesuai - General Error",
                        duration:5
                    })
                }
            });
    }


function DeleteActivityFromSubmit(uuid){
    PreAjax()
    $.ajax({
        type: "post",
        url: removeActivityFromSubmitUrl,
        data: {uuid},
        success: function (response) {
            console.log(response)
            Alertify({
                    message:"Activity Dikembalikan ",
                    duration:5
                })
            tableTimesheetApproval.ajax.reload()
            GenerateTableTimesheetSubmit_table.ajax.reload()
        }, 
        error:function(error){
            console.log(error)
            AlertifyFailed({
                message:"Format tidak sesuai - General Error",
                duration:5
            })
        }
    });
}

</script>

@endsection

@section('css')
@endsection