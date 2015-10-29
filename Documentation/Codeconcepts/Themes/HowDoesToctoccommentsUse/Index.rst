.. ==================================================
.. FOR YOUR INFORMATION
.. --------------------------------------------------
.. -*- coding: utf-8 -*- with BOM.

.. include:: ../../../Includes.txt


.. _codeconcepts-themes-how-does-toctoccomments-use:

How does toctoc_comments use themes?
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

When the plugin is rendered, the current colors (according to file **theme.txt** in the themes
folder) are checked against the content of file res/css/themes/default/css/tx-tc-**versionnumber**
-theme.css. 

For this purpose **toctoc_comments** picks up the default themes CSS,
and prepares it according the themes color definitions. 
