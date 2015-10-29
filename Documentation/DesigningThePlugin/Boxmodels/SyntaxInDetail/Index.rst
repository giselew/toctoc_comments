.. ==================================================
.. FOR YOUR INFORMATION
.. --------------------------------------------------
.. -*- coding: utf-8 -*- with BOM.

.. include:: ../../../Includes.txt


.. _designing-the-plugin-boxmodels-syntax-in-detail:

Syntax in detail
^^^^^^^^^^^^^^^^

Boxmodels are defined in text files and they have a simple syntax.

A boxmodel file consists of blocks of boxmodels which applies CSS-properties on CSS-selectors,
optionally with rules how to make values.

A boxmodel block has the following syntax (example and short explanation)

::

    Boxmodel (Identificator for new boxmodel)

    Borderradius small used everywhere in the plugin (Documentation part: Which aspect of CSS is handled by this boxmodel, here you give the element a speaking short description) 

    CSS (Identificator for CSS of boxmodel)

    [+]border-radius: 2px 2px 2px 2px; (border-radius will be set to "2px 2px 2px 2px" if no Rules are specified, with the optional leading '+' properties can be added to the selector)

    [border-radius: {10}px 2px 2px 2px; (if no "Rules" are defined, then {10} will be set to 2. With "Rules" the variable {10} is defined and will be set by the rule. Variables are in format {varname})

    [CSS] (more CSS sections can be used – but *only* if no "Rules" are present)

    [Rules

    {10} = 2 + 3] ({10} will be calculated as 2+3=5. In the evaluation part variables can be used and you have access to some TS-Options values like the line height for example.

    Selectors (Identificator for CSS-selectors containing the CSS of the boxmodel)
    .tx-tc-ct-box-picturecrop322 img (always full line without { as in the original CSS-File)
    .tx-tc-userpic, .tx-tc-userpicf, .tx-tc-avatarpicf, .tx-tc-avatarpic
    .txtc_details
    .tx-tc-ct-editbutton, .tx-tc-ct-deletebutton, .tx-tc-ct-denotifybutton
    .new-selector (if a selector is not found in the original CSS-File, it will be added at the end of the css file)

    *** (End of boxmodel)
