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


