let password = document.querySelector("#password")
let newPassword = document.querySelector("#newPassword")
let reNewPassword   = document.querySelector("#reNewPassword")


$("#updateUserPassword").submit(function (e) { 
    e.preventDefault();
    if(newPassword.value.localeCompare(reNewPassword.value)==0)
        doAjaxRequestPassword($(this).serialize())
    else {
        AlertifyFailed({
            message:"New Password missmatch with Re-Password",
            duration:5
        })
    }
    
    
});

function doAjaxRequestPassword(data){

    $.ajax({
        type: "post",
        url: urlDoUpdate,
        data,
        success: function (response) {
            AlertifyFailed({
                message:"Success Update Password",
                duration:5
            })
        },
        error:function(error){    
            AlertifyFailed({
                message:error.responseJSON.message,
                duration:5
            })
        }
    });
}



