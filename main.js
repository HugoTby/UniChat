const { app, BrowserWindow, ipcMain } = require('electron')
const path = require('path')
const ipc = ipcMain

///// PHP SERVER CREATION /////
const PHPServer = require('php-server-manager');

let server
  if (process.platform === 'win32') {

server = new PHPServer({
    php: `${__dirname}/php/php.exe`,
    port: 5555,
    directory: __dirname,
    directives: {
        display_errors: 1,
        expose_php: 1
    }
    });
  } else {

server = new PHPServer({
  
    port: 5555,
    directory: __dirname,
    directives: {
        display_errors: 1,
        expose_php: 1
    }
});
};

//////////////////////////

// Keep a global reference of the window object, if you don't, the window will
// be closed automatically when the JavaScript object is garbage collected.
let mainWindow

function createWindow () {

  server.run();
  // Create the browser window.
  mainWindow = new BrowserWindow({
        width: 1200,
        height: 680,
        minWidth: 940,
        minHeight: 560,
        frame: false,
        webPreferences: {
            nodeIntegration: true,
            contextIsolation: false,
            devTools: true,
            preload: path.join(__dirname, 'preload.js')
        }
    })

  // and load the index.html of the app.
  mainWindow.loadURL('http://'+server.host+':'+server.port+'/src/index.php')
  mainWindow.setBackgroundColor('#343B48')

/*
mainWindow.loadURL(url.format({
  pathname: path.join(__dirname, 'index.php'),
  protocol: 'file:',
  slashes: true
}))
*/
 const {shell} = require('electron')
 shell.showItemInFolder('fullPath')

  // Open the DevTools.
  // mainWindow.webContents.openDevTools()

  // Emitted when the window is closed.
  mainWindow.on('closed', function () {
    // Dereference the window object, usually you would store windows
    // in an array if your app supports multi windows, this is the time
    // when you should delete the corresponding element.
    // PHP SERVER QUIT
    server.close();
    mainWindow = null;
  })

  //// MINIMIZE APP
    ipc.on('minimizeApp', () =>{
        console.log('$$$$$$$$$$$$$$$$$$$$$$$$$--- Clicked on Minimize Btn ---$$$$$$$$$$$$$$$$$$$$$$$$$')
        mainWindow.minimize()
    })

    //// MAXIMISE RESTORE APP
    ipc.on('maximizeRestoreApp', () =>{
        if (mainWindow.isMaximized()) {
            console.log('$$$$$$$$$$$$$$$$$$$$$$$$$--- Clicked on Restore      ---$$$$$$$$$$$$$$$$$$$$$$$$$')
            mainWindow.restore()
        } else {
            console.log('$$$$$$$$$$$$$$$$$$$$$$$$$--- Clicked on Maximize     ---$$$$$$$$$$$$$$$$$$$$$$$$$')
            mainWindow.maximize()
        }
    })
    // Check if is maximized
    mainWindow.on('maximise', () =>{
      mainWindow.webContents.send('isMaximized')
    })
    // Check if is restored
    mainWindow.on('unmaximise', () =>{
      mainWindow.webContents.send('isRestored')
    })

    //// CLOSE APP
    ipc.on('closeApp', () =>{
        console.log('$$$$$$$$$$$$$$$$$$$$$$$$$--- Clicked on Close Btn    ---$$$$$$$$$$$$$$$$$$$$$$$$$')
        mainWindow.close()
    })
}

// This method will be called when Electron has finished
// initialization and is ready to create browser windows.
// Some APIs can only be used after this event occurs.
app.whenReady().then(() => {
    createWindow()

    app.on('activate', () => {
        if (BrowserWindow.getAllWindows().length === 0) {
            createWindow()
        }
    })
})

app.on('window-all-closed', () => {
    if (process.platform !== 'darwin') {
        app.quit()
    }
})


// In this file you can include the rest of your app's specific main process
// code. You can also put them in separate files and require them here.