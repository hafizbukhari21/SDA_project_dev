const HeadPart = document.querySelector("#HeadPart")
const select_role = document.querySelector("#select_role")
let HeadPartUpdate = document.querySelector("#HeadPartUpdate")
let select_role_update = document.querySelector("#select_role_update")
let tableUser = null

$(document).ready(function () {
    if(select_role.value !== "Officer")  HeadPart.style.display = "none"

    $.ajax({
        type: "get",
        url: getHeadUrl,
        success: function (response) {
            MappingSelectOption({
                default:"Select Head",
                element:document.querySelector("#getMyHead"),
                data : response.map(e => ({id:e.id, name:e.name}))
            })
            MappingSelectOption({
                default:"Select Head",
                element:document.querySelector("#getMyHead_update"),
                data : response.map(e => ({id:e.id, name:e.name}))
            })
        }
    });

    tableUser = loadTableUser()
});

$("#addUserForm").submit(function (e) { 
    e.preventDefault();
    $.ajax({
        type: "POST",
        url: createUserUrl,
        data: $(this).serialize(),
        success: function (response) {
            console.log(response)
            Alertify({
                message:"Berhasil Menambahkan Project",
                duration:5
            })
            tableUser.ajax.reload()
          ResetForm("#addUserForm")
        }, error: function (request, status, error) {
            console.log(request)
            AlertifyFailed({
                message:"Format tidak sesuai - General Error",
                duration:5
            })
        }
        
    });
    
});

select_role.addEventListener("change", ()=>{
    if(select_role.value=="Officer") HeadPart.style.display = "inline"
    else HeadPart.style.display = "none"
})


function loadTableUser(){
    
    return $("#tableUser").DataTable({
        ajax: {
            url: getAllUserUrl,
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
                        <a type="button" class="btn btn-sm btn-warning " id="${data}" title="Delete Project"  data-toggle="modal" data-target="#updateUserModal" onclick="showUpdateUser('${data}')">
                        <i class="fas fa-edit"></i>
                        </a>
                    </div>`
                }
          },
          {"data":"name"},
          {"data":"email"},
          {"data":"role"},
        ]
    
    })
    
}


function showUpdateUser(id){
   
    PreAjax()
    $.ajax({
        type: "post",
        url: getUserDetail,
        data: {id},

        success: function (response) {
            $("#name_update").val(response.name);
            $("#select_role_update").val(response.role)
            $("#email_update").val(response.email)
            $("#id_update").val(response.id);

            if(response.role==="Officer") {
                HeadPartUpdate.style.display = "inline"
                $("#getMyHead_update").val(response.myHeadId);
            }
            else{
                
                HeadPartUpdate.style.display = "none"
                $("#getMyHead_update").val(null);
            }
        }
    });
}


$("#updateUserForm").submit(function (e) { 
    e.preventDefault();

    $.ajax({
        type: "post",
        url: updateUserUrl,
        data: $(this).serialize(),
        success: function (response) {
            console.log(response)
            Alertify({
                message:"Berhasil Update User",
                duration:5
            })
            tableUser.ajax.reload()
        },
        error: function (request, status, error) {
            console.log(request)
            AlertifyFailed({
                message:"Format tidak sesuai - General Error",
                duration:5
            })
        }
    });
    
});


select_role_update.addEventListener("change",()=>{
    if(select_role_update.value=="Officer")HeadPartUpdate.style.display = "inline"
    else HeadPartUpdate.style.display = "none"
})





