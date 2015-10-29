.. ==================================================
.. FOR YOUR INFORMATION
.. --------------------------------------------------
.. -*- coding: utf-8 -*- with BOM.

.. include:: ../../Includes.txt


.. _using-ajax-social-network-cwtcommunity-1:

cwt_community
-------------

For extension **cwt_community**  the same it's the same like for **community**  

**cwt_community**  uses same jQuery like **toctoc_comments** , we recommend, on pages where you use
**toctoc_comments,**  to disbale jQuery from **cwt_ community**  with 

::

    plugin.tx_cwtcommunity_pi1.jquery.enabled = 0


You'll need this "Plugin to table map":

prefix: tx_cwtcommunity_pi1
table: fe_users
showUid parameter:
action=getviewprofile&uid

On the **user wall**  configuration option changes to 

::

    \ -- EMPTY CODE LINE --
    wallExtension = 2

