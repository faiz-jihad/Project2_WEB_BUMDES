self.addEventListener("push",(event)=>{
    const notifications = event.data.json();


    event.waitUntik(
        self.registration.showNotifications(
            body: notifications.body,
            title: notifications.title,
            icon :"./images/bumdes.jpg",
            data:{
                url: notification.url
            }
        )
    )

})

self.addEventListener("notificationclick",(event)=>{
    event.WaitUntil(
        clients.openWindow(event.notification.data.url)
    )

})
