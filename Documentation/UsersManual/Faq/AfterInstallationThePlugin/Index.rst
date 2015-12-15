.. ==================================================
.. FOR YOUR INFORMATION
.. --------------------------------------------------
.. -*- coding: utf-8 -*- with BOM.

.. include:: ../../../Includes.txt


.. _users-manual-faq-after-installation-the-plugin:

After installation, the plugin has to big font-size. How can I change this and where ?
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

If you use a boxmodel, then change it in the boxmodel file and make boxmodels for the blue CSS
Selectors below. You can use boxmodel.txt for a start and set TS option 

::

    theme.selectedBoxmodel = boxmodel.txt


If you do not use boxmodels then follow this procedure:

It's in file tx-tc-versionnumber.css. 
Find CSS selector .toctoc-comments-pi1 and
set the font-size to the percentage which fits the size needed.

::

    .toctoc-comments-pi1 {
    font-size: nn%;
    }


Check the Tool tips and the confirmation-popups. For tool tips change selector
.tx-tc-tooltip.

::

    .tx-tc-tooltip {
    font-size: nn%;
    }


.tx-tc-tooltip is the normal tooltip, .tx-tc-tooltip2 is the tooltip on the rating stars and
.tx-tc-tooltipemoji is used for tooltips on smilies and emojis.


For the confirmation pop ups adjust #confirm-container this:

::

    #confirm-container {
    font-size: nn%;
    line-height: mm%;
    }
