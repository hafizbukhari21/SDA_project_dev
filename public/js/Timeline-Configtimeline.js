let baseConfig = {

    width: '100%',        
    stack: true,
    start: new Date('2023-01-01'), // Set the start date to the beginning of the week
    end: new Date('2023-12-31'), // Set the end date to the end of the week
    editable: true,
    zoomMin: 1000 * 60 * 60 * 24 * 7, // Minimum zoom level: 1 week (7 days)
    zoomMax: 1000 * 60 * 60 * 24 * 360, // Minimum zoom level: 1 week (7 days)
    selectable :true,
    format: {
        minorLabels: {
            week: 'MMM D'
        },
        majorLabels: {
            week: 'MMM D'
        }
    },
    tooltip: {
        followMouse: true
    },
    editable: {
        updateTime: true,
        updateGroup: false,
        overrideItems: false,
        remove:true,
    },
    moveable: true,
}