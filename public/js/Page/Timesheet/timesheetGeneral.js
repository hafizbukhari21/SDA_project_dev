//format nested Timesheet activity
function formatMessage(d) {
    return `
            <table class="table">
                <thead>

                    <th scope="col" style="width: 50%">Detail Activity</th>
                    <th scope="col" style="width: 25%">Working Hours</th>
                    <th scope="col" style="width: 25%">Overtime</th>
                <thead>
                <tbody>
                <tr>

                    <td>${d.detail_activity}</td>
                    <td>${workingHourCount(d.from,d.finish)}</td>
                    <td>${overtimeCount(d.finish)}</td>
                
                </tr>
                <tr>
                </tbody>
            </table>                    
    `
}



function workingHourCount(from,finish){
    from = moment(from,"HH:mm:ss")
    finish = moment(finish,"HH:mm:ss")
    let duration = moment.duration(finish.diff(from))
    return `${duration.hours()} hours and ${duration.minutes()} minutes`

}

function overtimeCount(data ) {
    const overtimeAfter= "17:30:00"
    let finish = moment(data,"HH:mm:ss")
    let overtTimeAfter = moment(overtimeAfter,"HH:mm:ss")
    let duration = moment.duration(finish.diff(overtTimeAfter))
    if(duration.hours()<0) return "No Overtime"
    return `${duration.hours()} hours and ${duration.minutes()} minutes`
}
