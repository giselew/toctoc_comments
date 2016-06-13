.. ==================================================
.. FOR YOUR INFORMATION
.. --------------------------------------------------
.. -*- coding: utf-8 -*- with BOM.

.. include:: ../../../Includes.txt


.. _users-manual-ratings1-social-network-components-in:

Social network components in normal plugin mode
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

Social network components are

- comments
- ratings
- sharing

*toctoc_comments* rating component is part of the normal plugin mode.
 
You can configure the plugin to show comments and ratings, only comments, only ratings -
optionally with the sharing-component on top of the plugin.
 
Commenting-, rating- and sharing-component are all part of plugin mode 0, normal mode.


**Note**
 
The rating component is linked with records of other extensions using the same system like the comments component does:
 
Plugin-to-table-maps allow to link to records.
 
In addition (not exclusion) to this, the ViewHelper for full plugin integration in 
Classes/ViewHelpers/Social/TYPO3 7 and newer/, file ToctoccommentsViewHelper.php, 
can easily adapt for use in other extensions fluid-templates and -partials. 

The present ViewHelper is designed for *news*
