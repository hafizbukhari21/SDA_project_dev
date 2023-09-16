const HeadPart = document.querySelector("#HeadPart")
const select_role = document.querySelector("#select_role")
$(document).ready(function () {
    HeadPart.style.display = "none"
});
select_role.addEventListener("change", ()=>{
    if(select_role.value=="Officer") HeadPart.style.display = "inline"
    else HeadPart.style.display = "none"
})