# Overview
These are the files of the implemented app ReelRush.

## Files and Folders
All these files and folders should be located in the web host directory at the top level. In the following, the important things are explained:
* [/assets](assets) includes all used assets
* [/results](results) can be accessed in the browser to merge LimeSurvey session data with the captured session data of the app
* [/statements](statements) includes important scripts that are executed by the server, for example for registration, login, ...
* [/vendor](vendor) includes dependencies for the YouTube API
* [api.php](api.php) is the implemented API for communication of clients to the server
* [app.php](app.php) is the implemented video feed
* [db_connect.php](db_connect.php) includes important configurations for the MySQL database
* [error.php](error.php) is the page users see when an error occures
* [fetch_ytvideos_asjson.php](fetch_ytvideos_asjson.php) was used for test purposese do display video data
* [fetch_ytvideos_details.php](fetch_ytvideos_details.php) is for getting YouTube videos from the YouTube Data API and storing them in the database
* [firebase-messaging-sw.js](firebase-messaging-sw.js) is the service worker that handles notifications from firebase or from the app itself
* [functions.php](functions.php) was used for test purposes 
* [head.php](head.php) contains the header of the website
* [importToDb.php](importToDb.php) is used by the /results page to import LimeSurvey JSON session data into the database
* [imprint.php](imprint.php) is the imprint page
* [index.php](index.php) is the home page
* [info.php](info.php) displays important information for the user
* [keys.php](keys.php) is for setting the MySQL database password
* [logic-app.js](logic-app.js) contains all the logic for the app.php page and video feed
* [logic.js](logic.js) contains the logic for the ramining pages
* [login.php](login.php) is the page for logging in
* [manifest.json](manifest.json) contains all the configuration for the PWA to work
* [notice.php](notice.php) is the notice page that includes privacy statements
* [overview.php](overview.php) is the overview page that summarazies study information for participants after registration
* [permission.php](permission.php) is the page participants see if it is detected that notification access was rejected
* [prototyping_playlist.php](prototyping_playlist.php) was used for test purposes
* [prototyping.php](prototyping.php) was used for test purposes
* [register.php](register.php) is the page for registration
* [robots.txt](robots.txt) contains information for web crawlers to not index the page in search engines
* [start.php](start.php) is the page participants saw after installation of the PWA
* [style.scss](style.scss) contains all the design for the app and is compiled to CSS code
* [val_data.json](videodata.json) contains non ai-generated video dataset
* [yt_dataset.json](yt_dataset.json) contains ai-generated video dataset fetched from YouTube Shorts
* [val_data.json](tt_dataset.json) contains ai-generated video dataset fetched from TikTok

