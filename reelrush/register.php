<?php
include './assets/config.php';
include './statements/identify.php';
include './head.php';


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


<body id="register">
   <header>
      <input type="text" class="hidden" name="prolificid"
         value="<?php echo (isset($prolificid) ? $prolificid : ""); ?>">
         <input type="text" class="hidden" name="gid"
         value="<?php echo (isset($groupid) ? $groupid : ""); ?>">
         <input type="text" class="hidden" name="prolificid"
         value="<?php echo (isset($feednr) ? $feednr : ""); ?>">
      <input type="text" class="hidden" name="startdate" value="<?php echo (isset($startdate) ? $startdate : ""); ?>">
         <input type="text" class="hidden" name="proc"
         value="<?php echo (isset($proc) ? $proc : ""); ?>">
         <input type="text" class="hidden" name="lab"
         value="<?php echo (isset($lab) ? $lab : ""); ?>">
      <input type="text" class="hidden" name="redirect_to_register" id="redirect_to_register" value="false">
      <input type="text" class="hidden" name="redirect_to_app" id="redirect_to_app" value="true">
   </header>

   <!-- <?php if (!isset($prolificid)) { ?>
   <div id="entry_overlay">
      <div class="loading_animation"></div>
      <p>Verifying Identity</p>
   </div>
   <?php } ?> -->

   <main>
      <h1>Register for participation</h1>
      <form method="POST" action="./statements/insert_user.php" id="form_registration">
         <div class="collection">
            <div class="form-row">
               <label for="prolificid">UserID</label>
               <input type="text" name="prolificid" id="prolificid" required>
            </div>

            <div class="form-row hidden">
               <input type="text" name="fp_id" id="fp_id" value="">
            </div>
            <div class="frame nospace">
               <div class="icon-text">
                  
               </div>
            </div>
            <div class="form-row-h">

      <input type="text" class="hidden" name="pe" value="">
      <input type="text" class="hidden" name="la" value="">
               <label class="left" for="group">Group?</label>

                  <select class="right dropdown" id="dropdown" name="dropdown" required>
                     <option value="none">Select an option</option>
                     <option value="Group1">Group 1</option>
                     <option value="Group2">Group 2</option>
                     <option value="Group3">Group 3</option>
                     <option value="Group4">Group 4</option>
                     <option value="Group5">Group 5</option>
                     <option value="Group6">Group 6</option>
                     <option value="Group7">Group 7</option>
                     <option value="Group8">Group 8</option>
                     <option value="Group9">Group 9</option>
                     <option value="Group10">Group 10</option>
                  </select>
            </div>
            <button class="btn btn-primary" type="submit">Register & Participate</button>
         </div>
      </form>
   </main>

   <footer>
      <a href="./imprint.php?source=pwa">Imprint</a>
      |
      <a href="./notice.php?source=pwa">Notice</a>
   </footer>
</body>

</html>