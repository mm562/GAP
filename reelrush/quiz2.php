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
               value= "PANAS<?php echo (isset($feednr) ? $feednr : ""); ?>">
         <input type="text" class="hidden" name="proc" id="proc"
         value="<?php echo (isset($proc) ? $proc : ""); ?>">
         <input type="text" class="hidden" name="lab" id="lab"
         value="<?php echo (isset($lab) ? $lab : ""); ?>">
               <input type="text" class="hidden" name="feedOrSurvey" id="fos"
               value= "panas">


         <label>Nun möchten wir gerne von Ihnen wissen, wie Sie sich fühlen. Die folgenden Wörter beschreiben unterschiedliche Gefühle und Empfindungen. Lesen Sie jedes Wort und tragen Sie dann in die Skala neben jedem Wort die Intensität ein. Sie haben die Möglichkeit, zwischen fünf Abstufungen zu wählen. Geben Sie bitte an, wie Sie sich im Allgemeinen fühlen.</label>
         <fieldset class="fieldset">
            <div class="sub-group">
               <label class="left">1. Aktiv</label>
               <ul style="list-style: none; display: inherit;" class="right">
                  <li class="radio"><label class="small"><input name="f1" value="1" type="radio" required  oninvalid="setCustomValidity('Bitte wählen Sie eine Antwort aus')"><br>Gar nicht</label></li>
                  <li class="radio"><label class="small"><input name="f1" value="2" type="radio"><br>Ein Bisschen</label></li>
                  <li class="radio"><label class="small"><input name="f1" value="3" type="radio"><br>Einiger-<br>maßen</label></li>
                  <li class="radio"><label class="small"><input name="f1" value="4" type="radio"><br>Erheblich</label></li>
                  <li class="radio"><label class="small"><input name="f1" value="5" type="radio"><br>Äußerst</label></li>
               </ul>
            </div>
         </fieldset>  
         <fieldset class="fieldset">
            <div class="sub-group">
               <label class="left">2. Bekümmert</label>
               <ul style="list-style: none; display: inherit;" class="right">
                  <li class="radio"><label class="small"><input name="f2" value="1" type="radio" required  oninvalid="setCustomValidity('Bitte wählen Sie eine Antwort aus')"><br>Gar nicht</label></li>
                  <li class="radio"><label class="small"><input name="f2" value="2" type="radio"> <br>Ein Bisschen</label></li>
                  <li class="radio"><label class="small"><input name="f2" value="3" type="radio"><br>Einiger-<br>maßen</label></li>
                  <li class="radio"><label class="small"><input name="f2" value="4" type="radio"><br>Erheblich</label></li>
                  <li class="radio"><label class="small"><input name="f2" value="5" type="radio"><br>Äußerst</label></li>
               </ul>
            </div>
         </fieldset> 
         <fieldset class="fieldset">
            <div class="sub-group">
               <label class="left">3. Interessiert</label>
               <ul style="list-style: none; display: inherit;" class="right">
                  <li class="radio"><label class="small"><input name="f3" value="1" type="radio" required  oninvalid="setCustomValidity('Bitte wählen Sie eine Antwort aus')"><br>Gar nicht</label></li>
                  <li class="radio"><label class="small"><input name="f3" value="2" type="radio"> <br>Ein Bisschen</label></li>
                  <li class="radio"><label class="small"><input name="f3" value="3" type="radio"><br>Einiger-<br>maßen</label></li>
                  <li class="radio"><label class="small"><input name="f3" value="4" type="radio"><br>Erheblich</label></li>
                  <li class="radio"><label class="small"><input name="f3" value="5" type="radio"><br>Äußerst</label></li>
               </ul>
            </div>
         </fieldset>  
         <fieldset class="fieldset">
            <div class="sub-group">
               <label class="left">4. Freudig erregt</label>
               <ul style="list-style: none; display: inherit;" class="right">
                  <li class="radio"><label class="small"><input name="f4" value="1" type="radio" required  oninvalid="setCustomValidity('Bitte wählen Sie eine Antwort aus')"><br>Gar nicht</label></li>
                  <li class="radio"><label class="small"><input name="f4" value="2" type="radio"> <br>Ein Bisschen</label></li>
                  <li class="radio"><label class="small"><input name="f4" value="3" type="radio"><br>Einiger-<br>maßen</label></li>
                  <li class="radio"><label class="small"><input name="f4" value="4" type="radio"><br>Erheblich</label></li>
                  <li class="radio"><label class="small"><input name="f4" value="5" type="radio"><br>Äußerst</label></li>
               </ul>
            </div>
         </fieldset> 
         <fieldset class="fieldset">
            <div class="sub-group">
               <label class="left">5. Verärgert</label>
               <ul style="list-style: none; display: inherit;" class="right">
                  <li class="radio"><label class="small"><input name="f5" value="1" type="radio" required  oninvalid="setCustomValidity('Bitte wählen Sie eine Antwort aus')"><br>Gar nicht</label></li>
                  <li class="radio"><label class="small"><input name="f5" value="2" type="radio"> <br>Ein Bisschen</label></li>
                  <li class="radio"><label class="small"><input name="f5" value="3" type="radio"><br>Einiger-<br>maßen</label></li>
                  <li class="radio"><label class="small"><input name="f5" value="4" type="radio"><br>Erheblich</label></li>
                  <li class="radio"><label class="small"><input name="f5" value="5" type="radio"><br>Äußerst</label></li>
               </ul>
            </div>
         </fieldset>   
         <fieldset class="fieldset">
            <div class="sub-group">
               <label class="left">6. Stark</label>
               <ul style="list-style: none; display: inherit;" class="right">
                  <li class="radio"><label class="small"><input name="f6" value="1" type="radio" required  oninvalid="setCustomValidity('Bitte wählen Sie eine Antwort aus')"><br>Gar nicht</label></li>
                  <li class="radio"><label class="small"><input name="f6" value="2" type="radio"> <br>Ein Bisschen</label></li>
                  <li class="radio"><label class="small"><input name="f6" value="3" type="radio"><br>Einiger-<br>maßen</label></li>
                  <li class="radio"><label class="small"><input name="f6" value="4" type="radio"><br>Erheblich</label></li>
                  <li class="radio"><label class="small"><input name="f6" value="5" type="radio"><br>Äußerst</label></li>
               </ul>
            </div>
         </fieldset>  
         <fieldset class="fieldset">
            <div class="sub-group">
               <label class="left">7. Schuldig</label>
               <ul style="list-style: none; display: inherit;" class="right">
                  <li class="radio"><label class="small"><input name="f7" value="1" type="radio" required  oninvalid="setCustomValidity('Bitte wählen Sie eine Antwort aus')"><br>Gar nicht</label></li>
                  <li class="radio"><label class="small"><input name="f7" value="2" type="radio"> <br>Ein Bisschen</label></li>
                  <li class="radio"><label class="small"><input name="f7" value="3" type="radio"><br>Einiger-<br>maßen</label></li>
                  <li class="radio"><label class="small"><input name="f7" value="4" type="radio"><br>Erheblich</label></li>
                  <li class="radio"><label class="small"><input name="f7" value="5" type="radio"><br>Äußerst</label></li>
               </ul>
            </div>
         </fieldset> 
         <fieldset class="fieldset">
            <div class="sub-group">
               <label class="left">8. Erschrocken</label>
               <ul style="list-style: none; display: inherit;" class="right">
                  <li class="radio"><label class="small"><input name="f8" value="1" type="radio" required  oninvalid="setCustomValidity('Bitte wählen Sie eine Antwort aus')"><br>Gar nicht</label></li>
                  <li class="radio"><label class="small"><input name="f8" value="2" type="radio"> <br>Ein Bisschen</label></li>
                  <li class="radio"><label class="small"><input name="f8" value="3" type="radio"><br>Einiger-<br>maßen</label></li>
                  <li class="radio"><label class="small"><input name="f8" value="4" type="radio"><br>Erheblich</label></li>
                  <li class="radio"><label class="small"><input name="f8" value="5" type="radio"><br>Äußerst</label></li>
               </ul>
            </div>
         </fieldset> 
         <fieldset class="fieldset">
            <div class="sub-group">
               <label class="left">9. Feindselig</label>
               <ul style="list-style: none; display: inherit;" class="right">
                  <li class="radio"><label class="small"><input name="f9" value="1" type="radio" required  oninvalid="setCustomValidity('Bitte wählen Sie eine Antwort aus')"><br>Gar nicht</label></li>
                  <li class="radio"><label class="small"><input name="f9" value="2" type="radio"> <br>Ein Bisschen</label></li>
                  <li class="radio"><label class="small"><input name="f9" value="3" type="radio"><br>Einiger-<br>maßen</label></li>
                  <li class="radio"><label class="small"><input name="f9" value="4" type="radio"><br>Erheblich</label></li>
                  <li class="radio"><label class="small"><input name="f9" value="5" type="radio"><br>Äußerst</label></li>
               </ul>
            </div>
         </fieldset> 
         <fieldset class="fieldset">
            <div class="sub-group">
               <label class="left">10. Angeregt</label>
               <ul style="list-style: none; display: inherit;" class="right">
                  <li class="radio"><label class="small"><input name="f10" value="1" type="radio" required  oninvalid="setCustomValidity('Bitte wählen Sie eine Antwort aus')"><br>Gar nicht</label></li>
                  <li class="radio"><label class="small"><input name="f10" value="2" type="radio"> <br>Ein Bisschen</label></li>
                  <li class="radio"><label class="small"><input name="f10" value="3" type="radio"><br>Einiger-<br>maßen</label></li>
                  <li class="radio"><label class="small"><input name="f10" value="4" type="radio"><br>Erheblich</label></li>
                  <li class="radio"><label class="small"><input name="f10" value="5" type="radio"><br>Äußerst</label></li>
               </ul>
            </div>
         </fieldset> 
         <fieldset class="fieldset">
            <div class="sub-group">
               <label class="left">11. Stolz</label>
               <ul style="list-style: none; display: inherit;" class="right">
                  <li class="radio"><label class="small"><input name="f11" value="1" type="radio" required  oninvalid="setCustomValidity('Bitte wählen Sie eine Antwort aus')"><br>Gar nicht</label></li>
                  <li class="radio"><label class="small"><input name="f11" value="2" type="radio"> <br>Ein Bisschen</label></li>
                  <li class="radio"><label class="small"><input name="f11" value="3" type="radio"><br>Einiger-<br>maßen</label></li>
                  <li class="radio"><label class="small"><input name="f11" value="4" type="radio"><br>Erheblich</label></li>
                  <li class="radio"><label class="small"><input name="f11" value="5" type="radio"><br>Äußerst</label></li>
               </ul>
            </div>
         </fieldset> 
         <fieldset class="fieldset">
            <div class="sub-group">
               <label class="left">12. Gereizt</label>
               <ul style="list-style: none; display: inherit;" class="right">
                  <li class="radio"><label class="small"><input name="f12" value="1" type="radio" required  oninvalid="setCustomValidity('Bitte wählen Sie eine Antwort aus')"><br>Gar nicht</label></li>
                  <li class="radio"><label class="small"><input name="f12" value="2" type="radio"> <br>Ein Bisschen</label></li>
                  <li class="radio"><label class="small"><input name="f12" value="3" type="radio"><br>Einiger-<br>maßen</label></li>
                  <li class="radio"><label class="small"><input name="f12" value="4" type="radio"><br>Erheblich</label></li>
                  <li class="radio"><label class="small"><input name="f12" value="5" type="radio"><br>Äußerst</label></li>
               </ul>
            </div>
         </fieldset> 
         <fieldset class="fieldset">
            <div class="sub-group">
               <label class="left">13. Begeistert</label>
               <ul style="list-style: none; display: inherit;" class="right">
                  <li class="radio"><label class="small"><input name="f13" value="1" type="radio" required  oninvalid="setCustomValidity('Bitte wählen Sie eine Antwort aus')"><br>Gar nicht</label></li>
                  <li class="radio"><label class="small"><input name="f13" value="2" type="radio"> <br>Ein Bisschen</label></li>
                  <li class="radio"><label class="small"><input name="f13" value="3" type="radio"><br>Einiger-<br>maßen</label></li>
                  <li class="radio"><label class="small"><input name="f13" value="4" type="radio"><br>Erheblich</label></li>
                  <li class="radio"><label class="small"><input name="f13" value="5" type="radio"><br>Äußerst</label></li>
               </ul>
            </div>
         </fieldset> 
         <fieldset class="fieldset">
            <div class="sub-group">
               <label class="left">14. Beschämt</label>
               <ul style="list-style: none; display: inherit;" class="right">
                  <li class="radio"><label class="small"><input name="f14" value="1" type="radio" required  oninvalid="setCustomValidity('Bitte wählen Sie eine Antwort aus')"><br>Gar nicht</label></li>
                  <li class="radio"><label class="small"><input name="f14" value="2" type="radio"> <br>Ein Bisschen</label></li>
                  <li class="radio"><label class="small"><input name="f14" value="3" type="radio"><br>Einiger-<br>maßen</label></li>
                  <li class="radio"><label class="small"><input name="f14" value="4" type="radio"><br>Erheblich</label></li>
                  <li class="radio"><label class="small"><input name="f14" value="5" type="radio"><br>Äußerst</label></li>
               </ul>
            </div>
         </fieldset> 
         <fieldset class="fieldset">
            <div class="sub-group">
               <label class="left">15. Wach</label>
               <ul style="list-style: none; display: inherit;" class="right">
                  <li class="radio"><label class="small"><input name="f15" value="1" type="radio" required  oninvalid="setCustomValidity('Bitte wählen Sie eine Antwort aus')"><br>Gar nicht</label></li>
                  <li class="radio"><label class="small"><input name="f15" value="2" type="radio"> <br>Ein Bisschen</label></li>
                  <li class="radio"><label class="small"><input name="f15" value="3" type="radio"><br>Einiger-<br>maßen</label></li>
                  <li class="radio"><label class="small"><input name="f15" value="4" type="radio"><br>Erheblich</label></li>
                  <li class="radio"><label class="small"><input name="f15" value="5" type="radio"><br>Äußerst</label></li>
               </ul>
            </div>
         </fieldset> 
         <fieldset class="fieldset">
            <div class="sub-group">
               <label class="left">16. Nervös</label>
               <ul style="list-style: none; display: inherit;" class="right">
                  <li class="radio"><label class="small"><input name="f16" value="1" type="radio" required  oninvalid="setCustomValidity('Bitte wählen Sie eine Antwort aus')"><br>Gar nicht</label></li>
                  <li class="radio"><label class="small"><input name="f16" value="2" type="radio"> <br>Ein Bisschen</label></li>
                  <li class="radio"><label class="small"><input name="f16" value="3" type="radio"><br>Einiger-<br>maßen</label></li>
                  <li class="radio"><label class="small"><input name="f16" value="4" type="radio"><br>Erheblich</label></li>
                  <li class="radio"><label class="small"><input name="f16" value="5" type="radio"><br>Äußerst</label></li>
               </ul>
            </div>
         </fieldset> 
         <fieldset class="fieldset">
            <div class="sub-group">
               <label class="left">17. Entschlossen</label>
               <ul style="list-style: none; display: inherit;" class="right">
                  <li class="radio"><label class="small"><input name="f17" value="1" type="radio" required  oninvalid="setCustomValidity('Bitte wählen Sie eine Antwort aus')"><br>Gar nicht</label></li>
                  <li class="radio"><label class="small"><input name="f17" value="2" type="radio"> <br>Ein Bisschen</label></li>
                  <li class="radio"><label class="small"><input name="f17" value="3" type="radio"><br>Einiger-<br>maßen</label></li>
                  <li class="radio"><label class="small"><input name="f17" value="4" type="radio"><br>Erheblich</label></li>
                  <li class="radio"><label class="small"><input name="f17" value="5" type="radio"><br>Äußerst</label></li>
               </ul>
            </div>
         </fieldset> 
         <fieldset class="fieldset">
            <div class="sub-group">
               <label class="left">18. Aufmerksam</label>
               <ul style="list-style: none; display: inherit;" class="right">
                  <li class="radio"><label class="small"><input name="f18" value="1" type="radio" required  oninvalid="setCustomValidity('Bitte wählen Sie eine Antwort aus')"><br>Gar nicht</label></li>
                  <li class="radio"><label class="small"><input name="f18" value="2" type="radio"> <br>Ein Bisschen</label></li>
                  <li class="radio"><label class="small"><input name="f18" value="3" type="radio"><br>Einiger-<br>maßen</label></li>
                  <li class="radio"><label class="small"><input name="f18" value="4" type="radio"><br>Erheblich</label></li>
                  <li class="radio"><label class="small"><input name="f18" value="5" type="radio"><br>Äußerst</label></li>
               </ul>
            </div>
         </fieldset> 
         <fieldset class="fieldset">
            <div class="sub-group">
               <label class="left">19. Durcheinander</label>
               <ul style="list-style: none; display: inherit;" class="right">
                  <li class="radio"><label class="small"><input name="f19" value="1" type="radio" required  oninvalid="setCustomValidity('Bitte wählen Sie eine Antwort aus')"><br>Gar nicht</label></li>
                  <li class="radio"><label class="small"><input name="f19" value="2" type="radio"> <br>Ein Bisschen</label></li>
                  <li class="radio"><label class="small"><input name="f19" value="3" type="radio"><br>Einiger-<br>maßen</label></li>
                  <li class="radio"><label class="small"><input name="f19" value="4" type="radio"><br>Erheblich</label></li>
                  <li class="radio"><label class="small"><input name="f19" value="5" type="radio"><br>Äußerst</label></li>
               </ul>
            </div>
         </fieldset> 
         <fieldset class="fieldset">
            <div class="sub-group">
               <label class="left">20. Ängstlich</label>
               <ul style="list-style: none; display: inherit;" class="right">
                  <li class="radio"><label class="small"><input name="f20" value="1" type="radio" required  oninvalid="setCustomValidity('Bitte wählen Sie eine Antwort aus')"><br>Gar nicht</label></li>
                  <li class="radio"><label class="small"><input name="f20" value="2" type="radio"> <br>Ein Bisschen</label></li>
                  <li class="radio"><label class="small"><input name="f20" value="3" type="radio"><br>Einiger-<br>maßen</label></li>
                  <li class="radio"><label class="small"><input name="f20" value="4" type="radio"><br>Erheblich</label></li>
                  <li class="radio"><label class="small"><input name="f20" value="5" type="radio"><br>Äußerst</label></li>
               </ul>
            </div>
         </fieldset> 
         
         <button id="submit" type="submit">Weiter</button>
      </form>
</body>
</main>
</html>