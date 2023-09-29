
$(document).ready(function () {
    GenerateTableTimesheetSubmit()
});
function GenerateTableTimesheetSubmit () {
    return DatatableFormater_serverSide({
        element:"#tableTimesheetSubmit",
        dataSrc:"data",
        url:mySubmitListUrl,
        columns:[
            {"data":"title"},
            {"data":"message"},
            {"data":"status_submit"},
            {"data":"submitDate"},
            {"data":"approvalDate"},
            {"data":"attemp"},
            {
                "data":"uuid",
                render: function (data, type, row, meta) {
                 return `
                        <a href="#" class="btn btn-sm btn-warning" id="${data}" title="Show Detail" onClick="UpdateTimesheetApprovalOfficer('${data}')" data-toggle="modal" data-target="#SubmitTimesheetDetailModal" >
                        <i class="fa fa-info-circle"></i>
                        </a>
                        </div>`
                }
            },
        ]
    })
}


//Table Detail Submit yang udah diajuin ditamopilkan pada modal
function GeneratedTableTimesheetApproval(url){

    return  $('#tableTimesheetApprovalOfficer').DataTable({
            
            ajax: {
                url,
                "dataType": "json",
                "dataSrc": "timesheetactivity",
            },

            columns: [
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
                    "data":"uuid",
                    render: function (data, type, row, meta) {
                     return `
                            <a href="#" class="btn btn-sm btn-danger" id="${data}" title="Show Detail" onClick="DeleteActivityFromSubmit('${data}')"  >
                            Remove
                            </a>`
                    }
                },
            ]
    })
}





