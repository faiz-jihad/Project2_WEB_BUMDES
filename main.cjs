const { app, BrowserWindow } = require("electron");
function createWindow() {
    const win = new BrowserWindow({
        width: 1280,
        height: 800,
        icon: "/public/images/bumdes.jpg",
    });
    win.loadURL("http://localhost:8000");
}
app.whenReady().then(createWindow);
