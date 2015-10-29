.. ==================================================
.. FOR YOUR INFORMATION
.. --------------------------------------------------
.. -*- coding: utf-8 -*- with BOM.

.. include:: ../../Includes.txt


.. _configuration-dataprotect:

dataProtect
-----------

TypoScript options in dataProtect concern
data protection such as use of cookies and disclaimer 

All dataProtect options are valid per site (S) and were introduced with version 5.5.0

see also chapter “data protection”

==========================  ==========  =======================================================  ========
**Property:**               Data type:  Description:                                             Default:
==========================  ==========  =======================================================  ========
setCookie                   boolean     Set (1) or don't set (0) a cookie with data of not       1
                                        logged in commenter
                                        Cookie data is
                                        stored in encoded (unreadable) format.
--------------------------  ----------  -------------------------------------------------------  --------
useDisclaimer               boolean     Shows a Disclaimer menu point above the comments list.   1
                                        (1)
--------------------------  ----------  -------------------------------------------------------  --------
useDisclaimerInRatingsOnly  boolean     Shows a Disclaimer menu point when only ratings are      0
                                        shown (ratings.ratingsOnly=1)
--------------------------  ----------  -------------------------------------------------------  --------
disclaimerPageID            int+        ID of page with additional policy for data protection,
                                        link shown in disclaimer menu
--------------------------  ----------  -------------------------------------------------------  --------
disclaimerSystemCheck       boolean     Checks cookies, if database is on same server, checks    1
                                        if https is enabled and then shows a security rating of
                                        the site.
--------------------------  ----------  -------------------------------------------------------  --------
disclaimerFromTocToc        boolean     Shows the software creators disclaimer in the            1
                                        disclaimer

                                        It links to a webpage on toctoc.ch
==========================  ==========  =======================================================  ========
