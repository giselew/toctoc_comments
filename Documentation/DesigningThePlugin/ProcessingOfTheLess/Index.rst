.. ==================================================
.. FOR YOUR INFORMATION
.. --------------------------------------------------
.. -*- coding: utf-8 -*- with BOM.

.. include:: ../../Includes.txt


.. _designing-the-plugin-designing-with-less-processing-of-the-less:

Processing of the LESS-model
----------------------------

When using LESS, all input for the compiler is in the LESS-model.
The name of the final CSS is same as when processing CSS: it's in folder res/css/temp.

Additionally a txt-file is written, needed to control compilation jobs after changes in the model or in TypoScript-variables.


Changes to the basic LESS-model
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

As the LESS-model is split up into individual less-files and folders representing the components of toctoc_comments you can import or not import less-files according to your frontend setup.

This is in file bootstrap.less in the LESS-models root folder.

With less-version 1, this “component-isolation” might not yet be perfect under any circumstances. 

This will follow with subsequent versions of the LESS-model.

When you want to change colors used in the plug-in please change the color-variables in your selected theme, it's in file theme.less in the themes root folder. 

Example: res/css/themes/black/theme.less

Using a theme and save it to theme with name “work” is the best practice: 

- You keep CSS-colors of the layout in a separated less-file.
- You document the colors you use in the less-file
- Several examples of color themes are there for learning and customization


If you need to change the font-size, margins, heights, borders and properties like these, then it's best practice to use a *boxmodel.less* file


Changes done by definitions in a boxmodel.less file
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

There are several boxmodels included in folder res/less/toctoc_comments-LESS.2/boxmodel

Selection of a boxmodel is made with TS-option 

::

    theme {
        selectedBoxmodel = mycustomboxmodel
    }
    
    