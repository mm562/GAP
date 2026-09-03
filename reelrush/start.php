<?php
include './assets/config.php';
include './head.php';
include './statements/identify.php';

// if (isset($prolificid)) {
//    header('Location: ./app.php?source=pwa');
// }
// // check if called by PWA 
// if (!isset($_GET["source"])) {
//    header("location: ./index.php");
// } else {
//    if ($_GET["source"] !== "pwa") {
//       header("location: ./index.php");
//    }
// }
?>


<body id="page">
   <header>
      <input type="text" class="hidden" name="prolificid"
         value="<?php echo (isset($prolificid) ? $prolificid : ""); ?>">
         <input type="text" class="hidden" name="gid"
         value="<?php echo (isset($groupid) ? $groupid : ""); ?>">
         <input type="text" class="hidden" name="fnr"
         value="<?php echo (isset($feednr) ? $feednr : ""); ?>">
      <input type="text" class="hidden" name="startdate" value="<?php echo (isset($startdate) ? $startdate : ""); ?>">
      <input type="text" class="hidden" name="redirect_to_register" id="redirect_to_register" value="false">
      <input type="text" class="hidden" name="redirect_to_app" id="redirect_to_app" value="true">
   </header>

   <main>
      <h1>Welcome to the study!</h1>
      <p>By taking part in this study, you will be supporting research into the use of apps such as TikTok, Instagram
         and YouTube.<br>Therefore, <strong>thank you</strong> in advance! 👏🏻</p>
      <div class="frame">
         <h2>Procedure</h2>
         <div class="steps">
            <div class="step">
               <div class="number-wrapper">
                  <div class="number">
                     1
                  </div>
               </div>
               <div class="number-line"></div>
               <div class="content">
                  <h3>Register</h3>
                  <p class="small">Register with your <span class="prolific">ProlificID</span> so that we can consider
                     individual parameters and rewards.</p>
               </div>
            </div>
            <div class="step">
               <div class="number-wrapper">
                  <div class="number">
                     2
                  </div>
               </div>
               <div class="number-line"></div>
               <div class="content">
                  <h3>Use the application</h3>
                  <p class="small">Use the browser-based application at least <strong>1-3 times per day</strong> for a
                     period of <strong>7 days</strong>.</p>
               </div>
            </div>
            <div class="step">
               <div class="number-wrapper">
                  <div class="number">
                     3
                  </div>
               </div>
               <div class="content">
                  <h3>Answer questions</h3>
                  <p class="small">Answer randomly played questions from time to time to make important insights
                     detectable. </p>
               </div>
            </div>
         </div>
      </div>

      <div class="collection">
         <div class="text-button">
            <p>Information about data protection and the responsible persons can be found <a
                  href="./notice.php?source=pwa">here</a>.
            </p>
            <a href="./register.php?source=pwa"><button class="btn btn-primary noselect">Participate now</button></a>
         </div>
         <div class="text-button">
            <p>You're not here for the first time and did already participate on the study?</p>
            <a href="./login.php?source=pwa"><button class="btn btn-secondary noselect">Login</button></a>
         </div>
      </div>
   </main>

   <footer>
      <a href="./imprint.php?source=pwa">Imprint</a>
      |
      <a href="./notice.php?source=pwa">Notice</a>
   </footer>
</body>

</html>