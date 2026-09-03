<!DOCTYPE html>
<html>

<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <link rel="icon" type="image/png" href="../assets/img/favicon.png">

   <title>Result Data Converter</title>

   <link rel="stylesheet" href="./style.css" rel=preload>
</head>

<body>
   <div class="container">
      <h1>Result Data Converter</h1>
      <h4>Upload the LimeSurvey results and download the results table enriched by session data</h4>
      <form action="results_importToDb" method="post" enctype="multipart/form-data">
         <p>1. Select file to upload <span>(filetype .json)</span>:</p>
         <div class="upload">
            <input type="file" name="fileToUpload" id="fileToUpload" class="uploadinput" accept="application/json" />

            <p>2. Choose result data scope:</p>
            <div class="input-lines">
               <div class="input-line">
                  <input type="radio" id="only_survey" name="scope" value="only_survey" checked>
                  <label for="only_survey">Get only sessions with an answered questionnaire</label>
               </div>
               <div class="input-line">
                  <input type="radio" id="all_session" name="scope" value="all_session">
                  <label for="all_session">Get all sessions</label>
               </div>
            </div>

            <input type="submit" value="Upload File + Download Results" name="submit" class="btn btn-primary" />
         </div>
      </form>
   </div>
</body>

</html>