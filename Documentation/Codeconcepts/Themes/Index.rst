.. ==================================================
.. FOR YOUR INFORMATION
.. --------------------------------------------------
.. -*- coding: utf-8 -*- with BOM.

.. include:: ../../Includes.txt


.. _codeconcepts-themes:

Themes
------

.. index::
	single: Design; Themes txt-files

Since version 3.2, the extension uses themes to define the colors used in front end. 

Themes are organized in sub folders in folder res\css\themes and they help to make the life of the
webpage designer easier. 

Colors are defined in a text file called theme.txt with records like this:

::

    Color required field messages, Recaptcha Labels and Texts: fefefe 010101
    Border submit: fefefe 001da0

When applying your colors to the plug-in, you must not longer know what selector in CSS belongs to
what element in the plug-in - it is all precised in the descriptive first part of the theme-record. 

The first part is separated by ':' from the rest of the record. 
The second part
contains 2 color-codes: the color-code used in the present theme (color 1) and the reference
color-code of the default-template (color 0).

::

    Description: color1 color0


The rules for the fields of the record are

::

    <text>:<space><color1><space><color0>

.. toctree::
    :maxdepth: 2
    :titlesonly:

    HowDoesToctoccommentsUse/Index
    ChangingATheme/Index
    IncludedThemes/Index
    DevelopingYourTheme/Index
    TyposcriptAndThemes/Index
    PaletteOfTheDefaultTheme/Index
