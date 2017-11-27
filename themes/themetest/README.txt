
=====================
Introduction to ThemeTest
=====================

ThemeTest boasts a clean HTML5 structure with extensible CSS classes and IDs for
unlimited theming possibilities as well as a top-down load order for improved
SEO. It is fully responsive out-of-the-box and provides an adaptive, elegant,
SASS-based grid system (Bourbon Neat).

ThemeTest's goal is to provide themers the building blocks needed to get their
designs up and running quickly and simply.

ThemeTest is perfect if you want a simple, smart, and flexible theme starter.

Less code spam, more ham.


============
Installation
============

ThemeTest utilizes SASS for adaptive grids and layouts and general structure of the
site. It's recommended to use SASS for building out your theme. The following
packages are included via 'npm install'
  - SASS (http://sass-lang.com/)
  - Bourbon (http://bourbon.io/)
  - Bourbon Neat (http://neat.bourbon.io/)

ThemeTest is meant to be YOUR theme. Follow one of the two methods below and you can
rename 'themetest' to another name like 'mytheme'. You're also welcome to keep
'themetest'.

1. DRUSH: The provided drush install script will duplicate the themetest theme
   folder and rename all appropriate files and content to the new theme name you
   provide.

  - Download and enable the themetest theme: $ drush en themetest
  - Set the theme as default $ drush config-set system.theme default themetest
    or copy the includes/themetest.drush.inc into your .drush folder.
  - Run the provided drush install script: $ drush themetest-install
  - The script will first ask you to enter your theme name (eg. My Theme).
    Second, it will ask you to enter a machine name (eg. my_theme).
  - After complete, you can enable your new theme: $drush en my_theme
  - At this time, you can uninstall themetest: $drush pmu themetest
  - Commence work on your theme!

2. MANUAL: To manually change the name of the theme follow these steps BEFORE
   enabling the theme:

  - Rename the theme folder to 'mytheme'
  - Rename themetest.info.yml to mytheme.info.yml
  - edit themetest.info.yml and change the name, description, project (can be
    deleted), and change all other instances of 'themetest' to 'mytheme'
  - Rename themetest.libraries.yml to mytheme.libraries.yml
  - Rename themetest.theme to mytheme.theme
  - in themetest.theme, change each instance of 'themetest' to 'mytheme'
  - Rename config/schema/themetest.schema.yml to mytheme.schema.yml
  - Rename each file in config/install from block.block.themetest_tools.yml (for
    example) to block.block.mytheme_tools.yml
  - Every file in config/install, change each instance of 'themetest' to
    'mytheme'
  - In js/source/scripts.js, change each instance of 'themetest' to 'mytheme'
  - In theme-settings.php, change each instance of 'themetest' to 'mytheme'
  - In templates/html.html.twig, change each instance of 'themetest' to 'mytheme'
  - In templates/menu-local-tasks.html.twig, change each instance of 'themetest' to
    'mytheme'
  - In templates/status-messages.html.twig, change each instance of 'themetest' to
    'mytheme'

  When renaming, remember the following:
  - Do not simply replace every instance of 'themetest' in every file in the theme.
    Most of ThemeTest's dependencies use the word 'themetest' somewhere and renaming
    these instances will cause ThemeTest to break in unpredictable ways.
  - If you don't rename all these files, you may get a vague and unhelpful error
    message when attempting to enable your theme: "The website encountered an
    unexpected error. Please try again later." Turn on a higher level of error
    logging in your server's php.ini to help determine what you've missed.
  - If you don't bother renaming ThemeTest in the above locations, be advised that
    you will run into conflicts with other versions of ThemeTest on your site. If
    your site uses more than one theme based on ThemeTest, make sure at least one of
    the themes has been renamed properly!


============================
How to compile SASS in ThemeTest
============================

To use SASS and automatically compile it within your theme, please refer to "How
to Use Grunt with ThemeTest" in the documentation below.

Install node-sass:

  npm install node-sass -g

If you don't like Grunt, or would just prefer to use SASS' internal watch
functionality, simply cd into your theme directory and run:

  node-sass sass -o css --output-style expanded --source-map true --watch

Or simply compile the latest:

  node-sass sass -o css --output-style expanded --source-map true


=======================
What are the files for?
=======================

- themetest.info.yml
  Provide informations about the theme, like regions and libraries.
- block.html.twig
  Template to edit the blocks.
- comment.html.twig
  Template to edit the comments.
- node.html.twig
  Template to edit the nodes (in content).
- page.html.twig
  Template to edit the page.
- themetest.theme
  Used to modify Drupal's default behavior before outputting HTML through the
  templates.
- theme-settings.php
  Provides additional settings in the theme settings page.


============
In /sass
============

- layout/layout.sass
  Defines the layout of the theme (compiles to css/layout/layout.css)
- theme/print.sass
  Defines the way the theme looks when printed (compiles to css/theme/print.css)
- components/tabs.sass
  Styles for the admin tabs (compiles to css/components/tabs.css)


============
In /js
============

- modernizr.js
  Modernizr detects HTML and CSS features and applies classes to
  the <html> object you can then reference in your stylesheets. Use the URL at
  the top of the modernizr.js file to customize the features you wish to detect.
- selectivizr-min.js
  This script will only be loaded for Internet Explorer 8
  through the ie8 theme library. It will provide a JS fallback for CSS :nth-
  child, an important part of the Bourbon Neat grid system, as it is not
  supported in Internet Explorer 8.
- build/scripts.js & source/scripts.js
  When using Grunt, save files to the
  source folder and a minified version will automatically be saved to the build
  folder. See comments in themetest.libraries.yml file to enable the starter
  scripts.js file.


===================
Changing the Layout
===================

The layout used in ThemeTest is fairly similar to the Holy Grail method. It has been
tested on all major browsers including IE (5 to >10), Opera, Firefox, Safari,
and Chrome. The purpose of this method is to have a minimal markup for an ideal
display. For accessibility and search engine optimization, the best order to
display a page is the following:

1. Header
2. Content
3. Sidebars
4. Footer

This is how the page template is buit in ThemeTest, and it works in fluid and fixed
layout. Refer to the notes in layout.sass to see how to modify the layout.


===========================
How to Use Grunt with ThemeTest
===========================

Grunt (http://gruntjs.com/) requires Node.JS to be installed on your machine.
There are various package managers that can handle this for you.

https://nodejs.org/download/

Once Node.JS is installed, go to the root folder of ThemeTest and install your Grunt
packages:

  npm install

This will install the neccessary node_modules to run Grunt. In order for Grunt
to work from the command line we are going to need the Grunt CLI. Open a new
Terminal window and type:

  npm install -g grunt-cli

This will install the CLI globally. Restart terminal when that is complete and
you will now be able to use Grunt commands.

Once installed, cd to the root folder of ThemeTest and run Grunt via the command
line:

  grunt

This will initialize Grunt and start watching changes to your SASS files. Voilà!


==============
Updating ThemeTest
==============

Once you start using ThemeTest, you will massively change it until you reach the
point where it has nothing to do with ThemeTest anymore. Unlike Zen, ThemeTest is not
intended to be use as a base theme for a sub-theme (even though it is possible
to do so). Because of this, it is not necessary to update your theme when a new
version of ThemeTest comes out. Always see ThemeTest as a STARTER, and as soon as you
start using it, it is not ThemeTest anymore, but your own theme.

If you didn't rename your theme, but you don't want to be notified when ThemeTest
has a new version by the update module, simply delete "project = "themetest" in
themetest.info.yml.


================
Bugs & Questions
================

Thanks for using ThemeTest, and remember to use the issue queue in drupal.org for
any questions or bug reports:

http://drupal.org/project/issues/themetest


====================
Current maintainers:
====================
* Steve Krueger (SteveK)              - https://www.drupal.org/u/stevek
* Leah Marsh (leahtard)               - https://www.drupal.org/u/leahtard
* Joël Pittet (joelpittet)            - https://www.drupal.org/u/joelpittet
* Catherine Winters (CatherineOmega)  - https://www.drupal.org/u/catherineomega
* Johannes Schmidt (johannez)         - https://www.drupal.org/u/johannez
