.. ==================================================
.. FOR YOUR INFORMATION
.. --------------------------------------------------
.. -*- coding: utf-8 -*- with BOM.

.. include:: ../../../Includes.txt


.. _users-manual-administration-module-in-typo3-1-comment-administration:

Comment administration
^^^^^^^^^^^^^^^^^^^^^^

Clicking on the button List Comments shows the comments on the active page of the TYPO3 
page-tree, on the root-level it shows all comments available.

.. figure:: /Images/backendComments.jpg

Comments are shown in a list where you can sort the data, browse data and perform single or bulk actions

This is the bottom of the table, showing the last row, then the page browser.
 
By clicking on icons in the list you can perform single actions against the comments.

At the very bottom of the list you find the bulk actions.

To perform a bulk action first select the comments you want to work with. 
(click the select boxes at the end of the rows in the list)

.. figure:: /Images/backendCommentsBulkAct.jpg

Remark: deleting comments does not physically remove the data from the database. It sets the flag
"deleted" on the table to value 0.
