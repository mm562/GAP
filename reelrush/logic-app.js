var ai_database = new Array();
var video_database = new Array();
var total_video_index = 0;
var ds_video_index = 0;
var ai_index = 0;
var initial_video_index = 0;
var video_container;
var video_in_view = 0;
let sessionStartTime;
let sessionStartDateTime;
var scrollTimeout;
var using = false;
var ailabel_index = 0;
var video_amount = 180;
var ini_video = false;
var in_video_rep = false;
var first_date;
var videostartTime = []; //saves starttime for each video
var videoendTime = [];//saves endtime for each video
var loadedVideos = []; //saves videoIds of loaded videos
var watchedVideos = [] //saves videoIDs of watched videos
var likedVideos = []; //saves if videos were liked or not
var DSfile = "./assets/nonai_videos.json";
var AIfile = "./assets/ai_videos.json";
var maxScroll;
var thirdreached = false;
var thirdreached2 = false;
var percentage
var timeStop = 30000; //length of feed
var endpopup; 
var labelmode = "none"
var aiLabel_arr = [] //save position for ai Labels

var ai_amount;
var ai_pos_arr = [];
var ai_videoID_arr = [];
var ds_videoID_arr = [];

var videoWatchDurations = [];  //saves how long each video was watched
var firstVideo = true;

var prolificid;
var groupid;
var feednr;

var player = [];
var videoList = []
var origin = "http://localhost/";
//var origin = "https://07ed50de-3bd1-4454-8700-2905085fecec.ul.bw-cloud-instance.org/";

var active_intervention;
var intervention_list;

let lastScrollTop = 0;
var last_viw = 0;
var removedVideo = false;
var oldRemovedOnScroll = 0;
var removedOnScroll = 0;

var tryagain = [];

var blur_iteration = 0;
var desaturation_iteration = 0;
var organism_iteration = 0;
var glaucoma_iteration = 0;

$(document).ready(function () {
   /*
   OS RECOGNITION
   */
   var isAndroid = /Android/.test(navigator.userAgent);
   var isiOS = /(iPhone|iPad|iPod)/.test(navigator.userAgent);

   /*
   ASK FOR NOTIFICATION PERMISSION IF NOT SET ALREADY
   */
   // if ("Notification" in window) {
   //    // Request permission to show notifications if not already granted
   //    Notification.requestPermission().then((permission) => {
   //       if (permission !== "granted") {
   //          window.location.replace("./permission.php?source=pwa");
   //       }
   //    });
   // }

   /*
   AUTHENTIFICATION / IDENTIFICATION HANDLING
   */
   if ($("input[name=prolificid]")) {
      if ($("input[name=prolificid]").val() == "") {
         // getFingerprintID();  // fetch system fingerprint
         window.location.replace("./login?source=pwa");
      }
   }

   /*
   REGISTRATION OF SERVICE WORKER
   */
   if ('serviceWorker' in navigator) {
      navigator.serviceWorker
         .register('./firebase-messaging-sw.js?v=1.3')
         .then(res => {
            console.log("service worker registered");
         })
         .catch(err => console.log("service worker not registered", err));
      navigator.serviceWorker.ready
         .then((registration) => {
            console.log("service worker ready");
            const firebaseConfig = {
               apiKey: "AIzaSyB5jNRClAiN3Xk-HokO0hNaqZ2btAAysms",
               authDomain: "short-form-video-interventions.firebaseapp.com",
               projectId: "short-form-video-interventions",
               storageBucket: "short-form-video-interventions.appspot.com",
               messagingSenderId: "201859826944",
               appId: "1:201859826944:web:d62e7ceb0bb85fb40c5fe5"
            };
            function getFToken(firebase_messaging) {
               firebase_messaging.getToken({
                  vapidKey: "BDaic4kV7jQwwUKCmKG3S5K85tqnYhbF6HWbFVCt2yTKr9FJLkP_D5h3bHnjnY9jqdEe5C_ZgZTsglB8r9bq-wE",
                  serviceWorkerRegistration: registration
               }).then((currentToken) => {
                  if (currentToken) {
                     // Send the token to your server and update the UI if necessary
                     console.log('Registration successful.' + currentToken);
                     localStorage.setItem('vl_tk', currentToken);
                     var datenow_tk = new Date();
                     localStorage.setItem('vl_tk_date', datenow_tk);
                  } else {
                     // Show permission request UI
                     console.log('No registration token available. Request permission to generate one.');
                     // ...
                  }
               }).catch((err) => {
                  console.log('An error occurred while retrieving token. ', err);
                  // ...
               });
            }
            const firebase_app = firebase.initializeApp(firebaseConfig);
            const firebase_messaging = firebase.messaging();
            if (!localStorage.getItem('vl_tk')) {
               getFToken(firebase_messaging);
            } else {
               if (!localStorage.getItem('vl_tk_date')) {
                  getFToken(firebase_messaging);
               } else {
                  if (localStorage.getItem('vl_tk_date')) {
                     var compareDate = new Date(localStorage.getItem('vl_tk_date'))
                     var now_tk = new Date();
                     var now_tk_cleaned = now_tk.setHours(0, 0, 0, 0);
                     if (compareDate < now_tk_cleaned) {
                        getFToken(firebase_messaging);
                     }
                  }
               }
            }
         });
   }


   /*
   GET VIDEO LIST STATE
   */
   // ds_video_index = getVideoListState();
   // initial_video_index = getVideoListState();
   // video_in_view = getVideoListState();

   /*
   SET INTERVENTION OPTION
   */
   // active_intervention = Math.floor(Math.random() * (4 - 0 + 1) + 0);
   // randomizer = Math.floor(Math.random() * (12 - 0 + 1) + 0);

   // if (randomizer == 0) {
   //    active_intervention = 0;
   //    blur_iteration = 180;
   // } else if (randomizer == 1) {
   //    active_intervention = 0;
   //    blur_iteration = 360;
   // } else if (randomizer == 2) {
   //    active_intervention = 0;
   //    blur_iteration = 540;
   // } else if (randomizer == 3) {
   //    active_intervention = 1;
   //    desaturation_iteration = 180;
   // } else if (randomizer == 4) {
   //    active_intervention = 1;
   //    desaturation_iteration = 360;
   // } else if (randomizer == 5) {
   //    active_intervention = 1;
   //    desaturation_iteration = 540;
   // } else if (randomizer == 6) {
   //    active_intervention = 2;
   //    organism_iteration = 3;
   // } else if (randomizer == 7) {
   //    active_intervention = 2;
   //    organism_iteration = 6;
   // } else if (randomizer == 8) {
   //    active_intervention = 2;
   //    organism_iteration = 9;
   // } else if (randomizer == 9) {
   //    active_intervention = 3;
   //    glaucoma_iteration = 180;
   // } else if (randomizer == 10) {
   //    active_intervention = 3;
   //    glaucoma_iteration = 360;
   // } else if (randomizer == 11) {
   //    active_intervention = 3;
   //    glaucoma_iteration = 540;
   // } else if (randomizer == 12) {
   //    active_intervention = 4;
   // }

   // // active_intervention = 4; // DEBUG
   // debug("intervention: " + active_intervention);

   /*
   NOTIFICATION SENDING (ON APP LEAVE)
   */
   // const pushNotificationSuported = isPushNotificationSupported();
   // if (pushNotificationSuported) {
   //    initializePushNotifications().then(function (consent) {
   //       if (consent === 'granted') {
   //          window.addEventListener('beforeunload', function (event) {
   //             event.preventDefault();
   //             event.returnValue = '';

   //             // pushSessionData();

   //             // sendNotification(s_d);
   //          });
   //       }
   //    });
   // }

   /*
   VISIBILITY CHANGE HANDLER (ON APP LEAVE)
   */
   var reloading = false;
   // document.addEventListener("visibilitychange", () => {
   //    if (document.visibilityState === "visible") {
   //       location.reload();
   //       reloading = true;
   //    }
   //    if (document.visibilityState === "hidden") {
   //       var urlToOpen = "survey/index.php/435858/?newtest=Y&lang=en&pr=" + getProlificID() + "&se=" + getSessionID() + "&i=" + active_intervention + "&is=" + getInterventionIteration() + "&sd=" + getSessionDuration();
   //       // url opening works but gets blocked as pop-up
   //       // window.open(`${window.location.origin}/${urlToOpen}`, '_blank');

   //       // send notification on app leave
   //       if (!reloading) {
   //          if (parseFloat(getSessionDuration()) > start_time) {
   //             if ("Notification" in window) {
   //                // Request permission to show notifications if not already granted
   //                if (Notification.permission === "granted") {
   //                   sendNotification("Please answer some questions now. Click here", urlToOpen, "survey");
   //                } else if (Notification.permission !== "denied") {
   //                   Notification.requestPermission().then((permission) => {
   //                      if (permission === "granted") {
   //                         sendNotification("Please answer some questions now. Click here", urlToOpen, "survey");
   //                      }
   //                   });
   //                }
   //             }
   //          }
   //       }

   //       // set video list state to localstorage
   //       setVideoListState();
   //       // push session data on app leave
   //       if (!reloading) {
   //          videoWatchDurations.push(parseFloat(((performance.now() - videoStartTime) / 1000).toFixed(2)));
   //          pushSessionData(false, true);
   //          localStorage.setItem("vl_id", ds_video_index = 0);
   //       }
   //    }
   // });

   video_container = $("#video_container");

   // $("#player").find("iframe").on('load', function () {
   //    var video = $(this).contents().find("video");
   //    video.attr('webkit-playsinline', '');
   //    video.attr('playsinline', '');
   //    video.attr('autoplay', 'autoplay');
   // });


   last_viw = video_in_view - 1;
   video_container.on('scroll', function () {
      $
      getActiveVideo();
   });


   //set the ai percentage based on groupId and FeedNr
   groupid = getGroupID()
   feednr = getFeedNr()
   debug("Group " + groupid + " FeedNR " + feednr)
   if(groupid=="Group1") {
      if(feednr==1) {
         
         percentage = 0

      } else if(feednr==2) {
         
         percentage = 25
      } else if(feednr==3) {
         
         percentage = 100
      } else if(feednr==4) {
         
         percentage = 50
      } else if(feednr==5) {
         
         percentage = 75
      } 
      
   } else if(groupid=="Group2") {
      if(feednr==1) {
         
         percentage = 100
      } else if(feednr==2) {
         
         percentage = 75
      } else if(feednr==3) {
         
         percentage = 0
      } else if(feednr==4) {
         
         percentage = 50
      } else if(feednr==5) {
         
         percentage = 25
      } 
   } else if(groupid=="Group3") {
      if(feednr==1) {
         
         percentage = 50
      } else if(feednr==2) {
         
         percentage = 75
      } else if(feednr==3) {
         
         percentage = 25
      } else if(feednr==4) {
         
         percentage = 100
      } else if(feednr==5) {
         
         percentage = 0
      }       
   } else if(groupid=="Group4") {
      if(feednr==1) {
         
         percentage = 25
      } else if(feednr==2) {
         
         percentage = 0
      } else if(feednr==3) {
         
         percentage = 50
      } else if(feednr==4) {
         
         percentage = 100
      } else if(feednr==5) {
         
         percentage = 75
      } 
   } else if(groupid=="Group5") {
      if(feednr==1) {
         
         percentage = 100
      } else if(feednr==2) {
         
         percentage = 0
      } else if(feednr==3) {
         
         percentage = 75
      } else if(feednr==4) {
         
         percentage = 25
      } else if(feednr==5) {
         
         percentage = 50
      } 
   } else if(groupid=="Group6") {

      
      if(feednr==1) {
         
         percentage = 75
      } else if(feednr==2) {
         
         percentage = 50
      } else if(feednr==3) {
         
         percentage = 100
      } else if(feednr==4) {
         
         percentage = 25
      } else if(feednr==5) {
         
         percentage = 0
      } 
   } else if(groupid=="Group7") {
      if(feednr==1) {
         
         percentage = 25
      } else if(feednr==2) {
         
         percentage = 50
      } else if(feednr==3) {
         
         percentage = 0
      } else if(feednr==4) {
         
         percentage = 75
      } else if(feednr==5) {
         
         percentage = 100
      } 
   } else if(groupid=="Group8") {
      if(feednr==1) {
         
         percentage = 0
      } else if(feednr==2) {
         
         percentage = 100
      } else if(feednr==3) {
         
         percentage = 25
      } else if(feednr==4) {
         
         percentage = 75
      } else if(feednr==5) {
         
         percentage = 50
      } 
   } else if(groupid=="Group9") {
      if(feednr==1) {
         
         percentage = 75
      } else if(feednr==2) {
         
         percentage = 100
      } else if(feednr==3) {
         
         percentage = 50
      } else if(feednr==4) {
         
         percentage = 0
      } else if(feednr==5) {
         
         percentage = 25
      } 
   } else if(groupid=="Group10") {
      if(feednr==1) {
         
         percentage = 50
      } else if(feednr==2) {
         
         percentage = 25
      } else if(feednr==3) {
         
         percentage = 75
      } else if(feednr==4) {
         
         percentage = 0
      } else if(feednr==5) {
         
         percentage = 100
      } 
   }
   setDSIDs(video_amount)
   setAIIDs(video_amount)
   setAIamount(video_amount, percentage)
   debug("set ai amount")
   setAIvideos(video_amount, ai_amount)
   debug("set ai videos")
   setAILabels()
   debug("set ai labels")
   setLikes()
   startSessionTimer(); // start session tracking
   initializeLoop();    // initialize infinite video loop
   getActiveVideo(true);    // initialize active video identification

    // initialize intervention
   // if (active_intervention == 0) {
   //    $("#amd_overlay").show();
   // } else if (active_intervention == 1) {
   //    $("#cataract_overlay").show();
   // } else if (active_intervention == 2) {
   //    // nothing
   // } else if (active_intervention == 3) {
   //    $("#glaucoma_overlay").show();
   // } else if (active_intervention == 4) {
   //    // nothing
   // }
   //setInterval(addIntervention, 1000); // check intervention state every second


   // hide leave warning after 5 seconds
   // setTimeout(function () {
   //    if ($("#leave_warning").length) {
   //       $('#leave_warning').fadeOut();
   //    }
   // }, 6000);

   oldRemovedOnScroll = video_in_view;
   removedOnScroll = video_in_view;
});


