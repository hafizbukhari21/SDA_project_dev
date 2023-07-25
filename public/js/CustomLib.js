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

// function getWeekNumberInMonth(date) {
//     const givenDate = new Date(date);
//     const firstDayOfMonth = new Date(givenDate.getFullYear(), givenDate.getMonth(), 1);
//     const diffInDays = Math.floor((givenDate - firstDayOfMonth) / (1000 * 60 * 60 * 24));
//     const weekNumber = Math.ceil((diffInDays + firstDayOfMonth.getDay() + 1) / 7);
//     return weekNumber;
//   }
  


//Cast Jadi 4 Minggu sebulan
function getWeekNumberInMonth_4(givenDate){
    const firstDayOfMonth = new Date(givenDate.getFullYear(), givenDate.getMonth(), 1);
  
    let diffInDays = Math.floor((givenDate - firstDayOfMonth) / (1000 * 60 * 60 * 24));
  
    // Handle bulan Februari pada tahun kabisat
    if (givenDate.getMonth() === 1 && givenDate.getFullYear() % 4 === 0) {
      diffInDays++; // Tambah 1 hari untuk memperlakukan Februari sebagai 4 minggu
    }
  
    const weekNumber = Math.floor((diffInDays + firstDayOfMonth.getDay()) / 7) + 1;
  
    // Jika minggu ke-5 atau lebih, set ke 4 minggu
    if (weekNumber > 4) {
      return 4;
    }
  
    return weekNumber;
  }



