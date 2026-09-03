var fp_id;

$(document).ready(function () {
 //register service worker
 if ('serviceWorker' in navigator) {
 navigator.serviceWorker
 .register('./service-worker.js')
 .then(res => console.log("service worker registered"))
 .catch(err => console.log("service worker not registered", err));
 }
 // const pushNotificationSuported = isPushNotificationSupported();
 // if (pushNotificationSuported) {
 // initializePushNotifications().then(function (consent) {
 // if (consent === 'granted') {

 // }
 // });
 // }

 /*
 AUTHENTIFICATION / IDENTIFICATION HANDLING
 */
 // if ($("input[name=prolificid]")) {
 // if ($("input[name=prolificid]").val() == "") {
 // getFingerprintID(); // fetch system fingerprint
 // }
 // }
});



/*
NOTIFICATION HANDLING
*/
function isPushNotificationSupported() {
 return "serviceWorker" in navigator && "PushManager" in window;
}
// function initializePushNotifications() {
// // request user grant to show notification
// return Notification.requestPermission(function (result) {
// return result;
// });
//}
function sendNotification(input) {
 const text = input;
 const title = "Research Study";
 const options = {
 body: text,
 icon: "./assets/img/app-icon_192x192.png",
 vibrate: [200, 100, 200],
 tag: "new-notification",
 badge: "./assets/img/app-icon_192x192.png",
 actions: [{ action: "Detail", title: "View", icon: "" }]
 };
 navigator.serviceWorker.ready.then(function (serviceWorker) {
 serviceWorker.showNotification(title, options);
 });
}



/*
FINGERPRINT HANDLING
*/
function getFingerprintID() {
 // Initialize FingerprintJS
 var fpPromise = FingerprintJS.load({
 monitoring: false,
 });

 // Get ID
 fpPromise
 .then(fp => fp.get())
 .then(result => handleFingerprintID(result.visitorId));
}
function handleFingerprintID(id) {
 if (document.getElementById("fp_id")) {
 $('#fp_id').attr('value', id)
 }
 getDatabyFP(id);
}



/*
DATABASE DATA FETCHING & SETTING BY FINGERPRINT
*/
function getDatabyFP(id) {
 $.ajax({
 url: "./statements/get_userdata.php",
 method: "POST",
 dataType: 'json',
 data: { fp_id: id },
 success: function (result) {
 if ($('input#redirect_to_register').val() == "true") {
 window.location.replace("./register.php?source=pwa");
 } else {
 allowEntry();
 }
 // if (result == "") {
 // // USER NOT IDENTIFIED BY FINGERPRINT

 // // redirect unidentified user to register?
 // if ($('input#redirect_to_register').val() == "true") {
 // window.location.replace("./register?source=pwa");
 // } else {
 // allowEntry();
 // }
 // } else {
 // // USER IDENTIFIED BY FINGERPRINT

 // // redirect identified user to app?
 // if ($('input#redirect_to_app').val() == "true") {
 // window.location.replace("./app?source=pwa");
 // }

 // allowEntry(); // allow user to enter page
 // setData(result); // set fetched user data from database
 // }
 },
 // error: function (textStatus, errorThrown) {
 // console.log(textStatus);
 // console.log(errorThrown);
 // }
 });
}
function setData(result) {
 $("input[name=prolificid]").attr('value', result.prolificid);
 if ($("input[name=startdate]")) {
 if ($("input[name=startdate]").val() == "") {
 $("input[name=startdate]").attr('value', result.startdate);
 }
 }

 if ($("#show_prolificid")) {
 if ($("#show_prolificid").is(':empty')) {
 $("#show_prolificid").text(result.prolificid);
 }
 }
 if ($("#show_duration")) {
 if (isEmpty($("#show_duration"))) {
 var d1 = new Date("2023-08-06 12:25:24");
 // var d1 = new Date(result.startdate);
 var d2 = new Date();

 var diff = d2.getDate() - d1.getDate();
 if (diff == 1) {
 $("#show_duration").text(diff + " day");
 } else {
 $("#show_duration").text(diff + " days");
 }
 }
 }
}
function isEmpty(el) {
 return !$.trim(el.html())
}



