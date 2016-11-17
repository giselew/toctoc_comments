.. ==================================================
.. FOR YOUR INFORMATION
.. --------------------------------------------------
.. -*- coding: utf-8 -*- with BOM.

.. include:: ../../../Includes.txt


.. _users-manual-customizing-comments-use-as-typoscriptobject:

Use as TypoScript-Object
^^^^^^^^^^^^^^^^^^^^^^^^

It's possible to use *toctoc_comments*  as TypoScript Object.
Important
condition: optionalRecordId needs to be setup.


Example

::

    TSObj.toctoc_comments >
    TSObj.toctoc_comments = COA
    tmptoctoc_comments = COA
    tmptoctoc_comments {
    10 = USER
    10 < plugin.tx_toctoccomments_pi1
    10 {
    optionalRecordId = tt_news_76
    }
    }
    TSObj.toctoc_comments < tmptoctoc_comments

