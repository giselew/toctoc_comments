.. ==================================================
.. FOR YOUR INFORMATION
.. --------------------------------------------------
.. -*- coding: utf-8 -*- with BOM.

.. include:: ../../Includes.txt


.. _designing-the-plugin-designing-with-less:

Designing with LESS-model
-------------------------

.. index::
	single: Design; LESS model

**toctoc_comments** 8.0.0. introduces a LESS model which is planned to replace the system using 
boxmodel-files and  theme-files with the first version of **toctoc_comments** after a year of 
parallel versioning, end of summer 2016.

.. figure:: /Images/modellingpartsLESS.jpg

The LESS model continues the idea of themes and boxmodels.
 
However, text-files won't be needed anymore for the themes colors 
or the customization done with boxmodels – this is *all part of the LESS-model*.

[n] = Version of LESS-model

Less-files for boxmodels are present in res/less/toctoc_comments-LESS.[n]/boxmodel

theme.less-files are on the root-level of the themes in res/css/themes


The toctoc_comments LESS model
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

The LESS model of **toctoc_comments** in version 1.0 is still 100% aligned to CSS.

The isolation to components (less-files) is currently in "conceptual" state. 

This means that the direct link between the component in frontend and the less-file is not yet 100% tested. (as of Version 8.0.0)

This component isolation will be the goal for the next version of the LESS model. 
It will still work well with the old CSS system aside.

Once the LESS model will be component safe and the old CSS-model will be dropped, 
then we’ll review and improve, wherever possible, the use of the variables in the LESS model.

To activate LESS inside toctoc_comments set TypoScript-option 


::

    theme.refreshCSSFromLESS = 1. 

This is the new default. 
Note: Turning this to 0 enables the way CSS was handled before version 8.0.0.
To edit and review the LESS-modell – including theme.less files and customizations with boxmodels, 

I recommend to use Crunch or Crunch 2. `getcrunch.co/
<http://getcrunch.co/>`__ . 

