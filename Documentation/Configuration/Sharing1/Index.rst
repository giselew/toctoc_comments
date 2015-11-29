.. ==================================================
.. FOR YOUR INFORMATION
.. --------------------------------------------------
.. -*- coding: utf-8 -*- with BOM.

.. include:: ../../Includes.txt


.. _configuration-sharing-1:

sharing
-------

TypoScript options in sharing configure
the sharing component, such as design used and what social networks will be available for
sharing

All sharing options are valid per plugin (P). 
The sharing options – up to
Version 5.5.0 – were part of the “advanced”-TypoScript-options.
Here's their
new place :-)

=========================  ==========  =======================================================  ==============================
**Property:**              Data type:  Description:                                             Default:
=========================  ==========  =======================================================  ==============================
useSharing                 boolean     Use of Share-Links for social networks like Facebook,    1
                                       Google+ and Twitter

                                       (P – Sharing – use sharing)
-------------------------  ----------  -------------------------------------------------------  ------------------------------
useOnlySharing             boolean     Use of Use the plugin only to display sharing            0
                                       (P – Sharing – use only sharing)
                                       (V 8.0.0)
-------------------------  ----------  -------------------------------------------------------  ------------------------------
sharingNoCalculatedCSS     boolean     if you dont use the sharing components at all you can    0
                                       set this to 1, CSS generation for the sharrre component
                                       will be turned off resulting in less CSS.

                                       \(W) (V 5.0.0.)
-------------------------  ----------  -------------------------------------------------------  ------------------------------
useSharingDesign           int         Use Design with or without (default)                     0
                                       buttons 
                                       Default-popup=0,buttons-popup=1,
                                       default-open=2,buttons-open=3,Add This
                                       small=4,static display=5
                                       Static display uses a deactivated version of design 3,
                                       buttons-open
                                       Don't combine 1 and 3 on the same webpage.
                                       (P – Sharing – use sharing design)
-------------------------  ----------  -------------------------------------------------------  ------------------------------
dontUseSharingFacebook     boolean     Use of Share-Link for Facebook is suppressed             0

                                       (P – Sharing – don't use Sharing for
                                       Facebook)
-------------------------  ----------  -------------------------------------------------------  ------------------------------
dontUseSharingGoogle       boolean     Use of Share-Link for Google+ is suppressed              0

                                       (P – Sharing – don't use Sharing for Google+)
-------------------------  ----------  -------------------------------------------------------  ------------------------------
dontUseSharingTwitter      boolean     Use of Share-Link for Twitter is suppressed              0

                                       (P – Sharing – don't use Sharing for Twitter)
-------------------------  ----------  -------------------------------------------------------  ------------------------------
dontUseSharingLinkedIn     boolean     Use of Share-Link for LinkedIn is suppressed             0 (V 5.0.0.)

                                       (P – Sharing – don't use Sharing for
                                       LinkedIn)
-------------------------  ----------  -------------------------------------------------------  ------------------------------
dontUseSharingStumbleupon  boolean     Use of Share-Link for Stumbleupon is suppressed          0 (V 5.0.0.)

                                       (P – Sharing – don't use Sharing for
                                       Stumbleupon)
-------------------------  ----------  -------------------------------------------------------  ------------------------------
dontUseSharingPinterest    boolean     Use of Share-Link for Pinterest is suppressed            0

                                       \(P) (V 5.0.0.)
-------------------------  ----------  -------------------------------------------------------  ------------------------------
dontUseSharingDigg         boolean     Use of Share-Link for Digg is suppressed                 0

                                       \(P ) (V 5.0.0.)
-------------------------  ----------  -------------------------------------------------------  ------------------------------
dontUseSharingDelicious    boolean     Use of Share-Link for Delicious is suppressed            0

                                       \(P) (V 5.0.0.)
-------------------------  ----------  -------------------------------------------------------  ------------------------------
dontUseSharingAddThisMore  boolean     Don't Use Add This more button Use of
                                       additional Share-Links with Add this is suppressed
-------------------------  ----------  -------------------------------------------------------  ------------------------------
AddThisID                  string      Your ID string for Add This,
                                       like ra-41230c846b24bb7c
-------------------------  ----------  -------------------------------------------------------  ------------------------------
shareUsersTotalText        string      Optional title for sharing line, it replaces text
                                       "share this page" after the total number of users who
                                       shared

                                       (V 5.4.0) (P)
-------------------------  ----------  -------------------------------------------------------  ------------------------------
useShareIcon               boolean     use an icon in the sharing line                          1

                                       (V 5.4.0)
-------------------------  ----------  -------------------------------------------------------  ------------------------------
shareDataText              string      Optional text for shared item on Twitter, as shown in
                                       the share-message of the social network sharers

                                       (V 5.4.0) (P)
-------------------------  ----------  -------------------------------------------------------  ------------------------------
sharePageURL               string      Page URL you want to share. If left empty the current
                                       URL will be shared

                                       \(P)

                                       (V 6.0.0)
-------------------------  ----------  -------------------------------------------------------  ------------------------------
noShareCount               boolean     Dont show share count: If set to 1, the sharing totals   0
                                       won't be displayed

                                       (V 8.0.0)
-------------------------  ----------  -------------------------------------------------------  ------------------------------
**Options setup-only**
-------------------------  ----------  -------------------------------------------------------  ------------------------------
staticMode                 boolean     if enabled, sharing will be static                       0
                                       (only results shown, sharing closed)
                                       
                                       when a sharePageURL is given then staticMode is 
                                       activated automatically and the sharing component 
                                       displays in static mode

                                       (V 8.0.0) (P)
-------------------------  ----------  -------------------------------------------------------  ------------------------------
staticModeNoDetails        boolean     show only sharecount(1) or details by sharer(0)          1

                                       (V 8.0.0)(P)
=========================  ==========  =======================================================  ==============================
