.. ==================================================
.. FOR YOUR INFORMATION
.. --------------------------------------------------
.. -*- coding: utf-8 -*- with BOM.

.. include:: ../../Includes.txt


.. _designing-the-plugin-jquery-1:

jQuery
------

.. index::
	single: Frontend; jQuery

**jQuery:**  It's up to the programmer who put the extension in your site to link the jQuery-File.


Often jQuery is already used in a site, then you just need to
make sure that the version of the jQuery in use is newer than 1.8.

jQuery must be loaded before all other JavaScript files, thus in the beginning of the <head> of the
webpage.

We deliver a working version (1.10.2) in directory /resources if you don't use it already.

**Note** : Lightboxes often use the rel=sometext[index] – syntax in the href tags.

Newer versions of jQuery do not support the [] brackets anymore. To make it work
again make the brackets disappear.

! Do not use the present file res/js/jquery.js for the frontend, This version of jQuery is used in
the backend and it's version is to low for the frontend. Use the jQuery in /resources if you need
one in the frontend.

**jQuery tools:**  jquery.tools.min.js is present in folder res/js, 
but please use jquery.toctoc.tools.min.js. 
