self.addEventListener("push", (event) => {
    const notifications = event.data.json();

    event.waitUntil(
        self.registration.showNotification(notifications.title, {
            body: notifications.body,
            icon: "./images/bumdes.jpg",
            data: {
                url: notifications.url,
            },
        })
    );
});

self.addEventListener("notificationclick", (event) => {
    event.waitUntil(clients.openWindow(event.notification.data.url));
});
