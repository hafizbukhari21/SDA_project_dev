function CaptureTOExcel(base64File,height,width){
    // Create a new workbook
    var workbook = new ExcelJS.Workbook();

    // Add a worksheet
    var worksheet = workbook.addWorksheet('Sheet1');


  WorkSheetTimelineFormat(workbook.addWorksheet('Timeline'))


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

function WorkSheetTimelineFormat(workSheetTimeline){
  AdjustWidthColumn(workSheetTimeline)

  MainTitleProject(workSheetTimeline,"Timeline Project")
  
}



function MainTitleProject(workSheetTimeline,titleProject){
  workSheetTimeline.getCell('A1').value = titleProject
  workSheetTimeline.mergeCells('A1','V2')
  const centeredTitle = workSheetTimeline.getCell('A1')
  centeredTitle.alignment = { 
    horizontal: 'center', 
    vertical: 'middle', 
    size:20, 
  };
  centeredTitle.fill =  {
    type: 'pattern',
    pattern: 'solid',
    fgColor: { argb: 'FF0070c0' }, // Set the background color (red in this example)
  }
  centeredTitle.font = {
    color: { argb: 'FFFFFFFF' }, // Set the font color (blue in this example)
  };

}

function AdjustWidthColumn(workSheetTimeline){
  workSheetTimeline.getColumn('A').width=4
  workSheetTimeline.getColumn('B').width=25
  workSheetTimeline.getColumn('C').width=8
  workSheetTimeline.getColumn('D').width=2
  workSheetTimeline.getColumn('E').width=2
  workSheetTimeline.getColumn('F').width=2
  workSheetTimeline.getColumn('G').width=2
  workSheetTimeline.getColumn('H').width=2
  workSheetTimeline.getColumn('I').width=2
  workSheetTimeline.getColumn('J').width=2
  workSheetTimeline.getColumn('K').width=2
  workSheetTimeline.getColumn('L').width=2
  workSheetTimeline.getColumn('M').width=2
  workSheetTimeline.getColumn('N').width=2
  workSheetTimeline.getColumn('O').width=2
  workSheetTimeline.getColumn('P').width=2
  workSheetTimeline.getColumn('Q').width=2
  workSheetTimeline.getColumn('R').width=2
  workSheetTimeline.getColumn('S').width=2
  workSheetTimeline.getColumn('T').width=2
  workSheetTimeline.getColumn('U').width=2
  workSheetTimeline.getColumn('V').width=2
}