/*
GET/SET VIDEO LIST STATE FROM LOCALSTORAGE
*/
function getVideoListState() {
   if (localStorage.getItem("vl_id")) {
      return parseInt(localStorage.getItem("vl_id"));
   } else {
      return 0;
   }
}
function setVideoListState() {
   localStorage.setItem("vl_id", ds_video_index - 1);
}
function setLikes() {
   for(i=0;i<video_amount;i++) {
      likedVideos[i] = false;
   }
}


//set the order of nonAI videoIDs

function setDSIDs(video_amount) {
      do {
         let num = Math.floor(Math.random() * video_amount);
         ds_videoID_arr.push(num);
         ds_videoID_arr = ds_videoID_arr.filter((item, index) => {
            return ds_videoID_arr.indexOf(item) === index
         });
      } while (ds_videoID_arr.length < video_amount);
      debug("non ai videoIDs " + ds_videoID_arr);
}

//set the order of ai videoIDs

function setAIIDs(video_amount) {
      do {
         let aiN = Math.floor(Math.random() * video_amount);
         ai_videoID_arr.push(aiN);
         ai_videoID_arr = ai_videoID_arr.filter((item, index) => {
            return ai_videoID_arr.indexOf(item) === index
         });
      } while (ai_videoID_arr.length < video_amount);
      debug("ai videoIDs " + ai_videoID_arr);
}

function setAILabels() {
   
   if(labelmode === "none") {
      
   } else if (labelmode === "random") {
      do {
         let aiLN = Math.floor(Math.random() * video_amount);
         aiLabel_arr.push(aiLN);
         aiLabel_arr = aiLabel_arr.filter((item, index) => {
            return aiLabel_arr.indexOf(item) === index
         });
      } while (aiLabel_arr.length < video_amount);
   } else if (labelmode === "accurate") {
      for(i=0; i<ai_pos_arr; i++) {
         aiLabel_arr[i] = ai_pos_arr[i]
      }
   }
   debug("AI labeling " + labelmode)
   debug("AI labels at " + aiLabel_arr)
}


//set the amount of ai videos in feed
function setAIamount(video_amount, percentage) {
   if(percentage == 0) {
      ai_amount = Math.floor((0*video_amount) / 4)
   }
   if(percentage == 25) {
      ai_amount = Math.floor(video_amount / 4)
   }
   if(percentage == 50) {
      ai_amount = Math.floor((2*video_amount) / 4)
   }
   if(percentage == 75) {
      ai_amount = Math.floor((3*video_amount) / 4)
   }
   if(percentage == 100) {
      ai_amount = Math.floor((4*video_amount) / 4)
   }
   debug("ai_amount " + ai_amount)

}

//set the positions of the ai videos in feed
function setAIvideos(video_amount, ai_amount) {
if(ai_amount > 0) {
   if(percentage == 25) {
      for (i = 0; i < video_amount; i = i + 4) {
         let asN = i + Math.floor(Math.random() * 4)
         ai_pos_arr.push(asN)
      }
   } else if(percentage == 50) {
      for (i = 0; i < video_amount; i = i + 2) {
         let asN = i + Math.floor(Math.random() * 2)
         ai_pos_arr.push(asN)
      }
   } else if(percentage == 75) {
      let ds_pos_arr = []
      for (i = 0; i < video_amount; i = i + 4) {
         let asN = i + Math.floor(Math.random() * 4)
         ds_pos_arr.push(asN)
      }
      for (z = 0; z < video_amount; z++) {
         if(!(ds_pos_arr.includes(z))) {
            ai_pos_arr.push(z)
         }
      }
   } else if(percentage == 100) {
      for (i = 0; i < video_amount; i++) {
         ai_pos_arr.push(i)
      }
   }
      
   debug("ai at " + ai_pos_arr);
   
}
}

function showPopup() {
   document.getElementById("video_container").style.display="none"
   document.getElementById('stoppop').style.display="block"
      var finwatchedVideos = getWatchedVideos()

   var finAi_ar = getAIarr()
   var finLiked = getLikedVideos()
   var finWatchtimes = getVideoWatchDurations()
   var feedid = "Feed" + getFeedNr()
   var feednr = getFeedNr()
   var groupid = getGroupID()
   var prolificid = getProlificID()
   debug("watched videos " + finwatchedVideos)
   debug("liked videos " + finLiked)
   debug("ai videos " + finAi_ar)
   debug("watchtimes " + finWatchtimes)
   debug("feednr " + feednr)
   debug("groupid " + groupid)
   debug("feedid " + feedid)
   debug("userid " + prolificid)

}

//collect all the results for the study
function collectResults() {
   var finwatchedVideos = getWatchedVideos()

   var finAi_ar = getAIarr()
   var finLabel = getLabels()
   var finLiked = getLikedVideos()
   var finWatchtimes = getVideoWatchDurations()
   var feedid = "Feed" + getFeedNr()
   var feednr = getFeedNr()
   var groupid = getGroupID()
   var prolificid = getProlificID()

   var json = '[';
   for(i=0;i<(finwatchedVideos.length);i++) {
      if(i == (finwatchedVideos.length -1)) {
         json = json + ' {"video": "' + finwatchedVideos[i] + '", "Ai": "' + finAi_ar[i] + '", "Like": "' +finLiked[i] + '", "Label": "' +finLabel[i] + '", "WatchTime": "' + finWatchtimes[i] + '"}'
      } else {
         json = json + ' {"video": "' + finwatchedVideos[i] + '", "Ai": "' + finAi_ar[i] + '", "Like": "' +finLiked[i] + '", "Label": "' +finLabel[i] + '", "WatchTime": "' + finWatchtimes[i] + '"},'
      }
   }
      
   json = json + ']'
   var fd = new FormData();
   fd.append('prolificid', prolificid);
   fd.append('groupid', groupid)
   fd.append('feedid',feedid)
   fd.append('feednr', feednr)
   fd.append('proc', percentage)
   fd.append('lab', labelmode)
   fd.append('feedOrSurvey', 'feed')
   fd.append('data', json)
   getData()

   //post data after timer done

   async function getData() { 
      let response = await fetch("statements/insert_session_data.php", {
      method: "POST",
      body: fd
      });
      window.location.href = await response.text() ;
   }
}




/*
INITIALIZE YOUTUBE IFRAME API
*/
function initializeYT() {
   var tag = document.createElement('script');

   tag.src = "https://www.youtube.com/iframe_api";
   var firstScriptTag = document.getElementsByTagName('script')[0];
   firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);
   console.log("YT initialized")
}
function onPlayerReadyPlayPauseNow(event) {
   var div = event.target.g;
   var index = $(div).parent().attr('data_id');

   if (index == video_in_view) {
      event.target.unMute();
   } else {
      event.target.mute();
   }
   event.target.playVideo();
}



/*
CHECK SCREEN FOR ACTIVE VIDEO
*/
function getActiveVideo(initial) {
   clearTimeout(scrollTimeout);

   scrollTimeout = setTimeout(function () {
      var windowHeight = $(window).height();
      var scrollTop = $(window).scrollTop();
      debug("windowHeight " + windowHeight)
      debug("scrollTop " + scrollTop)

      // Remove "active" class from all video wrappers
      $('.video_wrapper').removeClass('video_in_view');

      // Find the video wrapper in view
      $('.video_wrapper').each(function () {
         var video_wrapper = $(this);
         var offsetTop = video_wrapper.offset().top;
         debug("scrolled to " + offsetTop)
         
         
         var sectionHeight = video_wrapper.outerHeight();
         debug("how big? " + sectionHeight)
         if(maxScroll == undefined) {
            maxScroll = sectionHeight
         }
         debug("max scroll " + maxScroll)
         if (offsetTop <= scrollTop + windowHeight && Math.round(offsetTop + sectionHeight) > scrollTop) {
            video_wrapper.addClass('video_in_view');
            video_in_view = video_wrapper.attr('id').match(/\d+/)[0];
            
            debug("video_in_view " + video_in_view)

            firstVideo = false;
            debug("changed firstvideo")

            onScrollChange();

            if (initial) {
               activateVideo(video_in_view, true);
               debug("initial video")
            } else {
               debug("not initial")
               if ($('[data_id="' + (parseInt(video_in_view) - 5) + '"]').length != 0) {
                  debug("data case")
                  if (last_viw > parseInt(video_in_view)) {
                     activateVideoUp(video_in_view);
                     debug("scrolled up")
                  } else if (last_viw < parseInt(video_in_view)) {
                     activateVideo(video_in_view);
                     debug("scrolled down")
                  }
               } else {
                  debug("second data case")
                  if (last_viw > parseInt(video_in_view)) {
                     activateVideoUp(video_in_view);
                     debug("scrolled up 2")
                  } else if (last_viw < parseInt(video_in_view)) {
                     activateVideo(video_in_view);
                     debug("scrolled down 2")
                  } else if(ini_video) {
                     activateVideoUp(video_in_view)
                     debug("activate initial video")
                  } else if (in_video_rep) {
                     activateVideo(video_in_view)
                     debug("activate second video")
                  }
                  firstVideo = false;
                  debug("changed firstvideo")
               }
            }

            last_viw = video_in_view;
            return false;
         }
      });

      // if (!firstVideo) {
      //    if (parseFloat(((performance.now() - videoStartTime) / 1000).toFixed(2)) > 0.4) {
      //       videoWatchDurations.push(parseFloat(((performance.now() - videoStartTime) / 1000).toFixed(2)));
      //       videoStartTime = performance.now();
      //       pushSessionData();
      //       setVideoListState();
      //    }
      // }
   }, 100); // timeout duration as needed
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
         if (result == "") {
            window.location.replace("./login.php?source=pwa");
         } else {
            allowEntry();
            setData(result);
         }
      },
      // error: function (textStatus, errorThrown) {
      //    console.log(textStatus);
      //    console.log(errorThrown);
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
   if ($("input[name=enddate]")) {
      if ($("input[name=enddate]").val() == "") {
         $("input[name=enddate]").attr('value', result.enddate);
      }
   }
   pushSessionData(false, false);
   checkDate(result);
}
function checkDate(result) {
   var check_prolificid, check_sessionid, check_enddate;
   check_prolificid = result.prolificid;
   check_sessionid = $("input[name=session_id]").val();
   check_enddate = result.enddate;

   var check_datenow = new Date();
   var check_datethen = new Date(check_enddate);
   if (check_datethen < check_datenow) {
      window.location.replace("survey/index.php/179378/?lang=en&pr=" + check_prolificid + "&se=" + check_sessionid);
   }
}



/*
ALLOW USE OF PAGE
*/
function allowEntry() {
   using = true;
   $("#entry_overlay").fadeOut();
}



