$(document).ready(function () {
    let elementProjectDropdown = document.querySelector("#projectDropdown")
    $.ajax({
        type: "get",
        url: setUrlTimeline_Var,
        success: function (response) {
            console.log(response)
            let projectList = ""
            response.forEach(e => {
                projectList += `<a class="dropdown-item" href="/project/detail/${e.id}">${e.project_name}</a>`
            });

            elementProjectDropdown.innerHTML = projectList

            // $(".timeLineChild").attr("href", "/project/detail/"+response[0].id);

           
        }
    });
});