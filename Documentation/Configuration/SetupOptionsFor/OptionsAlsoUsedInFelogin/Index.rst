.. ==================================================
.. FOR YOUR INFORMATION
.. --------------------------------------------------
.. -*- coding: utf-8 -*- with BOM.

.. include:: ../../../Includes.txt


.. _configuration-setup-options-for-options-also-used-in-felogin:

Options also used in felogin
^^^^^^^^^^^^^^^^^^^^^^^^^^^^

The following options you find also in
tx_felogin_pi1. Until version 7.2.0 toctoc_comments imported these options from
tx_felogin_pi1.

.. important::
	With Version 7.3.0 there is no more link between toctoc_comments_pi2 and tx_felogin_pi1

===========================================  ==========  =======================================================  ===================================================================================
**Property:**                                Data type:  Description:                                             Default:
===========================================  ==========  =======================================================  ===================================================================================
storagePid                                   string      Define the Storage Folder with the Website User          
                                                         Records, using a single value
-------------------------------------------  ----------  -------------------------------------------------------  -----------------------------------------------------------------------------------
recursive                                    string      If set, also any subfolders of the storagePid will be
                                                         used
-------------------------------------------  ----------  -------------------------------------------------------  -----------------------------------------------------------------------------------
templateFile                                 string      The template file from toctoc_comments AJAX Login        typo3conf/ext/toctoc_comments/res/template/
                                                                                                                  toctoccomments_template_felogin_pi1.html
-------------------------------------------  ----------  -------------------------------------------------------  -----------------------------------------------------------------------------------
linkConfig                                   array       Typolink Configuration for the generated Links, urls,
                                                         parameter and additionalParams are set by
                                                         extension Arrayelements:
                                                         target =
                                                         ATagParams = rel="nofollow"
-------------------------------------------  ----------  -------------------------------------------------------  -----------------------------------------------------------------------------------
feloginBaseURL                               string      Base url if something other than the system base URL is
                                                         needed
-------------------------------------------  ----------  -------------------------------------------------------  -----------------------------------------------------------------------------------
showForgotPasswordLink                       bool        If set, the section in the template to display the link
                                                         to the forget password dialogue is visible.
-------------------------------------------  ----------  -------------------------------------------------------  -----------------------------------------------------------------------------------
showPermaLogin                               bool        If set, the section in the template to display the
                                                         option to remember the login (with a cookie) is
                                                         visible.
-------------------------------------------  ----------  -------------------------------------------------------  -----------------------------------------------------------------------------------
forgetLinkHashValidTime                      integer     How many hours the link for forget password is valid     12
-------------------------------------------  ----------  -------------------------------------------------------  -----------------------------------------------------------------------------------
newPasswordMinLength                         integer     Minimum length of the new password a user sets           6
-------------------------------------------  ----------  -------------------------------------------------------  -----------------------------------------------------------------------------------
email_from                                   string      Email address used as sender of the change password
                                                         emails
-------------------------------------------  ----------  -------------------------------------------------------  -----------------------------------------------------------------------------------
email_fromName                               string      Name used as sender of the change password emails
-------------------------------------------  ----------  -------------------------------------------------------  -----------------------------------------------------------------------------------
replyTo                                      string      Reply-to address used in the change password emails
-------------------------------------------  ----------  -------------------------------------------------------  -----------------------------------------------------------------------------------
userfields                                   array       Array of fields from the fe_users table. Each field can  username {
                                                         have its own stdWrap configuration. These fields can be
                                                         used as markers in the template (e.g. ###USERNAME###)    htmlSpecialChars = 1

                                                                                                                  wrap = <strong>|</strong>

                                                                                                                  }
-------------------------------------------  ----------  -------------------------------------------------------  -----------------------------------------------------------------------------------
dateFormat                                   string      Format for the link is valid until message (forgot       Y-m-d H:i
                                                         password email)
-------------------------------------------  ----------  -------------------------------------------------------  -----------------------------------------------------------------------------------
exposeNonexistentUserInForgotPasswordDialog  bool        If set and the user account cannot be found in the
                                                         forgot password dialogue, an error message will be
                                                         shown that the account could not be found.

                                                         WARNING: enabling this will disclose information about
                                                         whether an email address is actually used for a
                                                         frontend user account! Visitors can find out if a user
                                                         is known as frontend user.
===========================================  ==========  =======================================================  ===================================================================================
