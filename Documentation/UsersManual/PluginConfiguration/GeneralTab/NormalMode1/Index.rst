.. ==================================================
.. FOR YOUR INFORMATION
.. --------------------------------------------------
.. -*- coding: utf-8 -*- with BOM.

.. include:: ../../../../Includes.txt


.. _users-manual-plugin-configuration-general-tab-normal-mode-1:

Normal Mode
"""""""""""

In mode “Normal” the plugin can be used for commenting, rating, sharing with many options which
are available on the other tabs.

.. figure:: /Images/image-47.jpg

**Triggering prefix**  defines what parameter in URL triggers displaying of comments. The value
depends on another plugin and its parameters. It's used when you want to related the comments to
News or Products shown on a page, but not on the page itself.
Typically this
parameter will be tx_extkey_pi1, but some older plug-ins have different values (for example,
“tx_ttnews” for **tt_news**  plugin). 
Special value “pages” allows to
comment on content elements on a page instead of records (value by default).

The mappings are in table “Plugin to table map”, custom mappings can be defined
there.
In versions before V3.1.0. this information was maintained in TS-Setup.

**Trigger optional record**  gives possibility to specify a record or content element for which the
comments will be valid. By Default the plugin associates to the containing content element or the
record in association with a triggering prefix. Here you can force the record to be commented. 

If it is a content element holding a plugin itself, then the comments of the other content element
are shown, but you still can represent them in another way.

**Storage records at page**  specifies the sys-folder where records should be stored. Normally TS
Option is used. If all is empty, current page is used. 
