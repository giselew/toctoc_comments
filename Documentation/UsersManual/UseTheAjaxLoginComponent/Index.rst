.. ==================================================
.. FOR YOUR INFORMATION
.. --------------------------------------------------
.. -*- coding: utf-8 -*- with BOM.

.. include:: ../../Includes.txt


.. _users-manual-use-the-ajax-login-component:

Use the AJAX Login Component
----------------------------

.. index::
	single: Setup; AJAX Login

You need to make sure that tx_toctoc_comments_pi2.storagePid points to the sysfolder holding
your fe_users.

The setup of the AJAX Login component is done by tx_toctoc_comments_pi2, not
tx_toctoc_comments_pi1. But nevertheless, it's activated in
tx_toctoc_comments_pi1 by

::

    tx_toctoc_comments_pi1.pluginmode=5 or 
    tx_toctoc_comments_pi1.advanced.loginRequired=1.

