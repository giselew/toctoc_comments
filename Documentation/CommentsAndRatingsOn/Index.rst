.. ==================================================
.. FOR YOUR INFORMATION
.. --------------------------------------------------
.. -*- coding: utf-8 -*- with BOM.

.. include:: ../Includes.txt


.. _comments-and-ratings-on:

Comments and ratings on records of other extensions
===================================================

.. index::
	single: Other Extensions; Plugin-to-table-maps

Before version 3.1 of **toctoc_comments**  commenting and rating on records was
implemented as Prefix-to-table-map and was setup in TS-Configuration. 
Now prefix-to-table maps are maintained in TYPO3 table **Plugin to table
map**.

.. figure:: /Images/image-66.jpg
   :alt: Plugin-to-tablemap icon.

You can maintain and add new records in the backend (see
also chapter “Changing the folder of static data”)

When is a plugin to table map needed ?
--------------------------------------

When you want to allow comments or ratings on records, then you can do this with TS-Option
externalPrefix and a corresponding entry in table “Plugin to table map”-

The records must be shown in a details view page and the parameters used by the extension to display
the record must be present as GET-Variables in the URL of the page. (Don't worry if you use nice
URLs made with realURL or others, it works)

**toctoc_comments**  already includes the “Plugin to table map” for the following 11 extension
keys.

If there are no “Plugin to table map”-entries present in your database you can import a first
set of them using an option in the plugin configuration in extension manager. 
The
option is “importDataprefixtotable”

List of known **Plugin to table map**
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

========================  =============================================  =========================  =================================================  ==================================================
**Plugin:**               Table:                                         Optional URL parameter:    Fields to display in top ratings list:             Folder with images to display in top ratings list:
========================  =============================================  =========================  =================================================  ==================================================
tx_album3x_pi1            tx_album3x_images
------------------------  ---------------------------------------------  -------------------------  -------------------------------------------------  --------------------------------------------------
tx_commerce_pi1           tx_commerce_products
------------------------  ---------------------------------------------  -------------------------  -------------------------------------------------  --------------------------------------------------
tx_irfaq_pi               tx_irfaq_q
------------------------  ---------------------------------------------  -------------------------  -------------------------------------------------  --------------------------------------------------
tx_mininews_pi1           tx_mininews_news
------------------------  ---------------------------------------------  -------------------------  -------------------------------------------------  --------------------------------------------------
tx_ttnews                 tt_news                                        tt_news                    title tstamp image sys_language_uid, short         uploads/pics/
------------------------  ---------------------------------------------  -------------------------  -------------------------------------------------  --------------------------------------------------
tt_products               tt_products                                    product                    title image, subtitle                              uploads/pics/
------------------------  ---------------------------------------------  -------------------------  -------------------------------------------------  --------------------------------------------------
tx_wecstaffdirectory_pi1  tx_wecstaffdirectory_info                                                 full_name start_date photo_main sys_language_uid,
                                                                                                    biography
------------------------  ---------------------------------------------  -------------------------  -------------------------------------------------  --------------------------------------------------
tx_community              fe_users                                       user                       first_name last_name image
------------------------  ---------------------------------------------  -------------------------  -------------------------------------------------  --------------------------------------------------
tx_cwtcommunity_pi1       fe_users                                       action=getviewprofile&uid  first_name last_name image                         uploads/pics/
------------------------  ---------------------------------------------  -------------------------  -------------------------------------------------  --------------------------------------------------
tx_news_pi1               tx_news_domain_model_news                      news                       title teaser tstamp sys_language_uid, bodytext
------------------------  ---------------------------------------------  -------------------------  -------------------------------------------------  --------------------------------------------------
tx_camaliga_pi1           tx_camaliga_domain_model_content               content                    title tstamp image sys_language_uid, shortdesc
------------------------  ---------------------------------------------  -------------------------  -------------------------------------------------  --------------------------------------------------
tx_restdoc_pi1            tx_restdoc_pi1                                 doc                        NA
========================  =============================================  =========================  =================================================  ==================================================

