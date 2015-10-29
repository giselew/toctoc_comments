.. ==================================================
.. FOR YOUR INFORMATION
.. --------------------------------------------------
.. -*- coding: utf-8 -*- with BOM.

.. include:: ../../Includes.txt


.. _configuration-attachments:

attachments
-----------

=====================================================  ==========  =======================================================  ====================================
**Property:**                                          Data type:  Description:                                             Default:
=====================================================  ==========  =======================================================  ====================================
useWebpagePreview                                      boolean     Use attachment feature web page preview: Web page        1
                                                                   previews are allowed

                                                                   (P – Attachments – 
                                                                   Use attachment type webpage
                                                                   preview)
-----------------------------------------------------  ----------  -------------------------------------------------------  ------------------------------------
useWebpageVideoPreview                                 boolean     Use attachment feature web page video preview: Flash-    1
                                                                   and HTML5-videos in are shown. Whenever the webpage
                                                                   scanner finds a video, then the video will be displayed
                                                                   instead of the HTML preview of the webpage.
-----------------------------------------------------  ----------  -------------------------------------------------------  ------------------------------------
webpagePreviewHeight                                   int+        Height of the                                            70
                                                                   Webpagepreview. Associated webpage
                                                                   preview-images will have same size. min is 30 max is
                                                                   120 pixels
-----------------------------------------------------  ----------  -------------------------------------------------------  ------------------------------------
maxCharsPreviewTitle                                   int+        Character length of the webpage preview                  70
                                                                   title
                                                                   values between 20 and 250 are
                                                                   accepted by the system
-----------------------------------------------------  ----------  -------------------------------------------------------  ------------------------------------
webpagePreviewDescriptionLength                        int+        Character length of the webpage preview description.     160
                                                                   Values between 50 and 500 are
                                                                   accepted by the system
-----------------------------------------------------  ----------  -------------------------------------------------------  ------------------------------------
webpagePreviewDescriptionMinimalLength                 int+        Minimal character length of the webpage preview          60
                                                                   description
                                                                   When a description found
                                                                   on a webpage is shorter than this number, the system
                                                                   gets the description from Google - values must be
                                                                   between 20 and 150
-----------------------------------------------------  ----------  -------------------------------------------------------  ------------------------------------
webpagePreviewCacheTimePage                            int+        Cache expiry for scanned pages in minutes                180

                                                                   After this time pages are scanned again. - values must
                                                                   be between 0 and 1440 (1 day max)
-----------------------------------------------------  ----------  -------------------------------------------------------  ------------------------------------
webpagePreviewCacheTimeTempImages                      int+        Cache expiry for temporary stored images in minutes      60

                                                                   After this time images in the temp folder are deleted,
                                                                   after a new page has been scanned. - values must be
                                                                   between 5 and 120 (2 hours max)
-----------------------------------------------------  ----------  -------------------------------------------------------  ------------------------------------
webpagePreviewCacheClearManual                         boolean     Delete temp images manually or by scheduled script

                                                                   If you want to control manually deletion of outdated
                                                                   images in temp folder set this to 1 - you can use a
                                                                   scheduled PHP-script, or if you don't mind, even delete
                                                                   the files when your disk-space contingent is reached.
-----------------------------------------------------  ----------  -------------------------------------------------------  ------------------------------------
webpagePreviewNumberOfImages                           int+        Number of images in webpage                              10
                                                                   previews
                                                                   The number of images shown
                                                                   influences the performance during scanning of webpages
                                                                   remarkably. Values between 4 and 25 are possible
-----------------------------------------------------  ----------  -------------------------------------------------------  ------------------------------------
webpagePreviewScanMinimalImageFileSize                 int+        Minimal file size for an image while scanning            1500
                                                                   webpages
                                                                   Value in Bytes, 300 - 6000
-----------------------------------------------------  ----------  -------------------------------------------------------  ------------------------------------
webpagePreviewScanMinImageSize                         int+        Minimal Height and Width for an image while scanning     40
                                                                   webpages Value in Pixel, 30 - 100
-----------------------------------------------------  ----------  -------------------------------------------------------  ------------------------------------
webpagePreviewScanMaxImageSize                         int+        Maximal Height and Width for an image while scanning     450
                                                                   webpages
                                                                   Value in Pixel, 300 - 1280
-----------------------------------------------------  ----------  -------------------------------------------------------  ------------------------------------
useLikeDislikewebpagePreviewScanMinLogoSize            int+        Minimal Height and Width for a logo image while          30
                                                                   scanning webpages: Value in Pixel, 20 - 70
-----------------------------------------------------  ----------  -------------------------------------------------------  ------------------------------------
webpagePreviewScanMaxImageScans                        int+        Maximal Pictures scanned (if logo has been found         40
                                                                   already)
                                                                   Values are 20 to 100, higher
                                                                   values result in longer scan time
-----------------------------------------------------  ----------  -------------------------------------------------------  ------------------------------------
webpagePreviewScanMaxImageScansForLogo                 int+        Maximal Pictures scanned if logo has not been found      55
                                                                   already:
                                                                   Values are 30 to 150, must
                                                                   be higher than webpagePreviewScanMaxImages to make
                                                                   sense
