function UpdateTimesheetApproval(uuid){
    
}

function format(d) {
    console.log(d)
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

function ShowTableTimesheet(){
   return DatatableFormater_serverSide({
       element:"#tableTimesheet",
       url:ShowTableTimesheet_var,
       columns:[
           {
               className: "dt-control",
               orderable: true,
               data: null,
               defaultContent:'<button type="button" class="btn-sm btn-primary">+</button>'
           },
           {"data":"title"},
           {"data":"status"},
           {"data":"activity_date"},
           {"data":"from"},
           {"data":"finish"},
           {   
               "data":"ref_timeSheetSubmit",
               render:function (ref_timeSheetSubmit, type, row, meta) {
                   if(ref_timeSheetSubmit===null) return "-"
                   else return "Requested"
               }
           },
           {
               "data":"uuid",
               render: function (data, type, row, meta) {
                   return `<div class="btn-group ">
                               <a href="#" class="btn btn-sm btn-danger" id="${data}" title="Show Detail" onClick="DeleteTimeSheet('${row.activity_date}','${data}')" data-toggle="modal" data-target="#deleteActivityTimesheetModal">
                               <i class="fas fa-trash"></i>
                               </a>
                               <br>
                               <a href="#" class="btn btn-sm btn-warning" id="${data}" title="Show Detail" onClick="UpdateTimesheet('${data}')" data-toggle="modal" data-target="#udapteTimeSheetModal" >
                               <i class="fa fa-info-circle"></i>
                               </a>
                          </div>`
               }
           },
       ]
   })
}

