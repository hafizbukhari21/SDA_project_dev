let dropDownNotif = document.querySelector("#dropDownNotif")
let showAllButton = null
let maxLengthNotif = 5
const notifKeyPrefix = "notif "
let buttondissmiss = document.querySelector("#modalNotifDismissButton")
let counterNotif = document.querySelector("#counterNotif")
$(document).ready(function () {
    AjaxNotifBar()
});


function AjaxNotifBar(){
    $.ajax({
        type: "get",
        url:setUrlNotif_Var,
        success: function (response) {
            SetCounterNotif(response.notifBar.length)
            ShowNotif(response)
        }
    });
}


function ShowNotif(response){
    let string = `<h6 class="dropdown-header">Notification</h6>`
    response.notifBar.forEach(nb=>{

        if(nb.group =="timeline") string+=IsTimeline(nb,response.userUid)
        else IsTimesheet(nb)
    })
    //string +=`<a class="dropdown-item text-center small text-gray-500" href="#">Show All Alerts</a>`

    dropDownNotif.innerHTML=string
}

// function setReadStatus(notifUid,userUid){
//     let notifDissmissStorage = localStorage.getItem(notifKeyPrefix+userUid)


//     if(!notifDissmissStorage) {
//         let container = []
//         container.push(notifUid)
//         localStorage.setItem(notifKeyPrefix+userUid,JSON.stringify(container))
//         container=[]
//         AjaxNotifBar()
//     }
// }

function SetCounterNotif(notifLength){
    counterNotif.innerHTML=`${notifLength}`
    if(notifLength==0) counterNotif.style.display="none"
    else counterNotif.style.display="inline"
}

function GetNotifDetail(notifUUid){
    //Dismiss modal when project has been over timeline date
    PreAjax()
    $.ajax({
        type: "post",
        url: setUrlNotif_VarDetail,
        data: {uuid:notifUUid},
        success: function (response) {
            console.log(response)
            document.querySelector("#modalNotifTitleProject").innerHTML = response.timeline.project.project_name
            document.querySelector("#modalNotifTaskName").innerHTML = "Task - "+response.timeline.task_name
            document.querySelector("#modalNotifDate").innerHTML = `${moment(response.timeline.from).format("MMM-DD, YYYY")} s.d. ${moment(response.timeline.to).format("MMM-DD, YYYY")}`
            document.querySelector("#modalNotifTaskDetail").innerHTML = response.timeline.notes
            $("#viewProjectButton").attr("href", `/project/detail/${response.timeline.project.id}`);
           
            let date = new Date
            let to = moment(response.timeline.to,"YYYY-MM-DD")
            let currentDate = moment(date.toISOString().split('T')[0],"YYYY-MM-DD")
            console.log({currentDate})
            let duration = moment.duration(to.diff(currentDate))
            totduration = duration.days()

     

            console.log({totduration})



            if(response.group =="timeline"){
                //Check if the date +1 or +2 from curren date summon button dissmiss
                if(totduration<0 ){
                    buttondissmiss.style.display="inline" 
                    buttondissmiss.setAttribute("notif-uid",response.uuid)
                }  
                else buttondissmiss.style.display="none"   
            }
            else buttondissmiss.style.display="inline" 

          //Tgl 7 = -1

            
        }
    });
}



buttondissmiss.addEventListener("click",(e)=>{
    e.preventDefault()
    $.ajax({
        type: "post",
        url: setUrlNotifRead_var,
        data: {uuid:buttondissmiss.getAttribute("notif-uid")},
        success: function (response) {
            console.log(response)
            AjaxNotifBar()
        }
    });
})


function IsTimeline(nb,userUid){
    let currentDate = moment().format("YYYY-MM-DD")
    let timelineDeadlineDate = moment(nb.timeline.to,"YYYY-MM-DD")
    let duration = moment.duration(timelineDeadlineDate.diff(currentDate))
    
    if(duration.days() > 0 ) return template_timeline({status:"warning", nb})
    else if(duration.days() == 0 ) return template_timeline({status:"danger", nb})
    else if(duration.days() < 0 ) return template_timeline({status:"dark",nb})



    
    function template_timeline(data){   
        //IF notif expired can be dismiss

        return  `<a class="dropdown-item d-flex align-items-center" data-toggle="modal" data-target="#notifDetailModal" onclick="GetNotifDetail('${data.nb.uuid}')">
        <div class="mr-3">
            <div class="icon-circle bg-${data.status}">
                <i class="fas fa-exclamation-triangle text-white"></i>
            </div>
        </div>
        <div>
            <div class="small text-gray-500">Deadline. ${moment(data.nb.timeline.to).format("MMM-DD, YYYY")}</div>
            <span style="font-size:10px; font-weight:100">Task - ${data.nb.timeline.task_name}</span><br/>
        </div>
        </a>`

    }
}

function IsTimesheet(nb){
    return
}


