function format(d) {
     console.log(d)
     return `
             <table class="table">
                 <thead>
                     
                     <th scope="col" style="width: 70%">Detail Activity</th>
                     <th scope="col" style="width: 30%">Overtime</th>
                 <thead>
                 <tbody>
                 <tr>
                     
                     <td>${d.detail_activity}</td>
                     <td>${overtimeCount(d.finish)}</td>
                    
                 </tr>
                 <tr>
                 </tbody>
             </table>                    
     `
 }

 function overtimeCount(data ) {
     let finish = moment(data,"HH:mm:ss")
     let overtTimeAfter = moment("17:30:00","HH:mm:ss")
     let duration = moment.duration(finish.diff(overtTimeAfter))
     // console.log(duration.hours() +" | "+ duration.minutes())
     return `${duration.hours()} hours and ${duration.minutes()} minutes`
 }