.. ==================================================
.. FOR YOUR INFORMATION
.. --------------------------------------------------
.. -*- coding: utf-8 -*- with BOM.

.. include:: ../../../Includes.txt


.. _introduction-features-new-in-versions-9xx:

New in versions 9.x.x
^^^^^^^^^^^^^^^^^^^^^

.. index::
	single: News; Version 9

- toctoc_comments 9.2.10 allows to break long words in comments lists, see option advanced.makeBreakWordsLongerThan
- With toctoc_comments 9.2.0 the CSS-modell has been dropped as announced 1 year ago, when LESS was introduced for CSS-generation
- toctoc_comments 9.2.0 improves performance with better caching and reduced output from server to client
- toctoc_comments 9.1.0 brings a new kind of ratings, called the emoLikes. EmoLikes are heavily inspired by the reactions Facebook introduced in winter 2016
- toctoc_comments 9.0.0 brings a new responsive and AJAX-based backend module. Old, non AJAX-Backend module is still available, new Backend module is available only with TYPO3 version 6 or newer
- Code of the backend module has been reorganized
- In the report bad comment form and in the sign-up component the captcha option is set to the internal captcha of *toctoc_comments* by default. **sr_freecap** can still be used
- LESS-model Version 2 implements the changes in design according to the evolution of design observed in social networks like Facebook.
 
The design in frontend used before version 9 can still be used by changing the according TYPO3-option theme.themeVersion.