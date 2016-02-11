.. ==================================================
.. FOR YOUR INFORMATION
.. --------------------------------------------------
.. -*- coding: utf-8 -*- with BOM.

.. include:: ../../Includes.txt


.. _caching-typo3-page-cache:

TYPO3 page cache
----------------

To display new data in the plugins in the frontend, the page cache of a webpage in TYPO3 needs to be
empty. 

When changing data, **toctoc_comments** clears the page cache of the current page and the cache of
the pages specified in additionalCachePages und additionalCachePagesLocal.

Up to version 3.5.0. date-display format - “2 hours and 45 minutes ago” was not yet updated by
JavaScript, so rendering a fresh page was needed.

These are the reasons why, up to version 3.5.0. page cache was emptied by the extension at almost
every page call. 

This is the behavior when TS option advanced.activateClearPageCache is set to 1.

Setting advanced.activateClearPage to the new default 0 enables TYPO3 page cache to be used
properly, also then Plugin caching in PHP-Sessions can be activated. It will be active if you leave
TS-Option useSessionCache unchanged (=1).

Page cache will still be emptied when new data is entered.
