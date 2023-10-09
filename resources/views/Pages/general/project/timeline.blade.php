@extends('Layouts.mainLayout')

@section('generalContent')
<div class="container-fluid">
    
    <!-- Page Heading -->
    <div class="row">
            <div class="col-md-12">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item dropdown">
                        {{-- <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown"
                            role="button" data-toggle="dropdown" aria-haspopup="true"
                            aria-expanded="false">
                            Select Project
                        </a>
                        <div  id="projectDropdown" class="dropdown-menu dropdown-menu-left animated--fade-in"
                            aria-labelledby="navbarDropdown" style="height: 200px; overflow: scroll;">
                            <a class="dropdown-item" href="#">Project 1</a>
                            <a class="dropdown-item" href="#">Project 2</a>
                            <a class="dropdown-item" href="#">Project 3</a>

                        </div> --}}

                        <button class="btn dropdown-toggle text-primary" id="btnSelectProjectDropDown" data-bs-toggle="dropdown" aria-expanded="false">
                            Select Project
                        </button>
                

                        {{-- <button class="nav-link dropdown-toggle" href="#" id="navbarDropdown">
                            Select Project
                    </button> --}}
                        <div class="row" id="selectProject">
                            <div class="form-group col-xl-4" style="width: 50%">
                                <input type="text" class="form-control " autocomplete="off" name="idProjectJalin" id="seachProjectName"placeholder="Seach by name..." required>
                                <div style="position: absolute;z-index:2; width: 100%;" id="projectAutoComplete">
                                    {{-- <a type="text" href="/project/detail/3" class="form-control " name="idProjectJalin" id="idProjectJalin"placeholder="Project ID QAMS" required>sdsd</a>
                                    <a type="text" href="/project/detail/3" class="form-control " name="idProjectJalin" id="idProjectJalin"placeholder="Project ID QAMS" required>fddf</a>
                                    <a type="text" href="/project/detail/3" class="form-control " name="idProjectJalin" id="idProjectJalin"placeholder="Project ID QAMS" required>dfdf</a> --}}
                                  </div>
                            </div>
                        </div>
                       

                    </li>
                </ul>
            </div>
            <div class="col-xl-5 mb-4" >
                <div class="card shadow mb-4 h-100">
                    <!-- Card Header - Dropdown -->
                    <div
                        class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">About</h6>
                        
                    </div>
                    <!-- Card Body -->
                    <div class="card-body ">
                        <div class="row">
                          
                            <div class="col-xl-12 col-lg-12 ">
                                <h5 class="text-primary"><Span id="project_name"></Span></h5>
                                
                                <h6>PIC - <span id="pic_name" ></span></h6>
                            </div>
                            
                        </div>
                        @if (session()->get("sessionKey")["role"]=="Head"||session()->get("sessionKey")["id"]==$payload->user_creator_id)
                        <div class="row col-xl-12 mt-4"  >
                            <label for="" style="font-size: 12px">Status Update</label>
                            <textarea type="text" class="form-control " autocomplete="off" name="" id="add_status_project"placeholder="Input Status disini" required></textarea>
                        </div>
                        @endif
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
                        <div class="row overflow-auto" style="max-height: 40vh">
                            <div class="col-xl-12" id="summary">Loading...</div>
                        </div>
                    </div>
                </div>
            </div>
        <!-- Area Chart -->
        <div class="col-xl-12 col-lg-12">
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between" id="timelineHeader">
                    <h6 class="m-0 font-weight-bold text-primary">Timeline </h6>
                    <div class="d-sm-inline-block">

                        {{-- cek apakah boleh edit data atau tidak --}}
                        
                        @if (session()->get("sessionKey")["role"]=="Head"||session()->get("sessionKey")["id"]==$payload->user_creator_id)
                            <a href="#" class="  btn btn-sm btn-primary shadow-sm" id="newTaskButton" data-toggle="modal" data-target="#addTaskModal"><i
                                class="fa fa-plus fa-sm text-white-50"></i> New Task
                            </a>
                            <a href="#" class="  btn btn-sm btn-primary shadow-sm" data-toggle="modal" id="newGroupModalButton" data-target="#addGroupActivityModal"><i
                                class="fa fa-plus fa-sm text-white-50"></i> New Group 
                            </a>  
                        @endif

                        <a href="#" class="  btn btn-sm btn-warning shadow-sm" onclick="captureTimeline()"><i
                            class=""></i> Generate Timeline
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
    {{-- Add Group Timeline Modal --}}
    @include('Components.Project.createProjectGroupModal')


