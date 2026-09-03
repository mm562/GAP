<?php
include './assets/config.php';
include './head.php';

$pwa = false;
if (isset($_GET["source"])) {
   if ($_GET["source"] == "pwa") {
      $pwa = true;
   }
}
?>


<body id="imprint">
   <header>
      <input type="text" class="hidden" name="redirect_to_register" id="redirect_to_register" value="false">
      <input type="text" class="hidden" name="redirect_to_app" id="redirect_to_app" value="false">
   </header>

   <main class="paragraph">
      <a href="./start.php<?php echo ($pwa ? "?source=pwa" : "")?>"><button
            class="btn btn-secondary back-link noselect">Back to the app</button></a>
      <h1>Notice (Privacy and General)</h1>
      <h2>Privacy policy for the collection of personal data for academic and industrial research purposes</h2>
      <h3>1. Name and Contact Details of the persons responsible for the data processing are:</h3>
      <h4>Contact Persons</h4>
      <p>
         Luca-Maxim Meinhardt<br>
         luca.meinhardt@uni-ulm.de<br>
         +49(0)731 / 50-31323<br>
         Universität Ulm<br>
         Faculty of Engineering, Computer Science and Psychology<br>
         Institute for Media Informatics<br>
         James-Franck-Ring<br>
         89081 Ulm, Germany
      </p>
      <p>
         Lukas Gruler<br>
         lukas.gruler@uni-ulm.de<br>
      </p>
      <p>
         René Schäfer<br>
         rschaefer@cs.rwth-aachen.de<br>
      </p>
      <h3>2. Purposes and legal bases of the processing:</h3>
      <h4>2.(a) The purpose of processing your data will be:</h4>
      <p>- to work on scientific questions regarding interventions in infinite scrolling apps featuring short-form
         videos.<br>
         - to write scientific publications based on the findings of the processing of the data.</p>
      <h4>2.(b) Legal basis of processing your data on the basis of Section 4 of the Federal Data Protection Act
         (Landesdatenschutzgesetz, LDSG) in connection with point e of Article 6 (1) of the GDPR and points b and c of
         Article 6 (1) of the GDPR. </h4>
      <h3>3. Recipients or categories of recipients of personal data:</h3>
      <p> Your data responses (including gender, age, and nationality) will be processed for research and development
         purposes by the Ulm University. No further identification will be required.</p>
      <h3>Rights of persons affected:</h3>
      <p> According to the General Data Protection Regulation, you have the following rights when providing personal
         data:<br>
         - the purpose of this data collection shall be made clear to you<br>
         - the identity of the researcher and their contact details are made clear<br>
         - the period for which this personal data will be stored (until about Decemeber 2024)<br>
         - the right to access, correct, or erase any personal data or to object to the processing of your data. That
         is, even after complete submission of this survey you have the right to access, correct or delete your
         answers.<br>
         Furthermore, find out more about your data protection rights at the provisions under the General Data
         Protection Regulation (GDPR) at: <a href="https://gdpr-info.eu/" target="_blank"
            referrer="noopener noreferrer">https://gdpr-info.eu/</a></p>
      <h3>4. Cookies and Fingerprint</h3>
      <p>We use cookies and fingerprinting. Cookies are small text files that are stored on your terminal device when
         you call up the page. They cannot transfer viruses or malware to your computer, but they do contain information
         that allows the user to be identified.</p>
      <p>Here you will find all cookies that are necessary for the operation of our website and its functions
         (technically necessary cookies). These are usually set in response to an action you have taken. These include
         registration, login or settings such as language or cookie preferences. It is possible to deactivate these
         cookies in the browser. In this case, error-free functioning of our website can no longer be guaranteed.</p>
      <h4>Cookie Name: "pid"</h4>
      <p>Host: local webserver; Type: necessary; Purpose: storing the user id to identify the user after
         registration/login; Period of validity: 14 days; Destination country: Location of the web server (Germany)</p>
      <h4>Cookie Name: "sd"</h4>
      <p>Host: local webserver; Type: necessary; Purpose: storing the start date of the participation after
         registration/login; Period of validity: 14 days; Destination country: Location of the web server (Germany)</p>
      <h4>Cookie Name: "ed"</h4>
      <p>Host: local webserver; Type: necessary; Purpose: storing the end date of the participation after
         registration/login; Period of validity: 14 days; Destination country: Location of the web server (Germany)</p>
      <h4>Cookie Name: "PHPSESSID"</h4>
      <p>Host: local webserver; Type: necessary; Purpose: server-side session usage; Period of validity: 14 days;
         Destination country: Location of the web server (Germany)</p>
      <p>Fingerprints can be used to identify a system by its parameters and settings. We use system fingerprints to
         identify the system or participant when there is no cookie set anymore to restore the session without needing
         to login again. Fingerprints are generated and stored on the server-side database as long as it is necessary
         for the conduct of the study (maxmimum of 6 months). For the generation of the fingerprint, we use an
         open-source library which is locally stored on the web server .</p>
      <h3>5. Consent Form</h3>
      <p>I am aware that the collection, processing and use of my data is voluntary.
         I have been informed that my following data are processed: my age, nationality, and gender as well as my
         personal information regarding lifestyle as it pertains to traffic environments, such as crossing a road.<br>
         My data will be needed to answer scientific research questions regarding interventions for short video infinite
         scrolling . I am aware that my data is processed anonymously.<br>
         I agree that my data will be collected, processed, used and stored by Universität Ulm for the following
         purposes:<br>
         - I agree that the results and primary data of this study may be published by the Universität Ulm as a
         scientific publication. The data is published completely anonymously, i.e. the collected data cannot be related
         to respective participants.<br>
         - The study described here is part of a scientific project of the Universität Ulm. The data is stored for an
         indefinite period of time. (until about December 2024)<br>
         I have been informed that my personal data collected in the context of the above purposes will be processed in
         compliance with the General Data Protection Regulation (GDPR).<br>
         Furthermore, I am aware that according to the General Data Protection Regulation (GDPR) Art. 7 point 3, I have
         the right to withdraw my consent at any time. Withdrawing my consent is made easy for me: by simply contacting
         the researcher in charge I can withdraw my consent to this study. </p>
      <h4>Contact Persons:</h4>
      <p>Luca-Maxim Meinhardt<br>
         luca.meinhardt@uni-ulm.de<br>
         ​​​​​​+49(0)731 / 50-31323</p>
      <p>Lukas Gruler<br>
         lukas.gruler@uni-ulm.de</p>

      <p>The survey can be canceled by me at any time without mentioning reasons and without causing me any
         disadvantages. In the event of cancellation, all data recorded of me will be irrevocably deleted.
         By continuing with this survey, I have been informed of my rights. </p>

      <h4>Further</h4>
      <p>You accept Google's <a href="https://policies.google.com/privacy" target="_blank">Privacy Policies</a> and <a
            href="https://www.youtube.com/t/terms" target="_blank">YouTube's Terms of Service</a>. You
         accept that our client uses YouTube API Services and data is loaded from Google (YouTube) servers and that
         Google (YouTube) can set cookies in your browser. You accept the <a
            href="https://firebase.google.com/support/privacy" target="_blank">Privacy and Security Policy</a> for
         Google Firebase Cloud Messaging to receive push notifications.</p>
   </main>

   <footer>
      <a href="./imprint.php<?php echo ($pwa ? "?source=pwa" : "")?>">Imprint</a>
      |
      <a href="./notice.php<?php echo ($pwa ? "?source=pwa" : "")?>">Notice</a>
   </footer>
</body>

</html>