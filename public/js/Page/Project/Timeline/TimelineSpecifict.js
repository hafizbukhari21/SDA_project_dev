$(document).ready(function () {
        
    let project_name = document.querySelector("#project_name")
    let pic_name = document.querySelector("#pic_name")
    let summary = document.querySelector("#summary")
    let project_id_new_task_form =document.querySelector("#project_id") 
    let idProjectInInsertGroupForm =document.querySelector("#idProjectGroup")
    let timelineDataParse =[]
    let groupTimeline = []
    
   
  
    
    $.ajax({
        type: "get",
        url: project_myproject_url,
        
        success: function (response) {
            console.log(response)
            project_name.innerHTML = response.project_name
            pic_name.innerHTML = response.user_creator.name
            summary.innerHTML = response.status
            project_id_new_task_form.value = response.id
            timelineDataParse = TimelineDataParser(response,editableTable)
            idProjectInInsertGroupForm.value = response.id

            if(project_status_update){
                project_status_update.value = response.status_progress==null?"":response.status_progress
                project_status_update.setAttribute("project-uuid", response.uuid)
            }


            
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


project_status_update.addEventListener("change",()=>{
    //console.log({uuid:project_status_update.getAttribute("project-uuid"),value:project_status_update.value})
    PreAjax()
    $.ajax({
        type: "post",
        url: updateStatusProgressUrl,
        data: {
            uuid:project_status_update.getAttribute("project-uuid"),
            status_progerss:project_status_update.value
        },
        success: function (response) {
            if (response){
                Alertify({
                        message:"Berhasil Mengubah Activity",
                        duration:5
                    })
            }
        }
    });
})


function GetGroupAjax(){
    $.ajax({
            type: "get",

            url: group_timeline_url ,

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
                url: project_myproject_url,
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
function GetDataFromTimeline(reset=false){
    let timelineDataParse_Update
    $.ajax({
            type: "get",
            url: project_myproject_url,
            success: function (response) {
                timelineDataParse_Update = TimelineDataParser(response,editableTable)
                console.log({editableTable})
                timelineChart.setItems(timelineDataParse_Update)
                if(reset)timelineChart.redraw()
                
            
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
        url: updateTimelineUrl,
        data:payload,
        success: function (response) {
            console.log(response)
            // GetGroupAjax()
            if (response){
                items.update(MappingTimeLine(response,editableTable))
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
        url: deleteTimelineUrl,
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


//Update Task All
$("#updateTask").submit(function (e) { 
    e.preventDefault();
    $.ajax({
        type: "post",
        url: updateTaskAll,
        data: $(this).serialize(),
        success: function (response) {
            console.log(response)
            Alertify({
                            message:"Berhasil Update timeline",
                            duration:5
                        })
            GetDataFromTimeline()                
            //Add Dataset Vis Js after adding task 
            items.update(MappingTimeLine(response,editableTable))
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
            url:addNewTask,
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


//Set Interval Date 
let timeline_to = document.querySelector("#timeline_to")
let timeline_from = document.querySelector("#timeline_from")

timeline_from.addEventListener("change",()=>timeline_to.min=timeline_from.value)
timeline_to.addEventListener("change",()=>timeline_from.max=timeline_to.value)


//NewTaskButton
const newTaskButton = document.querySelector("#newTaskButton")
newTaskButton.addEventListener("click",()=>ResetForm("#addTaskForm"))


