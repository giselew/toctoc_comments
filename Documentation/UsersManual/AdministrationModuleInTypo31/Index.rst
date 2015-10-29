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


The module offers 2 options: comment administration and (**toctoc_comments** -) user administration

.. toctree::
    :maxdepth: 2
    :titlesonly:

    CommentAdministration/Index
    UserAdministration/Index
    BannedIpAddressesFrom/Index
    Reports/Index
    ConfiguringTheBackendModule/Index
