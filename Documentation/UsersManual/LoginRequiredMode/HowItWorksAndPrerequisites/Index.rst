.. ==================================================
.. FOR YOUR INFORMATION
.. --------------------------------------------------
.. -*- coding: utf-8 -*- with BOM.

.. include:: ../../../Includes.txt


.. _users-manual-login-required-mode-how-it-works-and-prerequisites:

How it works and prerequisites
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

   
TS needed on the page
"""""""""""""""""""""
         
On the page where you want to make loginRequired available, you need to make sure that TS-option
plugin.tx_toctc_comments_pi1.advanced.loginRequired is set to 1.

With this preparation for the page are done.

TypoScript for toctoc_comments
""""""""""""""""""""""""""""""

If you have different setups for normal
and logged in users, then you must specify the options for logged in users as well in confAJAXlogin,
and thise for logged out users in confAJAXlogout


::

    plugin.tx_toctoccomments_pi1 {
    confAJAXlogin {
    spamProtect {
    requireApproval = 0
    useCaptcha = 0
    } 
    } 
    confAJAXlogout {
    spamProtect {
    requireApproval = 1
    useCaptcha = 1
    } 
    }  
    }



Remark: This is redundant to the set-up you might have made with 
TypoScrip-conditions on logged in or not logged in users, but it's necessary. 
When an AJAX request hits the server, then the plugin-configuration needs 
to be sent along the AJAX-request, we do not read the 
plugin configuration on AJAX-requests. 
The plugin-configuration is refreshed only on page reloads.


TypoScript for error messages
"""""""""""""""""""""""""""""

The existing TypoScript should to be extended as follows:

The error message should have about the same length as the welcome message. 
The
goal is that the login area do not need to be resized much when an error occurs.

The original error message is too long, with the following TypoScript you can
control the output in these labels

::

    plugin.tx_toctoc_comments_pi2 {
    _LOCAL_LANG {
    de {
    ll_welcome_message = Bitte geben Sie Ihren Benutzernamen und Ihr Passwort ein oder oeffnen Sie ein neues Konto
    ll_error_message = Ein Fehler ist aufgetreten. Ueberpruefen Sie Ihren Angaben und versuchen Sie es nochmals
    }
    en {
    ll_welcome_message = Please enter your username and password or open a new account
    ll_error_message = An error has occurred. Check your data and try again
    }
    }

