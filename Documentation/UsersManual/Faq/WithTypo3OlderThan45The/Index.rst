.. ==================================================
.. FOR YOUR INFORMATION
.. --------------------------------------------------
.. -*- coding: utf-8 -*- with BOM.

.. include:: ../../../Includes.txt


.. _users-manual-faq-with-typo3-older-than-45-the:

With TYPO3 older than 4.5 the plugin shows no reaction
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

TYPO3 version 4.3 and 4.4 are not yet capable to output JavaScript files as part of the page footer.
This has to be done manually in the page template by adding 

::

    <script src="`/typo3conf/ext/toctoc_comments/res/js/tx-tc-ftr-versionnumber.js <view-source:http://www.deltarose.org/typo3conf/ext/toctoc_comments/res/js/tx-tc-ftr-500.js>`__" type="text/javascript"></script>


just above the </body> end tag.
