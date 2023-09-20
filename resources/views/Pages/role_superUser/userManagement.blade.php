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
                            <h1 class="h4 text-gray-900 mb-4">Create User</h1>
                        </div>
                        <form class="user row needs-validation" id="addUserForm" novalidate>
                            @csrf
                            <div class="col-lg-12 row">
                                <div class="form-group col-lg-12 ">
                                    <label for="customRange2" class="form-label">Nama</label><br>
                                    <input type="text" class="form-control " name="name" id="project_name"placeholder="Title" required>

                                    <input type="hidden" class="form-control " name="password" value="" id="project_name"placeholder="Title" required>

                                </div>
                                <div class="form-group col-lg-12">
                                    <label for="">Role</label>
                                    <select class="form-control" id="select_role" name="role" aria-label="Default select example" required>
                                        <option value="Super User">Super User</option>
                                        <option value="Head">Head</option>
                                        <option value="Officer">Officer</option> 
                                      </select>
        
                                </div>  
                            </div>
                            <div class="col-lg-12 row">
                                <div class="form-group col-lg-12 ">
                                    <label for="customRange2" class="form-label">Email</label><br>
                                    <input type="email" class="form-control " name="email" id="email" placeholder="Title" required>
                                </div>
                                <div class="form-group col-lg-12" id="HeadPart">
                                    <label for="">Select Head</label>
                                    <select class="form-control" id="getMyHead" name="myHeadId" aria-label="Default select example" required>
                                        
                                    </select>
        
                                </div>
                              
                                
                            </div>
                            <div class="col-lg-12 row"  >
                                <div class="form-group  btn-block col-lg-12">
                                <button type="submit" class="btn btn-primary  ">
                                    Create User
                                </button>
                                </div>
                               
                            </div>
                          
                        </form>
                   
                    </div>
                </div>
                <div class="col-lg-8">
                    <div class="card shadow w-100 h-100 " >
                        
                        <div class="card-body" style=" overflow:scroll">
                            <div class="d-flex justify-content-between">
                                <div class="">
                                    <h1 class="h5 text-gray-900 mb-4">Approval By </h1>
                                </div>
                              
                              
                            </div>
                            <div class="table-responsive">
                                <table class="table table-bordered " id="tableUser" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Action</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Role</th>
                                            
                                            
                                            
                                        </tr>
                                    </thead>
                                    <tbody>

                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>Action</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Role</th>                                            
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

@include('Components.UserManagement.updateUser')
@endsection

@section("jsScript")
<script src="{{ asset('js/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('js/datatables/dataTables.bootstrap4.min.js') }}"></script>
<script src="//cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
<script src="//cdn.datatables.net/1.12.1/js/dataTables.bootstrap4.min.js"></script>
<script src="//cdn.datatables.net/buttons/2.2.3/js/dataTables.buttons.min.js"></script>

<script id="myscriptvar">
    const getHeadUrl = "{{route('superuser.get.head')}}"
    const createUserUrl = "{{route('superuser.user.create')}}"
    const getAllUserUrl = "{{route('superuser.user.all')}}"
    const getUserDetail = "{{route('superuser.user.detail')}}"
    const updateUserUrl = "{{route('superuser.user.update')}}"
 </script>

 

<script src="{{ asset('js/Page/Usermanagement/userManagement.js') }}"></script>



@endsection

@section('css')
@endsection
