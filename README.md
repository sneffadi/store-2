# WP-STORE - 2

This is the store theme with a colored ratings box that appears below the content (as opposed to the TME-type theme)

## Requirements

Run ```foundation update``` in the terminal to update Foundation to the latest version. (After an upgrade you must run ```npm run build``` to recompile files).

Many project force their users to install [Bower](http://bower.io) and [Grunt](http://gruntjs.com/) globally. We don't like that and decided to use them via `npm scripts` which means, that Grunt and Bower are installed in your `node_modules` folder and we'll call them there.

## Quickstart

$ npm install
$ npm run watch
$ npm run build
$ npm run grunt -- sass
$ npm run grunt -- copy

Check for Foundation Updates:
$ foundation update


### Stylesheet Folder Structure

  * `style.css`: Do not worry about this file. (For some reason) it's required by WordPress. All styling are handled in the Sass files described below

  * `scss/foundation.scss`: Imports for Foundation components and your custom styles.
  * `scss/config/_settings.scss`: Original Foundation 5 base settings
  * `scss/config/_custom-settings.scss`: Copy the settings you will modify to this file. Make it your own
  * `scss/site/*.scss`: Unleash your creativity and make it look perfect. Create the files you need (and remember to make import statements for all your files in scss/foundation.scss)

  * `css/foundation.css`: All Sass files are minified and compiled to this file
  * `css/foundation.css.map`: CSS source maps

### Script Folder Strucutre

  * `bower_components/`: This is the source folder where all Foundation components are located. `foundation update` will check and update scripts in this folder.

  * `js/custom`: This is where you put all your custom scripts. Every .js file you put in this directory will be minified and concatinated to [foundation.js](https://github.com/olefredrik/FoundationPress/blob/master/js/foundation.js)

  * `js/vendor`: Vendor scripts are copied from `bower_components/` to this directory. We use this path for enqueing the vendor scripts in WordPress.

  * Please note that you must run `npm run build` in your terminal for the script to be copied and concatinated. See [Gruntfile.js](https://github.com/olefredrik/FoundationPress/blob/master/Gruntfile.js) for details


## Unit Testing With Travis CI

FoundationPress is completely ready to be deployed to and tested by Travis CI for WordPress Coding Standards and best practices. All you need to do to activate the test is sign up and follow the instructions to point Travis CI towards your repo. Just don't forget to update the status badge to point to your repositories unit test.
[Travis CI](https://travis-ci.org/)

## Documentation
* [Zurb Foundation Docs](http://foundation.zurb.com/docs/)

Component to create:
