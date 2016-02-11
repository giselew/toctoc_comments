.. ==================================================
.. FOR YOUR INFORMATION
.. --------------------------------------------------
.. -*- coding: utf-8 -*- with BOM.

.. include:: ../../../Includes.txt


.. _introduction-screenshots-ajaxlogin-mode:

AJAX-Login mode
^^^^^^^^^^^^^^^

This screenshot shows the full featured AJAX-Login stand alone plugin 

AJAX-Login includes sign-up functionality – users can create a fe_users account and login directly
when the account is created.

Also for forgotten passwords the recovery of a new password can be done in this plugin mode.

.. figure:: /Images/image-56.jpg

Note that users can login with their
Facebook- or Google+-accounts
To use this features, you have to create first an app
for your website on Google or Facebook and then add the App ID and Secret to **toctoc_comments** 
pi2-TS-Setup

Note on the Captcha for the registration
process: 
It is strongly recommended that you use **sr_freecap** 


Note on preventing abusive user
registrations: 
You can either enable COI or be even more restrictive and require
Administrator Confirmation for new users.


#. COI (confirmed Opt-In) forces new
   fe_users to confirm their e-mail. This does not apply for Facebook or Google+-Accounts, since
   their e-mail is already confirmed to be true.
   
#. Administrator confirmation triggers all
   kinds of new users, Google+ and Facebook account included.
   
