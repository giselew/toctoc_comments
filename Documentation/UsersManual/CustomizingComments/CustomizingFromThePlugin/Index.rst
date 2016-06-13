.. ==================================================
.. FOR YOUR INFORMATION
.. --------------------------------------------------
.. -*- coding: utf-8 -*- with BOM.

.. include:: ../../../Includes.txt


.. _users-manual-customizing-comments-customizing-from-the-plugin:

Customizing from the plugin
^^^^^^^^^^^^^^^^^^^^^^^^^^^

Then some of the options setup in TS can be overwritten through the plug-in’s configuration when
it is inserted as content element. 
A few options are available only thru the plugin.

TypoScript configuration is the only possibility for configuration if the plugin is inserted through
TypoScript setup. (for example, as "TypoScript object path" in TemplaVoila or as a part of flexible
content element). 

For information on TypoScript configuration options see "Configuration" section later in this
manual.

**Important:**  Flexform configuration always overrides TypoScript configuration when a field is set
to some value!

The choice which options are available in the plugin was guided by the importance to have an option
individually setup in a specific plugin instance. 

So for example you can deactivate sharing in general TS-configuration, and activate it only in the
first plugin on a page. 