/* 
SESSION MEASURING 
*/
function startSessionTimer() {
   sessionStartTime = performance.now();
   sessionStartDateTime = getDateTimeNow();
}
function getSessionDuration() {
   const sessionDuration = performance.now() - sessionStartTime;
   return (sessionDuration / 1000).toFixed(2);  // return in seconds
}
function getSessionVideoCount() {
   var videocount = parseInt(video_in_view) - parseInt(initial_video_index) + 1;
   if (videocount < 0) {
      return 0;
   } else {
      return videocount;
   }
}
function getDateTimeNow() {
   var dt = new Date();
   dt.setMinutes(dt.getMinutes() - dt.getTimezoneOffset());
   return dt.toISOString();
}
function getAvgVideoWatchDuration() {
   var sum = 0;
   if (videoWatchDurations.length > 0) {
      videoWatchDurations.forEach((element) => {
         sum += element;
      });
      return (sum / videoWatchDurations.length).toFixed(2);
   } else {
      return 0;
   }
}
function getScreenResolution() {
   const w = window.screen.width;
   const h = window.screen.height;
   return w + ":" + h;
}
function getOS() {
   if (navigator.userAgentData && navigator.userAgentData.platform) {
      return navigator.userAgentData.platform;
   } else {
      return "";
   }
}
function getUserAgent() {
   if (navigator.userAgent) {
      return navigator.userAgent;
   } else {
      return "";
   }
}
function getLang() {
   return navigator.language;
}
function getTimeZone() {
   return Intl.DateTimeFormat().resolvedOptions().timeZone;
}



/*
SESSION DATA PUSH
*/
function pushSessionData() {
   // assembly session data and send it to the server
   var fd = new FormData();
   // fd.append('session_start', encrypt(sessionStartDateTime));
   // fd.append('session_end', encrypt(getDateTimeNow()));
   // fd.append('session_duration', encrypt(getSessionDuration()));
   // fd.append('session_videocount', encrypt(video_in_view));
   // fd.append('session_avgvideowatchtime', encrypt(getAvgVideoWatchDuration()));
   // fd.append('screenresolution', encrypt(getScreenResolution()));
   // fd.append('os', encrypt(getOS()));
   // fd.append('useragent', encrypt(getUserAgent()));
   // fd.append('language', encrypt(getLang()));
   // fd.append('timezone', encrypt(getTimeZone()));


   // var debugarray = [getSessionID(), getProlificID(), active_intervention, getInterventionIteration(), start_time, sessionStartDateTime, getDateTimeNow(), getSessionDuration(), getSessionVideoCount(), getAvgVideoWatchDuration(), getScreenResolution(), getOS(), getUserAgent(), getLang(), getTimeZone()];
   // console.log(debugarray);

   navigator.sendBeacon('./api.php', fd);
}



/*
ENCRYPT DATA (STRINGS)
*/
// var key = CryptoJS.enc.Hex.parse("yourEncryptionKey");
// var iv = CryptoJS.enc.Hex.parse("yourInitializationVector");

// function encrypt(text) {
//    var encrypted = CryptoJS.AES.encrypt(text, key, { iv: iv });
//    return encrypted.toString();
// }
// function decrypt(encryptedText) {
//    var decrypted = CryptoJS.AES.decrypt(encryptedText, key, { iv: iv });
//    return decrypted.toString(CryptoJS.enc.Utf8);
// }

function endReach() {
//stop when time is reached
      endAllVideos()
      showPopup()


}
setInterval(endReach, timeStop)



