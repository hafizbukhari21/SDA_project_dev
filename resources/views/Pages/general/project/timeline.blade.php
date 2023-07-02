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
                    <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" data-toggle="modal" data-target="#addTaskModal"><i
                        class="fa fa-plus fa-sm text-white-50"></i> New Task</a>
                </div>
                <!-- Card Body -->
                <div class="card-body ">
                <div id="overflow-auto">
                    <div id="timelineChart"></div>
                </div>
                </div>
            </div>
        </div>

       
    </div>

</div>

<div class="modal fade" id="addTaskModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add New Task</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body"></div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="">Add</a>
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
        let timelineDataParse =[]

        
        $.ajax({
            type: "get",
            url: "/project/myProject/"+projectId,
            
            success: function (response) {
                console.log(response)
                project_name.innerHTML = response.project_name
                pic_name.innerHTML = response.pic_id.name
                summary.innerHTML = response.status
                timelineDataParse = response.projects_timeline.map(e=>{
                    return {
                        id:e.id, 
                        content:e.task_name, 
                        start: moment.utc(e.from).local().format('YYYY-MM-DD') , 
                        end:moment.utc(e.to).local().format('YYYY-MM-DD'), tooltip: `<h3>${e.task_name}</h3><p>The Task Start between ${e.from} - ${e.to}.</p>`}
                })
                ConfigTimelineChart(timelineDataParse)
            
            }
        });
    });
      // Sample data for the timeline

      
function UpdateTask(item){
    // let StartDate = new Date(item.start)
    // let EndDate = new Date(item.end)
    // console.log()
    // // console.log('Item ID:', item.id);
    // // console.log('Start:', StartDate.toISOString().split('T')[0]);
    // // console.log('End:', EndDate.toISOString().split('T')[0]);
    // // console.log('New Position:', item.left);

    let payload = {
        id:item.id,
        from:moment(item.start).format("YYYY-MM-DD"),
        to:moment(item.end).format("YYYY-MM-DD"),
    }
    
    
    PreAjax()
    $.ajax({
        type: "post",
        url: "/timeline",
        data:payload,
        success: function (response) {
            console.log(response)
        },
        error:function(err){
            console.log(err.responseJSON)
        }
    });
    
}


function ConfigTimelineChart(timelineData){

    // Create a DataSet with the timeline data
    const items = new vis.DataSet(timelineData);
    
    // Set up the timeline options
    const options = {
        
        width: '100%',
        height: '400px',
        stack: true,
        start: new Date('2023-01-01'), // Set the start date to the beginning of the week
        end: new Date('2023-12-31'), // Set the end date to the end of the week
        editable: true,
        zoomMin: 1000 * 60 * 60 * 24 * 7, // Minimum zoom level: 1 week (7 days)
        zoomMax: 1000 * 60 * 60 * 24 * 360, // Minimum zoom level: 1 week (7 days)

        format: {
            minorLabels: {
                week: 'MMM D'
            },
            majorLabels: {
                week: 'MMM D'
            }
        },
        tooltip: {
            followMouse: true
        },
        onMove: function (item, callback) {
           
            UpdateTask(item)
        
            // Perform any desired action or update on drag completion
            // ...
            callback(item); // Required to apply the changes to the timeline
        },
        onRemove: function (item, callback) {
            console.log('Node with ID ' + item.id + ' is being removed.');
            // Perform any desired logic when a node is removed
            callback(item); // Call the callback to remove the item
        },
        editable: {
            updateTime: true,
            updateGroup: false,
            overrideItems: false,
            remove:true,
        },
        moveable: true,
        snap: function (date, scale, step) {
          // Adjust the step based on the scale
          var adjustedStep = step;
        
              // Check the scale to determine the step adjustment
              if (scale && scale < 24 * 60 * 60 * 1000) {
                adjustedStep = 24 * 60 * 60 * 1000; // Snap to 1 day step if zoomed out to a larger scale
              }
          
              // Use moment.js to calculate the nearest date step
              var snappedDate = moment(date).startOf('day');
              var remainder = snappedDate % adjustedStep;
              snappedDate.add(remainder >= adjustedStep / 2 ? adjustedStep : 0, 'ms');
          
              return snappedDate.valueOf();
            },
        
            // snapStep: 24 * 60 * 60 * 1000, // Snap to 1 day step (24 hours)
        
    };
    
    // Create a timeline chart
    const timelineChart = new vis.Timeline(document.getElementById('timelineChart'), items, options);
    
    // Add tooltips to the timeline items
    timelineChart.on('itemover', function (properties) {
        const item = items.get(properties.item);
        if (item.tooltip) {
            const tooltipElement = document.createElement('div');
            tooltipElement.className = 'custom-tooltip';
            tooltipElement.innerHTML = item.tooltip;
            document.body.appendChild(tooltipElement);
        
            // Position the tooltip near the mouse cursor
            const { pageX, pageY } = properties.event;
            tooltipElement.style.left = pageX + 'px';
            tooltipElement.style.top = pageY + 'px';
        }
    });
    
    timelineChart.on('itemout', function () {
        const tooltips = document.getElementsByClassName('custom-tooltip');
        for (let i = 0; i < tooltips.length; i++) {
            tooltips[i].parentNode.removeChild(tooltips[i]);
        }
    });
    
    timelineChart.on('itemout', function () {
        const tooltips = document.getElementsByClassName('custom-tooltip');
        for (let i = 0; i < tooltips.length; i++) {
            tooltips[i].parentNode.removeChild(tooltips[i]);
        }
    });
}
     

 
  

    
    
    </script>
@endsection

@section('css')
<style>
    .custom-tooltip {
            position: absolute;
            background-color: #f9f9f9;
            padding: 10px;
            border: 1px solid #ccc;
            font-size: 14px;
            z-index: 9999;
            color: black;
        }
    .custom-tooltip>h3{
       
        font-size: 20px;
    }
</style>
@endsection