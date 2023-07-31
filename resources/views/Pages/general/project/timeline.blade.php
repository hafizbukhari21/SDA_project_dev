@extends('Layouts.mainLayout')

@section('generalContent')
<div class="container-fluid">

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
                        <div  id="projectDropdown" class="dropdown-menu dropdown-menu-left animated--fade-in"
                            aria-labelledby="navbarDropdown" style="height: 200px; overflow: scroll;">
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
        <div class="col-xl-12 col-lg-12">
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div
                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between" id="timelineHeader">
                    <h6 class="m-0 font-weight-bold text-primary">Timeline </h6>
                    <div class="d-sm-inline-block">
                        <a href="#" class="  btn btn-sm btn-primary shadow-sm" data-toggle="modal" data-target="#addTaskModal"><i
                            class="fa fa-plus fa-sm text-white-50"></i> New Task
                        </a>
                        <a href="#" class="  btn btn-sm btn-warning shadow-sm" onclick="captureTimeline()"><i
                            class="fa fa-camera fa-sm text-white-50"></i> Capture
                        </a>
                    </div>
                    
                    
                </div>
                <!-- Card Body -->
                <div class="card-body ">
                <div id="">
                    <div id="timelineChart"></div>
                    
                </div>
                </div>
            </div>
        </div>

       
    </div>

</div>



    {{-- Add Timeline Modal --}}
    @include('Components.Project.createProjectTimelineModal')
    {{-- Update Timeline Modal --}}
    @include('Components.Project.updateProjecTImelineModal')

@endsection


@section("jsScript")
<script src="https://unpkg.com/exceljs/dist/exceljs.min.js"></script>
<script src="{{ asset('js/Page/project/timelineGeneral.js') }}"></script>

<script>

</script>

<script src="{{asset('js/Page/project/timeline/Configtimeline.js')}}"></script>
<script src="{{asset('js/Page/project/timeline/TimelineGeneral.js')}}"></script>



