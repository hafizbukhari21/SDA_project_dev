


function ShowTableTimesheet(){
   return DatatableFormater_serverSide({
       element:"#tableTimesheet",
       url:ShowTableTimesheet_var,
       columns:[
           {
               className: "dt-control",
               orderable: true,
               data: null,
               defaultContent:'<button type="button" class="btn-sm btn-primary">+</button>'
           },
           {"data":"title"},
           {"data":"status"},
           {"data":"activity_date"},
           {"data":"from"},
           {"data":"finish"},
           {   
               "data":"ref_timeSheetSubmit",
               render:function (ref_timeSheetSubmit, type, row, meta) {
                   if(ref_timeSheetSubmit===null) return "-"
                   else return "Requested"
               }
           },
           {
               "data":"uuid",
               render: function (data, type, row, meta) {
                   return `<div class="btn-group ">
                               <a href="#" class="btn btn-sm btn-danger" id="${data}" title="Show Detail" onClick="DeleteTimeSheet('${row.activity_date}','${data}')" data-toggle="modal" data-target="#deleteActivityTimesheetModal">
                               <i class="fas fa-trash"></i>
                               </a>
                               <br>
                               <a href="#" class="btn btn-sm btn-warning" id="${data}" title="Show Detail" onClick="UpdateTimesheet('${data}')" data-toggle="modal" data-target="#udapteTimeSheetModal" >
                               <i class="fa fa-info-circle"></i>
                               </a>
                          </div>`
               }
           },
       ]
   })
}



 function DoAjaxAproveTimesheet(url,uuid,success){
    PreAjax()
    $.ajax({
        type: "post",
        url,
        data:{uuid},
        success,
        error: function (request, status, error) {
            console.log(request)
            AlertifyFailed({
                message:"Format tidak sesuai - General Error",
                duration:5
            })
        }
    });
}

function updateMessageApprove(e,messageInput){
    e.preventDefault()
    PreAjax()
    $.ajax({
        type: "post",
        url: updateMessageUrl,
        data: {
            uuid:messageInput.getAttribute("uuid"),
            message:messageInput.value
        },
        success: function (response) {
            console.log(response)
            Alertify({
                message:"Timesheet Berhasil di Approve",
                duration:5
            })
        },
        error: function (request, status, error) {
            console.log(request)
            AlertifyFailed({
                message:"Format tidak sesuai - General Error",
                duration:5
            })
        }
    });
}



