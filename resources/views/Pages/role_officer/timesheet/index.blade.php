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
                                    <input type="text" class="form-control " name="project_name" id="project_name"placeholder="Title">
                                </div>
                                <div class="form-group col-lg-12">
                                    
                                    <textarea type="text" class="form-control " rows="3" name="project_name" id="project_name"placeholder="Status"></textarea>
                                </div>
                                
                            </div>
                            <div class="col-lg-4 row">
                                <div class="form-group col-lg-12">
                                    <label for="customRange2" class="form-label">Date</label><br>
                                    <input type="date" class="form-control " name="project_name" id="project_name"placeholder="Title">
                                </div>
                                <div class="form-group col-lg-6">
                                    <label for="customRange2" class="form-label">Start</label><br>
                                    <input type="time" class="form-control " name="project_name" id="project_name"placeholder="Title">
                                </div>
                                <div class="form-group col-lg-6">
                                    <label for="customRange2" class="form-label">Finish</label><br>
                                    <input type="time" class="form-control " name="project_name" id="project_name"placeholder="Status">
                                </div>
                            </div>
                          
                            <input type="hidden" name="user_creator_id" value="{{session()->get("sessionKey")["id"]}}">
                            
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
                            <div class="d-flex justify-content-end">
                                <button type="button" class="btn btn-success mb-4 ">
                                    Make Approval 
                                </button>
                                </div>
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover" id="tableProject" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Title</th>
                                            <th>Status</th>
                                            <th>Date</th>
                                            <th>Start</th>
                                            <th>Finish</th>
                                            <th>Overtime</th>
                                            <th>Action</th>
                                            
                                            
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>Title</th>
                                            <th>Status</th>
                                            <th>Date</th>
                                            <th>Start</th>
                                            <th>Finish</th>
                                            <th>Overtime</th>
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
@endsection