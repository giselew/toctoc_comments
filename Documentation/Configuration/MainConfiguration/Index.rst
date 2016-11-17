.. ==================================================
.. FOR YOUR INFORMATION
.. --------------------------------------------------
.. -*- coding: utf-8 -*- with BOM.

.. include:: ../../Includes.txt


.. _configuration-main-configuration:

Main configuration
------------------

TS options are valid per plugin
instance.

Some options, by their nature, are valid per webpage, others are valid site-wide. We marked
properties which are valid for the entire site with an (S) in the description, these valid for a
webpage are marked with an (W).

So don't setup options marked with (S) or
(W) per Plugin. Set them either in general Plugin TS (S) and (W) or if needed in a template attached
to the webpage (W).

Additionally we marked the options available in the backend plugin with (P – Page, mode(if
present) - Name in the backend)

For Updates we started to add the version number to new TS options, starting with version V 5.0.0.
Also changes to defaults are tagged by version number. 

Note: The following TypoScript-options apply to **plugin.tx_toctoc_comments_pi1** , it includes all
apart from the AJAX-Login part of the extension, which you'll find after this chapter, these option
are available as plugin.tx_toctoc_comments_pi2.

==============================  ==============  ============================================================  ============================================================================================
**Property:**                   Data type:      Description:                                                  Default:
==============================  ==============  ============================================================  ============================================================================================
storagePid                      int+            Page Uid of the Sysfolder where comment records will be       empty
                                                stored.

                                                Current page if empty.

                                                (P – General,
                                                Normal – Store records at page:)
------------------------------  --------------  ------------------------------------------------------------  --------------------------------------------------------------------------------------------
code                            string          Operation-mode of the commenting component:                   FORM, COMMENTS (V 5.0.0.)

                                                COMMENTS,FORM: First comments list, then the form

                                                FORM,COMMENTS: First the form is shown then the
                                                comments list

                                                COMMENTS: Only Comments list is shown
------------------------------  --------------  ------------------------------------------------------------  --------------------------------------------------------------------------------------------
externalPrefix                  string          See Triggering prefix in User guide.                          pages

                                                (P – General, Normal – Triggering prefix)
------------------------------  --------------  ------------------------------------------------------------  --------------------------------------------------------------------------------------------
templateFile                    string          Template file for the plugin. Accepts either                  EXT:toctoc_comments/res/template/
                                                site-relative path or extension-related path (EXT:            toctoccomments_template.html
                                                prefix)
                                                \(W)
------------------------------  --------------  ------------------------------------------------------------  --------------------------------------------------------------------------------------------
commentsPerPage                 int             Number of comments show in a comments list                    3
------------------------------  --------------  ------------------------------------------------------------  --------------------------------------------------------------------------------------------
minCommentLength                int+            Required length for a comment (W)                             10
------------------------------  --------------  ------------------------------------------------------------  --------------------------------------------------------------------------------------------
maxCommentLength                int+            Maximal length for a comment (W)                              4000
------------------------------  --------------  ------------------------------------------------------------  --------------------------------------------------------------------------------------------
commentCropLength               int+            Comment cropping: After this length a comment is              256
                                                cropped at initial display (W)
------------------------------  --------------  ------------------------------------------------------------  --------------------------------------------------------------------------------------------
reviewCropLength                int+            Review-comment cropping: After this length a comment          512
                                                used as a review is cropped at initial display (W)
                                                (V 6.0.0)
------------------------------  --------------  ------------------------------------------------------------  --------------------------------------------------------------------------------------------
UserImageSize                   int+            Size of user image in pixels. Image will be cropped           32
                                                from the center of the original image (square) (W)
                                                (V 9.1.0.)
------------------------------  --------------  ------------------------------------------------------------  --------------------------------------------------------------------------------------------
UserImageSizeInForm             int+            Size of user image in forms, in pixels or empty, if empty it  
                                                takes same value like UserImageSize, 18 to 96 is allowed.
------------------------------  --------------  ------------------------------------------------------------  --------------------------------------------------------------------------------------------
useUserImage                    boolean         Use or not use the user-image                                 1
------------------------------  --------------  ------------------------------------------------------------  --------------------------------------------------------------------------------------------
userContactUC                   boolean         This option enables display of basic user contact             1
                                                information in usercards
------------------------------  --------------  ------------------------------------------------------------  --------------------------------------------------------------------------------------------
userHomepageUC                  boolean         This option enables display of the users homepage in          1
                                                usercards
------------------------------  --------------  ------------------------------------------------------------  --------------------------------------------------------------------------------------------
userEmailUC                     boolean         This option enables display of the email of the
                                                commenting user in usercards
