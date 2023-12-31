@extends('Layouts.mainLayout')

@section('generalContent')
<div class="container-fluid">
            
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
        {{-- <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                class="fas fa-download fa-sm text-white-50"></i> Generate Report</a> --}}
    </div>

    <!-- Content Row -->
    <div class="row">

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs  mb-1">
                                <span class="font-weight-bold text-primary text-uppercase">Total Project</span>
                                <h5 id="totProject"></h5>
                            </div>
                          
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-calendar fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs  mb-1">
                                <span class="font-weight-bold text-primary text-uppercase">Total Open Project</span>
                                <h5 id="totProjectOpen"></h5>
                            </div>
                         
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-calendar fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs  mb-1">
                                <span class="font-weight-bold text-primary text-uppercase">Total Closed Project</span>
                                <h5 id="totProjectClosed"></h5>
                            </div>
                          
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-calendar fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

       
    </div>

    <!-- Content Row -->

    <div class="row">

        <!-- Area Chart -->
        <div class="col-xl-8 col-lg-7">
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div
                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">List & Status Project</h6>
                    
                    {{-- <div class="dropdown no-arrow">
                        <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                            aria-labelledby="dropdownMenuLink">
                            <div class="dropdown-header">Dropdown Header:</div>
                            <a class="dropdown-item" href="#">Action</a>
                            <a class="dropdown-item" href="#">Another action</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="#">Something else here</a>
                        </div>
                    </div> --}}
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <div class="tableWrapper" id="tableWrapper">
                        <table class="table " >
                            <thead>
                              <tr>
                                <th scope="col">Project</th>
                                <th scope="col">PIC SDA</th>
                                <th scope="col">PIC AM BPM</th>
                                <th scope="col">Category</th>
                                <th scope="col">Status</th>
                                <th scope="col">Time</th>
                                <th scope="col">Urgensi</th>
                                <th scope="col">Total Load</th>
                              </tr>
                            </thead>
                            <tbody id="apppendData">
                             
                            </tbody>
                          </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Pie Chart -->
        <div class="col-xl-4 col-lg-5">
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div
                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">This Month Burn %</h6>
                    <div class="dropdown no-arrow">
                        <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                            aria-labelledby="dropdownMenuLink">
                            <div class="dropdown-header">Dropdown Header:</div>
                            <a class="dropdown-item" href="#">Action</a>
                            <a class="dropdown-item" href="#">Another action</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="#">Something else here</a>
                        </div>
                    </div>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <div class="chart-pie pt-4 pb-2">
                        <canvas id="myPieChart"></canvas>
                    </div>
                    <div class="mt-4 text-center small">
                        <span class="mr-2">
                            <i class="fas fa-circle text-primary"></i> Direct
                        </span>
                        <span class="mr-2">
                            <i class="fas fa-circle text-success"></i> Social
                        </span>
                        <span class="mr-2">
                            <i class="fas fa-circle text-info"></i> Referral
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Content Row -->
    

</div>
@endsection

@section("jsScript")
<script>
    const totProject = document.querySelector("#totProject")
    const totProjectOpen = document.querySelector("#totProjectOpen")
    const totProjectClosed = document.querySelector("#totProjectClosed")
    const tableWrapper = document.querySelector("#tableWrapper")
    let pageProject = 1
    let readyNextProjectAjax  = false

    $(document).ready(function () {
        $.ajax({
            type: "get",
            url: "{{route('project.total')}}",
            success: function (response) {
                totProject.innerHTML = response.totalProject
                totProjectOpen.innerHTML = response.totalProjectOpen
                totProjectClosed.innerHTML = response.totalProjectClosed
            }
        });

        DoingAjaxData()
    });

    tableWrapper.addEventListener("scroll",()=>{
        let scrollTop = $("#tableWrapper").scrollTop()
        let scrollHeight = $("#tableWrapper").height() 
        let documentHeight = $("#tableWrapper>table").height()

        if (scrollTop+scrollHeight > documentHeight && readyNextProjectAjax) {
            pageProject++
            console.log(pageProject)
            readyNextProjectAjax = false
            DoingAjaxData()
            
        }
      
    })


    function DoingAjaxData(){
        $.ajax({
                type: "get",
                url: `/project/dashboard/detail?page=${pageProject}`,
                success: function (response) {
                    pageProject++
                    readyNextProjectAjax = true
                    console.log(response)
                    response.data.map(e=>{
                        $("#apppendData").append(`
                        <tr>
                                <td>${e.project_name}</td>
                                <td>${e.user_creator.name}</td>
                                <td>${e.pic_am}</td>
                                <td>${e.category_project.category_name}</td>
                                <td>${e.status_progress}</td>
                                <td>${e.time}</td>
                                <td>${e.urgensi}</td>
                                <td>${e.time*e.urgensi}</td>
                                
                              </tr>
                        `);
                    })
                }
            });
    }
</script>
@endsection



@section('css')
<style>
    .tableWrapper{
        height: 50vh;
        overflow:scroll;
    }
    .tableWrapper>table{
        width: 120vw;
    }
</style>
@endsection