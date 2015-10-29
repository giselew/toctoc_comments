.. ==================================================
.. FOR YOUR INFORMATION
.. --------------------------------------------------
.. -*- coding: utf-8 -*- with BOM.

.. include:: ../../Includes.txt


.. _users-manual-custom-language-labels:

Custom Language Labels
----------------------

.. index::
	single: Setup; Custom Language Labels

All the language labels defined in pi1/locallang.xml and used in the frontend plugin can be
overwritten from TypoScript.

For example you want to replace the value of xml key pi1_template.text_topratings (Top %s ratings)
by Top %s evaluations. In TypoScript it looks like this:

::

    plugin.tx_toctoccomments_pi1 {
    ll {
    en {
    pi1_template-text_topratings = Top %s evaluations
    }
    } 
    }

Note that the dot (.) becomes a hyphen (-) in TypoScript. 
“en” designates
language key “en” for English. There is no “default” - specify the language directly.
