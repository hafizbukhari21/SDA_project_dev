@extends('Layouts.mainLayout')

@section('generalContent')<div class="container-fluid">

    <!-- Page Heading -->
    <div class="row">
            <div class="col-md-12">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown"
                            role="button" data-toggle="dropdown" aria-haspopup="true"
                            aria-expanded="false">
                            Select Project
                        </a>
                        <div class="dropdown-menu dropdown-menu-left animated--fade-in"
                            aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="#">Project 1</a>
                            <a class="dropdown-item" href="#">Project 2</a>
                            <a class="dropdown-item" href="#">Project 3</a>

                        </div>
                    </li>
                </ul>
            </div>
            <div class="col-xl-5 col-lg-7">
                <div class="card shadow mb-4">
                    <!-- Card Header - Dropdown -->
                    <div
                        class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">Project - <span id="project_name"></span> </h6>
                        
                    </div>
                    <!-- Card Body -->
                    <div class="card-body ">
                        <div class="row">
                            <div class="col-xl-5 col-lg-7">
                                <img src="{{ asset('img/thumb.png') }}" class="rounded mx-auto d-block"style="width: 50%;">
                            </div>
                            <div class="col-xl-7 col-lg-7">
                                <h5 id="pic_name">
                                
                                </h5>
                                <p>PIC Project</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-7 col-lg-7">
                <div class="card shadow mb-4">
                    <!-- Card Header - Dropdown -->
                    <div
                        class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary" >Notes </h6>
                        
                    </div>
                    <!-- Card Body -->
                    <div class="card-body ">
                        <div class="row">
                            <div class="col-xl-6" id="summary">sd</div>
                            
                            <div class="col-xl-6">sd
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <!-- Area Chart -->
        <div class="col-xl-12 col-lg-7">
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div
                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Timeline </h6>
                    
                </div>
                <!-- Card Body -->
                <div class="card-body ">
                <div id="overflow-auto">
                    <canvas height="200vh" width="600vw" id="myChart"></canvas>
                </div>
                </div>
            </div>
        </div>

       
    </div>

</div>
@endsection

@section("jsScript")
<script>
    let urlArr= window.location.pathname.split('/');
    let projectId = urlArr[urlArr.length-1]
    
    $(document).ready(function () {
        let project_name = document.querySelector("#project_name")
        let pic_name = document.querySelector("#pic_name")
        let summary = document.querySelector("#summary")
        $.ajax({
            type: "get",
            url: "/project/myProject/"+projectId,
            
            success: function (response) {
                console.log(response)
                project_name.innerHTML = response.project_name
                pic_name.innerHTML = response.pic_id.name
                summary.innerHTML = response.status
            }
        });
    });
     
    const data = {
      labels: ['Kerja', 'Libur', 'Meeting', 'Perbaikan', 'Other1', 'Other2', 'Other3'],
      datasets: [{
        label: 'Weekly Sales',
        maintainAspectRatio: false,
        data: [
            ['2023-01-03','2023-01-20'],
            ['2023-03-03','2023-03-20'],
            ['2023-03-20','2023-03-25'],
            ['2023-04-10','2023-04-20'],
            ['2023-05-07','2023-05-30'],
            ['2023-06-17','2023-06-30'],
            ['2023-08-01','2023-08-20']
        ],
        backgroundColor: [
          'rgba(255, 26, 104, 0.2)',
          'rgba(54, 162, 235, 0.2)',
          'rgba(255, 206, 86, 0.2)',
          'rgba(75, 192, 192, 0.2)',
          'rgba(153, 102, 255, 0.2)',
          'rgba(255, 159, 64, 0.2)',
          'rgba(0, 0, 0, 0.2)'
        ],
        borderColor: [
          'rgba(255, 26, 104, 1)',
          'rgba(54, 162, 235, 1)',
          'rgba(255, 206, 86, 1)',
          'rgba(75, 192, 192, 1)',
          'rgba(153, 102, 255, 1)',
          'rgba(255, 159, 64, 1)',
          'rgba(0, 0, 0, 1)'
        ],
        barPercentage: 1,
        barThickness: 6,
        maxBarThickness: 8,
        minBarLength: 2,
      }]
    };

    // config 
    const config = {
      type: 'bar',
      data,
      options: {
        indexAxis:'y',
        scales: {
            x:{
                min:'2023-01-01',
                max:'2023-12-31',
               type:'time',
               time:{
                unit:'week',
                unitStepSize: 1,
                displayFormats:{
                    week:'MMM ww',
                }

               },
               
            },
            y: {
              beginAtZero: true
            },
            maintainAspectRatio:false,
            aspectRatio:3,
            barThickness:1
        }
      }
    };

    // render init block
    const myChart = new Chart(
      document.getElementById('myChart'),
      config
    );

    // Instantly assign Chart.js version
    const chartVersion = document.getElementById('chartVersion');
    chartVersion.innerText = Chart.version;
    </script>
@endsection