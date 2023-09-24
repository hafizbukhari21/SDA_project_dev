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
@endsection

@section("jsScript")
<script src="{{ asset('js/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('js/datatables/dataTables.bootstrap4.min.js') }}"></script>
<script src="//cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
<script src="//cdn.datatables.net/1.12.1/js/dataTables.bootstrap4.min.js"></script>
<script src="//cdn.datatables.net/buttons/2.2.3/js/dataTables.buttons.min.js"></script>

<script>

    let selectOfficer = document.querySelector("#selectOfficer")
    let tableTimesheetSubmit =null
    let firstGenTableTimeSheetSubmit=false

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
                    "data":"id",
                    render: function (data, type, row, meta) {
                     return `<div class="btn-group ">
                            <a href="#" class="btn btn-sm btn-danger" id="${data}" title="Show Detail" onClick="DeleteTimeSheet('${data}')" data-toggle="modal" data-target="#">
                            <i class="fas fa-trash"></i>
                            </a>
                            <br>
                            <a href="#" class="btn btn-sm btn-warning" id="${data}" title="Show Detail" onClick="UpdateTimesheet('${data}')" data-toggle="modal" data-target="#udapteTimeSheetModal" >
                            <i class="fa fa-info-circle"></i>
                            </a>
                            </div>`
                    }
                },
            ]
        })
    }


</script>
@endsection
    
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.3/css/buttons.dataTables.min.css" />

@section('css')
@endsection