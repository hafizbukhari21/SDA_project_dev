function CaptureTOExcel(base64File,height,width){
    // Create a new workbook
    var workbook = new ExcelJS.Workbook();

    // Add a worksheet
    var worksheet = workbook.addWorksheet('Sheet1');

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