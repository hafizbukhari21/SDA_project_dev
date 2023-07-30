@extends('Layouts.mainLayout')

@section('generalContent')
<div class="container-fluid">
    <div class="  border-0 ">
        <div class="card-body p-0 ">
            <!-- Nested Row within Card Body -->
            <div class="row"  >
                <div class="col-lg-4">
                    <div class="p-4">
                        <div class="">
                            <h1 class="h4 text-gray-900 mb-4">Create Project</h1>
                        </div>
                        <form class="user" id="addProjectForm">
                            @csrf
                            <div class="form-group ">
                                
                                    <input type="text" class="form-control " name="project_name" id="project_name"placeholder="Project Name">
                                
                               
                            </div>
                            <div class="form-group">
                                <select class="form-control" id="project_pic_id" name="pic_id" aria-label="Default select example">
                                    <!-- <option selected>PIC</option>
                                    <option value="1">One</option>
                                    <option value="2">Two</option>
                                    <option value="3">Three</option> -->
                                  </select>

                            </div>
                            <div class="form-group ">
                                
                                <select class="form-control " id="category_project" name="category_id" aria-label="Default select example">
                                   
                                  </select>
                            </div>
                            <div class="form-group">
                                <textarea type="text" class="form-control " id="exampleFirstName" name= "status" placeholder="Status"></textarea>

                            </div>
                            <div class="form-group ">
                                <input type="number" class="form-control " id="exampleFirstName"placeholder="Time" name="time">

                            </div>
                            <div class="form-group">
                                
                                <label for="customRange2" class="form-label">Urgensi - <span>10</span></label><br>
                                <input type="range" class="form-control" min="0" max="5" name="urgensi" id="customRange2">
                            </div>
                            <input type="hidden" name="user_creator_id" value="{{session()->get("sessionKey")["id"]}}">
                            
                                
                            {{-- <div class="form-group row">
                                <div class="col-sm-6 mb-3 mb-sm-0">
                                    <input type="password" class="form-control "
                                        id="exampleInputPassword" placeholder="Password">
                                </div>
                                <div class="col-sm-6">
                                    <input type="password" class="form-control "
                                        id="exampleRepeatPassword" placeholder="Repeat Password">
                                </div>
                            </div> --}}
                            <button type="submit" class="btn btn-primary   btn-block">
                                Create Project 
                            </button>
                            
                       
                        </form>
                        {{-- <div class="text-center">
                            <a class="small" href="forgot-password.html">Forgot Password?</a>
                        </div>
                        <div class="text-center">
                            <a class="small" href="login.html">Already have an account? Login!</a>
                        </div> --}}
                    </div>
                </div>
                <div class="col-lg-8">
                    <div class="card shadow w-100 h-100 " >
                        
                        <div class="card-body" style="height: 80vh; overflow:scroll">
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover" id="tableProject" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Project Name</th>
                                            <th>PIC Name</th>
                                            <th>Status</th>
                                            <th>Urgensi</th>
                                            <th>Time</th>
                                            <th>Action</th>
                                            
                                            
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>Project Name</th>
                                            <th>PIC Name</th>
                                            <th>Status</th>
                                            <th>Urgensi</th>
                                            <th>Time</th>
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

@include('Components.DeleteModal.deleteProject')

@endsection

@section("jsScript")
    {{-- <script src="{{ asset('js/Helper/createProject.js') }}"></script> --}}
    <script src="{{ asset('js/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('js/datatables/dataTables.bootstrap4.min.js') }}"></script>
    <script src="//cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script src="//cdn.datatables.net/1.12.1/js/dataTables.bootstrap4.min.js"></script>
    <script src="//cdn.datatables.net/buttons/2.2.3/js/dataTables.buttons.min.js"></script>
    <script id="myscript">
        // ProtectThis()
        let table =null
        let deleteId = null

        $(document).ready(function () {
            
            getAjax()
            table = ShowTableProject()
        })

        $("#addProjectForm").submit(function (e) { 
            e.preventDefault()
            $.ajax({
                type: "POST",
                url: "{{route('project.myProject')}}",
                data: $(this).serialize(),
                success: function (response) {
                    table.ajax.reload()
                    Alertify({
                        message:"Berhasil Menambahkan Project",
                        duration:5
                    })
                }
                
            });
        });
        $("#tableProject ").on('click', 'tbody tr td:not(:last-child)', function() {
            window.location.href = "/project/detail/"+table.row(this).data().id
            console.log('API row values : ', );
        })



        function getAjax(){
            $.ajax({
                type: "GET",
                url: "{{route('project.category.all')}}",
                success: function (response) {
                    MappingSelectOption({
                        default:"Select Category Project",
                        element:document.querySelector("#category_project"),
                        data : response.map(e => ({id:e.id, name:e.category_name}))
                    })
                }
            });

            $.ajax({
                type: "GET",
                url: "{{route('user.head')}}",
                success: function (response) {
                    MappingSelectOption({
                        default:"Select PIC Project",
                        element:document.querySelector("#project_pic_id"),
                        data : response.map(e => ({id:e.id, name:e.name}))
                    })
                }
            });
        }
        

        function ShowTableProject(){
            let table = $('#tableProject').DataTable({
                
            ajax: {
                url: `{{route('project.picAndCreator.myProject')}}`,
                "dataType": "json",
                "dataSrc": "",
            },
   
                columns: [
                    {
                        "data":"project_name",
                    },
                    {
                        "data":"pic_id.name",
                    },
                    {
                        "data":"status",
                    },
                    {
                        "data":"urgensi",
                    },
                    {
                        "data":"time",
                    },
                    {
                        "data":"id",
                        render: function (data, type, row, meta) {
                            console.log(row.project_name)
                    return `<div class="btn-group ">
                                <a type="button" class="btn btn-sm btn-danger" id="${data}" title="Show Detail"  data-toggle="modal" data-target="#deleteProjectModal" onclick="setDeleteProject(${data},'${row.project_name}')">
                                <i class="fas fa-trash"></i>
                                </a>
                                <br>
                                <br>
                                <a type="button" class="btn btn-sm btn-warning" id="${data}" title="Show Detail" oncClick="UpdateProject('${data}')">
                                <i class="fas fa-edit"></i>
                                </a>
                                <a type="button" class="btn btn-sm btn-success" id="${data}" title="Show Detail" href="/project/detail/${data}">
                                <i class="fa fa-info-circle"></i>
                                </a>
                            </div>`
                }
                    },
                  
                 
                ]
            });

            return table
        }


        //Set attribut delete Modal
        function setDeleteProject(id,project_name){
            $("#deleteModalBody").html("Apakah anda Yakin ingin menghapus Project " +project_name+"?");
            $("#deleteModalButton").attr("onclick", `DeleteProject(${id})`);
        }
      
        //Eksekusi Setelah Delete Modal Keluar Function ada di button modal
        function DeleteProject(id){
            
            $.ajax({
                type: "get",
                url: "{{route('project.myProject.delete')}}",
                data:{id},
                success: function (response) {
                    table.ajax.reload()
                    Alertify({
                            message:"Berhasil Menghapus Project",
                            duration:5
                        })
                }
            });
        }
        
        function GetProjectform(){
            // let payload = {
            //     pic_id:"",
            //     category_id:"",
            //     status:"",
            //     time:"",
            //     urgensi:"",
            //     user_creator_id:"",
            //     _token:
            // }
           
        }
       
    </script>
@endsection