const { ipcRenderer} = require('electron')
const maximizeBtn = document.getElementById('maximizeBtn')
const mySidebar = document.getElementById('mySidebar')
const ipc = ipcRenderer
var isLeftMenuActive = true

//// MINIMIZE APP
minimizeBtn.addEventListener('click', () =>{
    ipc.send('minimizeApp')
})

//// MAXIMISE RESTORE APP
function changeMaxResBtn(isMaximizedApp) {
    if (isMaximizedApp) {
        maximizeBtn.title = 'Restore'
        maximizeBtn.classList.remove('maximiseBtn')
        maximizeBtn.classList.add('restoreBtn')
    } else {
        maximizeBtn.title = 'Maximize'
        maximizeBtn.classList.remove('restoreBtn')
        maximizeBtn.classList.add('maximiseBtn')
    }
}
maximizeBtn.addEventListener('click', () =>{
    ipc.send('maximizeRestoreApp')
})
ipc.on('isMaximized', ()=> { changeMaxResBtn(true) })
ipc.on('isRestored', ()=> { changeMaxResBtn(false) })


//// CLOSE APP
closeBtn.addEventListener('click', () =>{
    ipc.send('closeApp')
})

//// TOGGLE MENU
// Expand end retract
showHideMenus.addEventListener('click', ()=>{
    if (isLeftMenuActive) {
        mySidebar.style.width = '0px'
        mySidebar.style.opacity = '0'
        isLeftMenuActive = false
    } else {
        mySidebar.style.width = '280px'
        mySidebar.style.opacity = '2'
        isLeftMenuActive = true
    }
})