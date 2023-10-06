let tableCateogry = null

$(document).ready(function () {
       tableCateogry  = GenerateCategoryProjectTable() 
});

function GenerateCategoryProjectTable(){
    return $('#tableCategoryProject').DataTable({
                
        ajax: {
            url: getAllProjectCategory_url,
            "dataType": "json",
            "dataSrc": "",
        },

            columns: [
                {
                    "data":"category_name",
                },
                {
                    "data":"id",
                    render: function (data, type, row, meta) {
                        return `<div class="btn-group ">
                                    <a href="#" class="btn btn-sm btn-danger" id="${data}" title="Show Detail" onClick="DeleteCategoryProject('${data}')" data-toggle="modal" data-target="#deleteActivityTimesheetModal">
                                    <i class="fas fa-trash"></i>
                                    </a>
                               </div>`
                    }
                },  
             
            ]
        });
}

$("#addCategoryProject").submit(function (e) { 
    e.preventDefault();

    $.ajax({
        type: "post",
        url: createProjectCategory_url,
        data: $(this).serialize(),
        success: function (response) {
            tableCateogry.ajax.reload()
            Alertify({
                    message:"Berhasil Menambahkan Category",
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
});


function DeleteCategoryProject(id){
    PreAjax()
    $.ajax({
        type: "post",
        url: deleteProjectCategory_url,
        data: {id},
        success: function (response) {
            tableCateogry.ajax.reload()
            Alertify({
                    message:"Berhasil Delete Category",
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




