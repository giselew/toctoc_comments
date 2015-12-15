.. ==================================================
.. FOR YOUR INFORMATION
.. --------------------------------------------------
.. -*- coding: utf-8 -*- with BOM.

.. include:: ../../Includes.txt


.. _designing-the-plugin-javascript:

JavaScript
----------

.. index::
	single: Frontend; JavaScript

There are 2 basic JavaScript files for all the comment- and ratings-specific tasks, one is included
in the header of the page automatically from the template, the other is added to the footer of the
webpage.

Uncompressed versions of 3 **toctoc_comments**  JavaScript files as well of jQuery.sharrre and
jQuery.watermark are in file res/js/js.uncompressed.zip

Header: res/js/tx-tc-**versionnumber** .js

Footer: res/js/tx-tc-ftr-**versionnumber** .js

When AJAX Login is active, then additionally file res/js/tx-tc-afl-**versionnumber** .js is added in
the <head>-part of the webpage

.. toctree::
    :maxdepth: 2
    :titlesonly:

    Jqueryextensions/Index
    JqueryPluginsUsed1/Index
    TemporaryJavascriptFiles/Index
