<?php
include './assets/config.php';
include './head.php';

// check if called by PWA 
if (!isset($_GET["source"])) {
   header("location: ./index.php");
} else {
   if ($_GET["source"] !== "pwa") {
      header("location: ./index.php");
   }
}
?>


<body id="page">
   <header>
      <input type="text" class="hidden" name="redirect_to_register" id="redirect_to_register" value="false">
      <input type="text" class="hidden" name="redirect_to_app" id="redirect_to_app" value="false">
   </header>

   <main>
      <h1>You have to grant permission for notifications.</h1>
      <p>It is possible that you denied the permission for notifications or your phone denied it
         automatically.<br><br>
      </p>
      <p>Please allow notifications for this app (in your phone's settings) or you can not participate on the
         study.<br><br></p>
      <h2>After allowing notifications, close and reopen this app.</h2>
   </main>

   <footer>
      <a href="./imprint.php?source=pwa">Imprint</a>
      |
      <a href="./notice.php?source=pwa">Notice</a>
   </footer>
</body>

</html>