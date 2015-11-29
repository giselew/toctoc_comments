.. ==================================================
.. FOR YOUR INFORMATION
.. --------------------------------------------------
.. -*- coding: utf-8 -*- with BOM.

.. include:: ../../../Includes.txt


.. _introduction-features-new-in-versions-7xx:

New in versions 7.x.x
^^^^^^^^^^^^^^^^^^^^^

.. index::
	single: News; Version 7

- toctoc_comments 7.0.0 the same like toctoc_comments 6.0.0 – it's a compatibility release for
  TYPO3 Version 7 and PHP 5.6
- Version 7.1.0 introduced a new plugin mode (7) which allows to search for comments containing a
  given word.
- Version 7.2.0 is compatible with Extension **toctoccommentsce** , an extension adding a new Tab to
  Content elements with enables Comments or ratings below the content element
- Version 7.3.0 removed the dependency to EXT:felogin, added Google+-Login and in attachments –
  for webpagepreviews on pages from soundcloud.com the Soundcloud-API is used now, localization for
  Facebook and Google+ is made by the extension with a coded map of corresponding language-codes
- Version 7.4.0 brings a Reports sub module into the backend module with 4 reports: 
- Sessions: Shows current PHP-sessions, possibility to delete sessions or black list
  IPs.
- Active User: Shows Users with activities one the site (You need to be placed on the Root Folder or a Sysfolder containing toctoc_comments records.)
- Crawler protocol: Shows which crawlers accessed pages holding AJAX Social Network Components
- Blacklist protocol: Shows access by black listed IPs/IP ranges
- User registration: Now COI is possible
- Version 7.4.1 brings news in the AJAX Login and -registration-Component: Administrator Confirmation for new users and HTML-E-Mails for forgot passwort requests.
- Included ViewHelpers for extension **news**  work now up to TYPO3 7.4.0.
