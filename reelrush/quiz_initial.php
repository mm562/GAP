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
   <script src="logic.js?v=4.13"></script>
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
   <h1>Bitte füllen Sie das Formular aus</h1>
   </header>
   

      <form id="survey-form" method="POST" action="statements/insert_session_data.php" id="form_initial">
         <fieldset class="fieldset">
            <input type="text" class="hidden" name="prolificid" id="prolificid"
               value="<?php echo (isset($prolificid) ? $prolificid : ""); ?>">
            <input type="text" class="hidden" name="groupid" id="groupid"
               value="<?php echo (isset($groupid) ? $groupid : ""); ?>">
            <input type="text" class="hidden" name="feedid" id="feedid"
               value="initial">

            <div class="sub-group">
               <label  class="left"for="number">Alter</label>
               <input type="number" name="Alter" placeholder="Alter" min="1" max="100" class="right input-field" id="age" required  oninvalid="setCustomValidity('Bitte geben Sie eine Antwort ein')">
            </div>
            </fieldset>

         <fieldset class="fieldset">
            <div class="sub-group">
               <label class="left">Geschlecht</label>

               <ul style="list-style: none" class="right">
                  <li class="radio"><label><input name="gender" value="W" type="radio" required  oninvalid="setCustomValidity('Bitte wählen Sie eine Antwort aus')"> Weiblich</label></li>
                  <li class="radio"><label><input name="gender" value="M" type="radio"> Männlich</label></li>
                  <li class="radio"><label><input name="gender" value="D" type="radio"> Divers</label></li>
               </ul>
            </div>
         </fieldset>
         <label>Die folgenden Aussagen beziehen sich darauf, wie Menschen ihre Mediennutzung empfinden. Bitte geben Sie an, wie oft Sie in den letzten 7 Tagen so empfunden haben.</label>
               
         <fieldset class="fieldset">
            <div class="sub-group">
               <label>1. Für meine Freunde ist es wichtig, dass ich ständig online erreichbar bin.</label>
               <ul style="list-style: none; display: inherit;" class="right">
                  <li class="radio"><label><input name="f1" value="1" type="radio" required  oninvalid="setCustomValidity('Bitte wählen Sie eine Antwort aus')"> Nie</label></li>
                  <li class="radio"><label><input name="f1" value="2" type="radio"> Selten</label></li>
                  <li class="radio"><label><input name="f1" value="3" type="radio"> Manchmal</label></li>
                  <li class="radio"><label><input name="f1" value="4" type="radio"> Oft</label></li>
                  <li class="radio"><label><input name="f1" value="5" type="radio"> Immer</label></li>
               </ul>
            </div>
         </fieldset>      
         <fieldset class="fieldset">
            <div class="sub-group">
               <label>2. Die meisten meiner Freunde finden es gut, dass ich ständig online erreichbar bin.</label>
               <ul style="list-style: none; display: inherit;" class="right">
                  <li class="radio"><label><input name="f2" value="1" type="radio" required  oninvalid="setCustomValidity('Bitte wählen Sie eine Antwort aus')"> Nie</label></li>
                  <li class="radio"><label><input name="f2" value="2" type="radio"> Selten</label></li>
                  <li class="radio"><label><input name="f2" value="3" type="radio"> Manchmal</label></li>
                  <li class="radio"><label><input name="f2" value="4" type="radio"> Oft</label></li>
                  <li class="radio"><label><input name="f2" value="5" type="radio"> Immer</label></li>
               </ul>
            </div>
         </fieldset>      
         <fieldset class="fieldset">
            <div class="sub-group">
               <label>3. Ich bin nervös, wie die Leute auf meine Beiträge und Fotos reagieren werden.</label>
               <ul style="list-style: none; display: inherit;" class="right">
                  <li class="radio"><label><input name="f3" value="1" type="radio" required  oninvalid="setCustomValidity('Bitte wählen Sie eine Antwort aus')"> Nie</label></li>
                  <li class="radio"><label><input name="f3" value="2" type="radio"> Selten</label></li>
                  <li class="radio"><label><input name="f3" value="3" type="radio"> Manchmal</label></li>
                  <li class="radio"><label><input name="f3" value="4" type="radio"> Oft</label></li>
                  <li class="radio"><label><input name="f3" value="5" type="radio"> Immer</label></li>
               </ul>
            </div>
         </fieldset>      
         <fieldset class="fieldset">
            <div class="sub-group">
               <label>4. Ich bin nervös, wie andere reagieren werden, wenn ich neue Beiträge in den sozialen Medien veröffentliche.</label>
               <ul style="list-style: none; display: inherit;" class="right">
                  <li class="radio"><label><input name="f4" value="1" type="radio" required  oninvalid="setCustomValidity('Bitte wählen Sie eine Antwort aus')"> Nie</label></li>
                  <li class="radio"><label><input name="f4" value="2" type="radio"> Selten</label></li>
                  <li class="radio"><label><input name="f4" value="3" type="radio"> Manchmal</label></li>
                  <li class="radio"><label><input name="f4" value="4" type="radio"> Oft</label></li>
                  <li class="radio"><label><input name="f4" value="5" type="radio"> Immer</label></li>
               </ul>
            </div>
         </fieldset>      
         <fieldset class="fieldset">
            <div class="sub-group">
               <label>5. Ich fürchte, meine Freunde machen mehr erfüllende Erfahrungen als ich.</label>
               <ul style="list-style: none; display: inherit;" class="right">
                  <li class="radio"><label><input name="f5" value="1" type="radio" required  oninvalid="setCustomValidity('Bitte wählen Sie eine Antwort aus')"> Nie</label></li>
                  <li class="radio"><label><input name="f5" value="2" type="radio"> Selten</label></li>
                  <li class="radio"><label><input name="f5" value="3" type="radio"> Manchmal</label></li>
                  <li class="radio"><label><input name="f5" value="4" type="radio"> Oft</label></li>
                  <li class="radio"><label><input name="f5" value="5" type="radio"> Immer</label></li>
               </ul>
            </div>
         </fieldset>      
         <fieldset class="fieldset">
            <div class="sub-group">
               <label>6. Ich fürchte, dass andere bereicherndere Erfahrungen machen als ich.</label>
               <ul style="list-style: none; display: inherit;" class="right">
                  <li class="radio"><label><input name="f6" value="1" type="radio" required  oninvalid="setCustomValidity('Bitte wählen Sie eine Antwort aus')"> Nie</label></li>
                  <li class="radio"><label><input name="f6" value="2" type="radio"> Selten</label></li>
                  <li class="radio"><label><input name="f6" value="3" type="radio"> Manchmal</label></li>
                  <li class="radio"><label><input name="f6" value="4" type="radio"> Oft</label></li>
                  <li class="radio"><label><input name="f6" value="5" type="radio"> Immer</label></li>
               </ul>
            </div>    
         <fieldset class="fieldset">
            <div class="sub-group">
               <label>7. Ich fühle mich von der Flut an Nachrichten und Benachrichtigungen auf meinem Handy überfordert.</label>
               <ul style="list-style: none; display: inherit;" class="right">
                  <li class="radio"><label><input name="f7" value="1" type="radio" required  oninvalid="setCustomValidity('Bitte wählen Sie eine Antwort aus')"> Nie</label></li>
                  <li class="radio"><label><input name="f7" value="2" type="radio"> Selten</label></li>
                  <li class="radio"><label><input name="f7" value="3" type="radio"> Manchmal</label></li>
                  <li class="radio"><label><input name="f7" value="4" type="radio"> Oft</label></li>
                  <li class="radio"><label><input name="f7" value="5" type="radio"> Immer</label></li>
               </ul>
            </div>
         </fieldset>  
         </fieldset>      
         <fieldset class="fieldset">
            <div class="sub-group">
               <label>8. Ich verbringe zu viel Zeit damit, auf Benachrichtigungen/Nachrichten zu antworten.</label>
               <ul style="list-style: none; display: inherit;" class="right">
                  <li class="radio"><label><input name="f8" value="1" type="radio" required  oninvalid="setCustomValidity('Bitte wählen Sie eine Antwort aus')"> Nie</label></li>
                  <li class="radio"><label><input name="f8" value="2" type="radio"> Selten</label></li>
                  <li class="radio"><label><input name="f8" value="3" type="radio"> Manchmal</label></li>
                  <li class="radio"><label><input name="f8" value="4" type="radio"> Oft</label></li>
                  <li class="radio"><label><input name="f8" value="5" type="radio"> Immer</label></li>
               </ul>
            </div>
         </fieldset>      
         <fieldset class="fieldset">
            <div class="sub-group">
               <label>9. Ohne mein Handy fühle ich mich verloren oder „nackt“.</label>
               <ul style="list-style: none; display: inherit;" class="right">
                  <li class="radio"><label><input name="f9" value="1" type="radio" required  oninvalid="setCustomValidity('Bitte wählen Sie eine Antwort aus')"> Nie</label></li>
                  <li class="radio"><label><input name="f9" value="2" type="radio"> Selten</label></li>
                  <li class="radio"><label><input name="f9" value="3" type="radio"> Manchmal</label></li>
                  <li class="radio"><label><input name="f9" value="4" type="radio"> Oft</label></li>
                  <li class="radio"><label><input name="f9" value="5" type="radio"> Immer</label></li>
               </ul>
            </div>
         </fieldset>      
         <fieldset class="fieldset">
            <div class="sub-group">
               <label>10. Ich fühle mich sozial abgeschnitten, wenn ich mein Handy nicht dabei habe.</label>
               <ul style="list-style: none; display: inherit;" class="right">
                  <li class="radio"><label><input name="f10" value="1" type="radio" required  oninvalid="setCustomValidity('Bitte wählen Sie eine Antwort aus')"> Nie</label></li>
                  <li class="radio"><label><input name="f10" value="2" type="radio"> Selten</label></li>
                  <li class="radio"><label><input name="f10" value="3" type="radio"> Manchmal</label></li>
                  <li class="radio"><label><input name="f10" value="4" type="radio"> Oft</label></li>
                  <li class="radio"><label><input name="f10" value="5" type="radio"> Immer</label></li>
               </ul>
            </div>
         </fieldset>
         <button id="submit" type="submit">Weiter</button>
      </form>
</body>
</main>
</html>
