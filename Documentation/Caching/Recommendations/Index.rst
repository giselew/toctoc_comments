.. ==================================================
.. FOR YOUR INFORMATION
.. --------------------------------------------------
.. -*- coding: utf-8 -*- with BOM.

.. include:: ../../Includes.txt


.. _caching-recommendations:

Recommendations
---------------

**In productive environments**  use the new caching behavior with settings
**advanced.activateClearPage = 0 and advanced.useSessionCache = 1.** 

**For development** set advanced.useSessionCache = 0. 

Also consider additionalCachePages und additionalCachePagesLocal to be setup correctly.
