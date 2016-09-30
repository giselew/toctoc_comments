.. ==================================================
.. FOR YOUR INFORMATION
.. --------------------------------------------------
.. -*- coding: utf-8 -*- with BOM.

.. include:: ../Includes.txt


.. _caching:

Caching
=======

Plugins for comments and ratings require advanced cache-handling.

They must handle changes of the data and make sure, that cache is refreshed, after users add comments or ratings. 

*toctoc_comments* displays a view counter, this makes things even more complicated:

After every new view the cache needs to be refreshed
TYPO3 CMS has sophisticated caching mechanism. 

It includes page cache and cache for plugins.

The goal of the cache is to speed up the server response. 

It is achieved by minimizing execution of PHP-scripts accessing the data in the individual tables in TYPO3.


**TYPO3 page cache**
""""""""""""""""""""

By default TYPO3-Webpages are cached. 

When the cache is empty the CMS actually accesses the database tables holding the data.

With some TypoScript options the setup how TYPO3 deletes the cached data defines: 

::

    config.cache_clearAtMidnight = 1 



TYPO3 page cache is cleared at midnight

::

    config.cache_clearAtMidnight = 0
    config.cache_period = 604800



TYPO3 page cache is cleared all 7 days (value is seconds)

*toctoc_comments* clears the page cache of the TYPO3-page after modifications of the data (after new comments or ratings) - that's 
why it can be run in USER-mode, for anonymous website visitors.

TypoScript options of *toctoc_comments*
TYPO3 page cache is cleared at midnight

::

    additionalClearCachePages =


Additional pages where the cache drops when data has been added or changed. 

This option has a global scope

::

    additionalClearCachePagesLocal =



Additional pages where the cache should be dropped, local scope, This is typically added in Page TS, it will be merged with additionalClearCachePages. 

On subpages you can decide if you want to inherit the additionalClearCachePagesLocal or set it back to empty again

**TYPO3 plugin cache**
""""""""""""""""""""""

If an object is defined as a _INT-object, then it is never cached.
Example: USER-objects are cached, USER_INT-objects are not cached

*toctoc_comments*: Anonymous users see *toctoc_comments* as USER-object.
Exceptions: 
When *toctoc_comments* - in normal mode - is called by a link in a recent comments list, then it is set to USER_INT in code during run time, avoiding to create a cache entry for the page
In all other modes than normal mode *toctoc_comments* is not cached

Logged-in users see it in non cached, USER_INT-mode.


**Conclusion:**
Apart normal mode for anonymous users, *toctoc_comments* does not use TYPO3 cache.

 
**Cache behind USER_INT**
"""""""""""""""""""""""""

Whenever the plugin is run as USER_INT it would access the data and recalculate everything present in the plugin

To avoid this *toctoc_comments* maintains it's own caching system.

Uncached rendering of the plugin consumes between 100ms to 700ms
 

**toctoc_comments database cache**
""""""""""""""""""""""""""""""""""

Caching in the database caches all kinds of reports in *toctoc_comments*: 

recent comments, user center, top rating reports and similar.

Normal mode of anonymous users with no ratings or comments is cached, normal mode of logged in users as well.

Cache is removed on changes of the data


The most difficult thing to handle with the cache are the views and the view-counters.

Imagine a news-site publishes an important article and has the view-counters enabled.

Every new visitor causes the counter to increase - and destroys the cache immediately after he created it.

To avoid this *toctoc_comments* delays cache removal by views with a delay. 

By default the delay is set to 3 minutes, but it can be varied using TS-Option 


::

    advanced.viewsCacheDelay. 


It means that views destroy the cache not earlier than 3 minutes after the cache has been created. 

Most visitors will see updates of the view-counters all 3 minutes.

Rendering of the plugin from the database cache consumes between 6ms to 15ms 

For normal mode the database cache is added also into the users-PHP-session


**toctoc_comments PHP-session cache**
"""""""""""""""""""""""""""""""""""""

PHP-session cache delivers it's data on page reloads. 

It is the fastest cache, but also it is the most disk space-consuming cache.

This cache is refreshed after changes of the data, but only when the user reloads the page

Rendering of the plugin from PHP-Session cache consumes between 3ms to 10ms 

With *toctoc_comments* database- and PHP-session cache execution of PHP-scripts accessing the data in the individual tables of *toctoc_comments* is optimized.


**toctoc_comments cache for AJAX and e-mails**
""""""""""""""""""""""""""""""""""""""""""""""

The goal of these caches is to reduce traffic between web browser (e-mail-client) and server. 

Speeding up the server response is a side effect of it.

It is achieved by minimizing exchange of data between server and web browser (e-mail-client) by storing the data away in a database.

The data is referenced by a key. 

Instead of the data only the key is sent to the web browser (e-mail-client) and returned to the server.


**toctoc_comments cache for AJAX**
""""""""""""""""""""""""""""""""""

For AJAX-calls - encoded data holding information like the plugins configuration was sent from the server to the clients. 

Caching this data in the database decreases the size of pages holding the plugin about 20 to 30%.


**toctoc_comments cache for e-mails**
"""""""""""""""""""""""""""""""""""""

This cache concerns e-mails with links back to *toctoc_comments*: 

administrator approval, COI, User account confirmation


**Cache handling in the backend module**
""""""""""""""""""""""""""""""""""""""""

In the backend modules "Overview", the section System has a small overview of the cache usage and there's a function which allows to delete all cache.


**Clearing the cache in frontend**
""""""""""""""""""""""""""""""""""

Clearing the cache with URL get parameter ?purge_cache=1 is still working

It clears the database cache and the PHP session cache of the present user. 

Usage of purge_cache is restricted to the dev IP mask defined in TYPO3 install tool.

"?purge_cache=1" is not required anymore to make changes in the configuration (TypoScript) pass thru the cache, 
such changes are detected and cache will be dropped automatically, if it happens.


**TypoScript options concerning cache - Overview**
"""""""""""""""""""""""""""""""""""""""""""""""""""


::

    additionalClearCachePages =
    Additional pages where the cache should be dropped when data has been added or changed, global scope
    
    additionalClearCachePagesLocal =
    Additional pages where the cache should be dropped, local scope, typically added in Page TS, this will be merged with globalscope
    
    sessionTimeout = 1440
    Timeout for PHP-Sessions in minutes (1 day)
    
    dbCacheTimeout = 10080
    Timeout for db-cache in minutes (7 days), must be longer than sessionTimeout 
    
    advanced.viewsCacheDelay = 3
    Cached viewcounts get refreshed in frontend when loading a page, in minutes
    
    advanced.viewMaxAge = 28
    Maximal age for a view, in days: After this delay a subsequent view counts as new view
    
    advanced.emailValidDays = 120
    Days an e-mail from *toctoc_comments* is valid: Links from e-mails to approval-, confirmation- or notification pages are valid this number of days, minimum: 7 days, maximum: 365 days
    
    attachments.webpagePreviewCacheClearManual = 0
    Enables deletion of temporary images from attachments
    
    attachments.webpagePreviewCacheTimeTempImages = 60
    Cache expiry for temporary stored images in minutes (1 hour)

    attachments.webpagePreviewCacheTimePage = 180
    Cache expiry for scanned pages in minutes (3 hours)


**Caching of toctoc_comments, resume**
""""""""""""""""""""""""""""""""""""""

We have all in all 4 caches maintained by *toctoc_comments*:

Caches maintained for reduction of client-server traffic 

1. E-mail-cache

2. Ajax-cache

Caches maintained to avoid full calculation of data when run as USER_INT-object

3. Plugincache in database

4. Plugincache in PHP-session

