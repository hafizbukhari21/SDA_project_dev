let groupDatatable = null
let buttonaddGroupModal = document.querySelector("#newGroupModalButton")
let input_order_update = null
let input_group_name_update = null
let allDeleteGroupButton = null

$(document).ready(function () {
    groupDatatable = SetDatatable()
    
});

buttonaddGroupModal.addEventListener("click",()=>{
    groupDatatable.ajax.reload()
    
})


function HandleDeleteGroup(delGroupElem){
    PreAjax()
    let id = delGroupElem.getAttribute("id")
    $.ajax({
        type: "post",
        url: deleteGroup,
        data: {id},
        success: function (response) {
            groupDatatable.ajax.reload()
            GetGroupAjax()
            GetDataFromTimeline(true)
        }
    });
    
}


function UpdateInputUpdate(){
    input_order_update=document.querySelectorAll(".order_update")
    input_group_name_update=document.querySelectorAll(".Group")
    allDeleteGroupButton = document.querySelectorAll(".deleteGroupButton")

    
    allDeleteGroupButton.forEach(delGroupElem=>{
        delGroupElem.addEventListener("click",e=>{
            HandleDeleteGroup(delGroupElem)
        })
    })

    input_order_update.forEach(order_update=>{
        order_update.addEventListener("input",()=>{
            let id =order_update.dataset.id
            let order = order_update.value
            updateOrder({id,order})
        })
    })

    let timerInput = null
    let interValInput = 5000 //5 sec
    input_group_name_update.forEach(group=>{
        group.addEventListener("change",()=>{
            
            let id = group.dataset.id
            let Group = group.value

            clearInterval(timerInput)
            timerInput = setTimeout(updateName({id,Group},group), interValInput)
        })
    })

}

function updateOrder(data,element){
    
    PreAjax()
    $.ajax({
        type: "post",
        url: updateGroupOrder,
        data,
        success: function (response) {
            Alertify({
                message:"Berhasil Mengubah Order",
                duration:5
            })
            groupDatatable.ajax.reload()
            GetGroupAjax()
            element.focus()
        }
    });
}

function updateName(data){
    PreAjax()
    $.ajax({
        type: "post",
        url: updateGroupName,
        data,
        success: function (response) {
            Alertify({
                message:"Berhasil Mengubah Nama Group",
                duration:5
            })
            GetGroupAjax()
        }
    });
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
                    <a type="button" class="btn btn-sm btn-danger deleteGroupButton" id="${data}" title="Delete Project"  data-toggle="modal" data-target="#deleteProjectModal" onclick="">
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
            groupDatatable.ajax.reload()
            GetGroupAjax()
        },
        error: function (request, status, error) {
            AlertifyFailed({
                message:"Format tidak sesuai - General Error",
                duration:5
            })
        }

    });
    
});



// $("#tableAddGroup").on('click', 'tbody tr td ', function(e) {
//     // window.location.href = "/project/detail/"+table.row(this).data().id
//     const idProject =groupDatatable.row(this).data().id 
//     console.log(idProject)
   
    
// })


