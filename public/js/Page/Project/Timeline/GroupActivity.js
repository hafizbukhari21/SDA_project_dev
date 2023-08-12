let groupDatatable = null
$(document).ready(function () {
    groupDatatable = SetDatatable()
});


function SetDatatable(){
    
    return $("#tableAddGroup").DataTable({
    info: false,
    ordering: false,
    paging: false,
    searching:false,
    "autoWidth": false
    })

}


$("#tableAddGroup").on('click', 'tbody tr td:not(:first-child)', function() {
    // window.location.href = "/project/detail/"+table.row(this).data().id
    console.log(groupDatatable.row(this).data())
})