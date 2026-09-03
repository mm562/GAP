<?php
include './assets/config.php';
include './head.php';
include './statements/identify.php';

//check if called by PWA 
if (!isset($_GET["source"])) {
   header("location: ./install");
} else {
   if ($_GET["source"] !== "pwa") {
      header("location: ./install");
   }
}
?>


<body id="overview">
   <header>
      <input type="text" class="hidden" name="prolificid"
         value="<?php echo (isset($prolificid) ? $prolificid : ""); ?>">
      <input type="text" class="hidden" name="startdate" value="<?php echo (isset($startdate) ? $startdate : ""); ?>">
      <input type="text" class="hidden" name="redirect_to_register" id="redirect_to_register" value="true">
      <input type="text" class="hidden" name="redirect_to_app" id="redirect_to_app" value="false">
   </header>

   <?php if (!isset($prolificid)) { ?>
   <div id="entry_overlay">
      <div class="loading_animation"></div>
      <p>Verifying Identity</p>
   </div>
   <?php } ?>

   <main>
      <h1>Your participation</h1>
      <table>
         <tr>
            <td>ProlificID</td>
            <td id="show_prolificid"><?php echo (isset($prolificid) ? $prolificid : ""); ?></td>
         </tr>
         <tr>
            <td>Participating since</td>
            <td id="show_duration">
               <?php 
               if (isset($startdate)) {
                  $d1 = new DateTime($startdate);
                  $d1->setTime(12, 0, 0);
                  $d2 = new DateTime("now");
                  $d2->setTime(12, 0, 0);
                  $diff = $d1->diff($d2);
                  if ($diff->format('%a') == 1) {
                     echo $diff->format('%a day');
                  } else {
                     echo $diff->format('%a days');
                  }
               } 
               ?>
            </td>
         </tr>
      </table>
      <div class="frame">
         <div class="steps highlines">
            <div class="icon-text">
               <div class="icon">
                  <!-- ionicons icon: apps -->
                  <svg xmlns="http://www.w3.org/2000/svg" width="512" height="512" viewBox="0 0 512 512">
                     <g class="nc-icon-wrapper" fill="currentColor">
                        <path d="M104 160a56 56 0 1 1 56-56 56.06 56.06 0 0 1-56 56z"></path>
                        <path d="M256 160a56 56 0 1 1 56-56 56.06 56.06 0 0 1-56 56z"></path>
                        <path d="M408 160a56 56 0 1 1 56-56 56.06 56.06 0 0 1-56 56z"></path>
                        <path d="M104 312a56 56 0 1 1 56-56 56.06 56.06 0 0 1-56 56z"></path>
                        <path d="M256 312a56 56 0 1 1 56-56 56.06 56.06 0 0 1-56 56z"></path>
                        <path d="M408 312a56 56 0 1 1 56-56 56.06 56.06 0 0 1-56 56z"></path>
                        <path d="M104 464a56 56 0 1 1 56-56 56.06 56.06 0 0 1-56 56z"></path>
                        <path d="M256 464a56 56 0 1 1 56-56 56.06 56.06 0 0 1-56 56z"></path>
                        <path d="M408 464a56 56 0 1 1 56-56 56.06 56.06 0 0 1-56 56z"></path>
                     </g>
                  </svg>
               </div>
               <div class="content">
                  <h4>You use the browser-based application at least <strong>1-3 times per day</strong> for the
                     duration of this study.</h4>
               </div>
            </div>
            <div class="icon-text">
               <div class="icon">
                  <!-- ionicons icon: calendar -->
                  <svg xmlns="http://www.w3.org/2000/svg" width="512" height="512" viewBox="0 0 512 512">
                     <g class="nc-icon-wrapper" fill="currentColor">
                        <path
                           d="M480 128a64 64 0 0 0-64-64h-16V48.45c0-8.61-6.62-16-15.23-16.43A16 16 0 0 0 368 48v16H144V48.45c0-8.61-6.62-16-15.23-16.43A16 16 0 0 0 112 48v16H96a64 64 0 0 0-64 64v12a4 4 0 0 0 4 4h440a4 4 0 0 0 4-4z">
                        </path>
                        <path
                           d="M32 416a64 64 0 0 0 64 64h320a64 64 0 0 0 64-64V179a3 3 0 0 0-3-3H35a3 3 0 0 0-3 3zm344-208a24 24 0 1 1-24 24 24 24 0 0 1 24-24zm0 80a24 24 0 1 1-24 24 24 24 0 0 1 24-24zm-80-80a24 24 0 1 1-24 24 24 24 0 0 1 24-24zm0 80a24 24 0 1 1-24 24 24 24 0 0 1 24-24zm0 80a24 24 0 1 1-24 24 24 24 0 0 1 24-24zm-80-80a24 24 0 1 1-24 24 24 24 0 0 1 24-24zm0 80a24 24 0 1 1-24 24 24 24 0 0 1 24-24zm-80-80a24 24 0 1 1-24 24 24 24 0 0 1 24-24zm0 80a24 24 0 1 1-24 24 24 24 0 0 1 24-24z">
                        </path>
                     </g>
                  </svg>
               </div>
               <div class="content">
                  <h4>Duration of study about 7 days</h4>
                  <p class="small">You will be informed when the participation is finished.</p>
               </div>
            </div>
            <div class="icon-text">
               <div class="icon">
                  <!-- ionicons icon: warning -->
                  <svg xmlns="http://www.w3.org/2000/svg" width="512" height="512" viewBox="0 0 512 512">
                     <g class="nc-icon-wrapper" fill="currentColor">
                        <path
                           d="M449.07 399.08L278.64 82.58c-12.08-22.44-44.26-22.44-56.35 0L51.87 399.08A32 32 0 0 0 80 446.25h340.89a32 32 0 0 0 28.18-47.17zm-198.6-1.83a20 20 0 1 1 20-20 20 20 0 0 1-20 20zm21.72-201.15l-5.74 122a16 16 0 0 1-32 0l-5.74-121.95a21.73 21.73 0 0 1 21.5-22.69h.21a21.74 21.74 0 0 1 21.73 22.7z">
                        </path>
                     </g>
                  </svg>
               </div>
               <div class="content">
                  <h4>Please hold on 🙏🏻</h4>
                  <p class="small">Please don't drop out of the study - your participation is an important contribution
                     to
                     research!</p>
               </div>
            </div>
         </div>
      </div>
      <a href="./app?source=pwa">
         <button class="btn btn-primary">Back to app</button>
      </a>
   </main>

   <footer>
      <a href="./imprint?source=pwa">Imprint</a>
      |
      <a href="./notice?source=pwa">Notice</a>
   </footer>
</body>

</html>