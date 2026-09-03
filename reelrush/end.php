<?php
include './assets/config.php';
include './statements/identify.php';
include './head.php';


//  if (isset($prolificid)) {
//     header('Location: ./app.php?source=pwa');
//  }
// check if called by PWA 
// if (!isset($_GET["source"])) {
//    header("location: ./index.php");
// } else {
//    if ($_GET["source"] !== "pwa") {
//       header("location: ./index.php");
//    }
//}
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
      <h1>Studie Abgeschlossen</h1>
      <p>Sie haben die Studie erfolgreich abgeschlossen. <br>Bitte geben Sie das Gerät den Studienaufsehern zurück.
         <br><strong>Vielen Dank!</strong></p>
      <div class="text-button">
         <p></p>
            <a href="./index.php"><button class="btn btn-primary">Abschließen</button></a>
         </div>
   </main>

</body>

</html>