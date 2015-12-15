.. ==================================================
.. FOR YOUR INFORMATION
.. --------------------------------------------------
.. -*- coding: utf-8 -*- with BOM.

.. include:: ../../../Includes.txt


.. _users-manual-faq-i-get-php-errors-when-voting:

I get PHP errors when voting or liking something
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

Different kind of PHP errors can occur.
The most referred errors are due to different TYPO3 page cache or errors in the
JavaScript.

**JavaScript:** You can get an error from toctoc_comments saying “invalid diffconf”. This
is because a variable coming from JavaScript could not be built and sent to the server. You will
probably see JavaScript-errors in the Console of the web browser.

Now with the big variety of possible JavaScript errors I just can hint on some common, known
problems.

1. Wrong or no version of jquery.tools present

2. jQuery version makes fail a jQuery-library, mostly the old fancybox or other older
jQuery-libraries. **toctoc_comments** has been tested with jQuery 1.7.2 to 1.10.2 
