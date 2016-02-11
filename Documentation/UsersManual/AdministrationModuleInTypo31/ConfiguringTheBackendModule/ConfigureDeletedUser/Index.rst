.. ==================================================
.. FOR YOUR INFORMATION
.. --------------------------------------------------
.. -*- coding: utf-8 -*- with BOM.

.. include:: ../../../../Includes.txt


.. _users-manual-administration-module-in-typo3-1-configuring-the-backend-module-configure-deleted-user:

Configure deleted user
""""""""""""""""""""""

.. figure:: /Images/image-26.jpg

When a user is deleted and there are comments from this user that have children, then these comments
will not be deleted. 
The content of the comment will be set to “deleted
comment”. 

The user that made the comment will be set to toctoc_comments user 0.0.0.127.0

At the moment of changes in the comments data the author of the comment will be updated to the
values shown above from the Extension configuration.