------------------------------  --------------  ------------------------------------------------------------  --------------------------------------------------------------------------------------------
userLocationUC                  boolean         This option enables display of the users location in          1
                                                usercards
------------------------------  --------------  ------------------------------------------------------------  --------------------------------------------------------------------------------------------
userStatsUC                     boolean         This option enables display of statistics in usercards        1
------------------------------  --------------  ------------------------------------------------------------  --------------------------------------------------------------------------------------------
UCUserStatsByEmail              boolean         Make statistics using email: The stats                        0
                                                are based on toctoc_userid by default (0), enabling
                                                stats by email links together toctoc_userids with same
                                                initial or current email
                                                (V 5.3.0)
------------------------------  --------------  ------------------------------------------------------------  --------------------------------------------------------------------------------------------
userIPUC                        boolean         This option enables display IP information about the          0
                                                user in usercards
------------------------------  --------------  ------------------------------------------------------------  --------------------------------------------------------------------------------------------
timeoutUC                       int+            Time in seconds for display of a user-card. Values            9
                                                between 3 and 15 are ok
------------------------------  --------------  ------------------------------------------------------------  --------------------------------------------------------------------------------------------
HTMLEmail                       boolean         e-mail are sent in HTML-Format (1) or Text format (0)         1
------------------------------  --------------  ------------------------------------------------------------  --------------------------------------------------------------------------------------------
HTMLEmailFontFamily             string          Font Family for HTML E-Mail                                   tahoma,verdana,arial,sans-serif
------------------------------  --------------  ------------------------------------------------------------  --------------------------------------------------------------------------------------------
sessionTimeout                  int+            Timeout for User-Sessions in minutes. After this time         1440
                                                sessions older than the timeout are deleted by the PHP
                                                Garbage collector. Session files were in
                                                toctoc_comments Sessionfolder in typo3temp, since V 5.2.2 
                                                the sessions are stored in the extension-directory in
                                                pi1/sessionTemp/TocTocCommentsSessions
                                                \(S), (V 5.1.0)
------------------------------  --------------  ------------------------------------------------------------  --------------------------------------------------------------------------------------------
dbCacheTimeout                  int+            Timeout for db-cache in minutes (7 days), must be             10080
                                                longer than sessionTimeout
                                                \(S), (V 9.2.0)
------------------------------  --------------  ------------------------------------------------------------  --------------------------------------------------------------------------------------------
**Options from setup.txt**
------------------------------  --------------  ------------------------------------------------------------  --------------------------------------------------------------------------------------------
dontSkipSearchEngines           boolean         Comments are hidden from search engines, if you want          0
                                                search-engines to index all your comments set this
                                                option to 1 (useful for single website
                                                previews)
                                                \(W), (V 5.2.2)
------------------------------  --------------  ------------------------------------------------------------  --------------------------------------------------------------------------------------------
pluginmode                      int             Empty, 0: Comments and Form, Sharing and Ratings              Empty

                                                1 – Recent comments

                                                2 – Report bad comment

                                                3 – Top ratings

                                                4 – Other charts

                                                5 – AJAX Login

                                                6 – User Center (V6.0.0)

                                                7 – Comments Search (V7.0.0)
                                                
                                                8 – Deprecated, removal in version 9.3: Top sharings (V8.0.0)

                                                (P – General – Mode )
------------------------------  --------------  ------------------------------------------------------------  --------------------------------------------------------------------------------------------
additionalClearCachePagesLocal  list            Locally needed pages that should extend
                                                additionalClearCachePages. This is needed for cloned
                                                views on comments. (LIST and DETAIL-views as well).

                                                (P – General, Normal –
                                                Additional pages
                                                to clear cache )
------------------------------  --------------  ------------------------------------------------------------  --------------------------------------------------------------------------------------------
optionalRecordId                string          A specific record to comment on, it can be a content          Example: tt_news_72
                                                element or a record with a table to prefix map defined,
                                                or a virtual content_element_id. Virtual content
                                                elements are needed when placing multiple plugins into
                                                1 'real' TYPO3-Content element.

                                                See: also externalPrefix for use of records

                                                You can specify a content element holding another
                                                *toctoc_comments*  plugin with this.
                                                If so, the comments of the other
                                                plugin are displayed, but still you can configure the
                                                current plugin as you want. It works
                                                for **toctoc_comment** plugins implemented for comments
                                                on pages (default).

                                                For **toctoc_comment** plugins implemented for comments
                                                on records it will not work, the prefix-to-table map
                                                can be used only in context of the plugin for the
                                                external records. And makes no sense, because comments
                                                are attached to records and not to a content element.

                                                (P – General, Normal – Trigger optional
                                                Record)
