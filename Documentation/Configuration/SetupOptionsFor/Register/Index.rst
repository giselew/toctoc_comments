.. ==================================================
.. FOR YOUR INFORMATION
.. --------------------------------------------------
.. -*- coding: utf-8 -*- with BOM.

.. include:: ../../../Includes.txt


.. _configuration-setup-options-for-register:

register
^^^^^^^^

In option group register there are all options relevant to User Sign up

=======================  ==========  ===================================================================  ========
**Property:**            Data type:  Description:                                                         Default:
=======================  ==========  ===================================================================  ========
enableSignup             boolean     Enable sign up                                                       1
-----------------------  ----------  -------------------------------------------------------------------  --------
usergroup                string      setup default usergroup(s)-uids setup when registering,              1
                                     separated by commas
-----------------------  ----------  -------------------------------------------------------------------  --------
signupUseCaptcha         options     Use a captcha during sign up                                         2
                                     1 is extension captcha, 2 is sr_freecap                              
                                     
-----------------------  ----------  -------------------------------------------------------------------  --------
signupRequireFirstname               Make first name of the new user mandatory                            1
-----------------------  ----------  -------------------------------------------------------------------  --------
newUserMinLength         int+        Minimal length required for a new username                           6
-----------------------  ----------  -------------------------------------------------------------------  --------
signupConfirmEmail       boolean     Require confirmation of e-mail for new users.
                                     If active the user cannot enter the
                                     passwort when creating the account. He will get an
                                     e-mail with a link to reset the password first, similar
                                     to the forgot password.

                                     ( V 7.4.0)
-----------------------  ----------  -------------------------------------------------------------------  --------
signupAdminConfirmation  boolean     New users need to be confirmed by administrator: new
                                     user confirmation by administrator uses eID-interface
                                     for admin authorizations and send notification mail to
                                     new user.

                                     See also TS-Options for email templates:
                                     tx_toctoc_comments_pi1.advanced.notificationForNewUserEmailTemplate

                                     ( V 7.4.1)
=======================  ==========  ===================================================================  ========