/* 
VIDEO FEED INITIALIZATION & HANDLING 
*/
function initializeLoop() {
   // getVideosFromDatabase().then(function () {
   //    createVideo(ai_database);
   //    createVideo(ai_database);
   //    createVideo(ai_database);
   // });
   getVideosFromJSON().then(function () {
      getVideosFromJSON2().then(function () {
         createInitialDSVideos(ai_database, video_database);
         debug("length AI " + ai_database.length + ", length DS " + video_database.length)
      });
   });
   onScrollChange(video_in_view);
}
function getVideosFromJSON() { //get ai videos
   // return $.getJSON('./yt-response_playlist.json', function (data) {
   return $.getJSON(AIfile, function (data) {
      ai_database = data;
   }).fail(function () {
      console.log("Error: Can't open JSON video database.");
   });
}
function getVideosFromJSON2() { //get nonai videos
   // return $.getJSON('./yt-response_playlist.json', function (data) {
   return $.getJSON(DSfile, function (data) {
      video_database= data;
   }).fail(function () {
      console.log("Error: Can't open JSON video database 2.");
   });
}
function createInitialDSVideos(meta_AI, meta_DS) { //the first two videos
   var profilePic = getProfilePic();
   var profilePicUrl = './assets/img/profiles/' + profilePic + '.jpg';
   var elementProfile = "<div class='button_main button_profile' style='background-image:url(" + profilePicUrl + ")'></div>";
   debug("ai video? " + ai_pos_arr.includes(total_video_index))
   if(aiLabel_arr.includes(total_video_index)) {
         var label = "Mit KI erstellt"
      } else {
         var label = ""
      }
   if(ai_pos_arr.includes(total_video_index)) { //check if fisrst video should be ai
      var ai_id = ai_videoID_arr[ai_index]
      debug("ai ID " + ai_id)
      var videoId = meta_AI[ai_id]['videoId'];
      var author = meta_AI[ai_id]['creatorname']
      var description = meta_AI[ai_id]['description']
      debug("videoID " + videoId)
      //var ytscript = "<script>player[" + total_video_index + "] = new YT.Player('player" + total_video_index + "', { height: '100%', width: '100%', videoId: '" + videoId + "', playerVars: { 'autoplay':1, 'controls':0, 'fs':0, 'iv_load_policy':3, 'loop':1, 'modestbranding':1, 'rel':0, 'showinfo':0, 'origin':'" + origin + "', 'playlist':'" + videoId + "' }, events: { 'onReady': onPlayerReadyPlayPauseNow, 'onError': onPlayerError }});</script>"
      video_container.append("<div data_id='" + total_video_index + "' id='video_" + total_video_index + "' videoid=' " + videoId + " ' class='video_wrapper video_in_view'> <div id='player" + total_video_index + "' class='player'> <video id = 'video" + total_video_index +"' src='" + videoId + "' autoplay = 'true' loop='true' frameborder='0' loading='lazy'> </video> <div class='ai_overlay'> <a href='#' class='ailabel'> <p class='ailabel'>" + label + "</p> </a></div> <div class='button_overlay'> <div class='button_array'> <div class='button_wrapper'> <a href='#'> " + elementProfile + " </a> <a href='#' a_id ='" + total_video_index + "' onclick='toggleLike(this)'> <div class='button_main button_like'> <svg width='100%' height='100%' viewBox='0 0 209 209' version='1.1' xmlns='http://www.w3.org/2000/svg' xmlns:xlink='http://www.w3.org/1999/xlink' xml:space='preserve' xmlns:serif='http://www.serif.com/' style='fill-rule:evenodd;clip-rule:evenodd;stroke-linejoin:round;stroke-miterlimit:2;'> <path d='M104.167,208.333c-0,0 -52.819,-54.022 -87.946,-104.908c-14.513,-21.023 -31.581,-62.667 9.31,-93.039c36.005,-26.743 78.636,4.928 78.636,19.361c-0,-14.433 42.63,-46.104 78.636,-19.361c40.89,30.372 23.823,72.016 9.31,93.039c-35.128,50.886 -87.946,104.908 -87.946,104.908Z' style='fill:#fff;' /> </svg> <p>" + "" + "</p> </div> </a> <a href='#'> <div class='button_main button_comment'> <svg width='100%' height='100%' viewBox='0 0 871 871' version='1.1' xmlns='http://www.w3.org/2000/svg' xmlns:xlink='http://www.w3.org/1999/xlink' xml:space='preserve' xmlns:serif='http://www.serif.com/' style='fill-rule:evenodd;clip-rule:evenodd;stroke-linejoin:round;stroke-miterlimit:2;'> <path d='M446.336,684.788c-3.629,0.065 -7.269,0.098 -10.919,0.098c-240.313,0 -435.417,-141.799 -435.417,-316.457c0,-174.657 195.104,-316.456 435.417,-316.456c240.313,-0 435.416,141.799 435.416,316.456c0,71.463 -32.662,137.425 -87.72,190.424c-85.362,98.489 -329.656,260.008 -329.656,260.008c15.59,-48.612 3.393,-102.306 -7.121,-134.073Zm-237.9,-388.182c-39.64,-0 -71.823,32.183 -71.823,71.823c-0,39.641 32.183,71.824 71.823,71.824c39.641,0 71.824,-32.183 71.824,-71.824c-0,-39.64 -32.183,-71.823 -71.824,-71.823Zm453.961,-0c-39.64,-0 -71.823,32.183 -71.823,71.823c-0,39.641 32.183,71.824 71.823,71.824c39.641,0 71.824,-32.183 71.824,-71.824c-0,-39.64 -32.183,-71.823 -71.824,-71.823Zm-226.98,-0c-39.641,-0 -71.824,32.183 -71.824,71.823c0,39.641 32.183,71.824 71.824,71.824c39.64,0 71.823,-32.183 71.823,-71.824c0,-39.64 -32.183,-71.823 -71.823,-71.823Z' style='fill:#fff;' /> </svg> <p>" + "" + "</p> </div> </a> <a href='#'> <div class='button_main button_save'> <svg width='100%' height='100%' viewBox='0 0 871 871' version='1.1' xmlns='http://www.w3.org/2000/svg' xmlns:xlink='http://www.w3.org/1999/xlink' xml:space='preserve' xmlns:serif='http://www.serif.com/' style='fill-rule:evenodd;clip-rule:evenodd;stroke-linejoin:round;stroke-miterlimit:2;'> <path d='M690.95,818.861l-255.533,-176.419l-255.533,176.419l-0,-766.888l511.066,-0l-0,766.888Z' style='fill:#fff;' /> </svg> <p>" + "" + "</p> </div> </a> <a href='#'> <div class='button_main button_share'> <svg width='100%' height='100%' viewBox='0 0 871 871' version='1.1' xmlns='http://www.w3.org/2000/svg' xmlns:xlink='http://www.w3.org/1999/xlink' xml:space='preserve' xmlns:serif='http://www.serif.com/' style='fill-rule:evenodd;clip-rule:evenodd;stroke-linejoin:round;stroke-miterlimit:2;'> <path d='M522.09,253.515l-0,-119.832l348.743,244.664l-348.743,244.664l-0,-130.427c-321.832,-0 -522.09,244.567 -522.09,244.567c0,-0 -33.619,-483.636 522.09,-483.636Z' style='fill:#fff;' /> </svg> <p>" + "" + "</p> </div> </a> <a href='#' class='hidden'> <div class='button_main button_audio'> </div> </a> </div> </div> <div class='description_overlay'> <a href='#' class='username'> <p class='video_author'>" + author + "</p> </a> <p class='video_description'>" + description + "</p> </div> </div> <div class='grid' onclick='togglePause(this)'><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div> <div class='noise_overlay'> </div> </div>");
      
      
      ai_index++;


   } else {
      var ds_id = ds_videoID_arr[ds_video_index]
      debug("ds ID " + ds_id)
      var videoId = meta_DS[ds_id]['videoId'];
      var author = meta_DS[ds_id]['creatorname']
      var description = meta_DS[ds_id]['description']
      debug("videoID " + videoId)
      video_container.append("<div data_id='" + total_video_index + "' id='video_" + total_video_index + "' videoid=' " + videoId + " ' class='video_wrapper video_in_view'> <div id='player" + total_video_index + "' class='player'> <video id = 'video" + total_video_index +"' src='" + videoId + "' autoplay = 'true' loop='true' frameborder='0' loading='lazy'> </video>  <div class='button_overlay'> <div class='button_array'> <div class='button_wrapper'> <a href='#'> " + elementProfile + " </a> <a href='#' a_id ='" + total_video_index + "' onclick='toggleLike(this)'> <div class='button_main button_like'> <svg width='100%' height='100%' viewBox='0 0 209 209' version='1.1' xmlns='http://www.w3.org/2000/svg' xmlns:xlink='http://www.w3.org/1999/xlink' xml:space='preserve' xmlns:serif='http://www.serif.com/' style='fill-rule:evenodd;clip-rule:evenodd;stroke-linejoin:round;stroke-miterlimit:2;'> <path d='M104.167,208.333c-0,0 -52.819,-54.022 -87.946,-104.908c-14.513,-21.023 -31.581,-62.667 9.31,-93.039c36.005,-26.743 78.636,4.928 78.636,19.361c-0,-14.433 42.63,-46.104 78.636,-19.361c40.89,30.372 23.823,72.016 9.31,93.039c-35.128,50.886 -87.946,104.908 -87.946,104.908Z' style='fill:#fff;' /> </svg> <p>" + "" + "</p> </div> </a> <a href='#'> <div class='button_main button_comment'> <svg width='100%' height='100%' viewBox='0 0 871 871' version='1.1' xmlns='http://www.w3.org/2000/svg' xmlns:xlink='http://www.w3.org/1999/xlink' xml:space='preserve' xmlns:serif='http://www.serif.com/' style='fill-rule:evenodd;clip-rule:evenodd;stroke-linejoin:round;stroke-miterlimit:2;'> <path d='M446.336,684.788c-3.629,0.065 -7.269,0.098 -10.919,0.098c-240.313,0 -435.417,-141.799 -435.417,-316.457c0,-174.657 195.104,-316.456 435.417,-316.456c240.313,-0 435.416,141.799 435.416,316.456c0,71.463 -32.662,137.425 -87.72,190.424c-85.362,98.489 -329.656,260.008 -329.656,260.008c15.59,-48.612 3.393,-102.306 -7.121,-134.073Zm-237.9,-388.182c-39.64,-0 -71.823,32.183 -71.823,71.823c-0,39.641 32.183,71.824 71.823,71.824c39.641,0 71.824,-32.183 71.824,-71.824c-0,-39.64 -32.183,-71.823 -71.824,-71.823Zm453.961,-0c-39.64,-0 -71.823,32.183 -71.823,71.823c-0,39.641 32.183,71.824 71.823,71.824c39.641,0 71.824,-32.183 71.824,-71.824c-0,-39.64 -32.183,-71.823 -71.824,-71.823Zm-226.98,-0c-39.641,-0 -71.824,32.183 -71.824,71.823c0,39.641 32.183,71.824 71.824,71.824c39.64,0 71.823,-32.183 71.823,-71.824c0,-39.64 -32.183,-71.823 -71.823,-71.823Z' style='fill:#fff;' /> </svg> <p>" + "" + "</p> </div> </a> <a href='#'> <div class='button_main button_save'> <svg width='100%' height='100%' viewBox='0 0 871 871' version='1.1' xmlns='http://www.w3.org/2000/svg' xmlns:xlink='http://www.w3.org/1999/xlink' xml:space='preserve' xmlns:serif='http://www.serif.com/' style='fill-rule:evenodd;clip-rule:evenodd;stroke-linejoin:round;stroke-miterlimit:2;'> <path d='M690.95,818.861l-255.533,-176.419l-255.533,176.419l-0,-766.888l511.066,-0l-0,766.888Z' style='fill:#fff;' /> </svg> <p>" + "" + "</p> </div> </a> <a href='#'> <div class='button_main button_share'> <svg width='100%' height='100%' viewBox='0 0 871 871' version='1.1' xmlns='http://www.w3.org/2000/svg' xmlns:xlink='http://www.w3.org/1999/xlink' xml:space='preserve' xmlns:serif='http://www.serif.com/' style='fill-rule:evenodd;clip-rule:evenodd;stroke-linejoin:round;stroke-miterlimit:2;'> <path d='M522.09,253.515l-0,-119.832l348.743,244.664l-348.743,244.664l-0,-130.427c-321.832,-0 -522.09,244.567 -522.09,244.567c0,-0 -33.619,-483.636 522.09,-483.636Z' style='fill:#fff;' /> </svg> <p>" + "" + "</p> </div> </a> <a href='#' class='hidden'> <div class='button_main button_audio'> </div> </a> </div> </div> <div class='description_overlay'> <a href='#' class='username'> <p class='video_author'>" + author + "</p> </a> <p class='video_description'>" + description + "</p> </div> </div> <div class='grid' onclick='togglePause(this)'><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div> <div class='noise_overlay'> </div> </div>");
      
      tmpvid1 = ds_video_index;
      ds_video_index++;
   }
   debug("video showing " + videoId)
   loadedVideos[0] = String(videoId)
   watchedVideos[0] = loadedVideos[0]

   videoList[total_video_index] = document.getElementById("video" + total_video_index)
   debug("checked video on list pos " + total_video_index)
   total_video_index++;
   videostartTime[0] = performance.now()
   videoWatchDurations[0] = 0


   //the second video
   var profilePic = getProfilePic();
   var profilePicUrl = './assets/img/profiles/' + profilePic + '.jpg';
   var elementProfile = "<div class='button_main button_profile' style='background-image:url(" + profilePicUrl + ")'></div>";
   debug("ai video? " + ai_pos_arr.includes(total_video_index))
   if(aiLabel_arr.includes(total_video_index)) {
         var label = "Mit KI erstellt"
      } else {
         var label = ""
      }
   if(ai_pos_arr.includes(total_video_index)) { //check if second video should be ai
      var ai_id = ai_videoID_arr[ai_index]
      debug("ai ID " + ai_id)
      var videoId = meta_AI[ai_id]['videoId'];
      var author = meta_AI[ai_id]['creatorname']
      var description = meta_AI[ai_id]['description']
      debug("videoID " + videoId)

      //var ytscript = "<script>player[" + total_video_index + "] = new YT.Player('player" + total_video_index + "', { height: '100%', width: '100%', videoId: '" + videoId + "', playerVars: { 'autoplay':1, 'controls':0, 'fs':0, 'iv_load_policy':3, 'loop':1, 'modestbranding':1, 'rel':0, 'showinfo':0, 'origin':'" + origin + "', 'playlist':'" + videoId + "' }, events: { 'onReady': onPlayerReadyPlayPauseNow, 'onError': onPlayerError }});</script>"
      video_container.append("<div data_id='" + total_video_index + "' id='video_" + total_video_index + "' videoid=' " + videoId + " ' class='video_wrapper'> <div id='player" + total_video_index + "' class='player'> <video id = 'video" + total_video_index +"' src='" + videoId + "'loop='true' frameborder='0' loading='lazy'> </video> </div> <div class='ai_overlay'> <a href='#' class='ailabel'> <p class='ailabel'>" + label + "</p> </a></div> <div class='button_overlay'> <div class='button_array'> <div class='button_wrapper'> <a href='#'> " + elementProfile + " </a> <a href='#' a_id ='" + total_video_index + "'onclick='toggleLike(this)'> <div class='button_main button_like'> <svg width='100%' height='100%' viewBox='0 0 209 209' version='1.1' xmlns='http://www.w3.org/2000/svg' xmlns:xlink='http://www.w3.org/1999/xlink' xml:space='preserve' xmlns:serif='http://www.serif.com/' style='fill-rule:evenodd;clip-rule:evenodd;stroke-linejoin:round;stroke-miterlimit:2;'> <path d='M104.167,208.333c-0,0 -52.819,-54.022 -87.946,-104.908c-14.513,-21.023 -31.581,-62.667 9.31,-93.039c36.005,-26.743 78.636,4.928 78.636,19.361c-0,-14.433 42.63,-46.104 78.636,-19.361c40.89,30.372 23.823,72.016 9.31,93.039c-35.128,50.886 -87.946,104.908 -87.946,104.908Z' style='fill:#fff;' /> </svg> <p>" + "" + "</p> </div> </a> <a href='#'> <div class='button_main button_comment'> <svg width='100%' height='100%' viewBox='0 0 871 871' version='1.1' xmlns='http://www.w3.org/2000/svg' xmlns:xlink='http://www.w3.org/1999/xlink' xml:space='preserve' xmlns:serif='http://www.serif.com/' style='fill-rule:evenodd;clip-rule:evenodd;stroke-linejoin:round;stroke-miterlimit:2;'> <path d='M446.336,684.788c-3.629,0.065 -7.269,0.098 -10.919,0.098c-240.313,0 -435.417,-141.799 -435.417,-316.457c0,-174.657 195.104,-316.456 435.417,-316.456c240.313,-0 435.416,141.799 435.416,316.456c0,71.463 -32.662,137.425 -87.72,190.424c-85.362,98.489 -329.656,260.008 -329.656,260.008c15.59,-48.612 3.393,-102.306 -7.121,-134.073Zm-237.9,-388.182c-39.64,-0 -71.823,32.183 -71.823,71.823c-0,39.641 32.183,71.824 71.823,71.824c39.641,0 71.824,-32.183 71.824,-71.824c-0,-39.64 -32.183,-71.823 -71.824,-71.823Zm453.961,-0c-39.64,-0 -71.823,32.183 -71.823,71.823c-0,39.641 32.183,71.824 71.823,71.824c39.641,0 71.824,-32.183 71.824,-71.824c-0,-39.64 -32.183,-71.823 -71.824,-71.823Zm-226.98,-0c-39.641,-0 -71.824,32.183 -71.824,71.823c0,39.641 32.183,71.824 71.824,71.824c39.64,0 71.823,-32.183 71.823,-71.824c0,-39.64 -32.183,-71.823 -71.823,-71.823Z' style='fill:#fff;' /> </svg> <p>" + "" + "</p> </div> </a> <a href='#' > <div class='button_main button_save'> <svg width='100%' height='100%' viewBox='0 0 871 871' version='1.1' xmlns='http://www.w3.org/2000/svg' xmlns:xlink='http://www.w3.org/1999/xlink' xml:space='preserve' xmlns:serif='http://www.serif.com/' style='fill-rule:evenodd;clip-rule:evenodd;stroke-linejoin:round;stroke-miterlimit:2;'> <path d='M690.95,818.861l-255.533,-176.419l-255.533,176.419l-0,-766.888l511.066,-0l-0,766.888Z' style='fill:#fff;' /> </svg> <p>" + "" + "</p> </div> </a> <a href='#'> <div class='button_main button_share'> <svg width='100%' height='100%' viewBox='0 0 871 871' version='1.1' xmlns='http://www.w3.org/2000/svg' xmlns:xlink='http://www.w3.org/1999/xlink' xml:space='preserve' xmlns:serif='http://www.serif.com/' style='fill-rule:evenodd;clip-rule:evenodd;stroke-linejoin:round;stroke-miterlimit:2;'> <path d='M522.09,253.515l-0,-119.832l348.743,244.664l-348.743,244.664l-0,-130.427c-321.832,-0 -522.09,244.567 -522.09,244.567c0,-0 -33.619,-483.636 522.09,-483.636Z' style='fill:#fff;' /> </svg> <p>" + "" + "</p> </div> </a> <a href='#' class='hidden'> <div class='button_main button_audio'> </div> </a> </div> </div> <div class='description_overlay'> <a href='#' class='username'> <p class='video_author'>" + author + "</p> </a> <p class='video_description'>" + description + "</p> </div> </div> <div class='grid' onclick='togglePause(this)'><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div> <div class='noise_overlay'> </div> </div>");
     
      ai_index++;


   } else {
      var ds_id = ds_videoID_arr[ds_video_index]
      debug("ds ID " + ds_id)
      var videoId = meta_DS[ds_id]['videoId'];
      var author = meta_DS[ds_id]['creatorname']
      var description = meta_DS[ds_id]['description']
      debug("videoID " + videoId)
      debug("ds_video_index: " + ds_video_index);
      video_container.append("<div data_id='" + total_video_index + "' id='video_" + total_video_index + "' videoid=' " + videoId + " ' class='video_wrapper'> <div id='player" + total_video_index + "' class='player'> <video id = 'video" + total_video_index +"' src='" + videoId + "' loop='true' frameborder='0' loading='lazy'> </video> </div> <div class='button_overlay'> <div class='button_array'> <div class='button_wrapper'> <a href='#'> " + elementProfile + " </a> <a href='#'a_id ='" + total_video_index + "' onclick='toggleLike(this)'> <div class='button_main button_like'> <svg width='100%' height='100%' viewBox='0 0 209 209' version='1.1' xmlns='http://www.w3.org/2000/svg' xmlns:xlink='http://www.w3.org/1999/xlink' xml:space='preserve' xmlns:serif='http://www.serif.com/' style='fill-rule:evenodd;clip-rule:evenodd;stroke-linejoin:round;stroke-miterlimit:2;'> <path d='M104.167,208.333c-0,0 -52.819,-54.022 -87.946,-104.908c-14.513,-21.023 -31.581,-62.667 9.31,-93.039c36.005,-26.743 78.636,4.928 78.636,19.361c-0,-14.433 42.63,-46.104 78.636,-19.361c40.89,30.372 23.823,72.016 9.31,93.039c-35.128,50.886 -87.946,104.908 -87.946,104.908Z' style='fill:#fff;' /> </svg> <p>" + "" + "</p> </div> </a> <a href='#'> <div class='button_main button_comment'> <svg width='100%' height='100%' viewBox='0 0 871 871' version='1.1' xmlns='http://www.w3.org/2000/svg' xmlns:xlink='http://www.w3.org/1999/xlink' xml:space='preserve' xmlns:serif='http://www.serif.com/' style='fill-rule:evenodd;clip-rule:evenodd;stroke-linejoin:round;stroke-miterlimit:2;'> <path d='M446.336,684.788c-3.629,0.065 -7.269,0.098 -10.919,0.098c-240.313,0 -435.417,-141.799 -435.417,-316.457c0,-174.657 195.104,-316.456 435.417,-316.456c240.313,-0 435.416,141.799 435.416,316.456c0,71.463 -32.662,137.425 -87.72,190.424c-85.362,98.489 -329.656,260.008 -329.656,260.008c15.59,-48.612 3.393,-102.306 -7.121,-134.073Zm-237.9,-388.182c-39.64,-0 -71.823,32.183 -71.823,71.823c-0,39.641 32.183,71.824 71.823,71.824c39.641,0 71.824,-32.183 71.824,-71.824c-0,-39.64 -32.183,-71.823 -71.824,-71.823Zm453.961,-0c-39.64,-0 -71.823,32.183 -71.823,71.823c-0,39.641 32.183,71.824 71.823,71.824c39.641,0 71.824,-32.183 71.824,-71.824c-0,-39.64 -32.183,-71.823 -71.824,-71.823Zm-226.98,-0c-39.641,-0 -71.824,32.183 -71.824,71.823c0,39.641 32.183,71.824 71.824,71.824c39.64,0 71.823,-32.183 71.823,-71.824c0,-39.64 -32.183,-71.823 -71.823,-71.823Z' style='fill:#fff;' /> </svg> <p>" + "" + "</p> </div> </a> <a href='#'> <div class='button_main button_save'> <svg width='100%' height='100%' viewBox='0 0 871 871' version='1.1' xmlns='http://www.w3.org/2000/svg' xmlns:xlink='http://www.w3.org/1999/xlink' xml:space='preserve' xmlns:serif='http://www.serif.com/' style='fill-rule:evenodd;clip-rule:evenodd;stroke-linejoin:round;stroke-miterlimit:2;'> <path d='M690.95,818.861l-255.533,-176.419l-255.533,176.419l-0,-766.888l511.066,-0l-0,766.888Z' style='fill:#fff;' /> </svg> <p>" + "" + "</p> </div> </a> <a href='#'> <div class='button_main button_share'> <svg width='100%' height='100%' viewBox='0 0 871 871' version='1.1' xmlns='http://www.w3.org/2000/svg' xmlns:xlink='http://www.w3.org/1999/xlink' xml:space='preserve' xmlns:serif='http://www.serif.com/' style='fill-rule:evenodd;clip-rule:evenodd;stroke-linejoin:round;stroke-miterlimit:2;'> <path d='M522.09,253.515l-0,-119.832l348.743,244.664l-348.743,244.664l-0,-130.427c-321.832,-0 -522.09,244.567 -522.09,244.567c0,-0 -33.619,-483.636 522.09,-483.636Z' style='fill:#fff;' /> </svg> <p>" + "" + "</p> </div> </a> <a href='#' class='hidden'> <div class='button_main button_audio'> </div> </a> </div> </div> <div class='description_overlay'> <a href='#' class='username'> <p class='video_author'>" + author + "</p> </a> <p class='video_description'>" + description + "</p> </div> </div> <div class='grid' onclick='togglePause(this)'><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div> <div class='noise_overlay'> </div> </div>");
     
      tmpvid2 = ds_video_index;
      ds_video_index++;
   }
   debug("video showing " + videoId)
   loadedVideos[1] = String(videoId)
   videoList[total_video_index] = document.getElementById("video" + total_video_index)
   debug("checked video on list pos " + total_video_index)
   total_video_index++;
   

   //var ytscript = "<script>function onYouTubeIframeAPIReady() { player[tmpvid1] = new YT.Player('player'+tmpvid1, { height: '100%', width: '100%', videoId: '" + meta_AI[tmpvid1]['contentDetails']['videoId'] + "', playerVars: { 'autoplay':1, 'controls':0, 'fs':0, 'iv_load_policy':3, 'loop':1, 'modestbranding':1, 'rel':0, 'showinfo':0, 'origin':'" + origin + "', 'playlist':'" + meta_AI[tmpvid1]['contentDetails']['videoId'] + "' }, events: { 'onReady': onPlayerReady, 'onError': onPlayerError }}); player[tmpvid2] = new YT.Player('player'+tmpvid2, { height: '100%', width: '100%', videoId: '" + meta_AI[tmpvid2]['contentDetails']['videoId'] + "', playerVars: { 'autoplay':0, 'controls':0, 'fs':0, 'iv_load_policy':3, 'loop':1, 'modestbranding':1, 'rel':0, 'showinfo':0, 'origin':'" + origin + "', 'playlist':'" + meta_AI[tmpvid2]['contentDetails']['videoId'] + "' }, events: { 'onReady': onPlayerReadyPlayPause, 'onError': onPlayerError }});} function onPlayerReady(event) { event.target.playVideo(); activateVideo(video_in_view, true); } function onPlayerReadyPlayPause(event) { event.target.mute(); event.target.playVideo(); } </script>"
   // video_container.append(ytscript);

   // $.ajax({
   //    url: "./statements/get_videodata.php",
   //    method: "POST",
   //    dataType: 'json',
   //    data: { video: meta_AI[tmpvid1]['contentDetails']['videoId'] },
   //    success: function (result) {
   //       result['likeCount'] = convertLikeCount(result['likeCount']);
   //       $('[videoid="' + meta_AI[tmpvid1]['contentDetails']['videoId'] + '"] .button_like p').text(result['likeCount']);
   //       $('[videoid="' + meta_AI[tmpvid1]['contentDetails']['videoId'] + '"] .video_author').text("@" + result['channelTitle']);
   //       $('[videoid="' + meta_AI[tmpvid1]['contentDetails']['videoId'] + '"] .video_description').text(result['videoTitle']);
   //    }
   // });
   //  $.ajax({
   //    url: "./statements/get_videodata.php",
   //    method: "POST",
   //    dataType: 'json',
   //    data: { video: meta_AI[tmpvid2]['contentDetails']['videoId'] },
   //    success: function (result) {
   //       result['likeCount'] = convertLikeCount(result['likeCount']);
   //       $('[videoid="' + meta_AI[tmpvid2]['contentDetails']['videoId'] + '"] .button_like p').text(result['likeCount']);
   //       $('[videoid="' + meta_AI[tmpvid2]['contentDetails']['videoId'] + '"] .video_author').text("@" + result['channelTitle']);
   //       $('[videoid="' + meta_AI[tmpvid2]['contentDetails']['videoId'] + '"] .video_description').text(result['videoTitle']);
   //    }
   // });
}
function createVideo(meta_AI) {
   temp_id = total_video_index % meta_AI.length;

   appendVideoMP4(temp_id, meta_AI);
   total_video_index++;
}
function createDSVideo(meta_AI, meta_DS, fill) {
   var totalTime = performance.now() - sessionStartTime
   debug("time " + totalTime)


   if (total_video_index < video_amount) {

      debug("ai video? " + ai_pos_arr.includes(total_video_index))
      
      if(ai_pos_arr.includes(total_video_index)){ //append ai video
         appendVideoYT(ai_index, meta_AI, meta_DS)
         ai_index++;
      } else {
         appendVideoDS(total_video_index, meta_AI, meta_DS); //append nonai video
      }
      
   } else  if(total_video_index == video_amount) { //stop when all videos were watched
      appendEmpty()
   }

   total_video_index++;

}
function appendVideoMP4(temp_id, meta_AI) {
   var profilePic = getProfilePic();
   var profilePicUrl = './assets/img/profiles/' + profilePic + '.jpg';
   var elementProfile = "<div class='button_main button_profile' style='background-image:url(" + profilePicUrl + ")'></div>";
   video_container.append("<div data_id='" + total_video_index + "' id='video_" + total_video_index + "' class='video_wrapper'> <div id='player'> <iframe src='" + meta_AI[temp_id]['url'] + "' frameborder='0' loading='lazy'> </iframe> </div> <div class='button_overlay'> <div class='button_array'> <div class='button_wrapper'> <a href='#'> " + elementProfile + " </a> <a href='#' onclick='toggleLike(this)'> <div class='button_main button_like'> <svg width='100%' height='100%' viewBox='0 0 209 209' version='1.1' xmlns='http://www.w3.org/2000/svg' xmlns:xlink='http://www.w3.org/1999/xlink' xml:space='preserve' xmlns:serif='http://www.serif.com/' style='fill-rule:evenodd;clip-rule:evenodd;stroke-linejoin:round;stroke-miterlimit:2;'> <path d='M104.167,208.333c-0,0 -52.819,-54.022 -87.946,-104.908c-14.513,-21.023 -31.581,-62.667 9.31,-93.039c36.005,-26.743 78.636,4.928 78.636,19.361c-0,-14.433 42.63,-46.104 78.636,-19.361c40.89,30.372 23.823,72.016 9.31,93.039c-35.128,50.886 -87.946,104.908 -87.946,104.908Z' style='fill:#fff;' /> </svg> <p>" + meta_AI[temp_id]['likes'] + "</p> </div> </a> <a href='#'> <div class='button_main button_comment'> <svg width='100%' height='100%' viewBox='0 0 871 871' version='1.1' xmlns='http://www.w3.org/2000/svg' xmlns:xlink='http://www.w3.org/1999/xlink' xml:space='preserve' xmlns:serif='http://www.serif.com/' style='fill-rule:evenodd;clip-rule:evenodd;stroke-linejoin:round;stroke-miterlimit:2;'> <path d='M446.336,684.788c-3.629,0.065 -7.269,0.098 -10.919,0.098c-240.313,0 -435.417,-141.799 -435.417,-316.457c0,-174.657 195.104,-316.456 435.417,-316.456c240.313,-0 435.416,141.799 435.416,316.456c0,71.463 -32.662,137.425 -87.72,190.424c-85.362,98.489 -329.656,260.008 -329.656,260.008c15.59,-48.612 3.393,-102.306 -7.121,-134.073Zm-237.9,-388.182c-39.64,-0 -71.823,32.183 -71.823,71.823c-0,39.641 32.183,71.824 71.823,71.824c39.641,0 71.824,-32.183 71.824,-71.824c-0,-39.64 -32.183,-71.823 -71.824,-71.823Zm453.961,-0c-39.64,-0 -71.823,32.183 -71.823,71.823c-0,39.641 32.183,71.824 71.823,71.824c39.641,0 71.824,-32.183 71.824,-71.824c-0,-39.64 -32.183,-71.823 -71.824,-71.823Zm-226.98,-0c-39.641,-0 -71.824,32.183 -71.824,71.823c0,39.641 32.183,71.824 71.824,71.824c39.64,0 71.823,-32.183 71.823,-71.824c0,-39.64 -32.183,-71.823 -71.823,-71.823Z' style='fill:#fff;' /> </svg> <p>" + meta_AI[temp_id]['comments'] + "</p> </div> </a> <a href='#'> <div class='button_main button_save'> <svg width='100%' height='100%' viewBox='0 0 871 871' version='1.1' xmlns='http://www.w3.org/2000/svg' xmlns:xlink='http://www.w3.org/1999/xlink' xml:space='preserve' xmlns:serif='http://www.serif.com/' style='fill-rule:evenodd;clip-rule:evenodd;stroke-linejoin:round;stroke-miterlimit:2;'> <path d='M690.95,818.861l-255.533,-176.419l-255.533,176.419l-0,-766.888l511.066,-0l-0,766.888Z' style='fill:#fff;' /> </svg> <p>" + meta_AI[temp_id]['saves'] + "</p> </div> </a> <a href='#'> <div class='button_main button_share'> <svg width='100%' height='100%' viewBox='0 0 871 871' version='1.1' xmlns='http://www.w3.org/2000/svg' xmlns:xlink='http://www.w3.org/1999/xlink' xml:space='preserve' xmlns:serif='http://www.serif.com/' style='fill-rule:evenodd;clip-rule:evenodd;stroke-linejoin:round;stroke-miterlimit:2;'> <path d='M522.09,253.515l-0,-119.832l348.743,244.664l-348.743,244.664l-0,-130.427c-321.832,-0 -522.09,244.567 -522.09,244.567c0,-0 -33.619,-483.636 522.09,-483.636Z' style='fill:#fff;' /> </svg> <p>" + meta_AI[temp_id]['shares'] + "</p> </div> </a> <a href='#' class='hidden'> <div class='button_main button_audio'> </div> </a> </div> </div> <div class='description_overlay'> <a href='#' class='username'> <p class='video_author'>" + meta_AI[temp_id]['username'] + "</p> </a> <p class='video_description'>" + meta_AI[temp_id]['description'] + "</p> </div> </div> <div class='noise_overlay'> </div> </div>");
}

