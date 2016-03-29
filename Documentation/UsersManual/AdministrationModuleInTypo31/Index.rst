.. ==================================================
.. FOR YOUR INFORMATION
.. --------------------------------------------------
.. -*- coding: utf-8 -*- with BOM.

.. include:: ../../Includes.txt


.. _users-manual-administration-module-in-typo3-1:

Administration module in TYPO3 Backend
--------------------------------------

.. index::
	single: Administration; Comments module in TYPO3 Backend

**toctoc_comments**  installs a module for comment- and user-administration in the TYPO3 backend.

With version 7.0.1 administration of spamhaus blocked IPs is available as 3rd option in the
administration menu.

4th option are reports: You can query Session-Usage, Active Users, Accesses by Web crawlers and Black listed IPs 


It can be found in module group “Web”.

.. figure:: /Images/image-3.jpg

Selecting comments on the root-level of your TYPO3-backend will scan for data in all pages of your
site.

Since version 9 the backend module changed to a responsive, AJAX-based module, but it's only available with TYPO3 6 or newer.

The old style backend module therefore has been preserved for TYPO3 4 versions – on newer installations 
it can be activated otionally in the extensions configuration with option basic.use_OldBackendModule

Apart from the AJAX-part a basic difference between new and old backend module is the overview-part which is available only in the new backend module.

.. toctree::
    :maxdepth: 2
    :titlesonly:

    OverView/Index
    CommentAdministration/Index
    UserAdministration/Index
    BannedIpAddressesFrom/Index
    Reports/Index
    ConfiguringTheBackendModule/Index
