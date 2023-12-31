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
                        <form class="user needs-validation" id="addProjectForm" novalidate>
                            @csrf
                            <div class="form-group ">
                                <input type="text" class="form-control " name="project_name" id="project_name"placeholder="Project Name" required>
                            </div>
                            <div class="form-group ">
                                <input type="text" class="form-control " name="idProjectJalin" id="idProjectJalin"placeholder="Project ID QAMS" required>
                            </div>
                            <div class="form-group ">
                                <input type="text" class="form-control " name="pic_am" id="idPIAM"placeholder="PIC AM" required>
                            </div>
                            @if (session()->get("sessionKey")["role"]=="Head")
                            <div class="form-group">
                                <label for="">PIC</label>

                                <select class="form-control" id="project_pic_id" name="user_creator_id" aria-label="Default select example" required>
                                    <!-- <option selected>PIC</option>
                                    <option value="1">One</option>
                                    <option value="2">Two</option>
                                    <option value="3">Three</option> -->
                                  </select>
                            </div>
                            @else
                            <input type="hidden" class="form-control " name="user_creator_id" >

                            @endif
                            <div class="form-group ">
                                <label for="">Category</label>
                                <select class="form-control " id="category_project" name="category_id" aria-label="Default select example" required>
                                  </select>
                            </div>
                            <div class="form-group">
                                <label for="">Status</label>
                                <textarea type="text" class="form-control " id="statusAdd" name= "status" placeholder="Status" aria-describedby="validationServerStatusFeedback" required></textarea>
                                <div id="validationServerStatusFeedback" class="invalid-feedback">
                                    Please insert Status
                                  </div>

                            </div>
                            <div class="form-group ">
                                <input type="number" class="form-control " id="exampleFirstName"placeholder="Time" name="time" step="0.5" required>

                            </div>
                            <div class="form-group">
                                
                                <label for="customRange2" class="form-label">Urgensi - <span id="previewUrgensi" >0</span></label><br>
                                <input type="range" class="form-control" value="0" min="0" max="5" name="urgensi" step="1" id="urgensi" required>
                            </div>                            
                            <button type="submit" class="btn btn-primary   btn-block">
                                Create Project 
                            </button>
                            
                       
                        </form>
                     
                    </div>
                </div>
                <div class="col-lg-8">
                    <div class="card shadow w-100 h-100 " >
                        
                        <div class="card-body" style="height: 80vh; overflow:scroll">
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover" id="tableProject" width="120%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Action</th>
                                            <th>Project ID QAMS</th>
                                            <th>Project Name</th>
                                            <th>PIC Name</th>
                                            <th>PIC AM</th>
                                            <th>Urgensi</th>
                                            <th>Time</th>
                                            
                                            
                                            
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>Action</th>
                                            <th>Project ID QAMS</th>
                                            <th>Project Name</th>
                                            <th>PIC Name</th>
                                            <th>PIC AM</th>
                                            <th>Urgensi</th>
                                            <th>Time</th>
                                            
                                            
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
@include('Components.Project.updateProjectModal')

@endsection

