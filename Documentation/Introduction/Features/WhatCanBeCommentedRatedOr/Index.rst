.. ==================================================
.. FOR YOUR INFORMATION
.. --------------------------------------------------
.. -*- coding: utf-8 -*- with BOM.

.. include:: ../../../Includes.txt


.. _introduction-features-what-can-be-commented-rated-or:

What can be commented, rated or shared ?
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

=======================================  ================  ==========  =======
\                                        Comments/Reviews  Ratings     Sharing
---------------------------------------  ----------------  ----------  -------
Pages                                    Yes \*\*\*        Yes \*\*\*  Yes
---------------------------------------  ----------------  ----------  -------
Content Elements                         Yes               Yes         Yes \*
---------------------------------------  ----------------  ----------  -------
Multiple times in content elements \*\*  Yes               Yes         Yes \*
---------------------------------------  ----------------  ----------  -------
Records in extensions DETAIL views       Yes               Yes         Yes \*
---------------------------------------  ----------------  ----------  -------
News in tt_news LIST view                Yes               Yes         Yes \*
---------------------------------------  ----------------  ----------  -------
Ratings on comments                      NA                Yes         NA
---------------------------------------  ----------------  ----------  -------
Specified content elements               Yes               Yes         Yes \*
---------------------------------------  ----------------  ----------  -------
Specified records                        Yes               Yes         Yes \*
=======================================  ================  ==========  =======

\* Sharing shows up but the sharing content is always the page containing the
comments.

\*\* Possible In TemplaVoila flexible content elements (FCE), plugin
identification is achieved with OptionalRecordIDs.

\*\*\* Comments and ratings on pages imply that only one **toctoc_comments**  plugin is present
on a page. 

TemplaVoila
"""""""""""

Shortcuts to plugins on other pages work
Can be used in FCE as TypoScript-Only Object

TypoScript-Object
"""""""""""""""""

**toctoc_comments**  can be used as TypoScript-Object and placed in the page by TypoScript

PHP code of other pibase-extensions
"""""""""""""""""""""""""""""""""""

Plugin can be called from code for a specific record. (comparable to a ViewHelper)
