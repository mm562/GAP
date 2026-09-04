# GAP

GAP (**G**enerational responses to **A**I-generated content and labeling on social media
**P**latforms) studies how people of different ages react to AI-generated short-form video
content, and to different ways of *labeling* it as AI-generated. Younger-adult and elderly
participants each go through a field study inside a custom TikTok/Shorts-style feed app
(**ReelRush**, in [`reelrush/`](reelrush)) that mixes AI-generated and non-AI clips at controlled
proportions and — depending on the deployment — marks the AI-generated ones with no label, a
randomly-placed label, or an accurate label. Scroll behaviour, watch time, and survey responses
are logged throughout and analyzed to compare how the two age groups respond to AI content and to
its (mis)labeling.

## Repository layout

- [`reelrush/`](reelrush) — the study instrument itself: a PHP/JS Progressive Web App
  participants use on their own phones. It has its own [README](reelrush/README.md) documenting
  every file.
- [`data/`](data) — the content side of the project: a scrape of trending TikTok videos (split out
  by existing AI-label status) and the curated datasets built from it.
- [`results/`](results) — the analysis pipeline, from the raw exported session/survey data down to
  the final per-participant scores.

## Study design

- **Participants** are recruited through Prolific (`prolificid`) and split into **young adult**
  vs. **elderly** age groups; each group runs through the study twice (`study 1` / `study 2` —
  see [`results/endresults`](results/endresults)).
- **Feed sessions** — each participant does 5 ReelRush feed sessions (`feednr` 1–5), one at each
  of 5 AI-content proportions (0%, 25%, 50%, 75%, 100%), with the order counterbalanced across 10
  assignment groups (`Group1`–`Group10`; see `setAIPercentage()` in
  [`reelrush/logic-app.js`](reelrush/logic-app.js)).
- **Labeling condition** (`labelmode` in `logic-app.js`) — AI-generated clips in the feed are
  shown with `"none"` (no indication), `"random"` (a label on a random subset, independent of
  which clips are actually AI-generated), or `"accurate"` (a label exactly on the AI-generated
  clips).
- **Feed content** — 180 AI-generated and 180 non-AI clips per condition
  ([`reelrush/assets/ai_videos.json`](reelrush/assets/ai_videos.json) /
  [`nonai_videos.json`](reelrush/assets/nonai_videos.json)), drawn from the TikTok scrape in
  [`data/`](data). The video files themselves are hosted on the app server, not in this repo —
  the JSON only stores their filenames/paths and captions.
- **Measures** — an initial survey (demographics + a 10-item scale, `DSS1`–`DSS10`) before the
  first session, then after every feed session a NASA-TLX (workload), PANAS (affect), UES
  (engagement), and MFI + stress (fatigue) questionnaire, plus per-video watch time logged
  automatically (`statements/insert_session_data.php`).

## Data pipeline (`data/`)

1. **Scraping** — TikTok hashtag pages (`www.tiktok.com/tag/[hashtag]`) for the top 100 trending
   hashtags (accessed May 2026), using the method from
   [Labeling AI-generated Content on Short-Form Video Platforms](https://github.com/maAIkekuipers/thesis).
2. **Raw scrape** — [`data/datasets/tt_trends_dataset.csv`](data/datasets/tt_trends_dataset.csv),
   16,556 videos, split by existing label into
   [`..._nolabel.csv`](data/datasets/tt_trends_dataset_nolabel.csv) (16,216),
   [`..._creatorlabel.csv`](data/datasets/tt_trends_dataset_creatorlabel.csv) (258, labeled by the
   creator), and [`..._platformlabel.csv`](data/datasets/tt_trends_dataset_platformlabel.csv) (82,
   labeled by TikTok itself).
3. **Curated dataset** — after manually removing unsuitable videos (visible AI watermarks,
   "like & subscribe" bait), [`data/aidesc_ds.csv`](data/aidesc_ds.csv) holds the final 120
   creator-labeled AI videos used for the description/content-analysis side of the project;
   [`data/creatorai_desc_extra.csv`](data/creatorai_desc_extra.csv) adds 60 more.
   *(An earlier version of this README also referenced a matching `nonaidesc_ds.csv` of 120
   non-AI videos — it isn't present in this copy of the repo; add it back here if you still have
   it.)*

## Results pipeline (`results/`)

1. **Raw** — [`results/raw/`](results/raw) holds the data as exported: the app's own
   session/survey table (mirroring the MySQL `results` table below) and the matching feed logs.
2. **Merge & reshape** — `reelrush/results/resultdata.php` is a small upload form that merges a
   LimeSurvey export with the app's own session data via `results_importToDb.php`;
   `reelrush/results/tojson.py` / `results.py` convert between the CSV/JSON representations and
   reshape the wide survey rows into the long format in
   [`results/processed/`](results/processed) — one row per
   `studynr, userid, labelmode, aiamount, survey, question, answer`.
3. **Scored output** — [`results/endresults/`](results/endresults) has the final per-participant
   numbers used for analysis: computed TLX / PANAS / UES / MFI scale scores and average watch
   time on AI vs. non-AI clips at each AI-content percentage (`condition`), split into four files
   by study number and age group (`scores_study{1,2}_{young,elderly}.csv`).

## Running ReelRush (`reelrush/`)

**Requirements**
- A PHP web host with MySQL.
- [Composer](https://getcomposer.org/) — `google/apiclient` is used to fetch YouTube video
  metadata (`fetch_ytvideos_details.php`, `statements/get_videodata.php`).
- [Node/npm](https://nodejs.org/) — `firebase`, device-fingerprinting (`broprint.js`/`clientjs`),
  and `sass` (compiles `style.scss` → `style.css`).

**Setup**
1. Create a MySQL database (`db_connect.php` expects it named `schelling`) with a `users` table
   (`userid, startdate, cookie, groupid`) and a `results` table
   (`studynr, userid, groupid, feedid, proc, lab, result_data`).
2. Set the DB password in `reelrush/keys.php` (`KEY_SQL`) — it's committed empty as a placeholder.
3. From inside `reelrush/`, run `composer install` and `npm install`, then
   `npm run compile:sass`.
4. Deploy the contents of `reelrush/` to the web root of a PHP host — per
   [`reelrush/README.md`](reelrush/README.md), the files need to sit at the top level, not
   nested under another folder.

**⚠️ Before deploying this anywhere public:** [`reelrush/statements/get_videodata.php`](reelrush/statements/get_videodata.php)
has a YouTube Data API key hardcoded directly in it. Now that this repository is public, that key
is exposed — regenerate/revoke it in the Google Cloud Console and move the replacement into a
gitignored config file (the same pattern FeedTrail uses for `google-services.json`) instead of
committing it again.

## Note on data and ethics

Live use of this app collects participant survey responses tied to Prolific IDs, and the
datasets contain TikTok content (creator usernames, captions) scraped without the creators'
consent, for research classification purposes only. Treat both as sensitive — this project is
meant to run under an approved study protocol, not as a general-purpose redistributable dataset.
The sample data currently committed under `results/raw` and `results/processed` is test data
(`test1`, `teilnehmer1_2`), not real participant records.
