.. ==================================================
.. FOR YOUR INFORMATION
.. --------------------------------------------------
.. -*- coding: utf-8 -*- with BOM.

.. include:: ../../../Includes.txt


.. _users-manual-data-protection-typoscript-options-relevant:

TypoScript options relevant for data protection
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

advanced.acceptTermsCondsOnSubmit
specify an ID of your page with term and
conditions, the link shows up beside the submit button in commenting forms. When the ID is specified
the terms and conditions must be accepted before submitting a comment

dataProtect.setCookie = 1
Set (1) or don't set (0) a cookie with data of not logged
in commenters

dataProtect.cookieLifetime = 31
Lifetime in days for a cookie, minimum is 7 days

dataProtect.useDisclaimer = 1
Shows a Disclaimer menu point above the comments
list. (1)

dataProtect.useDisclaimerInRatingsOnly = 0
Shows a Disclaimer menu point when only
ratings are shown (ratings.ratingsOnly=1)

dataProtect.disclaimerPageID =
ID of your page with additional policy for
dataprotection, link shown in disclaimer menu

dataProtect.disclaimerSystemCheck = 1
Checks if database is on same server, checks
if https is enabled and then shows a security rating of the site.

dataProtect.disclaimerFromTocToc = 1
Shows the software creators disclaimer in the
disclaimer

dontSkipSearchEngines = 0
comments are hidden from search engines, if you want
search engines to index all your comments set this option to 1
