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
   <style>
      
</style>
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
               value= "TLX<?php echo (isset($feednr) ? $feednr : ""); ?>">
         <input type="text" class="hidden" name="proc" id="proc"
         value="<?php echo (isset($proc) ? $proc : ""); ?>">
         <input type="text" class="hidden" name="lab" id="lab"
         value="<?php echo (isset($lab) ? $lab : ""); ?>">
               <input type="text" class="hidden" name="feedOrSurvey" id="fos"
               value= "tlx">


         <label>Klicken Sie in jeder Skala auf den Punkt, der Ihre Erfahrung im Hinblick auf die Aufgabe am besten verdeutlicht. </label>
         <fieldset class="fieldset">
            <div class="sub-group">
               <label class="left">1. Geistige Anforderung</label>
               <input class="nasa" name="ga" id="gascale" required  oninvalid="setCustomValidity('Bitte wählen Sie eine Antwort aus')" inputmode="none">
               <label class = "descr">
                  Wie viel geistige Anforderung war bei der Informationsaufnahme und bei der Informationsverarbeitung erforderlich (z.B. Denken, Entscheiden, Rechnen, Erinnern, Hinsehen, Suchen ...)? War die Aufgabe leicht oder anspruchsvoll, einfach oder komplex, erfordert sie hohe Genauigkeit oder ist sie fehlertolerant?
               </label>

               <table>
                  <tr><td id="ga_5" class="ga" onmouseup="scaleclick('ga', 5);" bgColor = "#FFFFFF"></td><td id="ga_10" class="ga" onmouseup="scaleclick('ga', 10);" bgColor = "#FFFFFF"></td><td id="ga_15" class="ga" onmouseup="scaleclick('ga', 15);" bgColor = "#FFFFFF"></td><td id="ga_20" class="ga" onmouseup="scaleclick('ga', 20);" bgColor = "#FFFFFF"></td><td id="ga_25" class="ga" onmouseup="scaleclick('ga', 25);" bgColor = "#FFFFFF"></td><td id="ga_30" class="ga" onmouseup="scaleclick('ga', 30);" bgColor = "#FFFFFF"></td><td id="ga_35" class="ga" onmouseup="scaleclick('ga', 35);" bgColor = "#FFFFFF"></td><td id="ga_40" class="ga" onmouseup="scaleclick('ga', 40);" bgColor = "#FFFFFF"></td><td id="ga_45" class="ga" onmouseup="scaleclick('ga', 45);" bgColor = "#FFFFFF"></td><td id="ga_50" class="ga" onmouseup="scaleclick('ga', 50);" bgColor = "#FFFFFF"></td><td id="ga_55" class="ga" onmouseup="scaleclick('ga', 55);" bgColor = "#FFFFFF"></td><td id="ga_60" class="ga" onmouseup="scaleclick('ga', 60);" bgColor = "#FFFFFF"></td><td id="ga_65" class="ga" onmouseup="scaleclick('ga', 65);" bgColor = "#FFFFFF"></td><td id="ga_70" class="ga" onmouseup="scaleclick('ga', 70);" bgColor = "#FFFFFF"></td><td id="ga_75" class="ga" onmouseup="scaleclick('ga', 75);" bgColor = "#FFFFFF"></td><td id="ga_80" class="ga" onmouseup="scaleclick('ga', 80);" bgColor = "#FFFFFF"></td><td id="ga_85" class="ga" onmouseup="scaleclick('ga', 85);" bgColor = "#FFFFFF"></td><td id="ga_90" class="ga" onmouseup="scaleclick('ga', 90);" bgColor = "#FFFFFF"></td><td id="ga_95" class="ga" onmouseup="scaleclick('ga', 95);" bgColor = "#FFFFFF"></td><td id="ga_100" class="ga" onmouseup="scaleclick('ga', 100);" bgColor = "#FFFFFF"></td></tr>
               </table>
               <label class="niedrig">
                  Niedrig
               </label>
               <label class="hoch">
                  Hoch
               </label>
            </div>
         </fieldset>
         <fieldset class="fieldset">
            <div class="sub-group">

               <label class="left">2. Körperliche Anforderung</label>
            <input class="nasa" name="ka"id="kascale"  required  oninvalid="setCustomValidity('Bitte wählen Sie eine Antwort aus')" inputmode="none">
               <label class = "descr">Wie viel körperliche Aktivität war erforderlich (z.B. ziehen, drücken, drehen, steuern, aktivieren ...)? War die Aufgabe leicht oder schwer, einfach oder anstrengend, erholsam oder mühselig?</label>

               <table>
                  <tr><td id="ka_5" class="ka" onmouseup="scaleclick('ka', 5);" bgColor = "#FFFFFF"></td><td id="ka_10" class="ka" onmouseup="scaleclick('ka', 10);" bgColor = "#FFFFFF"></td><td id="ka_15" class="ka" onmouseup="scaleclick('ka', 15);" bgColor = "#FFFFFF"></td><td id="ka_20" class="ka" onmouseup="scaleclick('ka', 20);" bgColor = "#FFFFFF"></td><td id="ka_25" class="ka" onmouseup="scaleclick('ka', 25);" bgColor = "#FFFFFF"></td><td id="ka_30" class="ka" onmouseup="scaleclick('ka', 30);" bgColor = "#FFFFFF"></td><td id="ka_35" class="ka" onmouseup="scaleclick('ka', 35);" bgColor = "#FFFFFF"></td><td id="ka_40" class="ka" onmouseup="scaleclick('ka', 40);" bgColor = "#FFFFFF"></td><td id="ka_45" class="ka" onmouseup="scaleclick('ka', 45);" bgColor = "#FFFFFF"></td><td id="ka_50" class="ka" onmouseup="scaleclick('ka', 50);" bgColor = "#FFFFFF"></td><td id="ka_55" class="ka" onmouseup="scaleclick('ka', 55);" bgColor = "#FFFFFF"></td><td id="ka_60" class="ka" onmouseup="scaleclick('ka', 60);" bgColor = "#FFFFFF"></td><td id="ka_65" class="ka" onmouseup="scaleclick('ka', 65);" bgColor = "#FFFFFF"></td><td id="ka_70" class="ka" onmouseup="scaleclick('ka', 70);" bgColor = "#FFFFFF"></td><td id="ka_75" class="ka" onmouseup="scaleclick('ka', 75);" bgColor = "#FFFFFF"></td><td id="ka_80" class="ka" onmouseup="scaleclick('ka', 80);" bgColor = "#FFFFFF"></td><td id="ka_85" class="ka" onmouseup="scaleclick('ka', 85);" bgColor = "#FFFFFF"></td><td id="ka_90" class="ka" onmouseup="scaleclick('ka', 90);" bgColor = "#FFFFFF"></td><td id="ka_95" class="ka" onmouseup="scaleclick('ka', 95);" bgColor = "#FFFFFF"></td><td id="ka_100" class="ka" onmouseup="scaleclick('ka', 100);" bgColor = "#FFFFFF"></td></tr>
               </table>
               <label class="niedrig">
                  Niedrig
               </label>
               <label class="hoch">
                  Hoch
               </label>
            </div>
         </fieldset>
         <fieldset class="fieldset">
            <div class="sub-group">
               <label class="left">3. Zeitliche Anforderung</label>
            <input class="nasa" name="za" id="zascale" required  oninvalid="setCustomValidity('Bitte wählen Sie eine Antwort aus')" inputmode="none">
               <label class = "descr">Wie viel Zeitdruck empfanden Sie hinsichtlich der Häufigkeit oder dem Takt mit dem die Aufgaben oder Aufgabenelemente auftraten? War die Aufgabe langsam und geruhsam oder schnell und hektisch?</label>

               <table>
                  <tr><td id="za_5" class="za" onmouseup="scaleclick('za', 5);" bgColor = "#FFFFFF"></td><td id="za_10" class="za" onmouseup="scaleclick('za', 10);" bgColor = "#FFFFFF"></td><td id="za_15" class="za" onmouseup="scaleclick('za', 15);" bgColor = "#FFFFFF"></td><td id="za_20" class="za" onmouseup="scaleclick('za', 20);" bgColor = "#FFFFFF"></td><td id="za_25" class="za" onmouseup="scaleclick('za', 25);" bgColor = "#FFFFFF"></td><td id="za_30" class="za" onmouseup="scaleclick('za', 30);" bgColor = "#FFFFFF"></td><td id="za_35" class="za" onmouseup="scaleclick('za', 35);" bgColor = "#FFFFFF"></td><td id="za_40" class="za" onmouseup="scaleclick('za', 40);" bgColor = "#FFFFFF"></td><td id="za_45" class="za" onmouseup="scaleclick('za', 45);" bgColor = "#FFFFFF"></td><td id="za_50" class="za" onmouseup="scaleclick('za', 50);" bgColor = "#FFFFFF"></td><td id="za_55" class="za" onmouseup="scaleclick('za', 55);" bgColor = "#FFFFFF"></td><td id="za_60" class="za" onmouseup="scaleclick('za', 60);" bgColor = "#FFFFFF"></td><td id="za_65" class="za" onmouseup="scaleclick('za', 65);" bgColor = "#FFFFFF"></td><td id="za_70" class="za" onmouseup="scaleclick('za', 70);" bgColor = "#FFFFFF"></td><td id="za_75" class="za" onmouseup="scaleclick('za', 75);" bgColor = "#FFFFFF"></td><td id="za_80" class="za" onmouseup="scaleclick('za', 80);" bgColor = "#FFFFFF"></td><td id="za_85" class="za" onmouseup="scaleclick('za', 85);" bgColor = "#FFFFFF"></td><td id="za_90" class="za" onmouseup="scaleclick('za', 90);" bgColor = "#FFFFFF"></td><td id="za_95" class="za" onmouseup="scaleclick('za', 95);" bgColor = "#FFFFFF"></td><td id="za_100" class="za" onmouseup="scaleclick('za', 100);" bgColor = "#FFFFFF"></td></tr>
               </table>
               <label class="niedrig">
                  Niedrig
               </label>
               <label class="hoch">
                  Hoch
               </label>
            </div>
         </fieldset>
         <fieldset class="fieldset">
            <div class="sub-group">
               <label class="left">4. Leistung</label>
            <input class="nasa" name="l" id="lscale" required  oninvalid="setCustomValidity('Bitte wählen Sie eine Antwort aus')" inputmode="none">
               <label class = "descr">Wie erfolgreich haben Sie Ihrer Meinung nach die vom Versuchsleiter (oder Ihnen selbst) gesetzten Ziele erreicht? Wie zufrieden waren Sie mit Ihrer Leistung bei der Verfolgung dieser Ziele?</label>
               <table>
                  <tr><td id="l_5" class="l" onmouseup="scaleclick('l', 5);" bgColor = "#FFFFFF"></td><td id="l_10" class="l" onmouseup="scaleclick('l', 10);" bgColor = "#FFFFFF"></td><td id="l_15" class="l" onmouseup="scaleclick('l', 15);" bgColor = "#FFFFFF"></td><td id="l_20" class="l" onmouseup="scaleclick('l', 20);" bgColor = "#FFFFFF"></td><td id="l_25" class="l" onmouseup="scaleclick('l', 25);" bgColor = "#FFFFFF"></td><td id="l_30" class="l" onmouseup="scaleclick('l', 30);" bgColor = "#FFFFFF"></td><td id="l_35" class="l" onmouseup="scaleclick('l', 35);" bgColor = "#FFFFFF"></td><td id="l_40" class="l" onmouseup="scaleclick('l', 40);" bgColor = "#FFFFFF"></td><td id="l_45" class="l" onmouseup="scaleclick('l', 45);" bgColor = "#FFFFFF"></td><td id="l_50" class="l" onmouseup="scaleclick('l', 50);" bgColor = "#FFFFFF"></td><td id="l_55" class="l" onmouseup="scaleclick('l', 55);" bgColor = "#FFFFFF"></td><td id="l_60" class="l" onmouseup="scaleclick('l', 60);" bgColor = "#FFFFFF"></td><td id="l_65" class="l" onmouseup="scaleclick('l', 65);" bgColor = "#FFFFFF"></td><td id="l_70" class="l" onmouseup="scaleclick('l', 70);" bgColor = "#FFFFFF"></td><td id="l_75" class="l" onmouseup="scaleclick('l', 75);" bgColor = "#FFFFFF"></td><td id="l_80" class="l" onmouseup="scaleclick('l', 80);" bgColor = "#FFFFFF"></td><td id="l_85" class="l" onmouseup="scaleclick('l', 85);" bgColor = "#FFFFFF"></td><td id="l_90" class="l" onmouseup="scaleclick('l', 90);" bgColor = "#FFFFFF"></td><td id="l_95" class="l" onmouseup="scaleclick('l', 95);" bgColor = "#FFFFFF"></td><td id="l_100" class="l" onmouseup="scaleclick('l', 100);" bgColor = "#FFFFFF"></td></tr>
               </table>
               <label class="niedrig">
                  Niedrig
               </label>
               <label class="hoch">
                  Hoch
               </label>
            </div>
         </fieldset>
         <fieldset class="fieldset">
            <div class="sub-group">
               <label class="left">5. Anstrengung</label>
            <input  class="nasa" name="a" id="ascale" required  oninvalid="setCustomValidity('Bitte wählen Sie eine Antwort aus')" inputmode="none">
               <label class = "descr">Wie hart mussten Sie arbeiten, um Ihren Grad an Aufgabenerfüllung zu erreichen?</label>
                  <table>
                  <tr><td id="a_5" class="a" onmouseup="scaleclick('a', 5);" bgColor = "#FFFFFF"></td><td id="a_10" class="a" onmouseup="scaleclick('a', 10);" bgColor = "#FFFFFF"></td><td id="a_15" class="a" onmouseup="scaleclick('a', 15);" bgColor = "#FFFFFF"></td><td id="a_20" class="a" onmouseup="scaleclick('a', 20);" bgColor = "#FFFFFF"></td><td id="a_25" class="a" onmouseup="scaleclick('a', 25);" bgColor = "#FFFFFF"></td><td id="a_30" class="a" onmouseup="scaleclick('a', 30);" bgColor = "#FFFFFF"></td><td id="a_35" class="a" onmouseup="scaleclick('a', 35);" bgColor = "#FFFFFF"></td><td id="a_40" class="a" onmouseup="scaleclick('a', 40);" bgColor = "#FFFFFF"></td><td id="a_45" class="a" onmouseup="scaleclick('a', 45);" bgColor = "#FFFFFF"></td><td id="a_50" class="a" onmouseup="scaleclick('a', 50);" bgColor = "#FFFFFF"></td><td id="a_55" class="a" onmouseup="scaleclick('a', 55);" bgColor = "#FFFFFF"></td><td id="a_60" class="a" onmouseup="scaleclick('a', 60);" bgColor = "#FFFFFF"></td><td id="a_65" class="a" onmouseup="scaleclick('a', 65);" bgColor = "#FFFFFF"></td><td id="a_70" class="a" onmouseup="scaleclick('a', 70);" bgColor = "#FFFFFF"></td><td id="a_75" class="a" onmouseup="scaleclick('a', 75);" bgColor = "#FFFFFF"></td><td id="a_80" class="a" onmouseup="scaleclick('a', 80);" bgColor = "#FFFFFF"></td><td id="a_85" class="a" onmouseup="scaleclick('a', 85);" bgColor = "#FFFFFF"></td><td id="a_90" class="a" onmouseup="scaleclick('a', 90);" bgColor = "#FFFFFF"></td><td id="a_95" class="a" onmouseup="scaleclick('a', 95);" bgColor = "#FFFFFF"></td><td id="a_100" class="a" onmouseup="scaleclick('a', 100);" bgColor = "#FFFFFF"></td></tr>
               </table>
               <label class="niedrig">
                  Niedrig
               </label>
               <label class="hoch">
                  Hoch
               </label>
            </div>
         </fieldset>
         <fieldset class="fieldset">
            <div class="sub-group">
               <label class="left">6. Frustration</label>
            <input  class = "nasa" name="f" id="fscale" required >
               <label class = "descr">Wie unsicher, entmutigt, irritiert, gestresst und verärgert (versus sicher, bestätigt, zufrieden, entspannt und zufrieden mit sich selbst) fühlten Sie sich während der Aufgabe?</label>

               <table>
                  <tr><td id="f_5" class="f" onmouseup="scaleclick('f', 5);" bgColor = "#FFFFFF"></td><td id="f_10" class="f" onmouseup="scaleclick('f', 10);" bgColor = "#FFFFFF"></td><td id="f_15" class="f" onmouseup="scaleclick('f', 15);" bgColor = "#FFFFFF"></td><td id="f_20" class="f" onmouseup="scaleclick('f', 20);" bgColor = "#FFFFFF"></td><td id="f_25" class="f" onmouseup="scaleclick('f', 25);" bgColor = "#FFFFFF"></td><td id="f_30" class="f" onmouseup="scaleclick('f', 30);" bgColor = "#FFFFFF"></td><td id="f_35" class="f" onmouseup="scaleclick('f', 35);" bgColor = "#FFFFFF"></td><td id="f_40" class="f" onmouseup="scaleclick('f', 40);" bgColor = "#FFFFFF"></td><td id="f_45" class="f" onmouseup="scaleclick('f', 45);" bgColor = "#FFFFFF"></td><td id="f_50" class="f" onmouseup="scaleclick('f', 50);" bgColor = "#FFFFFF"></td><td id="f_55" class="f" onmouseup="scaleclick('f', 55);" bgColor = "#FFFFFF"></td><td id="f_60" class="f" onmouseup="scaleclick('f', 60);" bgColor = "#FFFFFF"></td><td id="f_65" class="f" onmouseup="scaleclick('f', 65);" bgColor = "#FFFFFF"></td><td id="f_70" class="f" onmouseup="scaleclick('f', 70);" bgColor = "#FFFFFF"></td><td id="f_75" class="f" onmouseup="scaleclick('f', 75);" bgColor = "#FFFFFF"></td><td id="f_80" class="f" onmouseup="scaleclick('f', 80);" bgColor = "#FFFFFF"></td><td id="f_85" class="f" onmouseup="scaleclick('f', 85);" bgColor = "#FFFFFF"></td><td id="f_90" class="f" onmouseup="scaleclick('f', 90);" bgColor = "#FFFFFF"></td><td id="f_95" class="f" onmouseup="scaleclick('f', 95);" bgColor = "#FFFFFF"></td><td id="f_100" class="f" onmouseup="scaleclick('f', 100);" bgColor = "#FFFFFF"></td></tr>
               </table>
               <label class="niedrig">
                  Niedrig
               </label>
               <label class="hoch">
                  Hoch
               </label>
            </div>
         </fieldset>
         <button id="submit" type="submit">Weiter</button>
      </form>
</body>
</main>
</html>