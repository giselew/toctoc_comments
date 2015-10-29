.. ==================================================
.. FOR YOUR INFORMATION
.. --------------------------------------------------
.. -*- coding: utf-8 -*- with BOM.

.. include:: ../../Includes.txt


.. _configuration-usercenter:

userCenter
----------

TypoScript options in userCenter concern
the structure of the user center, which is plugin mode 6. 


All userCenter options are valid per webpage (W) and were introduced with version 6.6.0

=================  ==========  =======================================================  =============================================
**Property:**      Data type:  Description:                                             Default:
=================  ==========  =======================================================  =============================================
uCLists            string      Comment-Lists to be distinguished in user center.        Reviews, Plugintotablemap, Commentsoncomments
                               comma-separated list. Possible values: Reviews,
                               Plugintotablemap, Commentsoncomments. Normal comments
                               are always shown as a list, also iLikes und Votings
                               will always have their lists.
-----------------  ----------  -------------------------------------------------------  ---------------------------------------------
commentsPerUCList  int+        Comments per list: Number of visible comments shown per  3
                               list
-----------------  ----------  -------------------------------------------------------  ---------------------------------------------
userCenterPageID   int+        ID of your page with userCenter, link shown in menu on
                               comments list
-----------------  ----------  -------------------------------------------------------  ---------------------------------------------
maxItemsPerUCList  int+        Items per list: Maximal number of items shown per list   50
-----------------  ----------  -------------------------------------------------------  ---------------------------------------------
maxItemAgeUCList   int+        Maximal age of items shown in list: Items older than     365
                               this number (in days) won't be shown in the lists
=================  ==========  =======================================================  =============================================
