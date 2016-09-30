.. ==================================================
.. FOR YOUR INFORMATION
.. --------------------------------------------------
.. -*- coding: utf-8 -*- with BOM.

.. include:: ../../../Includes.txt


.. _designing-the-plugin-controlling-css-and-javascript-where-are-the-files:

Where are the files?
^^^^^^^^^^^^^^^^^^^^

.. index::
	single: Design; File locations

CSS-outputs are all in res/css/temp/.

CSS-file used for emojis is in res/css/emoji/, there are 4 variants, named emoji[**size of emojis in
pixel** ].css. Emojis' CSS is from TS-setup:

::

    advanced.useEmoji = 1
    options[inactive=0,emoji images 16px=1,emoji images 20px=2,emoji images 26px=3,emoji images 33px=4]
    make use of Emoji pictures: Unicode Emojis are replaced by image emojis in comments and while entering comments :text emojis: are converted to unicode-emojis.


CSS-file for the flowplayer is
contrib/flowplayer/css/functional.css

If you don't use emojis and/or
video attachments, then you can remove the corresponding lines refering these files in the template
file res/template/toctoccomments_template.html 
