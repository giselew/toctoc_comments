.. ==================================================
.. FOR YOUR INFORMATION
.. --------------------------------------------------
.. -*- coding: utf-8 -*- with BOM.

.. include:: ../../Includes.txt


.. _caching-plugin-cache:

Plugin cache
------------

When TYPO3-cache is allowed, then **toctoc_comments**  can use its internal plugin cache.

Plugin cache is stored at the level of Session → Plugin → Language → User → Page and it is
cleared on data access at the level of Session → Plugin → Language → User. Dirty Cache is
identified by the Plugins timestamp of last update in table tx_toctoc_comments_plugincache.

You can still disable plugin cache with TS-Option useSessionCache = 0.

Plugin cache dramatically reduces load times to values around 3ms to 12ms.

Note: useSessionCache = 0 is important during development, with this you don't need to reload the
page with ?purge_cache=1 when you want to get the uncached result.
