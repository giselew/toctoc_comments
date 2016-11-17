.. ==================================================
.. FOR YOUR INFORMATION
.. --------------------------------------------------
.. -*- coding: utf-8 -*- with BOM.

.. include:: ../../Includes.txt


.. _using-ajax-social-network-ttnews:

tt_news
-------

*toctoc_comments* provides 2 custom markers for **tt_news**.
 
The markers do
not influence performance of **tt_news**, when they are not used.

Same functionality is also available for **news**.


Comments Count with link to comments on News detail page
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

This marker is for display of number of comments inside LIST, LATEST or SEARCH views. 

Marker is ###TX_COMMENTS_COUNT###. 

By default it will produce the following HTML:

::

    <a href="url/to/news/item#tx-toctoc-comments-comments-###UID###" class="tx-toctoc-comments-count">5 comments(s)</span>


This HTML can be customized by modifying template supplied with **toctoc_comments**. 

See ###TTNEWS_COMMENT_COUNT_SUB### subpart in the template. 

**tt_news**-marker is typically included after "more" link.

Plug-in display
^^^^^^^^^^^^^^^

The marker is for display of the entire plugin. 

The configuration for the plug-in
is originating from TS, but every option can be overwritten from **tt_news**-TS setup:

::

    plugin.tt_news {
    toctoc_comments {
    ratings {
    useVotes =0
    useDislike =0
    }
    }
    ...
    }

It works, like the other marker, inside LIST, LATEST or SEARCH views. 

Marker is ###TX_TOCTOCCOMMENTS###.

When using the same comments on both detail and a list/search or latest view, then it it's necessary
to add the list-view, search or latest page to TS setup option **additionalClearCachePages**
or **additionalClearCachePagesLocal**. 

If detail page should not be refreshed, then add it as well. 
There's a little logic which tries to
find the detail page and cleans its cache on changed data. 
But this does not work in every
configuration: 
Only one detail page must exist and the plugin on this page must be set up normally.
(not injected by TS in TemplaVoila FCE)


