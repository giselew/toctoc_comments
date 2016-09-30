.. ==================================================
.. FOR YOUR INFORMATION
.. --------------------------------------------------
.. -*- coding: utf-8 -*- with BOM.

.. include:: ../../../Includes.txt


.. _users-manual-faq-after-change-of-template:

After change of template, changes are not visible in frontend, what to do?
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

You need to clear the internal session cache of **toctoc_comments**  as well. 

In the backend module delete all cache and sessions in Overview -> System

Using GET-Paramenter ** ?purge_cache=1 ** is a possibility as well, but the other users sessions remain intact.