//append a nonai video
function appendVideoDS(temp_id, meta_AI, meta_DS) {
   var profilePic = getProfilePic();
   var profilePicUrl = './assets/img/profiles/' + profilePic + '.jpg';
   var elementProfile = "<div class='button_main button_profile' style='background-image:url(" + profilePicUrl + ")'></div>";
   var ds_id = ds_videoID_arr[ds_video_index]
      debug("ds ID " + ds_id)
      var videoId = meta_DS[ds_id]['videoId'];
      var author = meta_DS[ds_id]['creatorname']
      var description = meta_DS[ds_id]['description']
      debug("videoID " + videoId)
   debug("ds index: " + ds_video_index + " on total index " + total_video_index);
   debug("video showing " + videoId)
   loadedVideos[total_video_index] = String(videoId)

   //var ytscript = "<script>player[" + total_video_index + "] = new YT.Player('player" + total_video_index + "', { height: '100%', width: '100%', videoId: '" + videoId + "', playerVars: { 'autoplay':1, 'controls':0, 'fs':0, 'iv_load_policy':3, 'loop':1, 'modestbranding':1, 'rel':0, 'showinfo':0, 'origin':'" + origin + "', 'playlist':'" + videoId + "' }, events: { 'onReady': onPlayerReadyPlayPauseNow, 'onError': onPlayerError }});</script>"
   video_container.append("<div data_id='" + total_video_index + "' id='video_" + total_video_index + "' videoid=' " + videoId + " ' class='video_wrapper'> <div id='player" + total_video_index + "' class='player'> <video id = 'video" + total_video_index +"' src='" + videoId + "' loop='true' frameborder='0' loading='lazy'> </video> </div> <div class='button_overlay'> <div class='button_array'> <div class='button_wrapper'> <a href='#'> " + elementProfile + " </a> <a href='#' a_id ='" + total_video_index + "'onclick='toggleLike(this)'> <div class='button_main button_like'> <svg width='100%' height='100%' viewBox='0 0 209 209' version='1.1' xmlns='http://www.w3.org/2000/svg' xmlns:xlink='http://www.w3.org/1999/xlink' xml:space='preserve' xmlns:serif='http://www.serif.com/' style='fill-rule:evenodd;clip-rule:evenodd;stroke-linejoin:round;stroke-miterlimit:2;'> <path d='M104.167,208.333c-0,0 -52.819,-54.022 -87.946,-104.908c-14.513,-21.023 -31.581,-62.667 9.31,-93.039c36.005,-26.743 78.636,4.928 78.636,19.361c-0,-14.433 42.63,-46.104 78.636,-19.361c40.89,30.372 23.823,72.016 9.31,93.039c-35.128,50.886 -87.946,104.908 -87.946,104.908Z' style='fill:#fff;' /> </svg> <p>" + "" + "</p> </div> </a> <a href='#' > <div class='button_main button_comment'> <svg width='100%' height='100%' viewBox='0 0 871 871' version='1.1' xmlns='http://www.w3.org/2000/svg' xmlns:xlink='http://www.w3.org/1999/xlink' xml:space='preserve' xmlns:serif='http://www.serif.com/' style='fill-rule:evenodd;clip-rule:evenodd;stroke-linejoin:round;stroke-miterlimit:2;'> <path d='M446.336,684.788c-3.629,0.065 -7.269,0.098 -10.919,0.098c-240.313,0 -435.417,-141.799 -435.417,-316.457c0,-174.657 195.104,-316.456 435.417,-316.456c240.313,-0 435.416,141.799 435.416,316.456c0,71.463 -32.662,137.425 -87.72,190.424c-85.362,98.489 -329.656,260.008 -329.656,260.008c15.59,-48.612 3.393,-102.306 -7.121,-134.073Zm-237.9,-388.182c-39.64,-0 -71.823,32.183 -71.823,71.823c-0,39.641 32.183,71.824 71.823,71.824c39.641,0 71.824,-32.183 71.824,-71.824c-0,-39.64 -32.183,-71.823 -71.824,-71.823Zm453.961,-0c-39.64,-0 -71.823,32.183 -71.823,71.823c-0,39.641 32.183,71.824 71.823,71.824c39.641,0 71.824,-32.183 71.824,-71.824c-0,-39.64 -32.183,-71.823 -71.824,-71.823Zm-226.98,-0c-39.641,-0 -71.824,32.183 -71.824,71.823c0,39.641 32.183,71.824 71.824,71.824c39.64,0 71.823,-32.183 71.823,-71.824c0,-39.64 -32.183,-71.823 -71.823,-71.823Z' style='fill:#fff;' /> </svg> <p>" + "" + "</p> </div> </a> <a href='#'> <div class='button_main button_save'> <svg width='100%' height='100%' viewBox='0 0 871 871' version='1.1' xmlns='http://www.w3.org/2000/svg' xmlns:xlink='http://www.w3.org/1999/xlink' xml:space='preserve' xmlns:serif='http://www.serif.com/' style='fill-rule:evenodd;clip-rule:evenodd;stroke-linejoin:round;stroke-miterlimit:2;'> <path d='M690.95,818.861l-255.533,-176.419l-255.533,176.419l-0,-766.888l511.066,-0l-0,766.888Z' style='fill:#fff;' /> </svg> <p>" + "" + "</p> </div> </a> <a href='#'> <div class='button_main button_share'> <svg width='100%' height='100%' viewBox='0 0 871 871' version='1.1' xmlns='http://www.w3.org/2000/svg' xmlns:xlink='http://www.w3.org/1999/xlink' xml:space='preserve' xmlns:serif='http://www.serif.com/' style='fill-rule:evenodd;clip-rule:evenodd;stroke-linejoin:round;stroke-miterlimit:2;'> <path d='M522.09,253.515l-0,-119.832l348.743,244.664l-348.743,244.664l-0,-130.427c-321.832,-0 -522.09,244.567 -522.09,244.567c0,-0 -33.619,-483.636 522.09,-483.636Z' style='fill:#fff;' /> </svg> <p>" + "" + "</p> </div> </a> <a href='#' class='hidden'> <div class='button_main button_audio'> </div> </a> </div> </div> <div class='description_overlay'> <a href='#' class='username'> <p class='video_author'>" + author + "</p> </a> <p class='video_description'>" + description + "</p> </div> </div> <div class='grid' onclick='togglePause(this)'><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div> <div class='noise_overlay'> </div> </div>");
   ds_video_index++;
   videoList[total_video_index] = document.getElementById("video" + total_video_index)
   debug("checked video on list pos " + total_video_index)
   // $.ajax({
   //    url: "./statements/get_videodata.php",
   //    method: "POST",
   //    dataType: 'json',
   //    data: { video: videoId },
   //    success: function (result) {
   //       result['likeCount'] = convertLikeCount(result['likeCount']);
   //       $('[videoid="' + videoId + '"] .button_like p').text(result['likeCount']);
   //       $('[videoid="' + videoId + '"] .video_author').text("@" + result['channelTitle']);
   //       $('[videoid="' + videoId + '"] .video_description').text(result['videoTitle']);
   //    },
   //    error: function (textStatus, errorThrown) {
   //       // console.log(textStatus);
   //       // console.log(errorThrown);
   //    }
   // });
}
function appendEmpty() {

   video_container.append("<div data_id='ende' id='ende' videoid='ende' class='video_wrapper'> <div id='player ende' class='player'> <video id = 'video ende' src='' loop='true' frameborder='0' loading='lazy'> </video> </div><div class='button_overlay'> <div class='button_array_ende'> <div class='button_wrapper_ende'> <a href='#' onclick=collectResults()> <div class='button_ende'> Weiter zum Fragebogen </div> </a></div></div></div>")
   //    method: "POST",
   //    dataType: 'json',
   //    data: { video: videoId },
   //    success: function (result) {
   //       result['likeCount'] = convertLikeCount(result['likeCount']);
   //       $('[videoid="' + videoId + '"] .button_like p').text(result['likeCount']);
   //       $('[videoid="' + videoId + '"] .video_author').text("@" + result['channelTitle']);
   //       $('[videoid="' + videoId + '"] .video_description').text(result['videoTitle']);
   //    },
   //    error: function (textStatus, errorThrown) {
   //       // console.log(textStatus);
   //       // console.log(errorThrown);
   //    }
   // });
}

