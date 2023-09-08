let timer =null
let isDown = false
let tempShow = false
//Cek koneksi internet
timer = setInterval(()=>{
    window.addEventListener("offline",()=>isDown=true)
    if(isDown && tempShow==false){
        tempShow=true
        Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: 'Koneksi Terputus.. Silahkan refresh halaman ini atau cek koneksi internet anda',
          })

    }
    window.addEventListener("online",()=>{
        isDown=false
        tempShow=false
        tempShow=true
        Swal.fire({
            icon: 'success',
            title: 'Terkonekesi Kembali',
            text: 'Silahkan lanjutkan...',
          })
    })

},1000)