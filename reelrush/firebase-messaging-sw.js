const CACHE_NAME = `study-app-v0.01`;

// Use the install event to pre-cache all initial resources.
self.addEventListener('install', function (event) {
   event.waitUntil(self.skipWaiting());
});
self.addEventListener('activate', function (event) {
   event.waitUntil(self.clients.claim());
});

self.addEventListener('fetch', event => {
   if (!event.request.url.startsWith('http')) {
      //skip request
   }

   event.respondWith(
      fetch(event.request).catch(function () {
         return caches.match(event.request)
      })
   )
})


// Send notifications
self.addEventListener('message', function (event) {
   if (event.data && event.data.action === 'sendNotification') {
      self.registration.showNotification("ReelRush – Questionnaire for Study", {
         body: event.data.body,
         icon: event.data.icon,
         badge: event.data.badge,
         tag: event.data.tag,
         silent: event.data.silent,
         importance: event.data.importance,
         vibrate: event.data.vibrate,
         data: {
            url: event.data.url  // open custom url on notification press (HANDLER IN serviceworker.js)
         }
      });
   }
});

// Click event handler for notifications
self.addEventListener("notificationclick", (event) => {
   // Check for notification tag
   var notification_tag = event.notification.tag;
   if (notification_tag == "reminder") {
      event.notification.close(); // Close the notification
      event.waitUntil(
         clients.openWindow(`${self.location.origin}/app?source=pwa`) // Open the app video feed
      );
   } else {
      const urlToOpen = event.notification.data.url;

      event.notification.close(); // Close the notification
      event.waitUntil(
         clients.openWindow(`${self.location.origin}/${urlToOpen}`) // Open the specified URL
      );
   }
});



// FIREBASE NOTIFICATION HANDLING
importScripts("./assets/scripts/firebase-app-compat.js");
importScripts("./assets/scripts/firebase-messaging-compat.js");

// Initialize firebase app in service worker
firebase.initializeApp({
   apiKey: "AIzaSyB5jNRClAiN3Xk-HokO0hNaqZ2btAAysms",
   authDomain: "short-form-video-interventions.firebaseapp.com",
   projectId: "short-form-video-interventions",
   storageBucket: "short-form-video-interventions.appspot.com",
   messagingSenderId: "201859826944",
   appId: "1:201859826944:web:d62e7ceb0bb85fb40c5fe5"
});

// Retrieve firebase messaging instance for handling background messages
const messaging = firebase.messaging();

messaging.onBackgroundMessage((payload) => {
   console.log(
      "[firebase-messaging-sw.js] Received background message ",
      payload,
   );
   // Customize notification here
   const notificationOptions = {
      body: payload.notification.body,
      icon: "./assets/img/app-icon_192x192.png",
      badge: "./assets/img/app-icon-badge.png",
      tag: "reminder",
      silent: false,
      importance: "high",
      vibrate: [200, 100, 200],
   };

   return self.registration.showNotification(
      payload.notification.title,
      notificationOptions,
   );
});