//append an ai video
function appendVideoYT(ai_index, meta_AI, meta_DS) {
   var profilePic = getProfilePic();
   var profilePicUrl = './assets/img/profiles/' + profilePic + '.jpg';
   var elementProfile = "<div class='button_main button_profile' style='background-image:url(" + profilePicUrl + ")'></div>";

   var ai_id = ai_videoID_arr[ai_index]
      debug("ai ID " + ai_id)
      var videoId = meta_AI[ai_id]['videoId'];
      var author = meta_AI[ai_id]['creatorname']
      var description = meta_AI[ai_id]['description']
      debug("videoID " + videoId)
      if(aiLabel_arr.includes(total_video_index)) {
         var label = "Mit KI erstellt"
      } else {
         var label = ""
      }

   //var ytscript = "<script>player[" + total_video_index + "] = new YT.Player('player" + total_video_index + "', { height: '100%', width: '100%', videoId: '" + videoId + "', playerVars: { 'autoplay':1, 'controls':0, 'fs':0, 'iv_load_policy':3, 'loop':1, 'modestbranding':1, 'rel':0, 'showinfo':0, 'origin':'" + origin + "', 'playlist':'" + videoId + "' }, events: { 'onReady': onPlayerReadyPlayPauseNow, 'onError': onPlayerError }});</script>"
   video_container.append("<div data_id='" + total_video_index + "' id='video_" + total_video_index + "' videoid=' " + videoId + " ' class='video_wrapper'> <div id='player" + total_video_index + "' class='player'> <video id = 'video" + total_video_index +"' src='" + videoId + "' loop='true' frameborder='0' loading='lazy'> </video> </div><div class='ai_overlay'> <a href='#' class='ailabel'> <p class='ailabel'>" + label + "</p> </a></div>  <div class='button_overlay'> <div class='button_array'> <div class='button_wrapper'> <a href='#'> " + elementProfile + " </a> <a href='#' a_id ='" + total_video_index + "'onclick='toggleLike(this)'> <div class='button_main button_like'> <svg width='100%' height='100%' viewBox='0 0 209 209' version='1.1' xmlns='http://www.w3.org/2000/svg' xmlns:xlink='http://www.w3.org/1999/xlink' xml:space='preserve' xmlns:serif='http://www.serif.com/' style='fill-rule:evenodd;clip-rule:evenodd;stroke-linejoin:round;stroke-miterlimit:2;'> <path d='M104.167,208.333c-0,0 -52.819,-54.022 -87.946,-104.908c-14.513,-21.023 -31.581,-62.667 9.31,-93.039c36.005,-26.743 78.636,4.928 78.636,19.361c-0,-14.433 42.63,-46.104 78.636,-19.361c40.89,30.372 23.823,72.016 9.31,93.039c-35.128,50.886 -87.946,104.908 -87.946,104.908Z' style='fill:#fff;' /> </svg> <p>" + "" + "</p> </div> </a> <a href='#' > <div class='button_main button_comment'> <svg width='100%' height='100%' viewBox='0 0 871 871' version='1.1' xmlns='http://www.w3.org/2000/svg' xmlns:xlink='http://www.w3.org/1999/xlink' xml:space='preserve' xmlns:serif='http://www.serif.com/' style='fill-rule:evenodd;clip-rule:evenodd;stroke-linejoin:round;stroke-miterlimit:2;'> <path d='M446.336,684.788c-3.629,0.065 -7.269,0.098 -10.919,0.098c-240.313,0 -435.417,-141.799 -435.417,-316.457c0,-174.657 195.104,-316.456 435.417,-316.456c240.313,-0 435.416,141.799 435.416,316.456c0,71.463 -32.662,137.425 -87.72,190.424c-85.362,98.489 -329.656,260.008 -329.656,260.008c15.59,-48.612 3.393,-102.306 -7.121,-134.073Zm-237.9,-388.182c-39.64,-0 -71.823,32.183 -71.823,71.823c-0,39.641 32.183,71.824 71.823,71.824c39.641,0 71.824,-32.183 71.824,-71.824c-0,-39.64 -32.183,-71.823 -71.824,-71.823Zm453.961,-0c-39.64,-0 -71.823,32.183 -71.823,71.823c-0,39.641 32.183,71.824 71.823,71.824c39.641,0 71.824,-32.183 71.824,-71.824c-0,-39.64 -32.183,-71.823 -71.824,-71.823Zm-226.98,-0c-39.641,-0 -71.824,32.183 -71.824,71.823c0,39.641 32.183,71.824 71.824,71.824c39.64,0 71.823,-32.183 71.823,-71.824c0,-39.64 -32.183,-71.823 -71.823,-71.823Z' style='fill:#fff;' /> </svg> <p>" + "" + "</p> </div> </a> <a href='#'> <div class='button_main button_save'> <svg width='100%' height='100%' viewBox='0 0 871 871' version='1.1' xmlns='http://www.w3.org/2000/svg' xmlns:xlink='http://www.w3.org/1999/xlink' xml:space='preserve' xmlns:serif='http://www.serif.com/' style='fill-rule:evenodd;clip-rule:evenodd;stroke-linejoin:round;stroke-miterlimit:2;'> <path d='M690.95,818.861l-255.533,-176.419l-255.533,176.419l-0,-766.888l511.066,-0l-0,766.888Z' style='fill:#fff;' /> </svg> <p>" + "" + "</p> </div> </a> <a href='#'> <div class='button_main button_share'> <svg width='100%' height='100%' viewBox='0 0 871 871' version='1.1' xmlns='http://www.w3.org/2000/svg' xmlns:xlink='http://www.w3.org/1999/xlink' xml:space='preserve' xmlns:serif='http://www.serif.com/' style='fill-rule:evenodd;clip-rule:evenodd;stroke-linejoin:round;stroke-miterlimit:2;'> <path d='M522.09,253.515l-0,-119.832l348.743,244.664l-348.743,244.664l-0,-130.427c-321.832,-0 -522.09,244.567 -522.09,244.567c0,-0 -33.619,-483.636 522.09,-483.636Z' style='fill:#fff;' /> </svg> <p>" + "" + "</p> </div> </a> <a href='#' class='hidden'> <div class='button_main button_audio'> </div> </a> </div> </div> <div class='description_overlay'> <a href='#' class='username'> <p class='video_author'>" + author + "</p> </a> <p class='video_description'>" + description + "</p> </div> </div> <div class='grid' onclick='togglePause(this)'><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div> <div class='noise_overlay'> </div> </div>");
   debug("video showing " + videoId)
   loadedVideos[total_video_index] = videoId
   videoList[total_video_index] = document.getElementById("video" + total_video_index)
   debug("checked video on list pos " + total_video_index)
   debug("total index " + total_video_index)
}

