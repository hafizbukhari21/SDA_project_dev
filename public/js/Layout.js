$(document).ready(function () {
    GetTimelineRoute()
});

function GetTimelineRoute(){
    $.ajax({
        type: "get",
        url: setUrlTimeline_Var,
        success: function (response) {
            console.log(response)

            $(".timeLineChild").attr("href", "/project/detail/"+response[0].id);
        }
    });
}