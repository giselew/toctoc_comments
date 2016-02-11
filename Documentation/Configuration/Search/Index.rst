.. ==================================================
.. FOR YOUR INFORMATION
.. --------------------------------------------------
.. -*- coding: utf-8 -*- with BOM.

.. include:: ../../Includes.txt


.. _configuration-search:

search
------

TypoScript options in search concern
the structure of the comments search which is plugin mode 7. 

All userCenter options are valid per webpage (W) and were introduced with version 7.1.0

=======================  ==========  =====================================================  ========
**Property:**            Data type:  Description:                                           Default:
=======================  ==========  =====================================================  ========
showCommentsPerPage      int+        Number of found comments shown in search result        5
-----------------------  ----------  -----------------------------------------------------  --------
initialCommentage        options     Initial setting for the age of comments to search for  6

                                     1=1 day, 2=7 days, 3 =1 month, 4=last 6 months, 5=1
                                     year, 6=ever
-----------------------  ----------  -----------------------------------------------------  --------
minSearchTermLength      int+        Minimal size of the term to search for                 4
-----------------------  ----------  -----------------------------------------------------  --------
SearchCommentCropLength  int+        Cropping of the shown found comments.                  200
-----------------------  ----------  -----------------------------------------------------  --------
SearchDisplayTitle       boolean     Displays a title on top of the search box              1
-----------------------  ----------  -----------------------------------------------------  --------
**Options setup-only**
-----------------------  ----------  -----------------------------------------------------  --------
searchMaxComments        int+        Maximum number of comments to be retrieved in the      1000
                                     frontend
-----------------------  ----------  -----------------------------------------------------  --------
linkComments             boolean     Link title and comments (1) or only title (0) to       0
                                     original comment
=======================  ==========  =====================================================  ========
