.. ==================================================
.. FOR YOUR INFORMATION
.. --------------------------------------------------
.. -*- coding: utf-8 -*- with BOM.

.. include:: ../../../Includes.txt


.. _users-manual-faq-i-get-error-message-the:

I get error message "The content element ID ..." instead of the plugin
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

The orange message "The content element ID containing the plugin could not be found automatically. Please use optionalRecordId to specify the content element."

This means that you should tell *toctoc_comments*  directly on
which content element id the comments will be referred.
The reference to a content
element is needed if you comment on content elements. It's needed as well for plugin operation when
commenting on records. 
So when the automatic detection fails, by what ever reason,
you'll get this message. 

Automatic detection is the default behavior of *toctoc_comments*  when it comes to this step of
identification. If it fails, the information has to be given manually.

In the backend plugin choose a content element for the plugin in “General\* -> “Trigger optional
Record”.

When running *toctoc_comments*  without backend plugin, then use TypoScript option
optionalRecordId.
