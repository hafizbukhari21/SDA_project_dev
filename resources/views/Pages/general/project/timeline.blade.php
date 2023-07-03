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
            <div class="col-xl-5 mb-4" >
                <div class="card shadow mb-4 h-100">
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
            <div class="col-xl-7 mb-4">
                <div class="card shadow mb-4 h-100">
                    <!-- Card Header - Dropdown -->
                    <div
                        class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary" >Notes </h6>
                        
                    </div>
                    <!-- Card Body -->
                    <div class="card-body ">
                        <div class="row">
                            <div class="col-xl-6" id="summary">sd</div>
                            
                            <div class="col-xl-6"></div>
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



<!-- Add Task Modal -->
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
                <div class="modal-body">
                    <form class="user" id="addTaskForm">
                        @csrf
                        <div class="form-group ">

                                <input type="text" class="form-control " name="task_name" id="project_name"placeholder="Project Name">
                        </div>
                        <div class="form-group ">
                            <label for="">Start Date</label>
                            <input type="date" class="form-control " name="from" id="project_name"placeholder="Start Date">
                        </div>
                        <div class="form-group ">
                            <label for="">End Date</label>
                            <input type="date" class="form-control " name="to" id="project_name"placeholder="End Date">
                        </div>
                       
                        <input type="hidden" name="project_id" value="" id="project_id">
                        
                        <!-- <button type="submit" class="btn btn-primary   btn-block">
                            Create Task
                        </button> -->
                        
                   
                    
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <button class="btn btn-primary" href="">Create</button>
                </div>
            </form>
            </div>
        </div>
    </div>
@endsection

@section("jsScript")
<script>
    let urlArr= window.location.pathname.split('/');
    let projectId = urlArr[urlArr.length-1]
    let timelineChart_parse = null
    let items = []
    let timelineChart = null

    const options = {
        
        width: '100%',
        height: '400px',
        stack: true,
        start: new Date('2023-01-01'), // Set the start date to the beginning of the week
        end: new Date('2023-12-31'), // Set the end date to the end of the week
        editable: true,
        zoomMin: 1000 * 60 * 60 * 24 * 7, // Minimum zoom level: 1 week (7 days)
        zoomMax: 1000 * 60 * 60 * 24 * 360, // Minimum zoom level: 1 week (7 days)
        selectable :true,
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

        onUpdate:function(item,callback){
            UpdateTask(item)
            callback(item)
        },
        onMove: function (item, callback) {
           
            UpdateTask(item)
        
            // Perform any desired action or update on drag completion
            // ...
            callback(item); // Required to apply the changes to the timeline
        },
        onRemove: function (item, callback) {
            // Perform any desired logic when a node is removed
            DeleteTask(item)
            callback(item); // Call the callback to remove the item
        },
        editable: {
            updateTime: true,
            updateGroup: true,
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

   

   function tooltipTemplate(param){
        return `<div class="card" style="width: 18rem;">
              <div class="card-body">
                <h5 class="card-title text-dark">${param.task_name}</h5>
                <p class="card-text">Waktu Ekseuksi ${moment.utc(param.start).local().format('DD-MM-YYYY')} - ${moment.utc(param.end).local().format('DD-MM-YYYY')}</p>
              </div>
              <div class="card-footer d-flex flex-row-reverse">
                <button type="button" class="btn btn-warning">Update Task</button>
              </div>
            </div>`
   }

   
    
    $(document).ready(function () {
        let project_name = document.querySelector("#project_name")
        let pic_name = document.querySelector("#pic_name")
        let summary = document.querySelector("#summary")
        let project_id_new_task_form =document.querySelector("#project_id") 
        let timelineDataParse =[]
        

    
    
        
        $.ajax({
            type: "get",
            url: "/project/myProject/"+projectId,
            
            success: function (response) {
                console.log(response)
                project_name.innerHTML = response.project_name
                pic_name.innerHTML = response.pic_id.name
                summary.innerHTML = response.status
                project_id_new_task_form.value = response.id
                timelineDataParse = response.projects_timeline.map(e=>{
                    return {
                        id:e.id, 
                        content:e.task_name, 
                        start: moment.utc(e.from).local().format('YYYY-MM-DD') , 
                        end:moment.utc(e.to).local().format('YYYY-MM-DD'), 
                        // tooltip: `<h3>${e.task_name}</h3><p>The Task Start between ${e.from} - ${e.to}.</p>`
                        tooltip:tooltipTemplate({
                            task_name:e.task_name,
                            start:e.from,
                            end:e.to
                        })
                    }
                })

                items = new vis.DataSet(timelineDataParse)
                // timelineChart.setItems(timelineDataParse)
                timelineChart = new vis.Timeline(document.getElementById('timelineChart'), items, options);

                  timelineChart.on('itemover', function (properties) {
                    // console.log("hover")
            const item = items.get(properties.item);
            console.log(item.tooltip)
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
                console.log("out")
                

                const tooltip = document.querySelector(".custom-tooltip")
                
                if($(".custom-tooltip:hover").length === 0){
                    const tooltips = document.querySelectorAll('.custom-tooltip');
                    tooltips.forEach(box => {
                        box.remove();
                    });
                } 
                tooltip.addEventListener("mouseleave", function(){
                    const tooltips = document.querySelectorAll('.custom-tooltip');
                    tooltips.forEach(box => {
                        box.remove();
                    });
                });
            
            });
            
            }
        });
      
    });
      // Sample data for the timeline

// Add tooltips to the timeline items





function GetDataFromTimeline(){
    let timelineDataParse_Update
    $.ajax({
            type: "get",
            url: "/project/myProject/"+projectId,
            success: function (response) {
                timelineDataParse_Update = response.projects_timeline.map(e=>{
                    return {
                        id:e.id, 
                        content:e.task_name, 
                        start: moment.utc(e.from).local().format('YYYY-MM-DD') , 
                        end:moment.utc(e.to).local().format('YYYY-MM-DD'), 
                        // tooltip: `<h3>${e.task_name}</h3><p>The Task Start between ${e.from} - ${e.to}.</p>`
                        toolbar: tooltipTemplate({
                            task_name:e.task_name,
                            start:e.from,
                            end:e.to
                        })
                    }
                })
                timelineChart.setItems(timelineDataParse_Update)
                timelineChart.redraw()
         
            
            }
        });
        console.log(items)
}




      
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
        url: "{{route('update.timeline')}}",
        data:payload,
        success: function (response) {
            if (response==1){
                SweetAlertSimple({
                    timer:1000,
                    title:"Berhasil Update Task"
                })
            }
            // console.log(response)
        },
        error:function(err){
            console.log(err.responseJSON)
            
        }
    });
    
}

