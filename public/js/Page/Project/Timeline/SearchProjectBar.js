let inputText = document.querySelector("#seachProjectName")
let output = document.querySelector("#projectAutoComplete")

let selectProject = document.querySelector("#selectProject")
selectProject.style.display="none"

let btnSelectProjectDropDown = document.querySelector("#btnSelectProjectDropDown")
let btnSelecttemp=false

btnSelectProjectDropDown.addEventListener("click",e=>{
    e.preventDefault()
    if(!btnSelecttemp){
        btnSelecttemp=true
        selectProject.style.display="block"
    }
    else{
        btnSelecttemp=false
        selectProject.style.display="none" 
    }
})


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
    document.addEventListener("click",e=>{
        if(selectProject != e.target) output.innerHTML = ""
    })
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