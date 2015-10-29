.. ==================================================
.. FOR YOUR INFORMATION
.. --------------------------------------------------
.. -*- coding: utf-8 -*- with BOM.

.. include:: ../../../Includes.txt


.. _introduction-features-administration-module-in-typo3:

Administration module in TYPO3 Backend
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

Adds a backend module **Comments** in TYPO3 Module section **Web**

Module has 4 sub modules: Comment-Administration, User-Administration, **Banned IPs** and Reports

Comment-Administration: Bulk actions for approving, disapproving, deleting, hiding and showing
comments

User-Administration: Bulk actions for deleting user data from frontend (delete), deleting user data
in database (kill data), merge of users (including comments and related data) into another user.

With **Banned IPs** you can update a list of IPs that are not allowed to leave comments using a
black list from Spamhaus.org

In Reports you find 4 reports: 

Sessions: Shows current PHP-sessions, possibility to delete sessions or black list IPs.

Active User: Shows Users with activities one the site (You need to be placed on the Root Folder or a
Sysfolder containing **toctoc_comments**  records.)

Crawler protocol: Shows which crawlers accessed pages holding AJAX Social Network Components

Blacklist protocol: Shows access by black listed IPs/IP ranges
