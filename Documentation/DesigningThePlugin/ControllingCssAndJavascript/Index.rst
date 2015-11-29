.. ==================================================
.. FOR YOUR INFORMATION
.. --------------------------------------------------
.. -*- coding: utf-8 -*- with BOM.

.. include:: ../../Includes.txt


.. _designing-the-plugin-controlling-css-and-javascript:

Controlling CSS and JavaScript file generation
----------------------------------------------

The JavaScript Part is always active, the CSS part can be set to state “frozen”. 

Once you have all needed CSS-Files in res/css/temp you can turn off CSS-generation and continue to
work on the CSS in res/css/temp directly.

The JavaScriptmodeller becomes only active if a file is missing or if changes to the configuration
require regeneration of JavaScript-files. 

Also, the Boxmodeller and the Colormodeller get active if
needed (by default), but they can be set to 'forced generation of CSS', this is useful when
developing the boxmodelfile or when making changes in the master-CSS-File
res/css/tx-tc-versionumber.css.

This also applies in mode theme.refreshCSSfromLESS


From setup.txt:

::

    # set this to 0 if you want to force CSS-generation, 1 for normal mode (changes in boxmodel or conf trigger refreshs) or 2 for frozen CSS (files must exist!)

    theme.freezeLevelCSS = 1


.. toctree::
    :maxdepth: 2
    :titlesonly:

    WhereAreTheFiles/Index
    WhereAreTheLESSFiles/Index
