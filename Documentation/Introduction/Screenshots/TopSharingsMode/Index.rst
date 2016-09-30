.. ==================================================
.. FOR YOUR INFORMATION
.. --------------------------------------------------
.. -*- coding: utf-8 -*- with BOM.

.. include:: ../../../Includes.txt


.. _introduction-screenshots-topsharings-mode:

Topsharings
^^^^^^^^^^^

*Deprecated and will be removed in version 9.3
As social platforms like Twitter and Facebook stopped to supply the API-interface to collect sharing totals for users (websites) 
without running an according app we need to stop supply top Sharing reports as well. 
The Top Sharings are based on these totals provided by the social networks, this is no longer given*

Pluginmode 8 shows charts on shared pages or on sharers (social platforms)

How does it work? **toctoc_comments** collects share-totals from the frontend in a table in the backend.

Around 3 to 5 seconds after a page is loaded the shown share-tools are sent to the database with an AJAX-call. 
 
On the server data is changed only if there is a change in share-totals, resulting in a history on the share-totals.

.. figure:: /Images/fetopsharings.jpg
