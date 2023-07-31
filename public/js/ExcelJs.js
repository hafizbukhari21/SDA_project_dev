function CaptureTOExcel(base64File,height,width,data){
    // Create a new workbook
    var workbook = new ExcelJS.Workbook();

    // Add a worksheet
    var worksheet = workbook.addWorksheet('Sheet1');


  WorkSheetTimelineFormat(workbook.addWorksheet('Timeline'),data)


  var image = workbook.addImage({
      base64:base64File,
      extension:"png"
  })



    // Add data to the worksheet
    // worksheet.addRow(['Name', 'Age']);
    // worksheet.addRow(['John Doe', 30]);
    // worksheet.addRow(['Jane Smith', 28]);
    worksheet.addImage(image, {
        tl: { col: 1, row: 1 },
        ext: { width, height }
  });

    // Save the workbook
    workbook.xlsx.writeBuffer().then(function (buffer) {
      // Download the Excel file
      saveAs(new Blob([buffer], { type: 'application/octet-stream' }), 'Timeline.xlsx');
    });
}

// Helper function for downloading the file
function saveAs(blob, fileName) {
  if (typeof window.navigator.msSaveBlob !== 'undefined') {
    // IE workaround
    window.navigator.msSaveBlob(blob, fileName);
  } else {
    var link = document.createElement('a');
    link.href = window.URL.createObjectURL(blob);
    link.download = fileName;
    link.click();
  }
}


//Construct Excel
 function WorkSheetTimelineFormat(workSheetTimeline,data){

  //Data Attribute
  //dateInterval
  //GroupWithTimeline
  //TimelineSorted
  // console.log(data)
  // console.log(RemoveArrayProjectNull(data.GroupWithTimeline))
  let listOfMonthYear = getMonthYearInterval(data.dateInterval.start,data.dateInterval.finish)
  let listMonthAndWeekTotalPerMonth = listOfMonthYear.map(e=>MappingDateProper(e))

  console.log(listMonthAndWeekTotalPerMonth)


  //Adjust Column And Label In Excel
  AdjustWidthColumn(workSheetTimeline,listMonthAndWeekTotalPerMonth)
  //Line 1
  MainTitleProject(workSheetTimeline,"Timeline Project",listMonthAndWeekTotalPerMonth)
  //Line 2
  SubTitleProject(workSheetTimeline,listMonthAndWeekTotalPerMonth)
  
  
}

//buang group yang gk ada projectsnya
function RemoveArrayProjectNull(data){
  return data.filter(elem=>elem.projects.length>0)
}

//Jadikan Satu Array Semuanya 
function MapingAndMergeAllActivity(data){ 
let projects=[]
    data.forEach(e=>{
      e.projects.forEach(pro=>{
        projects.push(pro)
      })
    })

return projects
}

//get Project Interval  in Month
function ProjectInterval(projects){
  projects.sort((a,b)=>a.from-b.from)
  return projects
}



const alignText={ 
  horizontal: 'center', 
  vertical: 'middle', 
  size:20, 
}
const fillText={
  type: 'pattern',
  pattern: 'solid',
  fgColor: { argb: 'FF0070c0' }, // Set the background color (red in this example)
}
const fontText={
  color: { argb: 'FFFFFFFF' }, // Set the font color (blue in this example)
}


//Line 1
function MainTitleProject(workSheetTimeline,titleProject,dateHeaderWidth){

  let totColumn=0
  dateHeaderWidth.forEach(e=>{
    totColumn+=e.totWeek
  })
  workSheetTimeline.getCell('A1').value = titleProject
  workSheetTimeline.mergeCells('A1',ConvertNumberToRowExcel(totColumn))
  workSheetTimeline.getRow(1).height=50
  const centeredTitle = workSheetTimeline.getCell('A1')
  centeredTitle.alignment = alignText;
  centeredTitle.fill =  fillText
  centeredTitle.font = fontText ;

}
//Line 2 
function SubTitleProject(workSheetTimeline,dateHeaderWidth){
  let NumberTitle =  workSheetTimeline.getCell('A2')
  workSheetTimeline.mergeCells('A2','A3')
  NumberTitle.value = "NO"
  NumberTitle.alignment = alignText;
  NumberTitle.fill =  fillText
  NumberTitle.font = fontText ;

  let ActivityTitle =  workSheetTimeline.getCell('B2')
  workSheetTimeline.mergeCells('B2','B3')
  ActivityTitle.value = "Activity"
  ActivityTitle.alignment = alignText;
  ActivityTitle.fill =  fillText
  ActivityTitle.font = fontText ;

  LineTwoDateHelper(workSheetTimeline,dateHeaderWidth)
}

//Line 2 Helper For DateTitle
function LineTwoDateHelper(workSheetTimeline,dateHeader){
  let StartMergingMonthString=1
  let StartDate
  dateHeader.forEach(e=>{

  })
}