@endsection


@section("jsScript")
<script src="https://unpkg.com/exceljs/dist/exceljs.min.js"></script>
<script src="{{ asset('js/Page/project/timelineGeneral.js') }}"></script>
<script src="{{ asset('js/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('js/datatables/dataTables.bootstrap4.min.js') }}"></script>
<script src="//cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
<script src="//cdn.datatables.net/1.12.1/js/dataTables.bootstrap4.min.js"></script>
<script src="//cdn.datatables.net/buttons/2.2.3/js/dataTables.buttons.min.js"></script>


<script>
    const insertGroup = " {{ route('group.insert')}}"
    const deleteGroup = "{{route('group.delete')}}"
    const updateGroupOrder = " {{ route('group.update.order')}}"
    const updateGroupName = " {{ route('group.update.name')}}"
    const searchProjectUrl= "{{route('project.search.name')}}"
    const updateStatusProgressUrl = "{{route('project.status_progress')}}"
    const updateTimelineUrl = "{{route('update.timeline')}}"
    const deleteTimelineUrl = "{{route('delete.timeline')}}"
    const updateTaskAll = "{{route('update.full.timeline')}}"
    const addNewTask =  "{{route('create.timeline')}}"
</script>

{{-- cek apakah boleh edit data atau tidak --}}
@if (session()->get("sessionKey")["role"]=="Head"||session()->get("sessionKey")["id"]==$payload->user_creator_id)
    <script src="{{asset('js/Page/Project/Timeline/Configtimeline.js')}}"></script>
    
@else
    <script src="{{asset('js/Page/Project/Timeline/Configtimeline_readonly.js')}}"></script>  
@endif

<script src="{{asset('js/Page/Project/Timeline/TimelineGeneral.js')}}"></script>
<script src="{{asset('js/Page/Project/Timeline/SearchProjectBar.js')}}"></script>




<script id="myscript">
    // ProtectThis()

    let urlArr= window.location.pathname.split('/');
    let projectId = urlArr[urlArr.length-1]
    let timelineChart_parse = null
    let items = []
    let timelineChart = null
    let timelineChartElement =document.getElementById('timelineChart')

    let project_status_update = document.querySelector("#add_status_project")


    //url
    let group_timeline_url = ParseRoute_SingleVar("{{route('group.timeline',':projectId')}}",projectId,":projectId")
    let project_myproject_url = ParseRoute_SingleVar("{{route('project.myProject',':projectId')}}",projectId,":projectId")
    

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

   
   

//zoom timeline specifict group
timelineChartElement.onclick = (event) => {
    let timelineChartGroup = document.querySelector(".vis-left")
    timelineChartGroup.addEventListener("click",()=>{
        let props = timelineChart.getEventProperties(event)
        var itemToSlideTo = items.get(props.group);
        timelineChart.focus(itemToSlideTo.id)
    })
    
}




//ajax updateTimeline needed
function ShowUpdateTask(idTimeline){
    $.ajax({
        type: "get",
        url: ParseRoute_SingleVar("{{route('detail.timeline',':idTimeline')}}",idTimeline,":idTimeline"),
        success: function (response) {
            $("#timeline_name_update").val(response.task_name);
            $("#timeline_pic_am_update").val(response.pic_am);
            $("#timeline_notes_update").val(response.notes);
            $("#timeline_group_update").val(response.idGroup)
            $("#timeline_from_update").val(moment(response.from).format("YYYY-MM-DD"))
            $("#timeline_to_update").val(moment(response.to).format("YYYY-MM-DD"))
            $("#project_id_update").val(idTimeline)

        }
    });
}



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
<script src="{{asset('js/Page/Project/Timeline/TimelineSpecifict.js')}}"></script>
<script src="{{asset('js/Page/Project/Timeline/GroupActivity.js')}}"></script>
@endsection

@section('css')
<style>
    .custom-tooltip {
            position: absolute;
            
            z-index: 9999;
        }
    
</style>
@endsection