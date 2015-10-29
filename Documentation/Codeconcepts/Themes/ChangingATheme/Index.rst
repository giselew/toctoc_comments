.. ==================================================
.. FOR YOUR INFORMATION
.. --------------------------------------------------
.. -*- coding: utf-8 -*- with BOM.

.. include:: ../../../Includes.txt


.. _codeconcepts-themes-changing-a-theme:

Changing a theme
^^^^^^^^^^^^^^^^

**file /theme/theme.txt:** 

If you change a color1 in the themes theme.txt file, the changes will
trigger an update of related CSS-files in /css/temp.


**file res/css/themes/default/css/tx-tc-versionnumber-theme.css:**
 
When you add new selectors in tx-tc-**versionnumber**-theme.css, 
these additions will be propagated to the other themes. 

The update happens on first use in the frontend.
