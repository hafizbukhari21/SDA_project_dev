


let buttonSendRequest = document.querySelector("#sendRequestButton")
buttonSendRequest.addEventListener("click",e=>{
    e.preventDefault();
    $.ajax({
        type: "get",
        url: buttonSendRequest_var,
        success: function (response) {
            console.log(response)
            tableTimesheet.ajax.reload()
            $("#previewApprovalTimesheet").modal("hide")
            SweetAlertSimple({
                title:"Request Sent",
                timer:1000
            })
        }
    });
})


function ShowTableTimesheet(){
    return DatatableFormater_serverSide({
        element:"#tableTimesheet",
        url:ShowTableTimesheet_var,
        columns:[
            {
                className: "dt-control",
                orderable: true,
                data: null,
                defaultContent:'<a type="button" class="btn-sm btn-primary">+</a>'
            },
            {"data":"title"},
            {
                "data":"status",
                render:function  (data, type, row, meta) {
                    return convertSubmitStatus(data).badge
                }
            },
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
                    if(row.status =="apv")return convertSubmitStatus(row.status).badge 
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

function DeleteTimeSheet(activity_date,uuid){
   $("#deleteActivityDatee").html(activity_date);
   $("#deleteTimesheetActivityButton").attr("uid", uuid);
}


function ShowTableUnApprove(){
    let table = $('#tableTimesheetApproval').DataTable({
            
    ajax: {
        url:ShowTableUnApprove_var,
        "dataType": "json",
        "dataSrc": "timesheetactivity",
    },
    info: false,
    ordering: false,
    paging: false,
    searching:false,
    columns: [
       
        {
            "data":"title",
        },
       
        {
            "data":"status",
        },
        {
            "data":"activity_date",
        },
        {
            "data":"from",
        },
        {
            "data":"finish",
           
        },
      
    ]
    });

    return table
}