------------------------------  --------------  ------------------------------------------------------------  --------------------------------------------------------------------------------------------
preventDuplicatePosts           boolean         If set, prevents duplicate posts on the same page             1 
------------------------------  --------------  ------------------------------------------------------------  --------------------------------------------------------------------------------------------
useFieldsSequence               lastname        Specify the fields you want to use for commenting and         firstname, lastname, email, location
                                                the sequence of their appearance in the form

                                                possible values = commenttitle, firstname, lastname,
                                                email, location, homepage (title is always on top, the
                                                remaining fields will display in this sequence


                                                # possible required values = commenttitle, firstname,
                                                location, homepage (email, content and lastname are
                                                always mandatory)

                                                (V 5.0.0.)
------------------------------  --------------  ------------------------------------------------------------  --------------------------------------------------------------------------------------------
useGenderWithField              lastname        The 2 icons to select the gender of the commenter are         lastname
                                                shown with this field

                                                (V 5.0.0.)
------------------------------  --------------  ------------------------------------------------------------  --------------------------------------------------------------------------------------------
requiredFields                  list of values  Comma-separated list of fields to be required for             Minimum recommended and
                                                comments. Available values:                                   default:
                                                firstname, lastname, email
                                                Remark: lastname, email and content are always required       (V 5.0.0.)
                                                by the system.
                                                If you want only an Alias, instead of firstname, then use 
                                                lastname for this purpose.
                                                Fe_users fields are filled automatically.
------------------------------  --------------  ------------------------------------------------------------  --------------------------------------------------------------------------------------------
requiredFields_errorWrap        array           dataWrap for required field (if field is not filled           dataWrap = <span
                                                properly)
                                                                                                              class="tx-tc-required-error">
                                                
                                                                                                              {LLL:EXT:toctoc_comments/pi1/
                                                                                                              
                                                                                                              locallang.xml:error}:&#32;|</span>
------------------------------  --------------  ------------------------------------------------------------  --------------------------------------------------------------------------------------------
firstName_stdWrap               array           Wrap for “First name” field                                   wrap = <b>|</b>
------------------------------  --------------  ------------------------------------------------------------  --------------------------------------------------------------------------------------------
lastName_stdWrap                array           Wrap for “Last name” field                                    wrap = <b>|</b>
------------------------------  --------------  ------------------------------------------------------------  --------------------------------------------------------------------------------------------
email_stdWrap                   array           Wrap for “E-mail” field                                       wrap = (empty)
------------------------------  --------------  ------------------------------------------------------------  --------------------------------------------------------------------------------------------
webSite_stdWrap                 array           Wrap for “Website” field                                      wrap =
------------------------------  --------------  ------------------------------------------------------------  --------------------------------------------------------------------------------------------
location_stdWrap                array           Wrap for “Location” field                                     wrap =
------------------------------  --------------  ------------------------------------------------------------  --------------------------------------------------------------------------------------------
content_stdWrap                 array           Wrap for “Content” field                                      wrap =
------------------------------  --------------  ------------------------------------------------------------  --------------------------------------------------------------------------------------------
commentTitle_stdWrap            array           Wrap for “Comment title” field                                wrap = <b>|</b><br />

                                                (V 5.0.0.)
------------------------------  --------------  ------------------------------------------------------------  --------------------------------------------------------------------------------------------
crdate_stdWrap                  array           Wrap for recent comments list “Date” field                    wrap =
------------------------------  --------------  ------------------------------------------------------------  --------------------------------------------------------------------------------------------
author_stdWrap                  array           Wrap for recent comments list “author” field                  wrap = "| ;- "
------------------------------  --------------  ------------------------------------------------------------  --------------------------------------------------------------------------------------------
recentComment_stdWrap           array           Wrap for recent comments list “Comment” field                 wrap =
------------------------------  --------------  ------------------------------------------------------------  --------------------------------------------------------------------------------------------
Options for smilies
------------------------------  --------------  ------------------------------------------------------------  --------------------------------------------------------------------------------------------
smiliePath                      string          Path to directory with smiley image files                     EXT:toctoc_comments/res/smilie
------------------------------  --------------  ------------------------------------------------------------  --------------------------------------------------------------------------------------------
fileExt                         string          file extension of smiley images                               png
------------------------------  --------------  ------------------------------------------------------------  --------------------------------------------------------------------------------------------
smilies                         array           Array with all available smilies defined                      see setup.txt

                                                Syntax:
                                                [filename] = [string1] [string2]

                                                Smilies are a mix from Facebook-like smilies and the 
                                                smilies from the original smilie-extension. Smilies
                                                gisele (Gisèle Wendl), Roman and Jacqueline are, just
                                                like the famous developer Putnam from Facebook,
                                                dedicated to the related, living persons, who
                                                contributed to this extension.
==============================  ==============  ============================================================  ============================================================================================
