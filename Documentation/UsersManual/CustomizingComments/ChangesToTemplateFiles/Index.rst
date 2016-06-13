.. ==================================================
.. FOR YOUR INFORMATION
.. --------------------------------------------------
.. -*- coding: utf-8 -*- with BOM.

.. include:: ../../../Includes.txt


.. _users-manual-customizing-comments-changes-to-template-files:

Changes to template files
^^^^^^^^^^^^^^^^^^^^^^^^^

**toctoc_comments**  is an AJAX-based solution. 
Normally a marker can be set-up
anywhere in a sub-template and it will work. 
But if a marker is needed in an AJAX
process, the zone where markers can be moved is mostly limited by the **CSS-selectors with id's**
inside the sub-template

**Recommendation:** You can change the templates for email or the eID-pages – but **please don't
touch the templates for ratings and comments** . 
There is always a solution with TypoScript or LESS
