.. ==================================================
.. FOR YOUR INFORMATION
.. --------------------------------------------------
.. -*- coding: utf-8 -*- with BOM.

.. include:: ../../Includes.txt


.. _using-ajax-social-network-news:

news
----

The same functions as for **tt_news** are also available for **news**. But the solution is is different:

With **news** use the ViewHelpers provided in folder Classes/ViewHelpers/Social.
These ViewHelper may be used as documented inside the php-files itself. 
You can use them in all templates and partials of **news** where you can send a news_id to the ViewHelper.

Autoload up to TYPO3 7
^^^^^^^^^^^^^^^^^^^^^^

Up to TYPO3 7 toctoc_comments loads 2 viewHelper for **news** automaticaly in autoload.php.
So for installations older tan TYPO3 7 please use these vViewHelpers.

TYPO3 7 or newer
^^^^^^^^^^^^^^^^

We recommend the following:

For TYPO3 7 or newer you need to copy manually (sorry) the ViewHelpers from folder 
        toctoc_comments/Classes/ViewHelpers/Social/TYPO3 7 and newer/
                                                                                              
to folder
        news/Classes/ViewHelpers/Social/
                                                                                              

Keep in mind to check the ViewHelpers after updates of **news**

The 2 ViewHelpers
^^^^^^^^^^^^^^^^^

One of the ViewHelpers (ToctoccommentsViewHelper.php) is for display of the entire plugin. 
Like for **tt_news** you can send the TypoScript-Setup for toctoc_comments used in **news** directly from **news** TypoScript-Setup. 
The configuration for the plug-in is originating from TS, but every option can be overwritten from tx_news-TS setup:

::

    plugin.tx_news {
    # toctoc_comments configuration
    toctoc_comments {
        ratings {
            useVotes =0
            useDislike =0
        }
    }
    ...
    }

                                                                                              
The other ViewHelper (ToctoccommentscountViewHelper) creates a Link to the DETAILs of the news
Here you can use Option "commentsShowCountText", if set to 1 only the number of comments will be rendered. 
If 0 (default) it will be a text like "No comments"

::

    plugin.tx_news {
      toctoc_comments {
          # text= 0, number=1
          commentsShowCountText = 0
      }
    }
    

See file Classes/help_ViewHelpers_for_news.txt for more informationon how to use the ViewHelpers in templates and partials

