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

Where are the themes?

Themes are organized in sub folders in folder res\css\themes. 

Each subfolder contains another subfolder holding the images and there's a LESS-file, where colors used are defined.

In the LESS-files the colors assigned to variables are explained with comments above the variable declarations. example:

::

    // Color of Watermark 
    @color-watermark:                   #8b8c91;
    // Color of highlighted Comment:  
    @color-highlight:                   #a1bbe4;


.. toctree::
    :maxdepth: 2
    :titlesonly:

    IncludedThemes/Index
    DevelopingYourTheme/Index
    TyposcriptAndThemes/Index
