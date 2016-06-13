.. ==================================================
.. FOR YOUR INFORMATION
.. --------------------------------------------------
.. -*- coding: utf-8 -*- with BOM.

.. include:: ../../Includes.txt


.. _users-manual-installing-and-setup:

Installing and Setup
--------------------

.. index::
	single: Setup; Basics

1) Install the extension in EM. If you
have problems with creating the tables, please deactivate **dbal**  for this
install.

If you update from a former version of**toctoc_comments** , then make sure that the
upload-folders are created: In EM open the Configuration-tab of the extension
and press Update to create these folders.

Static Data is imported during install, it's enough to do this once. After
this please make sure that possible existing data won't be overwritten by unchecking the
check-boxes for the imports.


2) Then include AJAX Social Network
Components in your sites TS-Template

.. figure:: /Images/image-55.jpg

3) **Make sure that jQuery is added to the
page**  by adding something like this to the page.config-TS:


::

    page.includeJSlibs {
    jquery = typo3conf/ext/toctoc_comments/resources/jquery-1.10.2.min.js
    }


Many Websites already run jQuery. toctoc_comments needs jQuery version 1.8. or newer.

jQuery must be located in the head of the webpage, best is, when it's loaded as the first
JavaScript file. Basic rule: jQuery needs to be loaded before all other libraries.

Users of **TYPO3 version 4.3 and 4.4** : In the footer of the page-template you need to add the
JavaScript link to tx-tc-ftr-version.js manually. 

It's

::

    <script src="/typo3conf/ext/toctoc_comments/res/js/tx-tc-ftr-versionnumber.js" type="text/javascript"></script>

    
(**versionnumber**  is like '530' for **toctoc_comments** version 5.3.0)

4) Setup your TS. See setup.txt in
directory /static for an example.

Important is to set the constant for the StoragePID – the pid of the folder where comments will be stored.
    
TS Setup can be very minimal, see the example above for logged in and anonymous users – this is the recommended minimal setup.

I recommend to setup the extension with TypoScript-Setup and not with the constants.     


Important TypoScript options
^^^^^^^^^^^^^^^^^^^^^^^^^^^^

**storagePID** : Set up a folder in TYPO3 where your comments are stored and set storagePID to
the ID of this folder

::

    storagePID = 452 
    # pid of your comments folder


for **email notifications** , these 3 options are important:

For approval needed e-mail setup a valid e-mail here

::

    spamProtect.notificationEmail = youradmin@yoursite.tld


For simple information e-mail, the same or an alternative e-mail should be setup:

::

    spamProtect.informationEmail = youradmin@yoursite.tld


From e-mail: Notifications to administrator about posted comment are sent from this e-mail

::

    spamProtect.fromEmail = youradmin@yoursite.tld


