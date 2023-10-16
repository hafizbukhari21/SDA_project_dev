@extends('Layouts.mainLayout')

@section('generalContent')
<div class="container-fluid">
    <div class="  border-0 ">
        <div class="card-body p-0 ">
            <!-- Nested Row within Card Body -->
            <div class="row"  >
                {{-- <div class="col-12">
                    <div class="p-4">
                        <div class="">
                            <h1 class="h4 text-gray-900 mb-4">Profile</h1>
                        </div>
                        <form class="user row needs-validation" id="addCategoryProject" novalidate>
                            @csrf
                            <div class="col-lg-6 row">
                                <div class="form-group col-lg-12 ">
                                    <label for="customRange2" class="form-label">Project Category</label><br>
                                    <input type="text" class="form-control " name="category_name" id="project_name"placeholder="Project Category" required>
                                </div>
                            </div>
                            <div class="col-lg-6 row">
                                <div class="form-group col-lg-12 ">
                                    <label for="customRange2" class="form-label">Project Category</label><br>
                                    <input type="text" class="form-control " name="category_name" id="project_name"placeholder="Project Category" required>
                                </div>
                            </div>
                            <div class="col-lg-12 row"  >
                                <div class="form-group  btn-block col-lg-12">
                                <button type="submit" class="btn btn-primary  ">
                                    Update Profile
                                </button>
                                </div>
                               
                            </div>
                          
                        </form>
                   
                    </div>
                </div> --}}


                <div class="col-12">
                    <div class="p-4">
                        <div class="">
                            <h1 class="h4 text-gray-900 mb-4">Password</h1>
                        </div>
                        <form class="user row needs-validation" id="addCategoryProject" novalidate>
                            @csrf
                            <div class="col-lg-6 row">
                                <div class="form-group col-lg-12 ">
                                    <label for="customRange2" class="form-label">Old Password</label><br>
                                    <input type="password" class="form-control " name="oldPassword" id="password"placeholder="Password" required>
                                </div>
                                <div class="form-group col-lg-12 ">
                                    <label for="customRange2" class="form-label">New Password</label><br>
                                    <input type="password" class="form-control " name="newPassword" id="newPassword"placeholder="New Password" required>
                                </div>

                                <div class="form-group col-lg-12 ">
                                    <input type="password" class="form-control " name="re" id="reNewPassword"placeholder="Re-type New Password" required>
                                </div>
                            </div>
                           
                            <div class="col-lg-12 row"  >
                                <div class="form-group  btn-block col-lg-12">
                                <button type="submit" class="btn btn-primary  ">
                                    Change Password
                                </button>
                                </div>
                               
                            </div>
                          
                        </form>
                   
                    </div>
                </div>
              
            </div>
        </div>
    </div>
</div>

@endsection

@section("jsScript")

<script src="//cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
<script src="//cdn.datatables.net/1.12.1/js/dataTables.bootstrap4.min.js"></script>
<script src="//cdn.datatables.net/buttons/2.2.3/js/dataTables.buttons.min.js"></script>

<script id="myscriptvar">

</script>


    
<script>

</script>
 
<script src="{{ asset('js/Page/SuperUser/projectCategory_SuperUser.js') }}"></script>



@endsection

@section('css')
@endsection
