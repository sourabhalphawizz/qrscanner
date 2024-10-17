importScripts('https://www.gstatic.com/firebasejs/8.10.1/firebase-app.js');
importScripts('https://www.gstatic.com/firebasejs/8.10.1/firebase-messaging.js');
let config = {
        apiKey: "AIzaSyBXLo_CloJCCjtqYa3kLxGIg78z4R9LjiU",
        authDomain: "billzify-70dc9.firebaseapp.com",
        projectId: "billzify-70dc9",
        storageBucket: "billzify-70dc9.appspot.com",
        messagingSenderId: "481785060708",
        appId: "1:481785060708:web:6ac3413d5e7786cdb02e71",
        measurementId: "G-YZWXGPTK6F",
 };
firebase.initializeApp(config);
const messaging = firebase.messaging();
messaging.onBackgroundMessage((payload) => {
    const notificationTitle = payload.notification.title;
    const notificationOptions = {
        body: payload.notification.body,
        icon: '/images/default/firebase-logo.png'
    };
    self.registration.showNotification(notificationTitle, notificationOptions);
});
