.. ==================================================
.. FOR YOUR INFORMATION
.. --------------------------------------------------
.. -*- coding: utf-8 -*- with BOM.

.. include:: ../../../Includes.txt


.. _designing-the-plugin-integration-in-responsive-integration-in-responsive-1:

Integration in responsive websites
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

Before version 5.1, *toctoc_comments*  produced CSS with a layouted design for the commenting
forms. 

This “layouted” design cannot be used properly in responsive website, because of fixed widths of
inputs, labels, fixed positions of submit buttons and more.

Version 5.1 introduced option

::

    theme.boxmodelLabelInputPreserve = 0

1st: When setting it to 1, the design of the layout of the form-elements becomes minimal

2nd: Class .tx-tc-reponsive is added to the plugin container.

This allows to pick up CSS-selectors from *toctoc_comments*  and define them according in your
CSS-Framework.

For CSS-framework **Twitter Bootstrap**  we had to style and redefine the following elements:

.. toctree::
    :maxdepth: 2
    :titlesonly:

    ApplyGeneralCssForInputs/Index
    CssForTextareasPadding/Index
    CssForSubmitButtons/Index