<script id="myscript">
    // ProtectThis()

    console.log("minggu ke"+getWeekNumberInMonth_4(new Date('2023-07-30')))
    let urlArr= window.location.pathname.split('/');
    let projectId = urlArr[urlArr.length-1]
    let timelineChart_parse = null
    let items = []
    let timelineChart = null
    let timelineChartElement =document.getElementById('timelineChart')
    

    const options = {
        
       ...baseConfig,

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

   
    $(document).ready(function () {
        
        let project_name = document.querySelector("#project_name")
        let pic_name = document.querySelector("#pic_name")
        let summary = document.querySelector("#summary")
        let project_id_new_task_form =document.querySelector("#project_id") 
        let timelineDataParse =[]
        let groupTimeline = []
        
       
      
        
        $.ajax({
            type: "get",
            url: ParseRoute_SingleVar("{{route('project.myProject',':projectId')}}",projectId,":projectId"),
            
            success: function (response) {
                // console.log(response)
                project_name.innerHTML = response.project_name
                pic_name.innerHTML = response.pic_id.name
                summary.innerHTML = response.status
                project_id_new_task_form.value = response.id
                timelineDataParse = TimelineDataParser(response)

                items = new vis.DataSet(timelineDataParse)
                // timelineChart.setItems(timelineDataParse)
                timelineChart = new vis.Timeline(timelineChartElement, items, options);
                //attach group to timeline
                GetGroupAjax()

                setTimeout(() => {
                    window.scrollTo(0, 0);
                }, 1000);

                timelineChart.on('itemover', function (properties) {
                    // console.log("hover")
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

      function TimelineDataParser(response){
    return response.projects_timeline.map(e=>{
       return MappingTimeLine(e)
    }
    )
}

timelineChartElement.onclick = (event) => {
    let props = timelineChart.getEventProperties(event)
    var itemToSlideTo = items.get(props.group);
    timelineChart.focus(itemToSlideTo.id)
    console.log(itemToSlideTo.id)
}


function GetGroupAjax(){
    $.ajax({
            type: "get",

            url: ParseRoute_SingleVar("{{route('group.timeline',':projectId')}}",projectId,":projectId"),


            success: function (response) {
                // console.log(response)
                let groupTimeline = response.map(e=>({
                    id: e.Group,
                    content: e.Group,
                    treeLevel: 1,
                    nestedGroups:e.projects.map(e=>e.id)
                }))
                ajaxDataToBeGroup(groupTimeline)
                
                MappingSelectOption({
                        default:"Select Group",
                        element:document.querySelector("#timeline_group"),
                        data : response.map(e => ({id:e.id, name:e.Group}))
                })

                MappingSelectOption({
                        default:"Select Group",
                        element:document.querySelector("#timeline_group_update"),
                        data : response.map(e => ({id:e.id, name:e.Group}))
                })
            }
        });

    
        function ajaxDataToBeGroup(groupTimeline){
            // console.log(groupTimeline)
            $.ajax({
                type: "get",
                url: ParseRoute_SingleVar("{{route('project.myProject',':projectId')}}",projectId,":projectId"),
                success: function (response) {
                    
                    let merge =[...response.projects_timeline.map(e=>({
                        id: e.id,
                        content: e.task_name,
                        treeLevel: 2,
                    })),...groupTimeline]
                    timelineChart.setGroups(merge)
                    setTimeout(() => {
                        $(window).scrollTop($('#timelineHeader').offset().top);
                    }, 1);
                }
            });
        }
}


//Re Get Data After Insert New Task
function GetDataFromTimeline(){
    let timelineDataParse_Update
    $.ajax({
            type: "get",
            url: ParseRoute_SingleVar("{{route('project.myProject',':projectId')}}",projectId,":projectId"),
            success: function (response) {
                timelineDataParse_Update = TimelineDataParser(response)
                timelineChart.setItems(timelineDataParse_Update)
                // timelineChart.redraw() 
            
            }
        });
        console.log(items)
}

//UpdateTask Callback From Vis Js Timeline    
function UpdateTask(item){
    
    console.item
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
            console.log(response)
            // GetGroupAjax()
            if (response){
                items.update(MappingTimeLine(response))
                Alertify({
                            message:"Berhasil Mengubah Activity",
                            duration:5
                        })
            }
            // console.log(response)
        },
        error:function(err){
            console.log(err.responseJSON)
            
        }
    });
    
}

//Delete Task Callback From Vis Js Timeline
function DeleteTask(item){
    console.log('Node with ID ' + item.id + ' is being removed.');
    PreAjax()
    $.ajax({
        type: "post",
        url: "{{route('delete.timeline')}}",
        data: {id:item.id},
        success: function (response) {
            Alertify({
                    message:"Berhasil Menghapus Activity",
                    duration:5
                })
            GetGroupAjax()
        },
        error:function(err){
            console.log(err.responseJSON)
        }
    });
}

//ajax updateTimeline needed
function ShowUpdateTask(idTimeline){
    $.ajax({
        type: "get",
        url: ParseRoute_SingleVar("{{route('detail.timeline',':idTimeline')}}",idTimeline,":idTimeline"),
        success: function (response) {
            $("#timeline_name_update").val(response.task_name);
            $("#timeline_notes_update").val(response.notes);
            $("#timeline_group_update").val(response.idGroup)
            $("#timeline_from_update").val(moment(response.from).format("YYYY-MM-DD"))
            $("#timeline_to_update").val(moment(response.to).format("YYYY-MM-DD"))
            $("#project_id_update").val(idTimeline)

        }
    });
}

//Update Task All
$("#updateTask").submit(function (e) { 
    e.preventDefault();
    $.ajax({
        type: "post",
        url: "{{route('update.full.timeline')}}",
        data: $(this).serialize(),
        success: function (response) {
            console.log(response)
            Alertify({
                            message:"Berhasil Update timeline",
                            duration:5
                        })
            GetDataFromTimeline()                
            //Add Dataset Vis Js after adding task 
            items.update(MappingTimeLine(response))
            GetGroupAjax()
            $("#updateTimeline").modal("hide")
        },
        error:function(error){
            console.log(error.responseJSON)
        }
    });
    
});
    
//Menabahkan Task Baru
$("#addTaskForm").submit(function (e) { 
        e.preventDefault()
        $.ajax({
            type: "post",
            url: "{{route('create.timeline')}}",
            data: $(this).serialize(),
            success: function (response) {
                console.log(response)
                Alertify({
                            message:"Berhasil Menambahkan timeline",
                            duration:5
                        })
                GetDataFromTimeline()                
                //Add Dataset Vis Js after adding task 
                items.add(MappingTimeLine(response))
                GetGroupAjax()
            },
            error:function(error){
            console.log(error.responseJSON)
        }
        });
        
    });



function captureTimeline(){
    $.ajax({
        type: "get",
        url: ParseRoute_SingleVar("{{route('excelGen',':projectId')}}",projectId,":projectId"),
  
        success: function (response) {
            html2canvas(timelineChartElement).then(canvas => {
    // Create a temporary link element
    const link = document.createElement('a');
    // link.href = canvas.toDataURL(); // Set the image data as the link URL
    CaptureTOExcel(canvas.toDataURL(),timelineChartElement.offsetHeight,timelineChartElement.offsetWidth,response)
    // link.download = 'timeline.png'; // Set the image filename
    
    // Simulate a click on the link to download the image
    link.click();
  });
        }
    });
    
}

  
    
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