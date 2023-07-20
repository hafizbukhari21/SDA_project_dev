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
                        <form class="user row" id="addTimeSheet">
                            @csrf
                            <div class="col-lg-8 row">
                                <div class="form-group col-lg-12 ">
                                    <label for="customRange2" class="form-label">Summary</label><br>
                                    <input type="text" class="form-control " name="title" id="project_name"placeholder="Title">
                                </div>
                                <div class="form-group col-lg-12">
                                    
                                    <textarea type="text" class="form-control " rows="3" name="detail_activity" id="project_name"placeholder="Status"></textarea>
                                </div>
                                
                            </div>
                            <div class="col-lg-4 row">
                                <div class="form-group col-lg-12">
                                    <label for="customRange2" class="form-label">Date</label><br>
                                    <input type="date" class="form-control " name="activity_date" id="project_name"placeholder="Title">
                                </div>
                                <div class="form-group col-lg-6">
                                    <label for="customRange2" class="form-label">Start</label><br>
                                    <input type="time" class="form-control " name="from" id="project_name"placeholder="Title">
                                </div>
                                <div class="form-group col-lg-6">
                                    <label for="customRange2" class="form-label">Finish</label><br>
                                    <input type="time" class="form-control " name="finish" id="project_name"placeholder="Status">
                                </div>
                            </div>
                          
                            <!-- <input type="hidden" name="user_creator_id" value="{{session()->get("sessionKey")["id"]}}"> -->
                            <input type="hidden" name="timeSheet_id" value="{{$payload->timesheet->id}}">

                            
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
                        
                        <div class="card-body" style="height: 80vh; overflow:scroll">
                            <div class="d-flex justify-content-between">
                                <div class="">
                                    <h1 class="h5 text-gray-900 mb-4">Approval By - {{$payload->myhead->name}}</h1>
                                </div>
                                <button type="button" class="btn btn-success mb-4 lv" data-toggle="modal" data-target="#previewApprovalTimesheet">
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

<!-- Add Update Timesheet Modal -->
<div class="modal fade" id="udapteTimeSheetModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Update Timesheet</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="col-lg-12">
                        <div class="p-4">
                            
                            <form class="user row" id="updateTimeSheet">
                                @csrf
                                <div class="col-lg-6 row">
                                    <div class="form-group col-lg-12 ">
                                        <label for="customRange2" class="form-label">Summary</label><br>
                                        <input type="text" class="form-control " name="title" id="upd_title"placeholder="Title">
                                    </div>
                                    <div class="form-group col-lg-12">
                                        
                                        <textarea type="text" class="form-control " rows="3" name="detail_activity" id="upd_detail_activity"placeholder="Status"></textarea>
                                    </div>
                                    
                                </div>
                                <div class="col-lg-6 row">
                                    <div class="form-group col-lg-12">
                                        <label for="customRange2" class="form-label">Date</label><br>
                                        <input type="date" class="form-control " name="activity_date" id="upd_activity_date"placeholder="Title">
                                    </div>
                                    <div class="form-group col-lg-6">
                                        <label for="customRange2" class="form-label">Start</label><br>
                                        <input type="time" class="form-control " name="from" id="upd_from"placeholder="Title">
                                    </div>
                                    <div class="form-group col-lg-6">
                                        <label for="customRange2" class="form-label">Finish</label><br>
                                        <input type="time" class="form-control " name="finish" id="upd_finish"placeholder="Status">
                                    </div>
                                </div>
                              
                                <input type="hidden" name="id" id="upd_id" value="">
                                
                                
                                <div class="col-lg-12 row"  >
                                    <div class="form-group  btn-block col-lg-12">
                                    <button type="submit" class="btn btn-primary  ">
                                        Udpate Activity 
                                    </button>
                                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>

                                    </div>
                                   
                                </div>
                                
                           
                            </form>
                       
                        </div>
                    </div>
                        
                   
                    
                </div>
                <!-- <div class="modal-footer">
                    {{-- <button class="btn btn-primary" href="">Create</button> --}}
                </div> -->
            </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="previewApprovalTimesheet" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Approval Preview</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="col-lg-12">
                        <div class="p-4">
                            
                            
                       
                        </div>
                    </div>
                        
                   
                    
                </div>
                <!-- <div class="modal-footer">
                    {{-- <button class="btn btn-primary" href="">Create</button> --}}
                </div> -->
            </form>
            </div>
        </div>
    </div>

    @php
        $idLabel="deleteActivityModal"
    @endphp
    @include('Components.deleteModal',compact("idLabel"))
