function MappingSelectOption(input){
    let string = `<option selected disabled >${input.default}</option>`
    input.data.forEach(e => {
        string += `<option value="${e.id}">${e.name}</option>`
    });
    input.element.innerHTML = string


}

function PreAjax(){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
}

function SweetAlertSimple(param){
    Swal.fire({
        position: 'top-end',
        icon: 'success',
        title:param.title,
        showConfirmButton: false,
        timer:param.timer
      })
}

function ParseRoute_SingleVar(route,Variable, variableName){
    return route.replace(variableName,Variable).replace("?","/")
}



//SecureWeb

function ProtectThis(){
    document.querySelector("#myscript").innerHTML =""
    document.addEventListener('contextmenu', event => {
        event.preventDefault()
        alert("Not Allowed")
    });
    document.onkeydown = function(e) {
        if (e.ctrlKey && 
            (e.keyCode === 67 || 
             e.keyCode === 86 || 
             e.keyCode === 85 || 
             e.keyCode === 117)) {
            alert("Not Allowed")
            return false;
        } else {
            return true;
        }
    };


}