function activateVideo(index, initial, notinview) {

   // if(index == 0 && !thirdreached && !thirdreached2) { //bug that switches first and second video to play on phones
   //    debug("bug")
   //    thirdreached = true
   //    debug("thirdreached")
   //    activateVideoUp(1)
   // } else {
   if(!firstVideo) {
      var newvid_index = Number(index);

      for (i = 0; i < videoList.length; i++) { //pause all videos expcept the one to play and save their watchtime
         if(i != newvid_index) {
         debug("videoList length " + videoList.length)

         var pausedvid = videoList[i].paused
         if(!pausedvid) {
            videoList[i].muted = true
            videoList[i].currentTime = 0
            videoList[i].pause()
            videoendTime[i] = performance.now()
            videoWatchDurations[i] = Number(videoWatchDurations[i]) + ((videoendTime[i]-videostartTime[i])/1000);
            debug("paused video on index " + i)
            debug("watched video " + i + " for " + videoWatchDurations[i] + " seconds ")
         }
         }
      }

      


      debug("new index to play " + newvid_index)
      if(newvid_index == 1) {
         ini_video = true
         
      } else {
         ini_video = false
      }
      // videoList.forEach((element) => { 
      //    debug("videoList " + element.src + " ")

      // })

      //play new video
      videoList[newvid_index].muted = false
      videoList[newvid_index].play()
      watchedVideos[newvid_index] = loadedVideos[newvid_index]
      debug("watching video " + watchedVideos[newvid_index])
      videostartTime[newvid_index] = performance.now()
      videoWatchDurations[newvid_index] = 0
      debug("ini video " + ini_video)
}
}



function activateVideoUp(index, initial, notinview) {
   debug("activate video up")



      if(ini_video) { //activate the first video when scrolling up
         debug("videoList length " + videoList.length)

         for (i = 1; i < videoList.length; i++) { //pause all videos expcept the one to play and save their watchtime

         var pausedvid = videoList[i].paused
         if(!pausedvid) {
            videoList[i].muted = true
            videoList[i].currentTime = 0
            videoList[i].pause()
            videoendTime[i] = performance.now()
            videoWatchDurations[i] = Number(videoWatchDurations[i]) + ((videoendTime[i]-videostartTime[i])/1000);
            debug("paused video on index " + i)
            debug("watched video " + i + " for " + videoWatchDurations[i] + " seconds ")
         }
      }
         

      

         debug("new index to play " + 0)
         // videoList.forEach((element) => { 
         //    debug("videoList " + element.src + " ")

         // })
         videoList[0].muted = false
         videoList[0].play()
         videostartTime[0] = performance.now()
         ini_video = false
         in_video_rep = true
         
      } else {
         var newvid_index = Number(index);
         debug("videoList length " + videoList.length)
         for (i = 0; i < videoList.length; i++) { //pause all videos expcept the one to play and save their watchtime
            if(i != newvid_index) {

            var pausedvid = videoList[i].paused
               if(!pausedvid) {
                  videoList[i].muted = true
                  videoList[i].currentTime = 0
                  videoList[i].pause()
                  videoendTime[i] = performance.now()
                  videoWatchDurations[i] = Number(videoWatchDurations[i]) + ((videoendTime[i]-videostartTime[i])/1000);
                  debug("paused video on index " + i)
            debug("watched video " + i + " for " + videoWatchDurations[i] + " seconds ")
               }
            }
         }
         debug("new index to play " + newvid_index)
         // videoList.forEach((element) => { 
         //    debug("videoList " + element.src + " ")

         // })
         videoList[newvid_index].muted = false
         videoList[newvid_index].play()
         videostartTime[newvid_index] = performance.now()
         if(newvid_index == 1) {
            ini_video = true
         } else {
            ini_video = false
         }

      }

      debug("ini video " + ini_video)

         


}

//stop all videos

function endAllVideos() {
   for (i = 0; i< videoList.length; i++) {
      var pausedvid = videoList[i].paused
      if(!pausedvid) {
         
         videoList[i].muted = true
         videoList[i].currentTime = 0
         videoList[i].pause()
         videoendTime[i] = performance.now()
         videoWatchDurations[i] = Number(videoWatchDurations[i]) + ((videoendTime[i]-videostartTime[i])/1000);
         debug("paused video on index " + i)
      }

   }
}



function activateYTVideo(index, initial, notinview) {
   // remove past videos
   if ($('[data_id="' + (parseInt(index) - 5) + '"]').length != 0) {
      $('[data_id="' + (parseInt(index) - 5) + '"]').remove();
   }


   if (typeof player[index] == "undefined") {
      if (!initial) {
         player.forEach((element) => element.pauseVideo());

         var yt_videoid = $('[data_id="' + index + '"]').attr('videoid');

         // console.log(index, yt_videoid);

         function onYouTubeIframeAPIReady() {
            player[index] = new YT.Player('player' + index, {
               height: '120%',
               width: '100%',
               videoId: yt_videoid,
               playerVars: { 'autoplay': 0, 'controls': 0, 'fs': 0, 'iv_load_policy': 3, 'loop': 1, 'modestbranding': 1, 'rel': 0, 'showinfo': 0, 'playlist': yt_videoid, 'origin': origin },
               events: { 'onReady': onPlayerReady, 'onError': onPlayerError }
            });
         }
         function onPlayerReady(event) {
            if (!notinview) {
               event.target.playVideo();
               event.target.unMute();
            }
         }
         onYouTubeIframeAPIReady();
      }
   } else {
      if (!notinview) {
         player.forEach((element, index) => {
            if (typeof element.pauseVideo === 'function') {
               if (!initial) {
                  if (index < video_in_view) {
                     element.pauseVideo();
                  } else {
                     element.unMute();
                  }
               }
            }
         });
      }
      if (!notinview) {
         if (typeof player[index].playVideo === 'function') {
            player[index].playVideo();
            player[index].unMute();
         }
      }
   }
}

/*function activateVideoUp(index, initial) {
   if (typeof player[index] == "undefined") {
      if (!initial) {
         player.forEach((element) => element.pauseVideo());

         var yt_videoid = $('[data_id="' + index + '"]').attr('videoid');

         // console.log(index, yt_videoid);

         function onYouTubeIframeAPIReady() {
            player[index] = new YT.Player('player' + index, {
               height: '120%',
               width: '100%',
               videoId: yt_videoid,
               playerVars: { 'autoplay': 1, 'controls': 0, 'fs': 0, 'iv_load_policy': 3, 'loop': 1, 'modestbranding': 1, 'rel': 0, 'showinfo': 0, 'playlist': yt_videoid, 'origin': origin },
               events: { 'onReady': onPlayerReady, 'onError': onPlayerError }
            });
         }
         function onPlayerReady(event) {
            event.target.playVideo();
            event.target.unMute();
         }
         onYouTubeIframeAPIReady();
      }
   } else {
      player.forEach((element, index) => {
         if (typeof element.pauseVideo === 'function') {
            element.pauseVideo();
            element.unMute();
         }
      });
      if (typeof player[index].playVideo === 'function') {
         player[index].playVideo();
         player[index].unMute();
      }
   }
}
   */
function onPlayerError(event) {
   var div = event.target.g;
   var index = $(div).parent().attr('data_id');
   fixVideo(index);
}
/*function fixVideo(index) {
   if (index.toString() in tryagain) {
      tryagain[index.toString()] = tryagain[index.toString()] + 1;
   } else {
      tryagain[index.toString()] = 1;
   }

   if (tryagain[index.toString()] <= 2) {
      debug("initiating video unavailable fix for " + index);
      var yt_videoid = $('[data_id="' + index + '"]').attr('videoid');
      player[index].destroy();
      player[index] = new YT.Player('player' + index, {
         height: '120%',
         width: '100%',
         videoId: yt_videoid,
         playerVars: { 'autoplay': 1, 'controls': 0, 'fs': 0, 'iv_load_policy': 3, 'loop': 1, 'modestbranding': 1, 'rel': 0, 'showinfo': 0, 'playlist': yt_videoid, 'origin': origin },
         events: { 'onReady': onPlayerReady, 'onError': onPlayerError }
      });
      function onPlayerReady(event) {
         event.target.playVideo();
         if (index == video_in_view) {
            event.target.unMute();
         } else {
            event.target.mute();
         }
         activateVideo(video_in_view, false, true);
      }
   }
}
   */
function getProfilePic(max = 12) {
   return Math.max(1, Math.floor(Math.random() * max));
}
function toggleLike(element) {
   var el_id = $(element).attr('a_id');
   var like_count = $(element).find('p').text();

   if ($(element).hasClass('liked')) {
      // remove like
      $(element).find('path').attr('style', 'fill:#fff');
      $(element).removeClass('liked');
      if (!isNaN(like_count) && +like_count === parseInt(like_count, 10)) {
         like_count = parseInt(like_count);
         $(element).find('p').text(like_count - 1);
      }
      likedVideos[el_id] = false;
      debug("unliked video " + el_id)

   } else {
      // add like
      $(element).find('path').attr('style', 'fill:#ee5253');
      $(element).addClass('liked');
      if (!isNaN(like_count) && +like_count === parseInt(like_count, 10)) {
         like_count = parseInt(like_count);
         $(element).find('p').text(like_count + 1);
      }

      likedVideos[el_id] = true;
      debug("liked video " + el_id)
   }

}
function togglePause(el) {
   var el_id = $(el).parent().attr('data_id');
   if(el_id == undefined) {
      el_id = 0;
   }
   var state = videoList[el_id].paused
   
   debug("video " + el_id + " is paused? " + state)
   if (state) {
      // video is paused
      videostartTime[el_id] = performance.now()
      videoList[el_id].play()
   } else {
      // video is playing
      videoendTime[el_id] = performance.now()
      videoList[el_id].pause()
      videoWatchDurations[el_id] = Number(videoWatchDurations[el_id]) + ((videoendTime[el_id]-videostartTime[el_id])/1000);
      debug("watched video " + el_id + " for " + videoWatchDurations[el_id] + " seconds ")
   }
}
function convertLikeCount(count) {
   if (count >= 1000000) {
      return (count / 1000000).toFixed(1) + 'M';
   } else if (count >= 1000) {
      return (count / 1000).toFixed(1) + 'K';
   } else {
      return count;
   }
}
function onScrollChange() {
   var totalTime = performance.now() -sessionStartTime
   debug("totaltime " + totalTime)
   debug("now next videos" +video_in_view+ "-"+video_in_view+ "=" + (total_video_index - video_in_view) + " " +(total_video_index - video_in_view == 2))
   
   if (video_in_view == (videoList.length - 1 ) && video_in_view > 0) {
      // createVideo(ai_database);
      setTimeout(function () {
         createDSVideo(ai_database, video_database, true);
      }, 100)

      debug("appending video " + total_video_index);
   }
}



