//Template tooltip node
function tooltipTemplate(param){
    return `<div class="card" style="width: 18rem;">
          <div class="card-body">
            <h5 class="card-title text-dark">${param.task_name}</h5>
            <p class="card-text">Waktu Ekseuksi ${moment.utc(param.start).local().format('DD-MM-YYYY')} - ${moment.utc(param.end).local().format('DD-MM-YYYY')}</p>
          </div>
          <div class="card-footer d-flex flex-row-reverse">
            <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#updateTimeline" onclick="ShowUpdateTask(${param.id})">Update Task</button>
          </div>
        </div>`
}


//Card Timeline
function CustomContentTooltip(e){
    return `
    <div class="card bg-danger" style="width: 18rem;">
      <div class="card-body">
        <h5 class="card-title">${e.task_name}</h5>
        <p class="card-text">${e.notes}</p>
      </div>
    </div>

    `
}


//Template For Every Nodes  In timeline
function CustomNodeTask(input){
    return `
    <div class="card" style="width: 18rem;">
  <img class="card-img-top" src="..." alt="Card image cap">
  <div class="card-body">
    <h5 class="card-title">Card title</h5>
    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
    <a href="#" class="btn btn-primary">Go somewhere</a>
  </div>
    </div>
    `
} 


//convert Response From API To Used in DataSet and Main Data Vis JS
function TimelineDataParser(response){
    return response.projects_timeline.map(e=>{
       return MappingTimeLine(e)
    }
    )
}


function MappingTimeLine(e){
    return {
            id:e.id, 
            content:CustomContentTooltip(e), 
            start: moment.utc(e.from).local().format('YYYY-MM-DD') , 
            end:moment.utc(e.to).local().format('YYYY-MM-DD'), 
            group:e.id,
            //style: 'background-color: #00ff00;',
            tooltip: tooltipTemplate({
                task_name:e.task_name,
                start:e.from,
                end:e.to,
                id:e.id
            }),
            type:e.from===e.to?"box":""

        }
}




//Capture Timeline to Image


$(document).ready(function () {
    let elementProjectDropdown = document.querySelector("#projectDropdown")
    $.ajax({
        type: "get",
        url: setUrlTimeline_Var,
        success: function (response) {
            let projectList = ""
            response.forEach(e => {
                projectList += `<a class="dropdown-item" href="/project/detail/${e.id}">${e.project_name}</a>`
            });

            elementProjectDropdown.innerHTML = projectList

            // $(".timeLineChild").attr("href", "/project/detail/"+response[0].id);

           
        }
    });
});