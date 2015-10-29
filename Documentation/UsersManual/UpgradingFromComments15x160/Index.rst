.. ==================================================
.. FOR YOUR INFORMATION
.. --------------------------------------------------
.. -*- coding: utf-8 -*- with BOM.

.. include:: ../../Includes.txt


.. _users-manual-upgrading-from-comments-15x160:

Upgrading from comments 1.5.x/1.6.0
-----------------------------------

You need to enable the upgrade mode in the
extension setup in Extension Manager.

When upgrade-mode is enabled, the comments
and ratings for comments on a page are imported in **toctoc_comments** regardless of their original
storage folder id.

For importing data data replace the
**comments** plugin by **toctoc_comments**-plugin and open the page. At this moment the data of
this page is imported from the tx_comments-tables to tx_toctoc_comments-tables.


After the update disable the update option again.
