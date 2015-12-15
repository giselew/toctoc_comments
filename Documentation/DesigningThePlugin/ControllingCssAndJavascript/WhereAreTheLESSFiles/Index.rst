.. ==================================================
.. FOR YOUR INFORMATION
.. --------------------------------------------------
.. -*- coding: utf-8 -*- with BOM.

.. include:: ../../../Includes.txt


.. _designing-the-plugin-controlling-css-and-javascript-where-are-the-less-files:

Where are the LESS files?
^^^^^^^^^^^^^^^^^^^^^^^^^

LESS-files used for processing the output are  

- in the current LESS-model in res/less/toctoc_comments.LESSless-versionnumber. (Input for LESS compiler in folder contrib/less/less.php)
- res/css/themes/theme/theme.less (Input for colormodeller). On compile the configured theme is copied from it's location in res/css/themes/theme/ to the LESS-model.

