.. ==================================================
.. FOR YOUR INFORMATION
.. --------------------------------------------------
.. -*- coding: utf-8 -*- with BOM.

.. include:: ../../Includes.txt


.. _configuration-commentsreport:

commentsreport
--------------

All options are setup only (no constants),
only one plugin instance on a page is possible.

=====================  ==========  ======================================================  =================================================
**Property:**          Data type:  Description:                                            Default:
=====================  ==========  ======================================================  =================================================
active                 boolean     Set comment reporting active (1) or inactive (0)
---------------------  ----------  ------------------------------------------------------  -------------------------------------------------
reportPid              int+        Report page id:ID of the page where reporting form is
                                   located
---------------------  ----------  ------------------------------------------------------  -------------------------------------------------
emailTemplateFile      string      Text mode template to use for notification email to     EXT:toctoc_comments/res/template/
                                   administrator.                                          toctoccomments_template_reportcomment_email.txt
                                   
---------------------  ----------  ------------------------------------------------------  -------------------------------------------------
HTMLemailTemplateFile  string      HTML-template to use for notification email to          EXT:toctoc_comments/res/template/
                                   administrator.                                          toctoccomments_template_reportcomment_email.html
---------------------  ----------  ------------------------------------------------------  -------------------------------------------------
requiredFields         string      Required fields: for the form, comma-separated list of  From, frommail, text
                                   required fields
---------------------  ----------  ------------------------------------------------------  -------------------------------------------------
useCaptcha             int         [None=0, captcha extension=1, sr_freecap extension=2]   2

                                   Use captcha: Enable captcha usage. (W)
---------------------  ----------  ------------------------------------------------------  -------------------------------------------------
sourceEmail            string      E-mail to send notifications from
---------------------  ----------  ------------------------------------------------------  -------------------------------------------------
destinationEmail       string      E-mail to send notifications to
=====================  ==========  ======================================================  =================================================
