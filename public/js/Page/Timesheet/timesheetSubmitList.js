
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
                        <a href="#" class="btn btn-sm btn-warning" id="${data}" title="Show Detail" onClick="UpdateTimesheetApproval('${data}')" data-toggle="modal" data-target="#previewApprovalTimesheetHead" >
                        <i class="fa fa-info-circle"></i>
                        </a>
                        </div>`
                }
            },
        ]
    })
}