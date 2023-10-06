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
                },  
             
            ]
        });
}

