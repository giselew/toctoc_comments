.. ==================================================
.. FOR YOUR INFORMATION
.. --------------------------------------------------
.. -*- coding: utf-8 -*- with BOM.

.. include:: ../../../Includes.txt


.. _designing-the-plugin-boxmodels-limits:

Limits
^^^^^^

CSS properties (and selectors) can't be deleted, the "Boxmodeller" supports only changes to CSS
properties and additions of CSS properties and selectors.

The default CSS in res/css/tx-tc-**versionnumber** .css must be **well formatted** : A leading space
before { and a leading tab before a CSS property are required.

In the boxmodel the **boxmodel-TS-Options**  must first be used in a CSS-declaration before it works
in Rules formulas. 

Example: If “boxmodelLineHeight” has not yet been used in your boxmodel, then you need to bring
it in like this:

::

    Boxmodel
    line height rating stars top
    CSS
    +line-height: 18px;
    line-height: {boxmodelLineHeight}px; // only now boxmodelLineHeight is defined in the model
    Selectors
    .tx-tc-cts-dp .tx-tc-text-top .tx-tc-atrts-dp .tx-tc-rts-area .tx-tc-rts-container .tx-tc-rts-li .tx-tc-rts
    ***

    Boxmodel
    line height rating stars top
    CSS
    +line-height: 18px;
    line-height: {22bbggl}px;
    Rules
    {22bbggl}=12+{boxmodelLineHeight} // only boxmodelLineHeight works in the rules-formula
    Selectors
    .toctoc-comments-pi1 .tx-tc-cts-dp .tx-tc-text-top .tx-tc-atrts-dp .tx-tc-rts-area .tx-tc-rts-container .tx-tc-rts-li .tx-tc-rts
