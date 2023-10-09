let inputText = document.querySelector("#seachProjectName")
let output = document.querySelector("#projectAutoComplete")


$(document).ready(function () {
    output.innerHTML = string
});

inputText.addEventListener("input",()=>{
    PreAjax()
    doingAjax()
    
})

inputText.addEventListener("focus", ()=>{
    PreAjax()
    doingAjax()
})

inputText.addEventListener("focusout", ()=>{
output.innerHTML= ""
})




function doingAjax(){
    $.ajax({
        type: "post",
        url: searchProjectUrl,
        data: {
            project_name:inputText.value
        },
        
        success: function (response) {
           let string = ""
            if(inputText.value.length==0 && response.length==0)string=""
            else if(response.length==0)  string=`<div type="text"  class="form-control ">Not Found...</div>`
            else{
                response.forEach(e => {
                    string+=`<a type="text" href="/project/detail/${e.id}" class="form-control ">${e.project_name}</a>`
                });
            }
    
           output.innerHTML = string
        }
        });
}