/* 
NOTIFICATION HANDLING 
*/
function isPushNotificationSupported() {
   return "serviceWorker" in navigator && "PushManager" in window;
}
// function initializePushNotifications() {
//    // request user grant to show notification
//    return Notification.requestPermission(function (result) {
//       return result;
//    });
// }
function sendNotification(input, url, tag) {
   // const text = input;
   // const title = "Research Study";
   // const options = {
   //    body: text,
   //    icon: "./assets/img/app-icon_192x192.png",
   //    vibrate: [200, 100, 200],
   //    tag: "new-notification",
   //    badge: "./assets/img/app-icon_192x192.png",
   //    actions: [{ action: "Detail", title: "View", icon: "" }]
   // };
   // navigator.serviceWorker.ready.then(function (serviceWorker) {
   //    serviceWorker.showNotification(title, options);
   // });

   if ("serviceWorker" in navigator) {
      // Use the service worker registration to send the notification
      // navigator.serviceWorker.ready.then((registration) => {
      //    registration.showNotification("ReelRush – Questionnaire for Study", {
      //       body: input,
      //       icon: "./assets/img/app-icon_192x192.png",
      //       badge: "./assets/img/app-icon-badge.png",
      //       tag: tag,
      //       silent: false,
      //       importance: "high",
      //       vibrate: [200, 100, 200],
      //       data: {
      //          url: url  // open custom url on notification press (HANDLER IN serviceworker.js)
      //       }
      //    });
      // });
      navigator.serviceWorker.controller.postMessage({
         action: 'sendNotification',
         body: input,
         icon: "./assets/img/app-icon_192x192.png",
         badge: "./assets/img/app-icon-badge.png",
         tag: tag,
         silent: false,
         importance: "high",
         vibrate: [200, 100, 200],
         url: url  // open custom url on notification press (HANDLER IN serviceworker.js)
      });

      // navigator.serviceWorker.ready
      //    .then(registration => {
      //       registration.active.postMessage({
      //          action: 'sendNotification',
      //          body: input,
      //          icon: "./assets/img/app-icon_192x192.png",
      //          badge: "./assets/img/app-icon-badge.png",
      //          tag: tag,
      //          silent: false,
      //          importance: "high",
      //          vibrate: [200, 100, 200],
      //          url: url  // open custom url on notification press (HANDLER IN serviceworker.js)
      //       });
      //    })
      //    .catch(error => {
      //       console.error('Service worker not ready:', error);
      //    });
   }
}



/* 
INTERVENTIONS 
*/
var start_value_video_count = 0;
// var time_list = [180, 360, 540];
// var time_list = [5, 10, 15];
// var start_time = time_list[Math.floor(Math.random() * time_list.length)];

var start_time = 600; // USE THIS FOR STUDY: 10 minutes until starting intervention

// function addIntervention() {
//    var timestamp = getSessionDuration();
//    var intervention_option = $('input[name="intervention_options"]:checked').val();

//    if (start_time < timestamp) {
//       // console.log("intervention start");
//       if (intervention_option == "option_blur" || active_intervention == 0) {
//          startAMD(timestamp);
//       } else if (intervention_option == "option_desaturation" || active_intervention == 1) {
//          startCataract(timestamp);
//       } else if (intervention_option == "option_organism" || active_intervention == 2) {
//          startDR(timestamp);
//       } else if (intervention_option == "option_glaucoma" || active_intervention == 3) {
//          startGlaucoma(timestamp);
//       } else if (intervention_option == "option_alerts" || active_intervention == 4) {
//          startAlerts(timestamp);
//       }
//    }
//}


/*** Blur - Age-Related Macular Degeneration (AMD) ***/
// var blur_iteration_list = [180, 360, 540];
// var blur_iteration = blur_iteration_list[Math.floor(Math.random() * blur_iteration_list.length)];
function startAMD(timestamp) {
   if (timestamp - start_time < blur_iteration) {
      var blur_intensity = (10 / blur_iteration) * (timestamp - start_time);
      var blur_size = (65 / blur_iteration) * (timestamp - start_time);
      $("#amd_overlay").css({ "--blur_intensity": blur_intensity + "px", "--blur_size": blur_size + "%" });
      // debug("Blur increase at " + getSessionDuration());
   }
}


/*** Desaturate - Cataract ***/
// var desaturation_iteration_list = [180, 360, 540]; // Increase blur by 2.5 pixel every 100 seconds
// var desaturation_iteration = desaturation_iteration_list[Math.floor(Math.random() * desaturation_iteration_list.length)];
function startCataract(timestamp) {
   if (timestamp - start_time < desaturation_iteration) {
      var desaturate_intensity = 100 - (((timestamp - start_time) / desaturation_iteration) * 68);
      var contrast_intensity = 100 - (((timestamp - start_time) / desaturation_iteration) * 61);
      if (desaturate_intensity < 0) {
         desaturate_intensity = 0;
      }
      if (contrast_intensity < 0) {
         contrast_intensity = 0;
      }

      $("#cataract_overlay").css({ "--desaturate_intensity": desaturate_intensity + "%", "--contrast_intensity": contrast_intensity + "%" });
      // debug("Saturation decrease at " + getSessionDuration());
   }
}


/*** Organism - Diabetic Retinopathy (DR) ***/
var organism_interval = 3; // run every 3 seconds
// var organism_iteration_list = [3, 6, 9]; // Spawn new cell every 12, 24 or 36 seconds
// var organism_iteration = organism_iteration_list[Math.floor(Math.random() * organism_iteration_list.length)];
var organism_activated = false;
var organism_cleared = false;
var organism_timer;
var organism_cell_count = 0;

var organism_callcounter = organism_iteration;
var organism_spawncounter = organism_interval;
var organism_cell_positions = [
   [25, 30], [70, 65], [50, 15], [35, 70], [50, 65], [10, 20]
]
// initialize organism rendering
function startDR(timestamp) {
   if (!organism_activated) {
      organism_timer = setInterval(toggleOrganism, organism_interval * 1000);
      organism_activated = true;
   }
   if (timestamp - start_time > (organism_iteration * 60) && !organism_cleared) {
      clearInterval(organism_timer);
      organism_cleared = true;
   }
}
// toggle organism function
function toggleOrganism() {
   const organism_overlay = $('#dr_overlay');

   // create new organism cell by slope definition
   if (organism_callcounter % organism_iteration === 0) {
      // debug("Organism spawn at " + getSessionDuration());
      if (organism_cell_count < 6) {
         var pos = organism_cell_positions[organism_cell_count];
      } else {
         var pos = [Math.floor(Math.random() * (95 - 5 + 1)) + 5, Math.floor(Math.random() * (95 - 5 + 1)) + 5];
      }
      // var growRate = Math.floor(Math.random() * (15 - 8 + 1) + 8); // size between 6 and 15 px
      var growRate = 30;
      if (organism_spawncounter % 3 === 0) {
         spawnCell(pos, growRate);
      }
      organism_spawncounter++;
   }
   organism_callcounter++;

   // create new organism cell by probability
   // var spawn_probability = Math.floor(Math.random() * (10 - 1 + 1)) + 1; // probability of 1/10
   // if (spawn_probability == 10) {
   //    var pos = [Math.floor(Math.random() * (90 - 10 + 1) + 10), Math.floor(Math.random() * (90 - 10 + 1) + 10)];
   //    var growRate = Math.floor(Math.random() * (15 - 5 + 1) + 5); // size between 5 and 15 px
   //    spawnCell(pos, growRate);
   // }

   // loop over organism cells and modify them
   // var weight = 0.2;
   var weight = 0.6 * (1 / organism_iteration);
   organism_overlay.children('.organism_cell').each(function () {
      var growRate = $(this).attr('grow_rate');
      $(this).width($(this).width() + growRate * weight * 1.25 * 0.33);
      $(this).height($(this).height() + growRate * weight * 1.5 * 0.33);

      // $(this).animate({ width: $(this).width() + growRate * weight, height: $(this).height() + growRate * weight }, 500);
   });
}
function spawnCell(pos, growRate) {
   const organism_overlay = $('#dr_overlay');
   var new_cell = organism_overlay.append("<div class='organism_cell' grow_rate='" + growRate + "' style='top:" + pos[0] + "%; left:" + pos[1] + "%; transform-origin: center; transform: translate(-50%, -50%) rotate(" + (Math.floor(Math.random() * (360 - 0 + 1) + 0)) + "deg); border-radius:" + getRandPercentage() + "% " + getRandPercentage() + "% " + getRandPercentage() + "% " + getRandPercentage() + "% / " + getRandPercentage() + "% " + getRandPercentage() + "% " + getRandPercentage() + "% " + getRandPercentage() + "%'></div>");
   organism_cell_count++;
}
function getRandPercentage() {
   return Math.floor(Math.random() * (70 - 30 + 1) + 30);
}
function getRandFloat(toplimit) {
   return Math.random() * (toplimit - 1) + 1;
}


/*** Glaucoma ***/
// var glaucoma_iteration_list = [180, 360, 540];
// var glaucoma_iteration = glaucoma_iteration_list[Math.floor(Math.random() * glaucoma_iteration_list.length)];
function startGlaucoma(timestamp) {
   if (timestamp - start_time < glaucoma_iteration) {
      var glaucoma_intensity1 = 100 - (((timestamp - start_time) / glaucoma_iteration) * 53);
      var glaucoma_intensity2 = glaucoma_intensity1 - 10;
      var glaucoma_opacity = (1 / glaucoma_iteration) * (timestamp - start_time) * 10;
      if (glaucoma_intensity1 < 0) {
         glaucoma_intensity1 = 0;
      }
      if (glaucoma_intensity2 < 0) {
         glaucoma_intensity2 = 0;
      }
      if (glaucoma_opacity > 1) {
         glaucoma_opacity = 1;
      }
      $("#glaucoma_overlay").css({ "--glaucoma_opacity": glaucoma_opacity, "--glaucoma_intensity1": glaucoma_intensity1 + "%", "--glaucoma_intensity2": glaucoma_intensity2 + "%" });
   }
}


/*** Alerts (Baseline) ***/
var alerts_interval = 600; // in seconds; 600 = 10 minutes
var alerts_activated = false;
var alerts_timer;
function startAlerts() {
   if (!alerts_activated) {
      togglePauseAlert(0);
      // alerts_timer = setInterval(togglePauseAlert, alerts_interval * 1000);
      togglePauseAlert(1);
      // $('#pause_alert_time').html((alerts_interval / 60) + " minutes");
      $('#pause_alert_time').html((start_time / 60) + " minutes");
      alerts_activated = true;
   }
}
function togglePauseAlert(task) {
   if (task == 0) {

   } else if (task == 1) {
      if ($('#pause_alert').is(":hidden")) {
         $('#pause_alert').css('display', 'flex');
      } else {
         clearInterval(alerts_timer);
         $('#pause_alert').hide();
         alerts_timer = setInterval(togglePauseAlert, alerts_interval * 1000);
      }
      // debug("Alert shown at " + getSessionDuration());
   } else {
      if ($('#pause_alert').is(":hidden")) {
         $('#pause_alert').css('display', 'flex');
      }
   }
}



/*
GETTER METHODS
*/
function getSessionID() {
   return $("input[name=session_id]").attr('value');
}
function getProlificID() {
   return $("input[name=prolificid]").attr('value');
}
function getProc() {
   return $("input[name=proc]").attr('value');
}
function getGroupID() {
   return $("input[name=gid]").attr('value');
}

function getFeedNr() {
   return $("input[name=fnr]").attr('value');
}
function getloadedVideos() {
   return loadedVideos;
}
function getWatchedVideos() {
   return watchedVideos;
}
function getAIarr() {
   var totalArr = []
   for(i=0;i<video_amount;i++) {
      if(ai_pos_arr.includes(i)) {
         totalArr[i] = true
      } else {
         totalArr[i] = false
      }
   }
   return totalArr
}
function getLabels() {
   var totalLArr = []
   for(i=0;i<video_amount;i++) {
      if(aiLabel_arr.includes(i)) {
         totalLArr[i] = true
      } else {
         totalLArr[i] = false
      }
   }
   return totalLArr
}

function getLikedVideos() {
   return likedVideos
}

function getVideoWatchDurations() {
   return videoWatchDurations
}



function getInterventionIteration() {
   if (active_intervention == 0) {
      if (blur_iteration == 180) {
         return 3;
      } else if (blur_iteration == 360) {
         return 6;
      } else if (blur_iteration == 540) {
         return 9;
      } else {
         return blur_iteration;
      }
   } else if (active_intervention == 1) {
      if (desaturation_iteration == 180) {
         return 3;
      } else if (desaturation_iteration == 360) {
         return 6;
      } else if (desaturation_iteration == 540) {
         return 9;
      } else {
         return desaturation_iteration;
      }
   } else if (active_intervention == 2) {
      if (organism_iteration == 3) {
         return 3;
      } else if (organism_iteration == 6) {
         return 6;
      } else if (organism_iteration == 9) {
         return 9;
      } else {
         return organism_iteration;
      }
   } else if (active_intervention == 3) {
      if (glaucoma_iteration == 180) {
         return 3;
      } else if (glaucoma_iteration == 360) {
         return 6;
      } else if (glaucoma_iteration == 540) {
         return 9;
      } else {
         return glaucoma_iteration;
      }
   } else if (active_intervention == 4) {
      return 10;
   }
}



/*
APP NAV MENU
*/
function toggleAppNav() {
   if ($('#app_nav').is(":hidden")) {
      $('#app_nav').show();
   } else {
      $('#app_nav').hide();
   }
}



/*
DEBUG WITH CONSOLE LOGGING
*/
function debug(input) {
   console.log("[DEBUG] " + input);
}