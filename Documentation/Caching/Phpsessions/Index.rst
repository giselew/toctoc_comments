.. ==================================================
.. FOR YOUR INFORMATION
.. --------------------------------------------------
.. -*- coding: utf-8 -*- with BOM.

.. include:: ../../Includes.txt


.. _caching-phpsessions:

PHP-Sessions
------------

**toctoc_comments** uses a **named session**  to avoid conflicts with other sessions. 

**toctoc_comments** saves its **session-data in a subfolder of /pi1/sessionTemp/TocTocCommentsSessions** . 
This allows the extension to fix the time how long sessions will remain active. 

With TS option sessionTimeout this time can be adjusted. 

It's by default set to a generous value of 1 days and 12 hours (2160 minutes).

This means that in this time all needed information to make AJAX-requests will be
present. One can leave open the browser over one day and the click an iLike for example – it will
still work because the Session is still there.

In the backend in the comment-module, in reports, you find a report showing the present sessions.
