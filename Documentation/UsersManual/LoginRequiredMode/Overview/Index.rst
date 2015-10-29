.. ==================================================
.. FOR YOUR INFORMATION
.. --------------------------------------------------
.. -*- coding: utf-8 -*- with BOM.

.. include:: ../../../Includes.txt


.. _users-manual-login-required-mode-overview:

Overview
^^^^^^^^

In “login required”-mode users need to
make login for commenting.
When a user is not logged in, then a login form is
displayed under the comment entry form.


When the user made log in he can save his
comment.

Login required mode is activated with
TypoScript Option

::

    plugin.tx_toctoccomments_pi1 {
    advanced {
    loginRequired = 1
    } 
    }
