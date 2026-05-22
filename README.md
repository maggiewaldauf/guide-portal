This project includes custom WordPress functionality created using the Code Snippets plugin.
All snippets are exported in snippets-export.json.

Custom CSS used in the project was extracted from the WordPress Customizer and included in this repository for documentation purposes.


## Pages Included in the Project

- Home (Guide Portal)
- Destinations (Overview Page)
- Guide Essentials (Overview Page)
- Norway Knowledge (Overview page)
- Safety
- Help
- Create Account
- Forget Password
- Log In
- Notifications
- Onboarding
- Trash
- My Account
- Scripts
- Create Script
- Templates for Blog Archive View (in astra-child/template-parts/blog/blog layout 4), including customized style.css
- Templates for Post Views (astra-child/single-destination, astra-child/single-knowledge,  astra-child/single-pages (css), astra-child/single-guide_topic, single-script

Each page was built using WordPress (Gutenberg, Shortcode) and structured as part of an interactive guide portal experience.


## Plugins Used

- Astra Theme: Base layout / Astra Child
- Spectra: Page building
- Code Snippets: Custom logic
- Advanced Custom Fields
- Custom Post Type UI
- Members: Access/Roles
- Relevanssi: Relevance-sorting search
- Safe SVG: Save upload of SVGS
- Wicked Folders: Folder structure

## Deployment
- When deploying the pages to a hosting platform, the structure slightly change from root / to /project/ -> most navigation links and pages have been reconnected, however in case there is some buttons leading to a 404 page, check if the URL says /project/... .
- Some code functionalities like the bookmarking system unfortunately broke. But it was like this the whole time - on and off and on and off. Maybe I can get it to work for the presentation again :D. If not, screenshots in the report & attached to this repository prove that it actually did work at some point:).
