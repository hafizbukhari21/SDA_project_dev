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
                            <h1 class="h4 text-gray-900 mb-4">Project List</h1>
                        </div>
                        <form class="user row needs-validation" id="addCategoryProject" novalidate>
                            @csrf
                            <div class="col-lg-12 row">
                                <div class="form-group col-lg-12 ">
                                    <label for="customRange2" class="form-label">Project Category</label><br>
                                    <input type="text" class="form-control " name="category_name" id="project_name"placeholder="Project Category" required>
                                </div>
                            </div>
                            <div class="col-lg-12 row"  >
                                <div class="form-group  btn-block col-lg-12">
                                <button type="submit" class="btn btn-primary  ">
                                    Create Category
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
                                <table class="table table-bordered " id="tableCategoryProject" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Category Name</th>
                                            <th>Action</th>
                                            
                                            
                                            
                                        </tr>
                                    </thead>
                                    <tbody>

                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>Category Name</th>
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

@include('Components.UserManagement.deleteUser')
@endsection

@section("jsScript")
<script src="{{ asset('js/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('js/datatables/dataTables.bootstrap4.min.js') }}"></script>
<script src="//cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
<script src="//cdn.datatables.net/1.12.1/js/dataTables.bootstrap4.min.js"></script>
<script src="//cdn.datatables.net/buttons/2.2.3/js/dataTables.buttons.min.js"></script>

<script id="myscriptvar">
    const createProjectCategory_url = "{{route('superuser.create.project.category')}}"
    const deleteProjectCategory_url = "{{route('superuser.delete.project.category')}}"
    const getAllProjectCategory_url = "{{route('superuser.get.project.category')}}"
</script>


    
<script>

</script>
 
<script src="{{ asset('js/Page/SuperUser/projectCategory_SuperUser.js') }}"></script>



@endsection

@section('css')
@endsection
