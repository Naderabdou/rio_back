// Give the service worker access to Firebase Messaging.
// Note that you can only use Firebase Messaging here. Other Firebase libraries
// are not available in the service worker.importScripts('https://www.gstatic.com/firebasejs/7.23.0/firebase-app.js');
// importScripts("https://www.gstatic.com/firebasejs/8.3.2/firebase-app.js");
// importScripts("https://www.gstatic.com/firebasejs/8.3.2/firebase-messaging.js");
// /*
// Initialize the Firebase app in the service worker by passing in the messagingSenderId.
// */
// firebase.initializeApp({
//     //    databaseURL: 'https://project-id.firebaseio.com',
//     apiKey: "AIzaSyAxiqIOVQ2awb6goJ2nCM30qAmjvivw6qw",
//     authDomain: "privateclasses-65609.firebaseapp.com",
//     projectId: "privateclasses-65609",
//     storageBucket: "privateclasses-65609.appspot.com",
//     messagingSenderId: "416521647723",
//     appId: "1:416521647723:web:ffc4ec4f6a6dfcdb36232e",
//     measurementId: "G-R3S2GCL904",
// });

// // Retrieve an instance of Firebase Messaging so that it can handle background
// // messages.
// const messaging = firebase.messaging();
// messaging.setBackgroundMessageHandler(function (payload) {
//     console.log("Message received.", payload);
//     const title = "Hello world is awesome";
//     const options = {
//         body: "Your notificaiton message .",
//         icon: "/firebase-logo.png",
//     };
//     return self.registration.showNotification(title, options);
// });

importScripts("https://www.gstatic.com/firebasejs/8.3.2/firebase-app.js");
importScripts("https://www.gstatic.com/firebasejs/8.3.2/firebase-messaging.js");

firebase.initializeApp({
    apiKey: "AIzaSyBDi05QZ3G-miyftMzuns9eBMmjEeN-62w",
  authDomain: "rio-notify.firebaseapp.com",
  projectId: "rio-notify",
  storageBucket: "rio-notify.appspot.com",
  messagingSenderId: "1038021577291",
  appId: "1:1038021577291:web:4b169bad133817b20e1bce",
  measurementId: "G-LQFPEV8S9J"
});

const messaging = firebase.messaging();
messaging.setBackgroundMessageHandler(function (payload) {
    console.log("Message received.", payload);
    const title = "Hello world is awesome";
    const options = {
        body: "Your notificaiton message .",
        icon: "/firebase-logo.png",
    };
    return self.registration.showNotification(title, options);
});
