<!-- # AIGenContent_BA_Schelling



## Getting started

To make it easy for you to get started with GitLab, here's a list of recommended next steps.

Already a pro? Just edit this README.md and make it your own. Want to make it easy? [Use the template at the bottom](#editing-this-readme)!

## Add your files

* [Create](https://docs.gitlab.com/user/project/repository/web_editor/#create-a-file) or [upload](https://docs.gitlab.com/user/project/repository/web_editor/#upload-a-file) files
* [Add files using the command line](https://docs.gitlab.com/topics/git/add_files/#add-files-to-a-git-repository) or push an existing Git repository with the following command:

```
cd existing_repo
git remote add origin https://gitlab.uni-ulm.de/epp92/AIgencontent_ba_schelling.git
git branch -M mAIn
git push -uf origin mAIn
```

## Integrate with your tools

* [Set up project integrations](https://gitlab.uni-ulm.de/epp92/AIgencontent_ba_schelling/-/settings/integrations)

## Collaborate with your team

* [Invite team members and collaborators](https://docs.gitlab.com/user/project/members/)
* [Create a new merge request](https://docs.gitlab.com/user/project/merge_requests/creating_merge_requests/)
* [Automatically close issues from merge requests](https://docs.gitlab.com/user/project/issues/managing_issues/#closing-issues-automatically)
* [Enable merge request approvals](https://docs.gitlab.com/user/project/merge_requests/approvals/)
* [Set auto-merge](https://docs.gitlab.com/user/project/merge_requests/auto_merge/)

## Test and Deploy

Use the built-in continuous integration in GitLab.

* [Get started with GitLab CI/CD](https://docs.gitlab.com/ci/quick_start/)
* [Analyze your code for known vulnerabilities with Static Application Security Testing (SAST)](https://docs.gitlab.com/user/application_security/sast/)
* [Deploy to Kubernetes, Amazon EC2, or Amazon ECS using Auto Deploy](https://docs.gitlab.com/topics/autodevops/requirements/)
* [Use pull-based deployments for improved Kubernetes management](https://docs.gitlab.com/user/clusters/agent/)
* [Set up protected environments](https://docs.gitlab.com/ci/environments/protected_environments/)

***

# Editing this README

When you're ready to make this README your own, just edit this file and use the handy template below (or feel free to structure it however you want - this is just a starting point!). Thanks to [makeareadme.com](https://www.makeareadme.com/) for this template.

## Suggestions for a good README

Every project is different, so consider which of these sections apply to yours. The sections used in the template are suggestions for most open source projects. Also keep in mind that while a README can be too long and detAIled, too long is better than too short. If you think your README is too long, consider utilizing another form of documentation rather than cutting out information. -->

## Bachelor Schelling - AI generated content
<!-- 
## Description
Let people know what your project can do specifically. Provide context and add a link to any reference visitors might be unfamiliar with. A list of Features or a Background subsection can also be added here. If there are alternatives to your project, this is a good place to list differentiating factors.

## Badges
On some READMEs, you may see small images that convey metadata, such as whether or not all the tests are passing for the project. You can use Shields to add some to your README. Many services also have instructions for adding a badge.

## Visuals
Depending on what you are making, it can be a good idea to include screenshots or even a video (you'll frequently see GIFs rather than actual videos). Tools like ttygif can help, but check out Asciinema for a more sophisticated method. -->

## MySQL Structure

```
$servername = "localhost";
$username = "root";
$password = '';
$dbname = "bachelor";
$tablename = "users" (userid, startdate, cookie, groupid)
$tablename = "results" (userid, groupid, feedid, longtext)
```

## Scraping
Methods used to scrape Youtube Videos [Labeling AI-generated Content on Short-Form Video Platforms](https://github.com/maAIkekuipers/thesis)

- Scraped from Hashtag Pages ("www.tiktok.com/tag/[hashtag]")

### Top 100 Hashtags [Accessed May 04 2026]

```
    "#summer",
    "#memecut",
    "#deep",
    "#sommer",
    "#67",
    "#brawlstars",
    "#mama",
    "#brawlstarstiktok",
    "#recomendation",
    "#ki",
    "#zitat",
    "#simson",
    "#bundesliga",
    "#tiktokmademebuyit",
    "#motorcycle",
    "#mtb",
    "#arbeit",
    "#championsleague",
    "#мем",
    "#spring",
    "#школа",
    "#репост",
    "#natur",
    "#running",
    "#lamineyamal",
    "#fcbayern",
    "#motorrad",
    "#germany🇩🇪_tik_tok",
    "#ostern",
    "#dealsfürdich",
    "#bikelife",
    "#biker",
    "#lecker",
    "#frühling",
    "#billieeilish",
    "#sunset",
    "#justinbieber",
    "#161",
    "#весна",
    "#vinted",
    "#sun",
    "#famous",
    "#sonne",
    "#mbappe",
    "#bs",
    "#relatablevideos",
    "#moped",
    "#бравлстарс",
    "#timgioh",
    "#btsarmy",
    "#residentevil",
    "#deutschlandtiktok",
    "#mamaleben",
    "#wahrheit",
    "#jungkook",
    "#digitalart",
    "#protein",
    "#sommervibes",
    "#filmclips",
    "#michaeljackson",
    "#s51",
    "#früchte",
    "#nintendo",
    "#tiktokmademebuylt",
    "#endfield",
    "#laufen",
    "#aymo",
    "#niche",
    "#geburtstag",
    "#drake",
    "#abi",
    "#brawl",
    "#likedocheinfach",
    "#pAIdpartnership",
    "#garten",
    "#twitchde",
    "#lypsinc",
    "#bayernmunich",
    "#مشاهير_تيك_توك",
    "#lehrer",
    "#ostsee",
    "#worldcup",
    "#eid",
    "#euphoria",
    "#invincible",
    "#supermoto",
    "#trauer",
    "#меллстрой",
    "#morenutrition",
    "#wm",
    "#escooter",
    "#praylumajang",
    "#kaffee",
    "#realität",
    "#housemusic",
    "#mallorca",
    "#wwe",
    "#liveincentiveprogram",
    "#cortisol",
    "#makemefamouse"

```
### Scraping Results
* [All scraped videos](data/datasets/tt_trends_dataset.csv) - 16556 videos
* [tiktok videos with no AI label](data/datasets/tt_trends_dataset_nolabel.csv) - 16216 videos
* [tiktok videos with AI label by creator](data/datasets/tt_trends_dataset_creatorlabel.csv) - 258 videos
* [tiktok videos with AI label by platform](data/datasets/tt_trends_dataset_platformlabel.csv) - 82 videos

### Final Datasets
After manually sorting out unsuitable videos (contAIning AI Watermarks, asking viewer to comment, share, subscribe)
* [Final AI Dataset](data/AIdesc_ds.csv) - 120 videos with AI Label by creator
* [Final NonAI Dataset](data/nonaidesc_ds.csv) - 120 videos without AI Label

<!-- ## Usage
Use examples liberally, and show the expected output if you can. It's helpful to have inline the smallest example of usage that you can demonstrate, while providing links to more sophisticated examples if they are too long to reasonably include in the README.

## Support
Tell people where they can go to for help. It can be any combination of an issue tracker, a chat room, an emAIl address, etc.

## Roadmap
If you have ideas for releases in the future, it is a good idea to list them in the README.

## Contributing
State if you are open to contributions and what your requirements are for accepting them.

For people who want to make changes to your project, it's helpful to have some documentation on how to get started. Perhaps there is a script that they should run or some environment variables that they need to set. Make these steps explicit. These instructions could also be useful to your future self.

You can also document commands to lint the code or run tests. These steps help to ensure high code quality and reduce the likelihood that the changes inadvertently break something. Having instructions for running tests is especially helpful if it requires external setup, such as starting a Selenium server for testing in a browser.

## Authors and acknowledgment
Show your appreciation to those who have contributed to the project.

## License
For open source projects, say how it is licensed.

## Project status
If you have run out of energy or time for your project, put a note at the top of the README saying that development has slowed down or stopped completely. Someone may choose to fork your project or volunteer to step in as a mAIntAIner or owner, allowing your project to keep going. You can also make an explicit request for mAIntAIners. -->
