.. ==================================================
.. FOR YOUR INFORMATION
.. --------------------------------------------------
.. -*- coding: utf-8 -*- with BOM.

.. include:: ../../../Includes.txt


.. _users-manual-administration-module-in-typo3-1-user-administration:

User Administration
^^^^^^^^^^^^^^^^^^^

In the overview click on *List Users*. 
It shows the (toctoc_comments)-users on the active page of the TYPO3 page-tree, 
on the root-level it shows all users available.




.. figure:: /Images/backendUsers.jpg

For users there is a little report showing
their activities.

For users 3 bulk actions are available.



.. figure:: /Images/backendUsersBultActs.jpg

Note that with “Kill selected users data from DB” all data from the selected user is removed
from the database.

However, if a deleted or killed user was a
fe_users-user, the entry in fe_users-table remains untouched.
Think of this when
you offer login with Facebook – Facebook user data is stored in fe_users.


Deleting a user completely includes
physical delete from fe_users.




.. figure:: /Images/backendUsersBultActMerge.jpg

Merging users into a user is the 3rd bulk
action possible in user administration




.. figure:: /Images/image-22.jpg

Please specify the destination user in the
input field beside the bulk action options.


**! Important note:**

Merging users and killing user data transform you database that there won't be an
undo possible.
If you want to restore the data before bulk actions, then first dump
the tx_toctoc_comment-tables in MySQL so you can run a restore if needed.

