.. ==================================================
.. FOR YOUR INFORMATION
.. --------------------------------------------------
.. -*- coding: utf-8 -*- with BOM.

.. include:: ../../Includes.txt


.. _designing-the-plugin-processing-of-the-css:

Processing of the CSS
---------------------

Parts 4 and 5 enter into processing for the final output of **toctoc_comments** CSS

This description of processing applies to *theme.refreshCSSfromLESS = 0* (old way before version 8.0.0):

#. CSS-definitions for colors are provided
   from the file res/css/themes/default/css/tx-tc-**versionnumber** -theme.css. The
   values for colors are checked against the themes theme.txt-file, images are setup to be referred
   in the themes img-folder.
#. CSS-definitions concerning layout are provided from file res/css/tx-tc-**versionnumber** .css
#. Most important CSS-definitions, which are derived from the themes TypoScript-options are added by
   PHP directly
#. Modifications to basic CSS-definitions, which are derived from the themes TypoScript-options are
   specified and applied as boxmodel with the definitions in file
   res/css/boxmodels/system/boxmodel_system.txt
#. If you select a user defined boxmodel, like for example res/css/boxmodels/boxmodel_windows.txt,
   then modifications or additions will be applied from these definitions. Boxmodels always apply to
   the basic CSS-definitions concerning layout (2)


The name of the file used in res/css/temp varies, depending on language, theme and boxmodel
selected. Default is tx-tc-**versionnumber** -system-default-0.css.

.. toctree::
    :maxdepth: 2
    :titlesonly:

    ControllingProcessing/Index
    ChangesToTheBasicCss/Index
    ChangesDoneByDefinitionsIn/Index