-----------------------------------------------------  ----------  -------------------------------------------------------  ------------------------------------
webpagePreviewScanMaxHorzizontalRelation               int+        Maximal allowed x to y relation for scanned              5
                                                                   images
                                                                   The integer value when dividing
                                                                   width by height a scanned image may have. Values
                                                                   between 1 and 5 are possible
-----------------------------------------------------  ----------  -------------------------------------------------------  ------------------------------------
webpagePreviewScanmaxverticalrelation                  int+        Maximal allowed y to x relation for scanned              3
                                                                   images
                                                                   The integer value when dividing
                                                                   height by width a scanned image may have. Values
                                                                   between 1 and 4 are possible
-----------------------------------------------------  ----------  -------------------------------------------------------  ------------------------------------
webpagePreviewScanLogoPatterns                         boolean     List of Patterns for logo                                logo,crght
                                                                   recognition
                                                                   A list of string patterns,
                                                                   separated by commas - if a pattern is found in a file
                                                                   name, then the image file is considered as logo of the
                                                                   website scanned. Be careful with short patterns -
                                                                   patterns shorter than 4 chars are ignored
-----------------------------------------------------  ----------  -------------------------------------------------------  ------------------------------------
webpagePreviewScanExcludeImagePatterns                 boolean     List of Patterns for image exclusion during              pixeltrans, spacer, 
                                                                   scan                                                     youtube, rclogos, 
                                                                   A list of string patterns,                               white, transpa, 
                                                                   separated by commas - if a pattern is found in a file
                                                                   name, then the image file is excluded
-----------------------------------------------------  ----------  -------------------------------------------------------  ------------------------------------
webpagePreviewDescriptionPortionLength                 int+        Minimal Length of a page text fragment during scan:      40
                                                                   When scanning text from pages, then the content of
                                                                   p-Tags and span-tags is analyzed. The content must be
                                                                   longer than this value for inclusion in page
                                                                   description. Values between 10 and 100 are accepted
-----------------------------------------------------  ----------  -------------------------------------------------------  ------------------------------------
webpagePreviewCurlTimeout                              int+        Timeout for HTML requests in                             7000
                                                                   ms
                                                                   Request are canceled after this
                                                                   duration. 3000 to 13000.
-----------------------------------------------------  ----------  -------------------------------------------------------  ------------------------------------
usePicUpload                                           boolean     Use Image attachment.                                    1
-----------------------------------------------------  ----------  -------------------------------------------------------  ------------------------------------
usePdfUpload                                           boolean     Use PDF attachment.                                      1
-----------------------------------------------------  ----------  -------------------------------------------------------  ------------------------------------
picUploadDims                                          int+        Maximal height and width for an preview image after      100
                                                                   upload. Value in Pixel, 50 - 150.
-----------------------------------------------------  ----------  -------------------------------------------------------  ------------------------------------
picUploadMaxDimX                                       int+        Maximal width for an image after upload. Value in        800
                                                                   Pixel, 100 - 900.
-----------------------------------------------------  ----------  -------------------------------------------------------  ------------------------------------
picUploadMaxDimY                                       int+        Maximal height for an image after upload. Value in       900
                                                                   Pixel, 100 - 1200.
-----------------------------------------------------  ----------  -------------------------------------------------------  ------------------------------------
picUploadMaxDimWebpage                                 int+        Maximal dimensions for an image for display in the       470
                                                                   comments list, 200 - 800.
-----------------------------------------------------  ----------  -------------------------------------------------------  ------------------------------------
picUploadMaxDimYWebpage                                int+;       Maximal height for an image for display in the comments  300
                                                                   list, 200 - 800.
-----------------------------------------------------  ----------  -------------------------------------------------------  ------------------------------------
picUploadMaxfilesize                                   int+        Maximal file size for image upload. Value in KB, 10 -    2500
                                                                   100000.
-----------------------------------------------------  ----------  -------------------------------------------------------  ------------------------------------
pdfUploadMaxfilesize                                   int+        Maximal file size for pdf upload. Value in KB, 10 -      3000
                                                                   100000.
-----------------------------------------------------  ----------  -------------------------------------------------------  ------------------------------------
soundcloudClientID                                     string      Soundcloud Client ID: Needed to make proper display of
                                                                   webpage previews from soundcloud.com

                                                                   How to make a soundcloud app? Sign into or open your
                                                                   soundcloud account, then go to
                                                                   http://soundcloud.com/you/apps
-----------------------------------------------------  ----------  -------------------------------------------------------  ------------------------------------
soundcloudClientSecret                                 string      Soundcloud Client Secret: Secret matching the
                                                                   Soundcloud Client ID
-----------------------------------------------------  ----------  -------------------------------------------------------  ------------------------------------
**Options only available in the plugin**                           **Options could also be set from TypoScript**
-----------------------------------------------------  ----------  -------------------------------------------------------  ------------------------------------
useTopWebpagePreview                                   int+        ID of the webpage preview to show on top of the
                                                                   plugin
                                                                   (P – Attachments –
                                                                   Optional webpage
                                                                   preview on top)
-----------------------------------------------------  ----------  -------------------------------------------------------  ------------------------------------
topWebpagePreviewPicture                               int+        Index of preview picture for the webpage preview to
                                                                   show on top of the plugin

                                                                   (P – Attachments – Index of preview picture (must
                                                                   exist, default is 0))
=====================================================  ==========  =======================================================  ====================================
