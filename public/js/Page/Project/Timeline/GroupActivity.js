let groupDatatable = null
let buttonaddGroupModal = document.querySelector("#newGroupModalButton")
let input_order_update = null
let input_group_name_update = null

$(document).ready(function () {
    groupDatatable = SetDatatable()
    
});

buttonaddGroupModal.addEventListener("click",()=>{
    groupDatatable.ajax.reload()
    
})




function UpdateInputUpdate(){
    input_order_update=document.querySelectorAll(".order_update")
    input_group_name_update=document.querySelectorAll(".Group")

    input_order_update.forEach(order_update=>{
        order_update.addEventListener("input",()=>{
            let idTimeline =order_update.dataset.id
            let update_value = order_update.value
            console.log({
                idTimeline,
                update_value
            })
        })
    })

    input_group_name_update.forEach(group=>{
        group.addEventListener("input",()=>{
            let idTimeline = group.dataset.id
            let update_value = group.value
            console.log({
                idTimeline,
                update_value
            })
        })
    })

}




function SetDatatable(){
    
    return $("#tableAddGroup").DataTable({
    info: false,
    ordering: false,
    paging: false,
    searching:false,
    autoWidth: false,
    initComplete:()=>UpdateInputUpdate(),
    drawCallback:()=>UpdateInputUpdate(),
    ajax: {
        url: group_timeline_url,
        "dataType": "json",
        "dataSrc": "",
    },
    columns:[
      {
        "data":"id",
        render: function (data, type, row, meta) {
            return `<div class="btn-group ">
                    <a type="button" class="btn btn-sm btn-danger" id="${data}" title="Delete Project"  data-toggle="modal" data-target="#deleteProjectModal" onclick="">
                    <i class="fas fa-trash"></i>
                    </a>
                </div>`
            }
      },
      {
        "data":"Group",
        render: function (data, type, row, meta) {
            return `<input type="text" data-id=${row.id} class="form-control Group" name="Group" id="project_name"placeholder="Group Name" value="${data}">`
        }
      },
      {
        "data":"order",
        render: function (data, type, row, meta) {
            return `<input type="number" data-id=${row.id} class="form-control order_update" name="order_update" id="order_update" value="${data}" min="0"  required >`
        }
      },

    ]
    
    })
    
}

$("#addGroupForm").submit(function (e) { 
    e.preventDefault();
    $.ajax({
        type: "post",
        url: insertGroup,
        data: $(this).serialize(),
        success: function (response) {
            Alertify({
                message:"Berhasil Menambahkan Group",
                duration:5
            })
            GetGroupAjax()
        }
    });
    
});


// $("#tableAddGroup").on('click', 'tbody tr td ', function(e) {
//     // window.location.href = "/project/detail/"+table.row(this).data().id
//     const idProject =groupDatatable.row(this).data().id 
//     console.log(idProject)
   
    
// })


