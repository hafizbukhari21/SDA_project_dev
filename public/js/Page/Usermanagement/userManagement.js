const HeadPart = document.querySelector("#HeadPart")
const select_role = document.querySelector("#select_role")
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
          ResetForm("#addUserForm")
        }
        
    });
    
});

select_role.addEventListener("change", ()=>{
    if(select_role.value=="Officer") HeadPart.style.display = "inline"
    else HeadPart.style.display = "none"
})