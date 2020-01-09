# About TYPEMILL

TYPEMILL is a small flat file cms created for editors and writers. It provides a author-friendly dashboard and a visual-block-editor for markdown based on vue.js. Use TYPEMILL for manuals, documentations, web-books and similar publications. The website http://typemill.net itself is an example for TYPEMILL.

![TYPEMILL Screenshot](https://typemill.net/media/tm-demo.gif)

## Features

* Creates a website based on markdown files.
* Provides an author-friendly visual markdown editor (work in progress, based on VUE.js).
* Provides a pure markdown editing mode.
* Markdown supports table of contents (TOC), tables, footnotes, abbreviations and definition lists.
* Create and sort pages with drag & drop in the navigation.
* Configure the system, the themes and the plugins in the dashboard.
* Create and manage users.
* Develop configurable plugins with the Symfony Event Dispatcher.
* Develop configurable themes with TWIG.
* Allows super easy backend and frontend forms with simple YAML-files.
* Ships with a fully responsive standard theme
* Ships with plugins for 
  * Search
  * MathJax and KaTeX.
  * Code highlighting.
  * Matomo/Piwik and Google Analytics.
  * Cookie Consent.

## Requirements

* PHP 7+
* Apache server
* mod_rewrite and htaccess

If you run a linux system, then please double check that mod_rewrite and htaccess are active!!!

## Installation

Download TYPEMILL from the [TYPEMILL website](http://typemill.net), unzip the files and you are done.

If you are a developer, you can also clone this repository. To do so, open your command line, go to your project folder (e.g. htdocs) and type:

    git clone git://github.com/trendschau/typemill.git

The GitHub-version has no vendor-folder, so you have to update and include all libraries and dependencies with composer. To do so, open your command line, go to your TYPEMILL folder and type:

    composer update

If you did not use composer before, please go to the [composer website](http://getcomposer.org) and start to learn.

To run TYPEMILL on a **live** system, simply upload the files to your server

## Make Folders Writable.

Make sure that the following folders and all their files are writable (permission 774 recursively):

* cache
* content
* media
* settings

You can use your ftp-software for that.

## Setup

Please go to `your-typemill-website.com/setup`, create an initial user and configure your system in the author panel. 

## Login

You can find your login screen under `/tm/login` or simply go to `/setup` and you will be redirected to the login-page. 

## Documentation

You can read the full documentation for writers, for theme developers and for plugin developers on the [TYPEMILL website](http://typemill.net).

## Licence

TYPEMILL is published under MIT licence. Please check the licence of the included libraries, too.

## Contributors & Supporters

* [Severo Juliano](https://github.com/iusvar) did the internationalization i18n.
* [Eziquel Bruni](https://github.com/EzequielBruni) edits the typemill documentation.
* [Ricky](https://github.com/rbertram90) developed the discard functionality.
* [vodaris](https://www.vodaris.de) sponsored the development of the search plugin.

## How to Contribute

Typemill is still in an early stage and contributions are highly welcome. 

You can check the [roadmap for Typemill](https://github.com/typemill/typemill/issues/35) and scroll through the issues. I will mark issues in future that are easy to start with or where help is highly appreciated.

Here are some contribution-ideas for non-coder:

* Find bugs and errors (open a new issue on github for it).
* Improve the documentation.
* Describe some missing features and explain, why they are important for other users.
* Write a blog post about typemill.

Some ideas for devs (please fork this repository make your changes and create a pull request):

* Fix a bug.
* Create or port a theme, especially for documentations, knowlegde bases or web-books.
* Create a fancy plugin.
* An auto-update functionality for core system, plugins and themes is highly needed.
* Improve the accessibility of html and css.
* Implement user roles and rights with RBAC or ACL.

For hints, questions, problems and support, please open up a new issue on GitHub.

## Support

This is an open source project. I love it and I spend about 20 hours a week on it (starting in 2017). There is no business model right now, but you can support this project with a donation or simply hire me for implementations.

Donate: https://www.paypal.me/typemill

## Follow

Twitter: https://twitter.com/typemill