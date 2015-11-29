.. ==================================================
.. FOR YOUR INFORMATION
.. --------------------------------------------------
.. -*- coding: utf-8 -*- with BOM.

.. include:: ../../Includes.txt


.. _designing-the-plugin-designing-with-boxmodel:

Designing with boxmodel and theme-files
---------------------------------------

.. index::
	single: Design; Boxmodel txt-files

The following image shows how **toctoc_comments**  automates design tasks with CSS color themes,
boxmodels and TS-Options:

.. figure:: /Images/image-17.jpg

This (old) way of automatism can be setup in TypoScript with 

::

    theme.refreshCSSFromLESS = 0
    

(by default 1 since **toctoc_comments** 8.0.0)
This "old way" is deprecated and is planned to be dropped in the 
version coming in late summer 2016.