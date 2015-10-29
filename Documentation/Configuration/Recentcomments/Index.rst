.. ==================================================
.. FOR YOUR INFORMATION
.. --------------------------------------------------
.. -*- coding: utf-8 -*- with BOM.

.. include:: ../../Includes.txt


.. _configuration-recentcomments:

recentcomments
--------------

All options are setup only (no
constants)

=========================  ==========  =======================================================  ==========
**Property:**              Data type:  Description:                                             Default:
=========================  ==========  =======================================================  ==========
listCount                  int+        Number of comments shown in the list                     3

                                       (P – General, Recent Comments –
                                       Number of recent comments to
                                       display)
-------------------------  ----------  -------------------------------------------------------  ----------
sorting                    string      Sorting of recent comments                               uid DESC
-------------------------  ----------  -------------------------------------------------------  ----------
anchorPre                  string      Anchor prefix used when highlighting comments after      #tx-tc-ct-
                                       clicking on a link
-------------------------  ----------  -------------------------------------------------------  ----------
linkComments               boolean     If set to 1 (default) Comments are linked to the         1
                                       original sources.
-------------------------  ----------  -------------------------------------------------------  ----------
maxCharCount               int+        Number of characters before the comment is cropped       100
-------------------------  ----------  -------------------------------------------------------  ----------
restictToprefixToTableMap  string      The custom external prefix for recent comments triggers
                                       specific records like News, Products or other records
                                       with associated comments.

                                       (P –
                                       General, Recent Comments – Custom triggering prefix
                                       for recent comments)
=========================  ==========  =======================================================  ==========
