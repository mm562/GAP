<?php
require_once("../db_connect.php");

// [Fetch Parameters]
if (isset($_POST['prolificid'])) {
   $studynr = 1;
   
   $prolificid = str_replace(' ', '', $_POST['prolificid']);
   $groupid= $_POST['groupid'];
   $feedid= $_POST['feedid'];
   if($_POST['feedid'] === 'initial') {
      $result_data= json_encode(array("Alter"=>$_POST['Alter'], "Geschlecht"=>$_POST['gender'], "DSS1"=>$_POST['f1'], "DSS2"=>$_POST['f2'], "DSS3"=>$_POST['f3'], "DSS4"=>$_POST['f4'], "DSS5"=>$_POST['f5'], "DSS6"=>$_POST['f6'], "DSS7"=>$_POST['f7'], "DSS8"=>$_POST['f8'], "DSS9"=>$_POST['f9'], "DSS10"=>$_POST['f10']));
      $feednr = 1;
      $proc = '';
      $lab = '';
   } else {
      if (isset($_POST['feedOrSurvey'])) {
         $fos= $_POST['feedOrSurvey'];
      if($fos === 'feed') {
         $result_data= $_POST['data'];
         $feednr = $_POST['feednr'];
         $proc = $_POST['proc'];
         $lab = $_POST['lab'];
      } else if($fos === 'tlx') {
         $feednr = $_POST['feednr'];
         $proc = $_POST['proc'];
         $lab = $_POST['lab'];
         $result_data= json_encode(array("Geistige Anforderung"=>$_POST['ga'], "Koerperliche Anforderung"=>$_POST['ka'], "Zeitliche Anforderung"=>$_POST['za'], "Leistung"=>$_POST['l'], "Anstrengung"=>$_POST['a'], "Frustration"=>$_POST['f']));
      } else if ($fos === 'panas') {
         $feednr = $_POST['feednr'];
         $proc = $_POST['proc'];
         $lab = $_POST['lab'];
         $result_data= json_encode(array("aktiv"=>$_POST['f1'], "bekuemmert"=>$_POST['f2'], "interessiert"=>$_POST['f3'], "freudig erregt"=>$_POST['f4'], "veraergert"=>$_POST['f5'], "stark"=>$_POST['f6'], "schuldig"=>$_POST['f7'], "erschrocken"=>$_POST['f8'], "feindselig"=>$_POST['f9'], "angeregt"=>$_POST['f10'], "stolz"=>$_POST['f11'], "gereizt"=>$_POST['f12'], "begeistert"=>$_POST['f13'], "beschaemt"=>$_POST['f14'], "wach"=>$_POST['f15'], "nervoes"=>$_POST['f16'], "entschlossen"=>$_POST['f17'], "aufmerksam"=>$_POST['f18'], "durcheinander"=>$_POST['f19'], "aengstlich"=>$_POST['f20']));
      } else if ($fos === 'ues') {
         $feednr = $_POST['feednr'];
         $proc = $_POST['proc'];
         $lab = $_POST['lab'];
         $result_data= json_encode(array("UES1"=>$_POST['f1'], "UES2"=>$_POST['f2'], "UES3"=>$_POST['f3'], "UES4"=>$_POST['f4'], "UES5"=>$_POST['f5'], "UES6"=>$_POST['f6'], "UES7"=>$_POST['f7'], "UES8"=>$_POST['f8'], "UES9"=>$_POST['f9'], "UES10"=>$_POST['f10'], "UES11"=>$_POST['f11'], "UES12"=>$_POST['f12']));
      } else if ($fos === 'mfi') {
         if($feedid === 'MFI1') {
            $feednr = 2;
         } else if($feedid === 'MFI2') {
            $feednr = 3;
         } else if($feedid === 'MFI3') {
            $feednr = 4;
         } else if($feedid === 'MFI4') {
            $feednr = 5;
         } else if($feedid === 'MFI5') {
            $feednr = 6;
         }
         $proc = $_POST['proc'];
         $lab = $_POST['lab'];
         $result_data= json_encode(array("MFI1"=>$_POST['f1'], "MFI2"=>$_POST['f2'], "MFI3"=>$_POST['f3'], "MFI4"=>$_POST['f4'], "Stress"=>$_POST['stress']));

      }
   }
   }

   

   // [Prepare Statement, Execute SQL]
   $stmt = $conn->prepare("INSERT INTO results (studynr, userid, groupid, feedid, proc, lab, result_data) VALUES (?, ?, ?, ?, ?, ?, ?)");
   $stmt->bind_param('sssssss',$studynr, $prolificid, $groupid, $feedid, $proc, $lab, $result_data);

   try{$stmt->execute();
   session_start();
      setcookie("pid", strip_tags(trim($prolificid)), time() + 86400 * 14, "/");
      setcookie("gid", strip_tags(trim($groupid)), time() + 86400 * 14, "/");
      setcookie("fnr", strip_tags(trim($feednr)), time() + 86400 * 14, "/");
      setcookie("proc", strip_tags(trim($proc)), time() + 86400 * 14, "/");
      setcookie("lab", strip_tags(trim($lab)), time() + 86400 * 14, "/");
     
      
      if($_POST['feedid'] === 'initial') {
         header("location: ../app.php");
      } else if($fos === 'feed') {
         echo './quiz1.php';
      } else if($fos === 'tlx') {
         header("location: ../quiz2.php");
      } else if($fos=== 'panas') {
         header("location: ../quiz3.php");
      } else if($fos=== 'ues') {
         header("location: ../quiz4.php");
      } else if($fos=== 'mfi') {
         if($feedid === 'MFI5') {
            header("location: ../end.php");
         } else {
            header("location: ../app.php");
         }
         
      }


   } catch(Exception){
      if ($conn->errno == 1062) {
         // Error: value already exists in database
         header("location: ../error.php");
      } else {
         // Error: something went wrong
         header("location: ../error.php");
      }
   }

   $stmt->close();
}
?>