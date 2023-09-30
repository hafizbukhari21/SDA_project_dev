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
                    <div class="col-xl-12 ">
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
        </div>
    </div>
</div>
@include('Components.Timesheet.Head.ActionApprovalModal')

@endsection

@section("jsScript")
<script src="{{ asset('js/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('js/datatables/dataTables.bootstrap4.min.js') }}"></script>
<script src="//cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
<script src="//cdn.datatables.net/1.12.1/js/dataTables.bootstrap4.min.js"></script>
<script src="//cdn.datatables.net/buttons/2.2.3/js/dataTables.buttons.min.js"></script>
<script src="{{ asset('js/Page/Timesheet/timesheetHead.js') }}"></script>
<script src="{{ asset('js/Page/Timesheet/timesheetGeneral.js') }}"></script>

<script>
    const apvTimesheetUrl = "{{route('apv.timesheet')}}"
</script>

<script>

    let selectOfficer = document.querySelector("#selectOfficer")
    let tableTimesheetSubmit =null
    let tableTimesheetApproval = null
    let firstGenTableTimeSheetSubmit=false

    let apvButton = document.querySelector("#apvButton")
    let revButton = document.querySelector("#revButton")

    $(document).ready(function () {
        $.ajax({
            type: "get",
            url: "{{route('get.myofficer.timesheet')}}",
            success: function (response) {
                console.log(response)
                MappingSelectOption({
                        default:"Select Officer",
                        element:document.querySelector("#selectOfficer"),
                        data : response.map(e => ({id:e.user.id, name:`${e.user.name} - ${e.user.email}`}))
                    })
                TriggerGeneratedTableApproval()
            }
        });

    });


    selectOfficer.addEventListener("change",()=>{
        TriggerGeneratedTableApproval()
    })

    function TriggerGeneratedTableApproval(){
        id=selectOfficer.value
        if(!firstGenTableTimeSheetSubmit)  {
            tableTimesheetSubmit= GenerateTableTimesheet(id)
            firstGenTableTimeSheetSubmit=true
        }
        else tableTimesheetSubmit.ajax.url( ParseRoute_SingleVar("{{route('get.myofficer.timesheet_submit',':id')}}",id,":id")).load()
    }


    function GenerateTableTimesheet (id) {
        return DatatableFormater_serverSide({
            element:"#tableTimesheetSubmit",
            dataSrc:"data",
            url:ParseRoute_SingleVar("{{route('get.myofficer.timesheet_submit',':id')}}",id,":id"),
            columns:[
                {"data":"title"},
                {"data":"message"},
                {"data":"status_submit"},
                {"data":"submitDate"},
                {"data":"approvalDate"},
                {"data":"attemp"},
                {
                    "data":"uuid",
                    render: function (data, type, row, meta) {
                     return `
                            <a href="#" class="btn btn-sm btn-warning" id="${data}" title="Show Detail" onClick="UpdateTimesheetApproval('${data}')" data-toggle="modal" data-target="#previewApprovalTimesheetHead" >
                            <i class="fa fa-info-circle"></i>
                            </a>
                            </div>`
                    }
                },
            ]
        })
    }


    function UpdateTimesheetApproval(uuid){
            let url = ParseRoute_SingleVar("{{route('detail.get.myOfficer',':uuid')}}",uuid,":uuid")

            DoAjaxUpdateTimesheetApproval(url)

            if(!tableTimesheetApproval) tableTimesheetApproval = GeneratedTableTimesheetApproval(url)
            else tableTimesheetApproval.ajax.url(url).load()
    }

    function GeneratedTableTimesheetApproval(url){
        return  $('#tableTimesheetApproval').DataTable({
                
                ajax: {
                    url,
                    "dataType": "json",
                    "dataSrc": "timesheetactivity",
                },

                columns: [
                    {
                        className: "dt-control",
                        orderable: true,
                        data: null,
                        defaultContent:'<button type="button" class="btn-sm btn-primary">+</button>'
                    },
                    {"data":"title"},
                    {"data":"status"},
                    {"data":"activity_date"},
                    {"data":"from"},
                    {"data":"finish"},
                ]
        })
    }

    $("#tableTimesheetApproval tbody").on("click", "td.dt-control", function () {
        let tr = $(this).closest('tr')
        let row = tableTimesheetApproval.row(tr)
        DatatableExpandable({tr,row,format:format(row.data())})
    })
    
    apvButton.addEventListener("click",e=>{
        e.preventDefault()
        DoAjaxAproveTimesheet(
            apvTimesheetUrl,
            $("#apvButton").attr("uuid"),
            response=>{
                let url = ParseRoute_SingleVar("{{route('detail.get.myOfficer',':uuid')}}",response.uuid,":uuid")
                console.log(url)
                DoAjaxUpdateTimesheetApproval(url)//Update Contain Modal
                TriggerGeneratedTableApproval()//Update Table SubmitList
                tableTimesheetApproval.ajax.reload()//Updalte Table Modal
                Alertify({
                    message:"Timesheet Berhasil di Approve",
                    duration:5
                })
            }
        )
    })

    
    

   


</script>
@endsection
    
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.3/css/buttons.dataTables.min.css" />

@section('css')
@endsection