//Adjust Column
function AdjustWidthColumn(workSheetTimeline,dateHeaderWidth){
  workSheetTimeline.getColumn('A').width=4
  workSheetTimeline.getColumn('B').width=25
  workSheetTimeline.getColumn('C').width=8

  let totColumn=0
  dateHeaderWidth.forEach(e=>{
    totColumn+=e.totWeek
  })

  for(let i=1; i<=totColumn;i++){
    console.log(i)
    workSheetTimeline.getColumn(ConvertNumberToRowExcel(i)).width=2
  }

}

//Convertsi dari Number To Column In Excel Start Dari Colom D
function ConvertNumberToRowExcel(number){
  let startFrom = 68 //start From column D
  let char = startFrom+number-1
  if (char <= 90) return String.fromCharCode(char)
  else return MappingAfter_Z(char)


  function MappingAfter_Z(char){
      let pairStart = 64 //Char A-1
      let z_char = 90
      let jummlahAlphabet = 26 

      while (char > z_char){
          char = char - jummlahAlphabet
          pairStart ++
      }



      return String.fromCharCode(pairStart)+String.fromCharCode(char)
  
  }
}






//Mapping Array date like "March 2023" => [3,2023]
function MappingDateProper(stringDate){
  let month = getMonthNumberFromString(stringDate.split(" ")[0]) 
  let year =parseInt(stringDate.split(" ")[1])
  let totWeek = countWeeksInMonth(year,month)
  let string = stringDate.split(" ")[0]
  return {month,year,totWeek,string}
  
  

  function getMonthNumberFromString(monthName) {
    const date = new Date(`${monthName} 1, 2000`);
    return date.getMonth() + 1; // Adding 1 because getMonth() returns zero-based month index (0 for January, 1 for February, etc.)
  }
  
}


//Count Total Week in Month With mounth Year
function countWeeksInMonth(year, month) {
  const firstDayOfMonth = new Date(year, month - 1, 1);
  const lastDayOfMonth = new Date(year, month, 0);

  const firstDayOfWeek = 1; // 0 for Sunday, 1 for Monday, 2 for Tuesday, etc.

  // Move to the first day of the week in the month (e.g., for Monday, move from Sunday to Monday)
  while (firstDayOfMonth.getDay() !== firstDayOfWeek) {
    firstDayOfMonth.setDate(firstDayOfMonth.getDate() + 1);
  }

  let totalWeeks = 0;
  while (firstDayOfMonth <= lastDayOfMonth) {
    totalWeeks++;
    firstDayOfMonth.setDate(firstDayOfMonth.getDate() + 7); // Move to the next week
  }

  return totalWeeks;
}


//Get A List of month between two Date
function getMonthYearInterval(startDate, endDate) {
  const start = new Date(startDate);
  const end = new Date(endDate);

  const intervalData = [];
  let currentDate = new Date(start);

  while (currentDate <= end) {
    intervalData.push(currentDate.toLocaleString('en-US', { month: 'long', year: 'numeric' }));
    currentDate.setMonth(currentDate.getMonth() + 1);
  }

  return intervalData;
}


//Get List OF Date Between Two dates
function getDatesBetween(startDate, endDate) {
  const dateArray = [];
  const currentDate = new Date(startDate);
  const lastDate = new Date(endDate);

  while (currentDate <= lastDate) {
    dateArray.push(new Date(currentDate));
    currentDate.setDate(currentDate.getDate() + 1);
  }

  return dateArray;
}



function getWeekNumberInMonth(date) {
    const givenDate = new Date(date);
    const firstDayOfMonth = new Date(givenDate.getFullYear(), givenDate.getMonth(), 1);
    const diffInDays = Math.floor((givenDate - firstDayOfMonth) / (1000 * 60 * 60 * 24));
    const weekNumber = Math.ceil((diffInDays + firstDayOfMonth.getDay() + 1) / 7);
    return weekNumber;
  }
  


function getWeekNumberInMonth_4(givenDate){
    const firstDayOfMonth = new Date(givenDate.getFullYear(), givenDate.getMonth(), 1);
  
    let diffInDays = Math.floor((givenDate - firstDayOfMonth) / (1000 * 60 * 60 * 24));
  
    // Handle bulan Februari pada tahun kabisat
    if (givenDate.getMonth() === 1 && givenDate.getFullYear() % 4 === 0) {
      diffInDays++; // Tambah 1 hari untuk memperlakukan Februari sebagai 4 minggu
    }
  
    const weekNumber = Math.floor((diffInDays + firstDayOfMonth.getDay()) / 7) + 1;
  
    // // Jika minggu ke-5 atau lebih, set ke 4 minggu
    // if (weekNumber > 4) {
    //   return 4;
    // }
  
    return weekNumber;
  }


  









