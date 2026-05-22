## Demo Login

You can test the platform using the demo account below:

Username: demo (Email: demo@guideportal.com  )
Password: demo12345

(without logging in some functionalities like bookmarking will not work)

## Code Info
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
- Some code functionalities like the bookmarking system are unfortunately a little unstable. It's an on - off - relationship. If it does not work, view the screenshots in the report & attached to this repository to see how it is supposed to work.