function DeleteTask(item){
    console.log('Node with ID ' + item.id + ' is being removed.');
    PreAjax()
    $.ajax({
        type: "post",
        url: "{{route('delete.timeline')}}",
        data: {id:item.id},
        success: function (response) {
            SweetAlertSimple({
                    timer:1000,
                    title:"Berhasil Menghapus Task"
                })
        },
        error:function(err){
            console.log(err.responseJSON)
        }
    });
}




     

$("#addTaskForm").submit(function (e) { 
        e.preventDefault()
        $.ajax({
            type: "post",
            url: "{{route('create.timeline')}}",
            data: $(this).serialize(),
            success: function (response) {
                console.log(response)
                SweetAlertSimple({
                    timer:1000,
                    title:"Berhasil Menambahkan Task"
                })
                GetDataFromTimeline()

                console.log($(this).serialize())
                
                items.add({
                        id:response.id, 
                        content:response.task_name, 
                        start: moment.utc(response.from).local().format('YYYY-MM-DD') , 
                        end:moment.utc(response.to).local().format('YYYY-MM-DD'), 
                        // tooltip: `<h3>${e.task_name}</h3><p>The Task Start between ${e.from} - ${e.to}.</p>`
                        tooltip:tooltipTemplate({
                            task_name:response.task_name,
                            start:response.from,
                            end:response.to
                        })
                })

            },
            error:function(error){
            console.log(error.responseJSON)
        }
        });
        
    });
  

    
    
    </script>
@endsection

@section('css')
<style>
    .custom-tooltip {
            position: absolute;
            
            z-index: 9999;
        }
    
</style>
@endsection