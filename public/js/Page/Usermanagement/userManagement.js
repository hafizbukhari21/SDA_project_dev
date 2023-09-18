const HeadPart = document.querySelector("#HeadPart")
const select_role = document.querySelector("#select_role")
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
            // table.ajax.reload()
            Alertify({
                message:"Berhasil Menambahkan Project",
                duration:5
            })
            tableUser.ajax.reload()
          ResetForm("#addUserForm")
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



