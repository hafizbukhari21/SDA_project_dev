function DatatableFormater_serverSide(data){
    return $(data.element).DataTable({
        "processing": true,
        "serverSide": true,
        "responsive" :true,
        language: {
            processing: `<div class="spinner-border text-primary" role="status">
            <span class="sr-only">Loading...</span>
          </div>`
        },
        ajax: {
            url: data.url,
            "dataType": "json",
            "dataSrc": "data",
        },

            columns: data.columns
        });

}



function DatatableExpandable(data){  
    if (data.row.child.isShown()) {
        data.row.child.hide()
        data.tr.removeClass("shown")
    } else {
        data.row.child(data.format).show()
        data.tr.addClass("shown")
    }
}