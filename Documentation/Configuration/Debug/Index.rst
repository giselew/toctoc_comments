.. ==================================================
.. FOR YOUR INFORMATION
.. --------------------------------------------------
.. -*- coding: utf-8 -*- with BOM.

.. include:: ../../Includes.txt


.. _configuration-debug:

debug
-----

All debug options are valid per webpage
(W)

=======================  ==========  ====================================================  ========
**Property:**            Data type:  Description:                                          Default:
=======================  ==========  ====================================================  ========
useDebug                 boolean     Use of debugging features such as run-times, caching  0
                                     and session resets.
-----------------------  ----------  ----------------------------------------------------  --------
useDebugFeUserIds        string      List with Fe_users.uid that are used for debugging,   
                                     comma-separated
-----------------------  ----------  ----------------------------------------------------  --------
**Options setup-only**
-----------------------  ----------  ----------------------------------------------------  --------
showStartupDetails       boolean     Show details on Startup-times useDebug must be 1 and  0
                                     useDebugFeUserId set to correct fe_users.uid.
-----------------------  ----------  ----------------------------------------------------  --------
showLibDetails           boolean     Show details on times used in main file               0
                                     toctoc_comment_lib.php. useDebug must be 1 and
                                     useDebugFeUserId set to correct fe_users.uid.
-----------------------  ----------  ----------------------------------------------------  --------
showDropsfromBoxmodel    boolean     Inconsistent entries in a boxmodel get dropped. Here  0
                                     you can turn on the protocol to see the drops
-----------------------  ----------  ----------------------------------------------------  --------
showCSScomments          boolean     Inserts comments in final CSS-output referencing      0
                                     boxmodell additions and more meta information on how
                                     the CSS was buildt.

                                     \(S) (V 5.0.0.)
=======================  ==========  ====================================================  ========
