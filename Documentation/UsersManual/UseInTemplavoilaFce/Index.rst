.. ==================================================
.. FOR YOUR INFORMATION
.. --------------------------------------------------
.. -*- coding: utf-8 -*- with BOM.

.. include:: ../../Includes.txt


.. _users-manual-use-in-templavoila-fce:

Use in TemplaVoila FCE
----------------------

.. index::
	single: Setup; TemplaVoila

In a flexible content element (FCE) of TemplaVoila you can setup TS for a mapped
element.
It's possible to use the plugin in a FCE like this: 

Setup the element as TypoScript only-element:

.. figure:: /Images/image-13.jpg

The TS you need looks like this

::

    10 = USER
    [usergroup = *]
    10 = USER_INT
    [global]
    [globalString = _GET|tx_toctoccomments_pi1|anchor=*]
    10 = USER_INT
    [global]

    10 < plugin.tx_toctoccomments_pi1


.. figure:: /Images/image-24.png

In normal TemplaVolia mode it is possible to use references on a **toctoc_comments**  plugin and, of
course use it as normal Plugin in TemplaVoila's main content area (see also UseTemplavoilaField =
field_content)
