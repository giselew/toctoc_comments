.. ==================================================
.. FOR YOUR INFORMATION
.. --------------------------------------------------
.. -*- coding: utf-8 -*- with BOM.

.. include:: ../../../Includes.txt


.. _users-manual-customizing-comments-use-as-typoscriptobject-in-a:

Use as TypoScript-Object in a page template
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

Since Version 7.4. of **toctoc_comments**  it is possible to add the plugin with TypoScript to a
page in order to collect comments or ratings for the page.

To use this feature you must set optionalRecordId = Pagemode

Example

::

    50 = USER_INT
    50 < plugin.tx_toctoccomments_pi1 
    50 {
    optionalRecordId = Pagemode
    }
