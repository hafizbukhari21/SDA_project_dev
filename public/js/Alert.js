function Alertify(data){
    var duration = data.duration;

    var basicMessage = `
    <div  style="justify-content: left;text-align: left;">
    <span >${data.message}</span><br>
    <small id="emailHelp" class="form-text text-muted">Auto-dismiss in `+ duration +` seconds. </small>
    <br>
    <div class="progress">
    <div class="progress-bar bg-success" role="progressbar" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
    </div>
    </div>
    `



    var msg = alertify.message(basicMessage, duration, function(){ clearInterval(interval);});
    var interval = setInterval(function(){
    msg.setContent(`
    <div style="justify-content: left;text-align: left;">
        <span>${data.message}</span><br>
        <small id="emailHelp" class="form-text text-muted">Auto-dismiss in `+ (--duration) +` seconds.</small>
        <br>
        <div class="progress">
        <div class="progress-bar bg-success" role="progressbar" style="width: ${duration/data.duration*100}%" aria-valuenow="${duration/data.duration*100}" aria-valuemin="0" aria-valuemax="100"></div>
        </div>
    </div>
    `);
    },1000);
}