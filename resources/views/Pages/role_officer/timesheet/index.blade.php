@extends('Layouts.mainLayout')

@section('generalContent')
<div class="container-fluid">
    <div class="  border-0 ">
        <div class="card-body p-0 ">
            <!-- Nested Row within Card Body -->
            <div class="row"  >
                <div class="col-lg-12">
                    <div class="p-4">
                        <div class="">
                            <h1 class="h4 text-gray-900 mb-4">Create Timesheet</h1>
                        </div>
                        <form class="user row  needs-validation" id="addTimeSheet" novalidate>
                            @csrf
                            <div class="col-lg-8 row">
                                <div class="form-group col-lg-12 ">
                                    <label for="customRange2" class="form-label">Summary</label><br>
                                    <input type="text" class="form-control " name="title" id="project_name"placeholder="Title" required>
                                </div>
                                <div class="form-group col-lg-12">
                                    
                                    <textarea type="text" class="form-control " rows="3" name="detail_activity" id="project_name"placeholder="Status" required></textarea>
                                </div>
                                
                            </div>
                            <div class="col-lg-4 row">
                                <div class="form-group col-lg-12">
                                    <label for="customRange2" class="form-label">Date</label><br>
                                    <input type="date" class="form-control " name="activity_date" id="project_name"placeholder="Title" required>
                                </div>
                                <div class="form-group col-lg-6">
                                    <label for="customRange2" class="form-label">Start</label><br>
                                    <input type="time" class="form-control " name="from" id="project_name"placeholder="Title" required>
                                </div>
                                <div class="form-group col-lg-6">
                                    <label for="customRange2" class="form-label">Finish</label><br>
                                    <input type="time" class="form-control " name="finish" id="project_name"placeholder="Status" required>
                                </div>
                            </div>
                          
                            <!-- <input type="hidden" name="user_creator_id" value="{{session()->get("sessionKey")["id"]}}"> -->
                            <input type="hidden" name="timeSheet_id" value="{{$payload->timesheet->id}}" required>

                            
                            <div class="col-lg-12 row"  >
                                <div class="form-group  btn-block col-lg-12">
                                <button type="submit" class="btn btn-primary  ">
                                    Create Timesheet 
                                </button>
                                </div>
                               
                            </div>
                            
                       
                        </form>
                   
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="card shadow w-100 h-100 " >
                        
                        <div class="card-body" style=" overflow:scroll">
                            <div class="d-flex justify-content-between">
                                <div class="">
                                    <h1 class="h5 text-gray-900 mb-4">Approval By - {{$payload->myhead->name}}</h1>
                                </div>
                                <button type="button" class="btn btn-success mb-4 lv" onclick="fetchPreviewUpdate()" data-toggle="modal" data-target="#previewApprovalTimesheet">
                                    Make Approval 
                                </button>
                              
                            </div>
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
                                            <th>Action</th>
                                            
                                            
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
                                            <th>Request</th>
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


@include('Components.Timesheet.Officer.UpdateTimesheetModal')
@include('Components.Timesheet.Officer.PreviewApprovalModal')
@include('Components.Timesheet.Officer.DeleteTimesheetModal')




@endsection

@section("jsScript")
{{-- <script src="{{ asset('js/Helper/createProject.js') }}"></script> --}}
<script src="{{ asset('js/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('js/datatables/dataTables.bootstrap4.min.js') }}"></script>
<script src="//cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
<script src="//cdn.datatables.net/1.12.1/js/dataTables.bootstrap4.min.js"></script>
<script src="//cdn.datatables.net/buttons/2.2.3/js/dataTables.buttons.min.js"></script>



<script id="myscriptvar">
    ///var url
    const ShowTableTimesheet_var= `{{route('show.myTimesheet',["idTimesheet"=>$payload->timesheet->id])}}`
    const ShowTableUnApprove_var= `{{route('show.unApprove.myTimesheet')}}`
    const buttonSendRequest_var = `{{ route('make.request.timesheet') }}`
    const deleteTimesheet_var = "{{route('delete.timesheet')}}"
    
</script>

<script src="{{ asset('js/Page/Timesheet/timesheet.js') }}"></script>
<script src="{{ asset('js/Page/Timesheet/timesheetGeneral.js') }}"></script>



<script id="myscript">
    // ProtectThis()
    let tableTimesheet = null
    let tableTimesheetApprove = null
    $(document).ready(function () {
        
        tableTimesheet= ShowTableTimesheet()
        tableTimesheetApprove = ShowTableUnApprove();
        tableTimesheet.on("order.dt search.dt", () => {
                let i = 1
                tableTimesheet.cells(null, 0, { search: 'applied', order: 'applied' }).every(function (cell) {
                    this.data(i++);
                });
            }).draw()
    });

    $("#addTimeSheet").submit(function (e) { 
        e.preventDefault()
        $.ajax({
            type: "post",
            url: "{{route('create.timesheet')}}",
            data: $(this).serialize(),
            success: function (response) {
               
                tableTimesheet.ajax.reload()
                Alertify({
                    message:"Berhasil Menambahkan Timesheet",
                    duration:5
                })
            },error:function(error){
                console.log(error.responseJSON.message) 
                AlertifyFailed({
                message:error.responseJSON.message,
                duration:5
            })
            }
        });
    });

    document.querySelector("#deleteTimesheetActivityButton").addEventListener("click",()=>{
        PreAjax()
        $.ajax({
            type: "post",
            url: deleteTimesheet_var,
            data: {uuid:$("#deleteTimesheetActivityButton").attr("uid")},
            success: function (response) {
                tableTimesheet.ajax.reload()
                Alertify({
                    message:"Berhasil Menghapus Timesheet",
                    duration:5
                })
            }
        });
    })

    $("#updateTimeSheet").submit(function (e) { 
        e.preventDefault();
        $.ajax({
            type: "post",
            url: "{{route('update.timesheet')}}",
            data: $(this).serialize(),
            success: function (response) {
                tableTimesheet.ajax.reload()
                Alertify({
                    message:"Berhasil Mengubah Timesheet",
                    duration:5
                })
            },
            error:function(error){
                    
                AlertifyFailed({
                message:error.responseJSON.message,
                duration:5
            })
            }
        });
    });
  

    function fetchPreviewUpdate(){
    
        tableTimesheetApprove.ajax.reload()
    }


    function UpdateTimesheet(id){
        console.log(id)
        $.ajax({
            type: "get",
            url: ParseRoute_SingleVar("{{route('get.timesheet.activity',':id')}}",id,":id"),
            success: function (response) {
                console.log(response)
                document.querySelector("#upd_uuid").value = response.uuid
                document.querySelector("#upd_title").value = response.title
                document.querySelector("#upd_detail_activity").value = response.detail_activity
                document.querySelector("#upd_activity_date").value = response.activity_date
                document.querySelector("#upd_from").value = response.from
                document.querySelector("#upd_finish").value = response.finish
            }
        });
    }

 
    
      
    $("#tableTimesheet tbody").on("click", "td.dt-control", function () {
        let tr = $(this).closest('tr')
        let row = tableTimesheet.row(tr)
        DatatableExpandable({tr,row,format:format(row.data())})
    })

    
   
</script>
@endsection
@section('css')
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.3/css/buttons.dataTables.min.css" />
@endsection