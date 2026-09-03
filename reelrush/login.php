<?php
include './assets/config.php';
include './head.php';
include './statements/identify.php';

if (isset($prolificid)) {
   header('Location: ./app?source=pwa');
}
// check if called by PWA 
if (!isset($_GET["source"])) {
   header("location: ./index.php");
} else {
   if ($_GET["source"] !== "pwa") {
      header("location: ./index.php");
   }
}
?>


<body id="login">
   <header>
      <input type="text" class="hidden" name="prolificid"
         value="<?php echo (isset($prolificid) ? $prolificid : ""); ?>">
      <input type="text" class="hidden" name="startdate" value="<?php echo (isset($startdate) ? $startdate : ""); ?>">
      <input type="text" class="hidden" name="redirect_to_register" id="redirect_to_register" value="false">
      <input type="text" class="hidden" name="redirect_to_app" id="redirect_to_app" value="true">
   </header>

   <?php if (!isset($prolificid)) { ?>
   <div id="entry_overlay">
      <div class="loading_animation"></div>
      <p>Verifying Identity</p>
   </div>
   <?php } ?>

   <main>
      <h1>Login</h1>
      <form method="POST" action="./statements/login_user.php" id="form_registration">
         <div class="collection">
            <div class="form-row">
               <label for="prolificid">ProlificID</label>
               <input type="text" name="prolificid" id="prolificid" required>
            </div>
            <div class="form-row hidden">
               <input type="text" name="fp_id" id="fp_id" value="">
            </div>
            <div class="frame nospace">
               <div class="icon-text">
                  <div class="icon">
                     <!-- bootstrap icon: person-fill-lock -->
                     <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16">
                        <g fill="currentColor" class="nc-icon-wrapper">
                           <path
                              d="M11 5a3 3 0 1 1-6 0 3 3 0 0 1 6 0zm-9 8c0 1 1 1 1 1h5v-1a1.9 1.9 0 0 1 .01-.2 4.49 4.49 0 0 1 1.534-3.693C9.077 9.038 8.564 9 8 9c-5 0-6 3-6 4zm7 0a1 1 0 0 1 1-1v-1a2 2 0 1 1 4 0v1a1 1 0 0 1 1 1v2a1 1 0 0 1-1 1h-4a1 1 0 0 1-1-1v-2zm3-3a1 1 0 0 0-1 1v1h2v-1a1 1 0 0 0-1-1z">
                           </path>
                        </g>
                     </svg>
                  </div>
                  <div class="content">
                     <h4>Your user account</h4>
                     <p class="small">If you're already registered, you can login with your ProlificID to continue using
                        the app.
                     </p>
                  </div>
               </div>
            </div>
            <button class="btn btn-primary" type="submit">Login</button>
         </div>
      </form>
      <div class="text-button" style="margin-top:20px">
         <p>You didn't register with your <span class="prolific">ProlificID</span> yet?</p>
         <a href="./register.php?source=pwa"><button class="btn btn-secondary noselect">Register</button></a>
      </div>
   </main>

   <footer>
      <a href="./imprint.php?source=pwa">Imprint</a>
      |
      <a href="./notice.php?source=pwa">Notice</a>
   </footer>
</body>

</html>