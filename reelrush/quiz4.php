<?php
include './assets/config.php';
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

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
   <link rel="icon" type="image/png" href="./assets/img/favicon.png">

   <link rel="manifest" href="./manifest.json" crossorigin="use-credentials">
   <meta name="apple-mobile-web-app-status-bar" content="#000000" />
   <meta name="theme-color" content="#000000" />
   <title><?=$config_title?></title>

   <link rel="stylesheet" href="quiz-style.css?v=4.13" rel=preload>
   <script src="./assets/scripts/fingerprintjs.min.js"></script>
   <script src="./assets/scripts/jquery-3.7.0.min.js"></script>
   <script src="logic.js"></script>
</head>
<main>
<body>
   <header>
   <input type="text" class="hidden" name="prolificid"
         value="<?php echo (isset($prolificid) ? $prolificid : ""); ?>">
      <input type="text" class="hidden" name="gid"
         value="<?php echo (isset($groupid) ? $groupid : ""); ?>">
      <input type="text" class="hidden" name="prolificid"
         value="<?php echo (isset($feednr) ? $feednr : ""); ?>">
         <input type="text" class="hidden" name="proc"
         value="<?php echo (isset($proc) ? $proc : ""); ?>">
         <input type="text" class="hidden" name="lab"
         value="<?php echo (isset($lab) ? $lab : ""); ?>">
   <input type="text" class="hidden" name="startdate" value="<?php echo (isset($startdate) ? $startdate : ""); ?>">
   <input type="text" class="hidden" name="redirect_to_register" id="redirect_to_register" value="false">
   <input type="text" class="hidden" name="redirect_to_app" id="redirect_to_app" value="true">
   <h1>Bitte beantworten Sie die folgenden Fragen</h1>
   </header>
   

      <form id="survey-form" method="POST" action="statements/insert_session_data.php" id="form_initial">
            <input type="text" class="hidden" name="prolificid" id="prolificid"
               value="<?php echo (isset($prolificid) ? $prolificid : ""); ?>">
            <input type="text" class="hidden" name="groupid" id="groupid"
               value="<?php echo (isset($groupid) ? $groupid : ""); ?>">
            <input type="text" class="hidden" name="feednr" id="feednr"
               value="<?php echo (isset($feednr) ? $feednr : ""); ?>">
            <input type="text" class="hidden" name="feedid" id="feedid"
               value= "MFI<?php echo (isset($feednr) ? $feednr : ""); ?>">
         <input type="text" class="hidden" name="proc" id="proc"
         value="<?php echo (isset($proc) ? $proc : ""); ?>">
         <input type="text" class="hidden" name="lab" id="lab"
         value="<?php echo (isset($lab) ? $lab : ""); ?>">
               <input type="text" class="hidden" name="feedOrSurvey" id="fos"
               value= "mfi">


         <label>Anhand der folgenden Aussagen möchten wir uns ein Bild davon machen, wie es Ihnen in letzter Zeit ergangen ist. Wenn Sie der Meinung sind, dass eine Aussage vollkommen zutrifft, klicken Sie bitte auf das obere Kästchen. Je mehr Sie der Aussage widersprechen, desto eher sollten Sie das Kästchen in Richtung „Nein, das stimmt nicht“ anklicken.</label>
         <fieldset class="fieldset">
            <div class="sub-group">
               <label>Wenn ich etwas tue, kann ich mich voll und ganz darauf konzentrieren.</label>
               <ul style="list-style: none; display: inherit; height:5px; width: 50vw" >
                  <li class="radio"><input name="f1" value="1" type="radio" required  oninvalid="setCustomValidity('Bitte wählen Sie eine Antwort aus')"></li>
                  <li class="radio"><input name="f1" value="2" type="radio"></li>
                  <li class="radio"><input name="f1" value="3" type="radio"></li>
                  <li class="radio"><input name="f1" value="4" type="radio"></li>
                  <li class="radio"><input name="f1" value="5" type="radio"></li>
               </ul>
               <label class="niedrig">
                  Ja, das stimmt
               </label>
               <label class="hoch">
                  Nein, das stimmt nicht
               </label>
            </div>
            </fieldset>
         <fieldset class="fieldset">
            <div class="sub-group">
               <label>Ich kann mich gut konzentrieren.</label>
               <ul style="list-style: none; display: inherit; height:5px; width: 50vw" >
                  <li class="radio"><input name="f2" value="1" type="radio" required  oninvalid="setCustomValidity('Bitte wählen Sie eine Antwort aus')"></li>
                  <li class="radio"><input name="f2" value="2" type="radio"></li>
                  <li class="radio"><input name="f2" value="3" type="radio"></li>
                  <li class="radio"><input name="f2" value="4" type="radio"></li>
                  <li class="radio"><input name="f2" value="5" type="radio"></li>
               </ul>
               <label class="niedrig">
                  Ja, das stimmt
               </label>
               <label class="hoch">
                  Nein, das stimmt nicht
               </label>
            </div>
            </fieldset>
         <fieldset class="fieldset">
            <div class="sub-group">
               <label>Es kostet viel Mühe, sich auf Dinge zu konzentrieren.</label>
               <ul style="list-style: none; display: inherit; height:5px; width: 50vw" >
                  <li class="radio"><input name="f3" value="1" type="radio" required  oninvalid="setCustomValidity('Bitte wählen Sie eine Antwort aus')"></li>
                  <li class="radio"><input name="f3" value="2" type="radio"></li>
                  <li class="radio"><input name="f3" value="3" type="radio"></li>
                  <li class="radio"><input name="f3" value="4" type="radio"></li>
                  <li class="radio"><input name="f3" value="5" type="radio"></li>
               </ul>
               <label class="niedrig">
                  Ja, das stimmt
               </label>
               <label class="hoch">
                  Nein, das stimmt nicht
               </label>
            </div>
            </fieldset>
         <fieldset class="fieldset">
            <div class="sub-group">
               <label>Meine Gedanken schweifen leicht ab.</label>
               <ul style="list-style: none; display: inherit; height:5px; width: 50vw" >
                  <li class="radio"><input name="f4" value="1" type="radio" required  oninvalid="setCustomValidity('Bitte wählen Sie eine Antwort aus')"></li>
                  <li class="radio"><input name="f4" value="2" type="radio"></li>
                  <li class="radio"><input name="f4" value="3" type="radio"></li>
                  <li class="radio"><input name="f4" value="4" type="radio"></li>
                  <li class="radio"><input name="f4" value="5" type="radio"></li>
               </ul>
               <label class="niedrig">
                  Ja, das stimmt
               </label>
               <label class="hoch">
                  Nein, das stimmt nicht
               </label>
            </div>
            </fieldset>
            <fieldset>

            <div class="sub-group">
               <label>Wie gestresst fühlen Sie sich in diesem Moment? <br> Ziehen Sie den Punkt auf der Skala auf den Wert, der ihrer Antwort entspricht, wobei 0 dem geringstmöglichen Stress und 100 dem höchstmöglichem Stress entspricht.</label>
               <p>0</p>
               <input name="stress" type="range" min="0" max="100" value="0" class="slider" id="stress" style="width:80%">
               <p>100</p>
               </div> 
               <div style="text-align:center;">
               <p>Wert: <span id="wert"></span></p>
               </div>
               <script>
                  var slider = document.getElementById("stress");

                  var output = document.getElementById("wert");

                  output.innerHTML = slider.value;
                  slider.oninput = function() {
                     output.innerHTML = this.value;
                     debug(this.value)}
                  </script>
            </fieldset>
         <button id="submit" type="submit">Weiter</button>
      </form>
</body>
</main>
</html>