@section("jsScript")
    {{-- <script src="{{ asset('js/Helper/createProject.js') }}"></script> --}}
    <script src="{{ asset('js/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('js/datatables/dataTables.bootstrap4.min.js') }}"></script>
    <script src="//cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script src="//cdn.datatables.net/1.12.1/js/dataTables.bootstrap4.min.js"></script>
    <script src="//cdn.datatables.net/buttons/2.2.3/js/dataTables.buttons.min.js"></script>

 <!-- Include Trumbowyg JavaScript -->
 <script src="https://cdn.jsdelivr.net/npm/trumbowyg@2.26.0/dist/trumbowyg.min.js"></script>    <script id="myscript">
        // ProtectThis()
        let table =null
        let deleteId = null


        $(document).ready(function () {
            $('#statusAdd').trumbowyg();
            $('#status_update').trumbowyg();
            getAjax()
            table = ShowTableProject()
        })

        $("#addProjectForm").submit(function (e) { 
            e.preventDefault()
            $.ajax({
                type: "POST",
                url: "{{route('project.myProject.create')}}",
                data: $(this).serialize(),
                success: function (response) {
                    table.ajax.reload()
                    Alertify({
                        message:"Berhasil Menambahkan Project",
                        duration:5
                    })
                  ResetForm("#addProjectForm")
                  $("#status_update").trumbowyg('html', "")
                  document.querySelector("#previewUrgensi").innerHTML = 0
                }, error:function(error){
                    console.log(error)
                    AlertifyFailed({
                    message:error.responseJSON.message,
                    duration:5
                })
                }
                
            });
        });
        $("#tableProject ").on('click', 'tbody tr td:not(:first-child)', function() {
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
                    MappingSelectOption({
                        default:"Select Category Project",
                        element:document.querySelector("#category_project_update"),
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
                    MappingSelectOption({
                        default:"Select PIC Project",
                        element:document.querySelector("#project_pic_id_update"),
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
                        "data":"id",
                        render: function (data, type, row, meta) {
                        return `<div class="btn-group ">
                                <a type="button" class="btn btn-sm btn-danger" id="${data}" title="Delete Project"  data-toggle="modal" data-target="#deleteProjectModal" onclick="setDeleteProject(${data},'${row.project_name}')">
                                <i class="fas fa-trash"></i>
                                </a>
                                <br>
                                <br>
                                <a type="button" class="btn btn-sm btn-warning" id="${data}" title="Update Project" data-toggle="modal" data-target="#updateProject"" onClick="showUpdateProject('${data}')">
                                <i class="fas fa-edit"></i>
                                </a>
                                <a type="button" class="btn btn-sm btn-success" id="${data}" title="Show Detail" href="/project/detail/${data}">
                                <i class="fa fa-info-circle"></i>
                                </a>
                            </div>`
                        }
                    },
                    {
                        "data":"idProjectJalin",
                    },
                    {
                        "data":"project_name",
                    },
                    {
                        "data":"user_creator.name",
                    },
                    {
                        "data":"pic_am",
                    },
                    {
                        "data":"urgensi",
                    },
                    {
                        "data":"time",
                    },
                    
                  
                 
                ]
            });

            return table
        }

        //preview SliderUrgensi
        document.querySelector("#urgensi").addEventListener("change",()=>{
            document.querySelector("#previewUrgensi").innerHTML = document.querySelector("#urgensi").value
        })

        //preview SliderUrgensiUpdate
        document.querySelector("#urgensi_update").addEventListener("change",()=>{
            document.querySelector("#previewUrgensi_update").innerHTML = document.querySelector("#urgensi_update").value
        })



        //Set attribut delete Modal
        function setDeleteProject(id,project_name){
            $("#deleteModalBody").html("Apakah anda Yakin ingin menghapus Project " +project_name+"?");
            $("#deleteModalButton").attr("onclick", `DeleteProject(${id})`);
        }

        function showUpdateProject(id){
            $.ajax({
                type: "get",
                url: ParseRoute_SingleVar("{{route('project.myProject',':id')}}",id,":id"),
                success: function (response) {
                    console.log(response)
                    $("#project_name_update").val(response.project_name)
                    $("#project_pic_id_update").val(response.user_creator.id)
                    $("#category_project_update").val(response.category_id);
                    $("#status_update").trumbowyg('html', response.status)
                    $("#time_update").val(response.time)
                    $("#urgensi_update").val(response.urgensi)
                    $("#project_id_update").val(response.id)
                    $("#pic_am_update").val(response.pic_am)
                    $("#previewUrgensi_update").html(response.urgensi);

                }
            });
        }

        $("#updateProjectForm").submit(function (e) { 
            e.preventDefault();
            $.ajax({
                type: "post",
                url: "{{route('project.update')}}",
                data: $(this).serialize(),
                success: function (response) {
                    
                    table.ajax.reload()
                    Alertify({
                            message:"Berhasil Update Project",
                            duration:5
                        })
                    $("#updateProject").modal("hide")
                }
            });
            
        });
      
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
                    $("#deleteProjectModal").modal("hide")

                }
            });
        }
        
       
       
    </script>
@endsection

@section('css')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/trumbowyg@2.26.0/dist/ui/trumbowyg.min.css">
@endsection