/*
ALLOW USE OF PAGE
*/
function allowEntry() {
 using = true;
 $("#entry_overlay").fadeOut();
}
function scaleclick(scalenr, amount) {
 var value = amount
 debug("scale " + scalenr + " wert " + value)
 for(i = 5; i<105; i=i+5) {
 document.getElementById((scalenr) + '_' + i).bgColor ='#FFFFFF'
 }
 document.getElementById((scalenr) + '_' + (amount)).bgColor = '#AAAAAA'
 document.getElementById((scalenr) + "scale").setAttribute('value', value)
}

function uesRandom() {
   var uesElem = document.getElementById("fieldset-container")
 var ues1 = '<fieldset class="fieldset"><div class="sub-group"><label>Ich habe mich bei dieser Anwendung vergessen.</label><ul style="list-style: none; display: inherit;" class="right"><li class="radio"><label class="small"><input name="f1" value="1" type="radio" required  oninvalid="setCustomValidity("Bitte wählen Sie eine Antwort aus")"><br>Stimme überhaupt nicht zu</label></li><li class="radio"><label class="small"><input name="f1" value="2" type="radio"><br>Stimme nicht zu</label></li><li class="radio"><label class="small"><input name="f1" value="3" type="radio"> Weder noch</label></li><li class="radio"><label class="small"><input name="f1" value="4" type="radio"><br>Stimme zu</label></li><li class="radio"><label class="small"><input name="f1" value="5" type="radio"><br>Stimme voll und ganz zu</label></li></ul></div></fieldset>'
 var ues2 ='<fieldset class="fieldset"><div class="sub-group"><label>Die Zeit verging wie im Flug, als ich die Anwendung anwendete.</label><ul style="list-style: none; display: inherit;" class="right"><li class="radio"><label class="small"><input name="f2" value="1" type="radio" required  oninvalid="setCustomValidity("Bitte wählen Sie eine Antwort aus")"><br>Stimme überhaupt nicht zu</label></li><li class="radio"><label class="small"><input name="f2" value="2" type="radio"><br>Stimme nicht zu</label></li><li class="radio"><label class="small"><input name="f2" value="3" type="radio"> Weder noch</label></li><li class="radio"><label class="small"><input name="f2" value="4" type="radio"><br>Stimme zu</label></li><li class="radio"><label class="small"><input name="f2" value="5" type="radio"><br>Stimme voll und ganz zu</label></li></ul></div></fieldset>'
 var ues3 = '<fieldset class="fieldset"><div class="sub-group"><label>Ich war gänzlich in die Anwendung vertieft.</label><ul style="list-style: none; display: inherit;" class="right"><li class="radio"><label class="small"><input name="f3" value="1" type="radio" required  oninvalid="setCustomValidity("Bitte wählen Sie eine Antwort aus")"><br>Stimme überhaupt nicht zu</label></li><li class="radio"><label class="small"><input name="f3" value="2" type="radio"><br>Stimme nicht zu</label></li><li class="radio"><label class="small"><input name="f3" value="3" type="radio"> Weder noch</label></li><li class="radio"><label class="small"><input name="f3" value="4" type="radio"><br>Stimme zu</label></li><li class="radio"><label class="small"><input name="f3" value="5" type="radio"><br>Stimme voll und ganz zu</label></li></ul></div></fieldset>'
 var ues4 = '<fieldset class="fieldset"> <div class="sub-group"> <label>Ich war frustriert, während ich die Anwendung nutzte.</label> <ul style="list-style: none; display: inherit;" class="right"> <li class="radio"><label class="small"><input name="f4" value="1" type="radio" required  oninvalid="setCustomValidity("Bitte wählen Sie eine Antwort aus")"><br>Stimme überhaupt nicht zu</label></li> <li class="radio"><label class="small"><input name="f4" value="2" type="radio"><br>Stimme nicht zu</label></li> <li class="radio"><label class="small"><input name="f4" value="3" type="radio"> Weder noch</label></li> <li class="radio"><label class="small"><input name="f4" value="4" type="radio"><br>Stimme zu</label></li> <li class="radio"><label class="small"><input name="f4" value="5" type="radio"><br>Stimme voll und ganz zu</label></li> </ul> </div> </fieldset>' 
 var ues5 = '<fieldset class="fieldset"> <div class="sub-group"> <label>Ich fand die Anwendung verwirrend.</label> <ul style="list-style: none; display: inherit;" class="right"> <li class="radio"><label class="small"><input name="f5" value="1" type="radio" required  oninvalid="setCustomValidity("Bitte wählen Sie eine Antwort aus")"><br>Stimme überhaupt nicht zu</label></li> <li class="radio"><label class="small"><input name="f5" value="2" type="radio"><br>Stimme nicht zu</label></li> <li class="radio"><label class="small"><input name="f5" value="3" type="radio"> Weder noch</label></li> <li class="radio"><label class="small"><input name="f5" value="4" type="radio"><br>Stimme zu</label></li> <li class="radio"><label class="small"><input name="f5" value="5" type="radio"><br>Stimme voll und ganz zu</label></li> </ul> </div> </fieldset>' 
 var ues6 = '<fieldset class="fieldset"> <div class="sub-group"> <label>Die Benutzung der Anwendung war anstrengend.</label> <ul style="list-style: none; display: inherit;" class="right"> <li class="radio"><label class="small"><input name="f6" value="1" type="radio" required  oninvalid="setCustomValidity("Bitte wählen Sie eine Antwort aus")"><br>Stimme überhaupt nicht zu</label></li> <li class="radio"><label class="small"><input name="f6" value="2" type="radio"><br>Stimme nicht zu</label></li> <li class="radio"><label class="small"><input name="f6" value="3" type="radio"> Weder noch</label></li> <li class="radio"><label class="small"><input name="f6" value="4" type="radio"><br>Stimme zu</label></li> <li class="radio"><label class="small"><input name="f6" value="5" type="radio"><br>Stimme voll und ganz zu</label></li> </ul> </div> </fieldset>'
 var ues7 = '<fieldset class="fieldset"> <div class="sub-group"> <label>Die Anwendung war attraktiv.</label> <ul style="list-style: none; display: inherit;" class="right"> <li class="radio"><label class="small"><input name="f7" value="1" type="radio" required  oninvalid="setCustomValidity("Bitte wählen Sie eine Antwort aus")"><br>Stimme überhaupt nicht zu</label></li> <li class="radio"><label class="small"><input name="f7" value="2" type="radio"><br>Stimme nicht zu</label></li> <li class="radio"><label class="small"><input name="f7" value="3" type="radio"> Weder noch</label></li> <li class="radio"><label class="small"><input name="f7" value="4" type="radio"><br>Stimme zu</label></li> <li class="radio"><label class="small"><input name="f7" value="5" type="radio"><br>Stimme voll und ganz zu</label></li> </ul> </div> </fieldset>'
 var ues8 = '<fieldset class="fieldset"> <div class="sub-group"> <label>Die Anwendung war ästhetisch ansprechend.</label> <ul style="list-style: none; display: inherit;" class="right"> <li class="radio"><label class="small"><input name="f8" value="1" type="radio" required  oninvalid="setCustomValidity("Bitte wählen Sie eine Antwort aus")"><br>Stimme überhaupt nicht zu</label></li> <li class="radio"><label class="small"><input name="f8" value="2" type="radio"><br>Stimme nicht zu</label></li> <li class="radio"><label class="small"><input name="f8" value="3" type="radio"> Weder noch</label></li> <li class="radio"><label class="small"><input name="f8" value="4" type="radio"><br>Stimme zu</label></li> <li class="radio"><label class="small"><input name="f8" value="5" type="radio"><br>Stimme voll und ganz zu</label></li> </ul> </div> </fieldset>'
 var ues9 = '<fieldset class="fieldset"> <div class="sub-group"> <label>Die Anwendung spricht auf visuelle Sinne an.</label> <ul style="list-style: none; display: inherit;" class="right"> <li class="radio"><label class="small"><input name="f9" value="1" type="radio" required  oninvalid="setCustomValidity("Bitte wählen Sie eine Antwort aus")"><br>Stimme überhaupt nicht zu</label></li> <li class="radio"><label class="small"><input name="f9" value="2" type="radio"><br>Stimme nicht zu</label></li> <li class="radio"><label class="small"><input name="f9" value="3" type="radio"> Weder noch</label></li> <li class="radio"><label class="small"><input name="f9" value="4" type="radio"><br>Stimme zu</label></li> <li class="radio"><label class="small"><input name="f9" value="5" type="radio"><br>Stimme voll und ganz zu</label></li> </ul> </div> </fieldset> ' 
 var ues10 = '<fieldset class="fieldset"> <div class="sub-group"> <label>Die Nutzung der Anwendung hat sich gelohnt.</label> <ul style="list-style: none; display: inherit;" class="right"> <li class="radio"><label class="small"><input name="f10" value="1" type="radio" required  oninvalid="setCustomValidity("Bitte wählen Sie eine Antwort aus")"><br>Stimme überhaupt nicht zu</label></li> <li class="radio"><label class="small"><input name="f10" value="2" type="radio"><br>Stimme nicht zu</label></li> <li class="radio"><label class="small"><input name="f10" value="3" type="radio"> Weder noch</label></li> <li class="radio"><label class="small"><input name="f10" value="4" type="radio"><br>Stimme zu</label></li> <li class="radio"><label class="small"><input name="f10" value="5" type="radio"><br>Stimme voll und ganz zu</label></li> </ul> </div> </fieldset> '
 var ues11 = '<fieldset class="fieldset"> <div class="sub-group"> <label>Meine Erfahrung mit der Anwendung hat sich gelohnt.</label> <ul style="list-style: none; display: inherit;" class="right"> <li class="radio"><label class="small"><input name="f11" value="1" type="radio" required  oninvalid="setCustomValidity("Bitte wählen Sie eine Antwort aus")"><br>Stimme überhaupt nicht zu</label></li> <li class="radio"><label class="small"><input name="f11" value="2" type="radio"><br>Stimme nicht zu</label></li> <li class="radio"><label class="small"><input name="f11" value="3" type="radio"> Weder noch</label></li> <li class="radio"><label class="small"><input name="f11" value="4" type="radio"><br>Stimme zu</label></li> <li class="radio"><label class="small"><input name="f11" value="5" type="radio"><br>Stimme voll und ganz zu</label></li> </ul> </div> </fieldset>'
 var ues12 = '<fieldset class="fieldset"> <div class="sub-group"> <label>Die Anwendung hat mich in ihren Bann gezogen.</label> <ul style="list-style: none; display: inherit;" class="right"> <li class="radio"><label class="small"><input name="f12" value="1" type="radio" required  oninvalid="setCustomValidity("Bitte wählen Sie eine Antwort aus")"><br>Stimme überhaupt nicht zu</label></li> <li class="radio"><label class="small"><input name="f12" value="2" type="radio"><br>Stimme nicht zu</label></li> <li class="radio"><label class="small"><input name="f12" value="3" type="radio"> Weder noch</label></li> <li class="radio"><label class="small"><input name="f12" value="4" type="radio"><br>Stimme zu</label></li> <li class="radio"><label class="small"><input name="f12" value="5" type="radio"><br>Stimme voll und ganz zu</label></li> </ul> </div> </fieldset>' 
   var uesArr = [ues1,ues2,ues3,ues4,ues5,ues6,ues7,ues8,ues9,ues10,ues11,ues12]
   for(let i = 0; i<12; i++) {
      debug("ues length " + uesArr.length)
      var uesNr = Math.floor(Math.random() * uesArr.length)
      debug("uesNr " + uesNr)
      var uesSelect = uesArr[uesNr]
      debug("ues selected " + uesSelect)
      uesElem.innerHTML += uesSelect
      uesArr.splice(uesNr, 1)

   }
}


/*
DEBUG WITH CONSOLE LOGGING
*/
function debug(input) {
 console.log("[DEBUG] " + input);
}