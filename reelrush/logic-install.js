

$(document).ready(function () {
   /*
   OS RECOGNITION
   */
   var is_iOS = /iphone|ipad|ipod/.test(window.navigator.userAgent.toLowerCase());

   if (is_iOS) {
      $("#install-prompting").html("");
      $("#install-prompting").append("<p>To participate on the study, please install our web-app on your iPhone.</p>");
      $("#install-prompting").append('<table><tr><td><p>1.</p></td><td><p>Tap on the icon <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><title>share-outline</title><g fill="currentColor"><path d="M336 192h40a40 40 0 0 1 40 40v192a40 40 0 0 1-40 40H136a40 40 0 0 1-40-40V232a40 40 0 0 1 40-40h40" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="32"></path><path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="32" d="M336 128l-80-80-80 80"></path><path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="32" d="M256 321V48"></path></g></svg> at the bottom of your screen.</p></td></tr><tr><td><p>2.</p></td><td><p>Then press "<span>Add to Home Screen</span>".</p></td></tr><tr><td><p>3.</p></td><td><p>Open the app on your phone.</p></td></tr></tr></table>');
   }
});

/*
DEBUG WITH CONSOLE LOGGING
*/
function debug(input) {
   console.log("[DEBUG] " + input);
}