NA: Not available for extensions without TYPO3-tables or/and non-numeric showUid (Optional URL parameter) – Parameter.


Adding entries to table “Plugin to table map”
---------------------------------------------

Extension users and authors, who want to enable rating and commenting on their records, may add entries to TYPO3 table “Plugin to table map”. 
Here is an example how it should be done:

Make a new record in table “Plugin to table map”. 
If your plug-ins extensionkey is **tx_myext_pi1**  and its records table is **tx_myext_mytable** , then the URL calling your extension will look like this:

http://domain.tld/index.php?id=12345&tx_myext_pi1[showUid]=67890

(Parameter “showUid” is normally set by default extension design)

**toctoc_comments**  will understand that it must refer to tx_myextmytable for triggering prefix
tx_myext_pi1.

Optional URL parameter
^^^^^^^^^^^^^^^^^^^^^^

Some extensions use names other than “showUid” to refer to a single record.

Our extension needs to know the name of this URL parameter to find the record's
uid.

Since toctoc_comments 8.1.0 also non numeric showUid-Parmeters can be mapped. 
Typically the extensions using non-numeric showUid parameters do not maintain TYPO3 tables,
That's why for these extensions “displayfields” is not available (must be left empty) – as 
it references normally fields in the according TYPO3 table.

Why optional ?
""""""""""""""

Extensions mostly use “showUid” parameter. If “showUid” is used, there is no need to repeat
it in “Plugin to table map”, it will be the default.

With “Optional URL parameter” it is possible to use custom URL parameter with
**toctoc_comments** . 

If your extension, for example, uses parameter “newsid” to display it's records, then add
“newsid” to the entry concerning your extension in “Plugin to table map” field “Optional
URL parameter”.

So if the paramenter is “newsid”, the URL looks like this:

::

    `http://domain.tld/index.php?id=12345&tx_myext_pi1[newsid]=67890 <http://domain.tld/index.php?id=12345&tx_myext_pi1[uid]=67890>`__


**toctoc_comments**  will understand that record's uid value is 67890.

    
Entries for top Ratings
^^^^^^^^^^^^^^^^^^^^^^^

displayfields
"""""""""""""

For selecting topRatings data on records like News or Products **toctoc_comments** needs to know
which fields of the record to display. 
In displayfields you can specify title,
time of the record, the content (will be cropped) and you can specify if toctoc_comments should use
translated records (in the same records table) with sys_languahe_uid, also you can specify the name
of the field holding an image for display.

A displayfield has the following syntax

::

    Field for title [filed for time] [field for image] [field for sys_language_uid], [field for content]

for tt_news it looks like this:

::

    title tstamp image sys_language_uid, short

When you install or update to toctoc_comments 4.0 or above, then the plugin automatically fills in
some fields for existing prefixes. displayfields and topratingsimagesfolder are set to default
values, that can be changed as you want later in the Backend in the table.

topratingsimagesfolder
""""""""""""""""""""""

If in displayfileds an image is specified, then we need to now the folder containing the images of
the extension, Normally this is uploads/pics/, but it can be another folder which can be specified
here.

topratingsdetailpage
""""""""""""""""""""

Some website allow their records to be rated on overview pages and also on detailpages. It concerns
mainly the extensions **tt_products**  and **tt_news.** So linking the rated item to the overview
page is a bad idea - here you can force the page which displays the detail records.
    
Community extensions
^^^^^^^^^^^^^^^^^^^^

cwt_community
"""""""""""""

You need to create the following "Plugin to table map":

prefix: tx_cwtcommunity_pi1

table: fe_users

showUid parameter: action=getviewprofile&uid

community
"""""""""

You need to create the following "Plugin to table map":

prefix: tx_community

table: fe_users

showUid parameter: user

See also :ref:`using-ajax-social-network`
