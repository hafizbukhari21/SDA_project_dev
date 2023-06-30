@extends('Layouts.mainLayout')

@section('generalContent')
<div class="">
    <div class="  border-0 ">
        <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row">
                <div class="col-lg-5 ">
                    <div class="p-5">
                        <div class="">
                            <h1 class="h4 text-gray-900 mb-4">Create Project</h1>
                        </div>
                        <form class="user">
                            <div class="form-group ">
                                
                                    <input type="text" class="form-control " id="exampleFirstName"placeholder="Project Name">
                                
                               
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control " id="exampleFirstName"placeholder="PIC Name">

                            </div>
                            <div class="form-group ">
                                
                                <input type="text" class="form-control " id="exampleFirstName"placeholder="Category">

                            
                           
                            </div>
                            <div class="form-group">
                                <textarea type="text" class="form-control " id="exampleFirstName"placeholder="Status"></textarea>

                            </div>
                            <div class="form-group ">
                                <input type="text" class="form-control " id="exampleFirstName"placeholder="Time">

                            </div>
                            <div class="form-group">
                                
                                <label for="customRange2" class="form-label">Urgensi - <span>10</span></label><br>
                                <input type="range" class="form-control" min="0" max="5" id="customRange2">
                            </div>
                                
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
                            <a href="login.html" class="btn btn-primary  btn-block">
                                Create Project
                            </a>
                            
                       
                        </form>
                        {{-- <div class="text-center">
                            <a class="small" href="forgot-password.html">Forgot Password?</a>
                        </div>
                        <div class="text-center">
                            <a class="small" href="login.html">Already have an account? Login!</a>
                        </div> --}}
                    </div>
                </div>
                <div class="col-lg-7">
                  
                </div>
            </div>
        </div>
    </div>
</div>

@endsection