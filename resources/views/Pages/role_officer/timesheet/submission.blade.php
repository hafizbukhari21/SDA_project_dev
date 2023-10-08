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
    const resubmitTimesheetUrl = "{{route('resubmit.timesheet')}}"

</script>
<script src="{{ asset('js/Page/Timesheet/timesheetSubmitList.js') }}"></script>
<script src="{{ asset('js/Page/Timesheet/timesheetGeneral.js') }}"></script>


<script>
        let tableTimesheetApproval = null
        let  GenerateTableTimesheetSubmit_table = null
        let resubmitButton = null

    $(document).ready(function () {
        GenerateTableTimesheetSubmit_table =  GenerateTableTimesheetSubmit()
    });

      function UpdateTimesheetApproval(uuid){
            let url = ParseRoute_SingleVar("{{route('detail.get.myOfficer',':uuid')}}",uuid,":uuid")
        $.ajax({
            type: "get",
            url ,
            success: function (response) {
                $("#titleApprove").html(response.title);

                $("#statusApprove").html(convertSubmitStatus(response.status_submit).badgeH5);
                if(response.status_submit=='rev'){
                    $("#buttonAction").html(`
                        <button type="button" class="btn btn-success" id="resubmitButton">Re-Submit</button>
                    `)
                }
                   
                else
                    $("#buttonAction").html("")

                resubmitButton = document.querySelector("#resubmitButton")
                $("#resubmitButton").attr("uuid", response.uuid);
                
                resubmitButton.addEventListener("click",()=>reSubmitTimesheet($("#resubmitButton").attr("uuid")))

                $("#resubmitButton").attr("uuid", response.uuid); 
                $("#submittedDateApprove").html(response.submitDate);
                $("#attempApprove").html(response.attemp);
                $("#officerApprove").html(response.user.name);
                $("#messageApprove").val(response.message)
                
            }
        });
        $('#tableTimesheetApprovalOfficerDetail').DataTable()

        if(!tableTimesheetApproval) tableTimesheetApproval = GeneratedTableTimesheetApproval(url)
        else tableTimesheetApproval.ajax.url(url).load()
    }

    function reSubmitTimesheet(uuid){
    PreAjax()
    $.ajax({
        type: "post",
        url: resubmitTimesheetUrl,
        data: {uuid},
        success: function (response) {
            console.log(response)
            $("#SubmitTimesheetDetailModal").modal("hide")
            Alertify({
                    message:"Berhasil Mengirim ulang timesheet",
                    duration:5
                })
            GenerateTableTimesheetSubmit_table.ajax.reload()
        }
    });
}

    function UpdateTimesheetApprovalOfficer(uuid){
        UpdateTimesheetApproval(uuid)
    }

    $("#tableTimesheetApprovalOfficer tbody").on("click", "td.dt-control", function ()      {
        let tr = $(this).closest('tr')
        let row = tableTimesheetApproval.row(tr)
        DatatableExpandable({tr,row,format:formatMessage(row.data())})
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