@endsection

@section("jsScript")
{{-- <script src="{{ asset('js/Helper/createProject.js') }}"></script> --}}
<script src="{{ asset('js/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('js/datatables/dataTables.bootstrap4.min.js') }}"></script>
<script src="//cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
<script src="//cdn.datatables.net/1.12.1/js/dataTables.bootstrap4.min.js"></script>
<script src="//cdn.datatables.net/buttons/2.2.3/js/dataTables.buttons.min.js"></script>

<script id="myscript">
    ProtectThis()
    let tableTimesheet = null
    $(document).ready(function () {
        
        tableTimesheet= ShowTableTimesheet()
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
                SweetAlertSimple({
                    title:"Berhasil Menambahkan Timehseet",
                    timer:1000
                })
            }
        });
    });

    $("#updateTimeSheet").submit(function (e) { 
        e.preventDefault();
        $.ajax({
            type: "post",
            url: "{{route('update.timesheet')}}",
            data: $(this).serialize(),
            success: function (response) {
                tableTimesheet.ajax.reload()
                SweetAlertSimple({
                    title:"Berhasil Mengubah Activity",
                    timer:1000
                })
            }
        });
    });

    function ShowTableTimesheet(){
            let table = $('#tableTimesheet').DataTable({
                
            ajax: {
                url: `{{route('show.myTimesheet',["idTimesheet"=>$payload->timesheet->id])}}`,
                "dataType": "json",
                "dataSrc": "",
            },
   
                columns: [
                    {
                        className: "dt-control",
                        orderable: false,
                        data: null,
                        defaultContent:'<button type="button" class="btn-sm btn-primary">+</button>'
                    },
                    {
                        "data":"title",
                    },
                   
                    {
                        "data":"status",
                    },
                    {
                        "data":"activity_date",
                    },
                    {
                        "data":"from",
                    },
                    {
                        "data":"finish",
                       
                    },
                  
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
            });

            return table
    }


    function UpdateTimesheet(id){
        console.log(id)
        $.ajax({
            type: "get",
            url: ParseRoute_SingleVar("{{route('get.timesheet.activity',':id')}}",id,":id"),
            success: function (response) {
                document.querySelector("#upd_id").value = response.id
                document.querySelector("#upd_title").value = response.title
                document.querySelector("#upd_detail_activity").value = response.detail_activity
                document.querySelector("#upd_activity_date").value = response.activity_date
                document.querySelector("#upd_from").value = response.from
                document.querySelector("#upd_finish").value = response.finish
            }
        });
    }

        function DeleteTimeSheet(id){
            $.ajax({
                type: "method",
                url: "url",
                data: "data",
                success: function (response) {
                    
                }
            });
        }


        function format(d) {
            console.log(d)
            return `
                    <table class="table">
                        <thead>
                            
                            <th scope="col" style="width: 70%">Detail Activity</th>
                            <th scope="col" style="width: 30%">Overtime</th>
                        <thead>
                        <tbody>
                        <tr>
                            
                            <td>${d.detail_activity}</td>
                            <td>${overtimeCount(d.finish)}</td>
                           
                        </tr>
                        <tr>
                        </tbody>
                    </table>                    
            `
        }

        function overtimeCount(data ) {
            let finish = moment(data,"HH:mm:ss")
            let overtTimeAfter = moment("17:30:00","HH:mm:ss")
            let duration = moment.duration(finish.diff(overtTimeAfter))
            // console.log(duration.hours() +" | "+ duration.minutes())
            return `${duration.hours()} hours and ${duration.minutes()} minutes`
        }
    
            
        $("#tableTimesheet tbody").on("click", "td.dt-control", function () {
            let tr = $(this).closest('tr')
            let row = tableTimesheet.row(tr)
            
            if (row.child.isShown()) {
                row.child.hide()
                tr.removeClass("shown")
            } else {
                row.child(format(row.data())).show()
                tr.addClass("shown")
            }
        })



          


        
</script>
@endsection
@section('css')
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.3/css/buttons.dataTables.min.css" />

@endsection