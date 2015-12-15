.. ==================================================
.. FOR YOUR INFORMATION
.. --------------------------------------------------
.. -*- coding: utf-8 -*- with BOM.

.. include:: ../../Includes.txt


.. _configuration-spamprotect:

spamProtect
-----------

=========================  ==========  =======================================================  ============================================
Property:                  Data type:  Description:                                             Default:
=========================  ==========  =======================================================  ============================================
requireApproval            boolean     If enabled, messages will be set to disapproved state    1
                                       and notification will be sent to administrator (see
                                       **notificationEmail**  below). If approval is not
                                       requested but **checkTypicalSpam**  is set, messages
                                       still can be set to disapproved state and notification
                                       is sent. (P – Anti-Spam –
                                       Require approval
                                       of each comment)
-------------------------  ----------  -------------------------------------------------------  --------------------------------------------
useCaptcha                 string      Enables using captcha to post comments. Possible values
                                       are:

                                       Captcha is checked after submit !

                                       (P – Anti-Spam – Use captcha)
-------------------------  ----------  -------------------------------------------------------  --------------------------------------------
checkTypicalSpam           boolean     If set, extension automatically checks all comments for  1
                                       typical guest-book spam. If comments receives more than
                                       the value of spamCutOffPoint spam points, it is
                                       automatically set to disapproved state and notification
                                       is sent to the author in the plugin.
-------------------------  ----------  -------------------------------------------------------  --------------------------------------------
spamCutOffPoint            integer     If number of points is greater than this value, new      10
                                       comment is ignored, user receives spam warning message
                                       and e-mail to administrator is not sent.
-------------------------  ----------  -------------------------------------------------------  --------------------------------------------
freecapBackgoundcolor      string      freecaptcha-clone Backgoundcolor: Use valid rgb-code     255, 255, 255
                                       like 225,225, 225
-------------------------  ----------  -------------------------------------------------------  --------------------------------------------
freecapTextcolor           string      freecaptcha-clone textcolor:Use valid rgb-code like      95, 107, 200
                                       25,25, 25
-------------------------  ----------  -------------------------------------------------------  --------------------------------------------
freecapNumberchars         int+        Number of characters freecaptcha-clone:max is 10, min    4
                                       is 3
-------------------------  ----------  -------------------------------------------------------  --------------------------------------------
freecapHeight              int+        Height for freecaptcha-clone: max is 50, min is 23.      23
-------------------------  ----------  -------------------------------------------------------  --------------------------------------------
notificationEmail          string      E-mail address to send notifications to

                                       (P – Anti-Spam – Send notification to this email)
-------------------------  ----------  -------------------------------------------------------  --------------------------------------------
informationEmail           string      Notify administrator about posted comment without
                                       approval by e-mail
-------------------------  ----------  -------------------------------------------------------  --------------------------------------------
fromEmail                  string      E-mail address to send notifications from

                                       (P – Anti-Spam – Send email from this address)
-------------------------  ----------  -------------------------------------------------------  --------------------------------------------
fromEmailName              string      From e-mail Sendername:Notification to administrator     %site% - Administrator
                                       about posted comment is sent from this name.

                                       %site% is replaced by your sitename

                                       ( V5.3.0.)
-------------------------  ----------  -------------------------------------------------------  --------------------------------------------
emailTemplateHTML          string      HTML-template to use for approval needed-notification    EXT:toctoc_comments/res/template/
                                       email to administrator. Is also used for simple          toctoccomments_template_email.html
                                       notifications without approval.
-------------------------  ----------  -------------------------------------------------------  --------------------------------------------
emailTemplate              string      Template to use for Approval needed-notification email   EXT:toctoc_comments/res/template/
                                       to administrator. It will result in a simple             toctoccomments_template_email.txt
                                       text-E-mail.
-------------------------  ----------  -------------------------------------------------------  --------------------------------------------
emailTemplateInfo          string      Template to use for information-notification email to    EXT:toctoc_comments/res/template/
                                       administrator                                            toctoccomments_template_emailinfo.txt                                                    
-------------------------  ----------  -------------------------------------------------------  --------------------------------------------
emailTemplatecoiHTML       string      HTML-E-mail template for confirmed opt in:, it's used    EXT:toctoc_comments/res/template/
                                       for confirmed opt in-request email to user who made a    toctoccomments_template_email_coi.html
                                       comment first time using his email-address.
-------------------------  ----------  -------------------------------------------------------  --------------------------------------------
emailcoiTemplate           string      Text-E-mail template for confirmed opt in:, it's used    EXT:toctoc_comments/res/template/
                                       for confirmed opt in-request email to user who made a    toctoccomments_template_email_coi.txt
                                       comment first time using his email-address.
-------------------------  ----------  -------------------------------------------------------  --------------------------------------------
useIPblocking              boolean     Enables IP-Blocklists in frontend, if enabled comments   1
                                       by blocked IPs are evaluated as spam
-------------------------  ----------  -------------------------------------------------------  --------------------------------------------
confirmedOptIn                         Enables Confirmed opt-in (COI): When a
                                       commentator sends his email first time, then he will
                                       receive a confirmation email and he needs to confirm
                                       his email address by clicking a link, which changes the
                                       state “hidden” of his comment from false to true.
                                       Remark: the comment might not be approved yet, this
                                       works in addition to coi and needs just to be handled
                                       normally.
-------------------------  ----------  -------------------------------------------------------  --------------------------------------------
emailTemplateDislikeHTML   string      HTML-E-mail template notification on too many            EXT:toctoc_comments/res/template/
                                       dislikes                                                 toctoccomments_template_email_dislike.html
                                       HTML-Template to use for
                                       notification email for dislike-alerts to administrator
-------------------------  ----------  -------------------------------------------------------  --------------------------------------------
emailTemplateDislike       string      E-mail template for notification on too many             EXT:toctoc_comments/res/template/
                                       dislikes                                                 toctoccomments_template_emaildislike.txt
                                       Template to use for
                                       notification email for dislike-alerts to administrator
-------------------------  ----------  -------------------------------------------------------  --------------------------------------------
checkSMTPService           boolean     Enables check of SMTP-Service before send: This feature
                                       needs PHP extension sockets to be compiled in the
                                       PHP-binary. It makes sending mail more safe and errors
                                       can be detected more easily. Requires SMTP-Service to
                                       be configurend correctly in INSTALL-Tool of TYPO3

                                       V 7.0.2)
-------------------------  ----------  -------------------------------------------------------  --------------------------------------------
commentWaitTime            integer     Wait time between comments: Number of minutes an user    1
                                       has to wait before they may post another comment
                                       (includes all pages)
-------------------------  ----------  -------------------------------------------------------  --------------------------------------------
Options from setup.txt
-------------------------  ----------  -------------------------------------------------------  --------------------------------------------
considerReferer            boolean     If set, checks that referrer of the current page is
                                       within the same web site. If not, message is set to
                                       disapproved state and notification is sent to
                                       administrator. (P – Anti-Spam –
                                       Check referrer)
=========================  ==========  =======================================================  ============================================
