<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <link rel="icon" type="image/png" href="./assets/img/favicon.png">

   <link rel="manifest" href="./manifest.json" crossorigin="use-credentials">
   <meta name="apple-mobile-web-app-status-bar" content="#000000" />
   <meta name="theme-color" content="#000000" />
   <title>FCM Test</title>
</head>

<body>
   <!-- FIREBASE WIP -->
   <!-- <script src="./assets/scripts/firebase-app.js"></script>
      <script src="./assets/scripts/firebase-messaging.js"></script> -->
   <div id="token"></div>
   <div id="msg"></div>
   <div id="notis"></div>
   <div id="err"></div>
   <script src="./assets/scripts/firebase-app-compat.js"></script>
   <script src="./assets/scripts/firebase-messaging-compat.js"></script>
   <script>
   var MsgElem = document.getElementById("msg");
   var TokenElem = document.getElementById("token");
   var NotisElem = document.getElementById("notis");
   var ErrElem = document.getElementById("err");

   const firebaseConfig = {
      apiKey: "AIzaSyB5jNRClAiN3Xk-HokO0hNaqZ2btAAysms",
      authDomain: "short-form-video-interventions.firebaseapp.com",
      projectId: "short-form-video-interventions",
      storageBucket: "short-form-video-interventions.appspot.com",
      messagingSenderId: "201859826944",
      appId: "1:201859826944:web:d638261fa40ef7cc0c5fe5"
   };
   const firebase_app = firebase.initializeApp(firebaseConfig);
   const firebase_messaging = firebase.messaging();


   // firebase_messaging.getToken({
   //    vapidKey: "BDaic4kV7jQwwUKCmKG3S5K85tqnYhbF6HWbFVCt2yTKr9FJLkP_D5h3bHnjnY9jqdEe5C_ZgZTsglB8r9bq-wE"
   // });
   // firebase_messaging.onMessage((payload) => {
   //    console.log('Msg received', payload);
   // });
   firebase_messaging.getToken({
      vapidKey: "BDaic4kV7jQwwUKCmKG3S5K85tqnYhbF6HWbFVCt2yTKr9FJLkP_D5h3bHnjnY9jqdEe5C_ZgZTsglB8r9bq-wE"
   }).then((currentToken) => {
      if (currentToken) {
         // Send the token to your server and update the UI if necessary
         TokenElem.innerHTML = currentToken;
         console.log(currentToken);
      } else {
         // Show permission request UI
         console.log('No registration token available. Request permission to generate one.');
         // ...
      }
   }).catch((err) => {
      console.log('An error occurred while retrieving token. ', err);
      // ...
   });

   // firebase_messaging.onMessage(payload => {
   //    console.log("Message received in foreground. ", payload);
   //    const {
   //       title,
   //       ...options
   //    } = payload.notification;
   // });
   </script>
   <!-- FIREBASE WIP -->
</body>

</html>