.. ==================================================
.. FOR YOUR INFORMATION
.. --------------------------------------------------
.. -*- coding: utf-8 -*- with BOM.

.. include:: ../../Includes.txt


.. _configuration-advanced:

advanced
--------

==============================================================================  ==========  =======================================================  =====================================================
**Property:**                                                                   Data type:  Description:                                             Default:
==============================================================================  ==========  =======================================================  =====================================================
dateFormat                                                                      string      Defines date format to use for date/time information     %d.%m.%Y
                                                                                            about posts. Format specifiers depend on dateFormatMode
                                                                                            configuration option. See PHP function `date()           (Changed in V 7.2.0)
                                                                                            <http://www.php.net/date>`__ and `strftime()
                                                                                            <http://lv2.php.net/manual/en/function.strftime.php>`__
                                                                                            for information about format specifiers. If empty, 
                                                                                            defaults to concatenation of SYS->ddmmyy and SYS->hhmm
                                                                                            systemvariables (from Install tool) and dateFormatMode
                                                                                            is forced to “date”.

                                                                                            If the format is invalid, you will get an error-message
                                                                                            in the frontend.
------------------------------------------------------------------------------  ----------  -------------------------------------------------------  -----------------------------------------------------
dateFormatMode                                                                  string      Determines what PHP function to use for date             strftime
                                                                                            formatting. Defaults to “date”. If you want to use       (Changed in V 7.2.0)
                                                                                            month or week days in national language, you have to
                                                                                            use “strftime”.

                                                                                            Valid values are:

                                                                                            \(W)
------------------------------------------------------------------------------  ----------  -------------------------------------------------------  -----------------------------------------------------
commentReview                                                                   boolean     Commenting works in Review                               0
                                                                                            mode: Switching on this flag changes
                                                                                            the behavior of the commenting plugin in the frontend.
                                                                                            Comments are considered as reviews
                                                                                            and are handled differently than comments.
                                                                                            Please read chapter “Reviews” for
                                                                                            more information on this

                                                                                            (P – General,
                                                                                            Advanced – Comments are reviews:)

                                                                                            (V 6.0.0)
------------------------------------------------------------------------------  ----------  -------------------------------------------------------  -----------------------------------------------------
closeCommentsAfter                                                              string      If set, automatically disables commenting for items      empty
                                                                                            older than this period. See **Close commenting after**
                                                                                            in the User manual for more information.

                                                                                            Setup-only option

                                                                                            (P – Advanced – 
                                                                                            Close commenting after)
------------------------------------------------------------------------------  ----------  -------------------------------------------------------  -----------------------------------------------------
commentingClosed                                                                boolean     Commenting can be totally suppressed, 0 (default) or 1   0
                                                                                            When commenting is closed also
                                                                                            rating is closed.

                                                                                            (P – Advanced – 
                                                                                            Commenting closed for this
                                                                                            plugin-instance)
------------------------------------------------------------------------------  ----------  -------------------------------------------------------  -----------------------------------------------------
autoConvertLinks                                                                boolean     If enabled, will search for possible links in comment    1
                                                                                            text and turn them to links. Specifically the following
                                                                                            texts are searched:

                                                                                            Anything that starts from these strings and till next
                                                                                            space will be converted to links. This procedure is not
                                                                                            very clever but works in most cases.

                                                                                            Links are always created with `rel=”nofollow”
                                                                                            <http://googleblog.blogspot.com/2005/01/
                                                                                            preventing-comment-spam.html>`__
                                                                                            and css class “tx-comments-external-autolink”.
                                                                                            There is no way to change any of these two attributes.
------------------------------------------------------------------------------  ----------  -------------------------------------------------------  -----------------------------------------------------
autoConvertLinksCropLength                                                      int+        Crop length for created links in comments:               50
                                                                                            Autoconverted links will be cropped if they exceed this
                                                                                            length (Values: 40 – 150)

                                                                                            (V 5.1.0.)
------------------------------------------------------------------------------  ----------  -------------------------------------------------------  -----------------------------------------------------
adminCommentResponse                                                            boolean     Admin can give direct comments on comments: When         0
                                                                                            notification mails for new comments come in, the admin
                                                                                            can give a direct reply which will be displayed below
                                                                                            the comment.
------------------------------------------------------------------------------  ----------  -------------------------------------------------------  -----------------------------------------------------
userCommentResponseLevels                                                       int+        Number of levels of comments on comments, values from 0  3
                                                                                            (none) to 20 are allowed
------------------------------------------------------------------------------  ----------  -------------------------------------------------------  -----------------------------------------------------
userCommentResponseLevelExpanded                                                int+        When displaying comments on comments this sets how many  1
                                                                                            levels are expanded. values from 0 (none) to 20 are
                                                                                            allowed
------------------------------------------------------------------------------  ----------  -------------------------------------------------------  -----------------------------------------------------
showFeUsercomments                                                              boolean     Show comments of FE Users:If set to 0 comments of FE     1
                                                                                            users are shown only after login.
------------------------------------------------------------------------------  ----------  -------------------------------------------------------  -----------------------------------------------------
showFeUsercommentsOnlyInSameUserGroup                                           boolean     Show comments for FE Users depending of the user         0
                                                                                            groups:For logged in users only comments by users of
                                                                                            the same user groups are shown (showFeUsercomments must
                                                                                            be set to 0).
------------------------------------------------------------------------------  ----------  -------------------------------------------------------  -----------------------------------------------------
commentatorNotify                                                               boolean     commentator of former comments can be notified about     1
                                                                                            new, approved comments
------------------------------------------------------------------------------  ----------  -------------------------------------------------------  -----------------------------------------------------
notificationLevel                                                               boolean     Scope for commentators that must be notified: 0: All     0
                                                                                            commentators in the comments-list, 1: Only if the new
                                                                                            comment is a reply, 2: like 1 but also if the comment
                                                                                            is a subsequent comment on the same parent comment

                                                                                            (V 5.4.0.)
------------------------------------------------------------------------------  ----------  -------------------------------------------------------  -----------------------------------------------------
notificationValidDays                                                           int+        Notification validity in days: 0: no limit, >= 1.        0
                                                                                            Number of days for notification after a commentator
                                                                                            left a comment

                                                                                            (V 5.4.0.)
------------------------------------------------------------------------------  ----------  -------------------------------------------------------  -----------------------------------------------------
commentatorNotifybyIP                                                           boolean     commentator of former comments are identified by their   1
                                                                                            IP:If enabled, the commentators are identified as per
                                                                                            their IP address if they are not logged in. If disabled
                                                                                            commentators who are not logged in can't disable E-Mail
                                                                                            notification on new comments.
------------------------------------------------------------------------------  ----------  -------------------------------------------------------  -----------------------------------------------------
moderationMessageWithComment                                                    boolean     Moderation message after posting a comment will contain  1
                                                                                            the posted comment as a confirmation. 
                                                                                            0 disables the feature, 1 enables it
                                                                                            (V 9.1.0.)
------------------------------------------------------------------------------  ----------  -------------------------------------------------------  -----------------------------------------------------
notificationForCommentatorEmail                                                 string      E-mail address to use when sending mails to users who
                                                                                            want to be notified on new comments
------------------------------------------------------------------------------  ----------  -------------------------------------------------------  -----------------------------------------------------
notificationForCommentatorEmailName                                             string      Name used in information e-mail for commentator of       %site% - Commentingsystem
                                                                                            former comments

                                                                                            (V5.3.0)
------------------------------------------------------------------------------  ----------  -------------------------------------------------------  -----------------------------------------------------
notificationForCommentatorHTMLEmailTemplate                                     string      HTML Template to use for notification email to           EXT:toctoc_comments/res/template/
                                                                                            commentator of former comments                           toctoccomments_template_commentator_email.html
------------------------------------------------------------------------------  ----------  -------------------------------------------------------  -----------------------------------------------------
notificationForCommentatorEmailTemplate                                         string      E-mail template for commentator of former comments       EXT:toctoc_comments/res/template/
                                                                                                                                                     toctoccomments_template_commentatoremail.txt
------------------------------------------------------------------------------  ----------  -------------------------------------------------------  -----------------------------------------------------
notificationForNewUserEmail                                                     string      Information e-mail for new user

                                                                                            Information e-mail for new user is sent from this
                                                                                            address

                                                                                            (V 7.4.1)
------------------------------------------------------------------------------  ----------  -------------------------------------------------------  -----------------------------------------------------
notificationForNewUserEmailName                                                 string      Name used in information e-mail for new user             %site% - Useradministration

                                                                                            (V 7.4.1)
------------------------------------------------------------------------------  ----------  -------------------------------------------------------  -----------------------------------------------------
notificationForNewUserHTMLEmailTemplate                                         string      HTML E-mail template for new user                        EXT:toctoc_comments/res/template/
                                                                                                                                                     toctoccomments_template_newuseremail.html

                                                                                            HTML-template to use for notification email to new user

                                                                                            (V 7.4.1)
------------------------------------------------------------------------------  ----------  -------------------------------------------------------  -----------------------------------------------------
notificationForNewUserEmailTemplate                                             string      Text e-mail template for new user:Text-template to use   EXT:toctoc_comments/res/template/
                                                                                            for notification email to new user                       toctoccomments_template_newuseremail.txt

                                                                                            (V 7.4.1)
------------------------------------------------------------------------------  ----------  -------------------------------------------------------  -----------------------------------------------------
notificationForPwdChangeHTMLEmailTemplate                                       string      HTML E-mail template for password changes and user       EXT:toctoc_comments/res/template/
                                                                                            COI:HTML-template to use for notification email to user  toctoccomments_template_forgotpwdemail.html
                                                                                            who needs to change his password (forgot or new user)

                                                                                            (V 7.4.1)

                                                                                            =
------------------------------------------------------------------------------  ----------  -------------------------------------------------------  -----------------------------------------------------
eIDHTMLTemplate                                                                 string      When clicking on Links in Admin-E-Mails this template    EXT:toctoc_comments/res/template/toctoccomments_template_eid.html
                                                                                            will be used to show the answer of the system (S)
------------------------------------------------------------------------------  ----------  -------------------------------------------------------  -----------------------------------------------------
CommentsShowOldPerCID                                                           int+        This is the scrolling multiplication number, telling     3
                                                                                            how many commentsPerPage the show older comments
                                                                                            function reveals at a time.
------------------------------------------------------------------------------  ----------  -------------------------------------------------------  -----------------------------------------------------
commentsEditBack                                                                int+        When a user can edit his comments, this number           1
                                                                                            indicates how many comments back the user is allowed to
                                                                                            edit. set 0 for none. allowed 0 to 50.
------------------------------------------------------------------------------  ----------  -------------------------------------------------------  -----------------------------------------------------
FeUserImagePath                                                                 string      Path where the feuser-images are stored. Normally        uploads/pics/
                                                                                            uploads/pics/. (W)
------------------------------------------------------------------------------  ----------  -------------------------------------------------------  -----------------------------------------------------
FeUserDbField                                                                   string      Database field in fe_users where *toctoc_comments*     image
                                                                                            should look for a user pic. (W)
------------------------------------------------------------------------------  ----------  -------------------------------------------------------  -----------------------------------------------------
useAdditionalFe_usersFields                                                     string      Only fe_users-fields in 'uid, pid, username, email,
                                                                                            image, gender, first_name, name, last_name, www, city,
                                                                                            country' are available (and the the FeUserDbField)

                                                                                            If you use custom fe_users markers in your template,
                                                                                            then you need to specify these fields here as a
                                                                                            comma-separated list of the field names you'd like to
                                                                                            use in addition.

                                                                                            fe_users marker: ###FEUSER_ . strtoupper($key) . ###,
                                                                                            example: ###FEUSER_FACEBOOK_ID### (field name of
                                                                                            fe_users is in capitals)

                                                                                            (V 7.0.1)
------------------------------------------------------------------------------  ----------  -------------------------------------------------------  -----------------------------------------------------
Formerly to version 6 in section advanced you had TS options for sharing.
You find them now in section “sharing”.
In version 7 the sharing options here in section advanced were removed.
------------------------------------------------------------------------------  ----------  -------------------------------------------------------  -----------------------------------------------------
recentcommentsPluginpages                                                       string      Pages with a record to display :

                                                                                            When a plugin is linked to a content element on a page,
                                                                                            but the page displays records, then you should indicate
                                                                                            the page-ids here as a comma separated list.

                                                                                            Used by recent comments (if mode Restrict to external
                                                                                            prefix = “All”) and report bad comments forms.
                                                                                            


                                                                                            Also your website must contain pages which are used to
                                                                                            display single records and then you place the plugin
                                                                                            toctoc_comments without setting up the triggering
                                                                                            prefix. 


                                                                                            So when linking on a comment of this page, the recent
                                                                                            comment list needs to know which record to display.

                                                                                            Here you simply select the concerned
                                                                                            pages. This option
                                                                                            and the next option recentcommentsPluginRecords go
                                                                                            together and they are **really rarely needed** .
------------------------------------------------------------------------------  ----------  -------------------------------------------------------  -----------------------------------------------------
recentcommentsPluginRecords                                                     string      Records for pages with a record to display
                                                                                            : Corresponding list of records, a
                                                                                            list like "tt_news_51, tt_products_65". Here you define
                                                                                            the records which need to be shown for the list of
                                                                                            pages where a record of a contained plugin should be
                                                                                            shown. The sequence of the records selected here must
                                                                                            be same as the pages.
------------------------------------------------------------------------------  ----------  -------------------------------------------------------  -----------------------------------------------------
commentsShowCount                                                               boolean     Show total number of comments In                         1
                                                                                            comments listing on top the total number of comments is
                                                                                            shown
------------------------------------------------------------------------------  ----------  -------------------------------------------------------  -----------------------------------------------------
commentsShowCountText                                                           boolean     Show number of comments with text, only number or with   0
                                                                                            icon In comments listing on top the
                                                                                            total number of comments has text aside or is just
                                                                                            displayed as a number
------------------------------------------------------------------------------  ----------  -------------------------------------------------------  -----------------------------------------------------
commentsShowCountLevel                                                          boolean     Level needed to show number of                           1
                                                                                            comments Display of number of comments
                                                                                            starts when number of comments is higher or equal this
                                                                                            level.
------------------------------------------------------------------------------  ----------  -------------------------------------------------------  -----------------------------------------------------
reverseSorting                                                                  boolean     Shows last comments first and reverses sorting order to  1
                                                                                            show last comments on level 0
                                                                                                                                                     (V 5.0.0.)
------------------------------------------------------------------------------  ----------  -------------------------------------------------------  -----------------------------------------------------
sortMostPopular                                                                 boolean     Show most popular comments first                         0

                                                                                            (V 5.4.0.)
------------------------------------------------------------------------------  ----------  -------------------------------------------------------  -----------------------------------------------------
useMostPopular                                                                  boolean     If you use popularity then sorting by popularity is      1
                                                                                            enabled in the comments list

                                                                                            (V 5.4.0.)
------------------------------------------------------------------------------  ----------  -------------------------------------------------------  -----------------------------------------------------
useSortMenu                                                                     boolean     use a menu for sorting of comments in the frontend       1

                                                                                            (V 5.4.0.)
------------------------------------------------------------------------------  ----------  -------------------------------------------------------  -----------------------------------------------------
invertBrowser                                                                   boolean     Invert comment browser position Puts                     1
                                                                                            comments browser on top or bottom of comments list.
                                                                                                                                                     (V 5.0.0.)
------------------------------------------------------------------------------  ----------  -------------------------------------------------------  -----------------------------------------------------
allowHTMLTagsInComments                                                         boolean     Allows HTML-Tags in comments. If set to 1 then           0
                                                                                            HTML-Tags can be used to format comments, extending the
                                                                                            BB-Codes, but more risky.
------------------------------------------------------------------------------  ----------  -------------------------------------------------------  -----------------------------------------------------
wallExtension                                                                   options     Enables plugin mode for walls of community extensions,   Options:
                                                                                            if so, only comments of you and your friends are shown.
                                                                                                                                                     inactive=0
                                                                                                                                                     
                                                                                                                                                     wall of tx_community=1, 
                                                                                                                                                     
                                                                                                                                                     wall of cwt_community=2]; 
                                                                                                                                                     
                                                                                                                                                     \(W)
------------------------------------------------------------------------------  ----------  -------------------------------------------------------  -----------------------------------------------------
communityProfileCommentsVisibility                                              options     only user=0, user and friends=1, all community           1
                                                                                            users=2 Enables visibility of comments
                                                                                            on users community profile page.
------------------------------------------------------------------------------  ----------  -------------------------------------------------------  -----------------------------------------------------
replyModeInline                                                                 boolean     Replies on comments are entered under the comment        1
                                                                                            replied on. Slows down bit performance.
------------------------------------------------------------------------------  ----------  -------------------------------------------------------  -----------------------------------------------------
replyModeInlineOpenForm                                                         boolean     reply mode inline with open form                         0
Form
                                                                                            for Replies on comments is shown instead of reply link
------------------------------------------------------------------------------  ----------  -------------------------------------------------------  -----------------------------------------------------
useEmoji                                                                        options     inactive=0,emoji images 16px=1,emoji images              1
                                                                                            20px=2
                                                                                            Make use of Emoji
                                                                                            pictures
                                                                                            Unicode Emojis are replaced
                                                                                            by image emojis in comments and while entering comments
                                                                                            :text emojis: are converted to unicode-emojis. (W)
------------------------------------------------------------------------------  ----------  -------------------------------------------------------  -----------------------------------------------------
useInternalSmiliesInEmojiSelector                                               boolean     Specify if the internal smilies are displayed in the     0
                                                                                            emoji selection panel                                    (V 9.1.0)
------------------------------------------------------------------------------  ----------  -------------------------------------------------------  -----------------------------------------------------
emojiConfigCacheLevel                                                           options     Caching of Emoji configurations:Starting up the Emojis   0
                                                                                            uncached costs much time. So we cache them. Here you
                                                                                            can specify at what level they are cached.

                                                                                            [site=0,page=1,plugin=2]
------------------------------------------------------------------------------  ----------  -------------------------------------------------------  -----------------------------------------------------
useMultilingual                                                                 boolean     Make Plugins multilingual                                0

                                                                                            If set to 0 TYPO3 translations of the plugin will
                                                                                            always contain the content of the default language
                                                                                            content element. If you set the option to 1 and
                                                                                            localize a plugin, the comments and ratings of the
                                                                                            plugin will be per language. (S recommended, W
                                                                                            possible)
------------------------------------------------------------------------------  ----------  -------------------------------------------------------  -----------------------------------------------------
cacheBackTrack                                                                  boolean     Show the user the plugins where data has changed since   1 
                                                                                            their first visit using the current session. 
                                                                                            (left plugin border gets a highlight)
                                                                                            (S recommended, W possible)
------------------------------------------------------------------------------  ----------  -------------------------------------------------------  -----------------------------------------------------
countViews                                                                      boolean     Enables counting of Plugin views: For each Plugin a      1
                                                                                            counter will be maintained and will be displayed on top
                                                                                            of comments list, if enabled
------------------------------------------------------------------------------  ----------  -------------------------------------------------------  -----------------------------------------------------
countViewsShowSince                                                             boolean     Shows view since date                                    1
------------------------------------------------------------------------------  ----------  -------------------------------------------------------  -----------------------------------------------------
showCountViews                                                                  boolean     Shows counting of Plugin views                           0
------------------------------------------------------------------------------  ----------  -------------------------------------------------------  -----------------------------------------------------
showCountViewsOnlyIfCommentsExist                                               boolean     Shows counting of Plugin views only if comments are      1
                                                                                            present. showCountViews must be set to 1.
------------------------------------------------------------------------------  ----------  -------------------------------------------------------  -----------------------------------------------------
countViewsAddComments                                                           boolean     Adds comments count to view count and enables initial    0
                                                                                            values for viewcounts and firstview. showCountViews
                                                                                            must be set to 1.
------------------------------------------------------------------------------  ----------  -------------------------------------------------------  -----------------------------------------------------
showCountCommentViews                                                           boolean     Shows counting of comment views                          0
------------------------------------------------------------------------------  ----------  -------------------------------------------------------  -----------------------------------------------------
countCommentViews                                                               boolean     enables counting of comment views                        1
------------------------------------------------------------------------------  ----------  -------------------------------------------------------  -----------------------------------------------------
showCountViewsLongFormat                                                        boolean     Shows the text for counting of views in a longer         0
                                                                                            format: Short: 909 Views since 21.12.2012. Long: 909
                                                                                            people saw this content since 21.12.2012
------------------------------------------------------------------------------  ----------  -------------------------------------------------------  -----------------------------------------------------
viewMaxAge                                                                      int+        Maximal age for a view, in days: After this delay a      28
                                                                                            subsequent viewcounts as new view.
                                                                                            This option controls the size of table
                                                                                            tx_toctoc_comments_feuser_mm
                                                                                            
                                                                                            (V 8.1.0.)
------------------------------------------------------------------------------  ----------  -------------------------------------------------------  -----------------------------------------------------
activityMultiplicatorRating                                                     int+        or calculation of activity, multiplicand for number of   2
                                                                                            ratings: For the value of an activity ratings might be
                                                                                            considered more than views, with this ratings are given
                                                                                            more value than simple views in the calculation of the
                                                                                            activity-value
------------------------------------------------------------------------------  ----------  -------------------------------------------------------  -----------------------------------------------------
activityMultiplicatorComment                                                    int+        For calculation of activity, multiplicand for number of  4
                                                                                            comments: For the value of an activity ratings might be
                                                                                            comments more than views, with this comments are given
                                                                                            more value than simple views in the calculation of the
                                                                                            activity-value
------------------------------------------------------------------------------  ----------  -------------------------------------------------------  -----------------------------------------------------
useCommentLink                                                                  boolean     Display the link for Commenting on top of the plugin     1
------------------------------------------------------------------------------  ----------  -------------------------------------------------------  -----------------------------------------------------
displayChildComments                                                            boolean     Display the link for and number of subcomments – in      1
                                                                                            addition to the “expand-collapse”-Icons (if
                                                                                            useUserPic=1)
------------------------------------------------------------------------------  ----------  -------------------------------------------------------  -----------------------------------------------------
loginRequired                                                                   boolean     Require login: The commenting form will link to a login  0
                                                                                            form and onyl after login commenting will be possible.
                                                                                            (W)
------------------------------------------------------------------------------  ----------  -------------------------------------------------------  -----------------------------------------------------
watermarkFormFields                                                             boolean     Watermark form fields form fields will                   1
                                                                                            have a watermark instead of labels
                                                                                                                                                     (Changed in V 7.2.0)
------------------------------------------------------------------------------  ----------  -------------------------------------------------------  -----------------------------------------------------
useBBCodeMenu                                                                   boolean     Use the menu for bb-codes: when youselect text in the    1
                                                                                            commenting form a popup allows to insert bb-codes (W)

                                                                                            (V 5.0.0.)
------------------------------------------------------------------------------  ----------  -------------------------------------------------------  -----------------------------------------------------
BBCodebbs                                                                       boolean     string and sequence of available bb-codes: The           b, i, code, q, ct, bq
                                                                                            available bb-codes are defined here, the initial setup
                                                                                            hold all possible bb-codes. bold(b), italic(i),
                                                                                            code(code), q(inlinbe quote), bq(blockquote) and
                                                                                            ct(citation) (W)
                                                                                            (V 5.0.0.)
------------------------------------------------------------------------------  ----------  -------------------------------------------------------  -----------------------------------------------------
midDot                                                                          string      string for the separator between links iLike and         &middot;
                                                                                            iDislike (and more)

                                                                                            (V 5.3.0.)
------------------------------------------------------------------------------  ----------  -------------------------------------------------------  -----------------------------------------------------
gravatarEnable                                                                  boolean     Show Gravatar Icon if present for fe_users: If no        0
                                                                                            gravatar is found, the local userpicture is shown (if
                                                                                            your site is accessble from the internet) (V 5.3.0.)
------------------------------------------------------------------------------  ----------  -------------------------------------------------------  -----------------------------------------------------
gravatarRating                                                                  options     Gravatar Rating:                                         G
                                                                                [G,PG,R,X]  Maximum allowed Gravatar rating to show. G - suitable
                                                                                            for display on all websites with any audience type, PG
                                                                                            - may contain rude gestures, provocatively dressed
                                                                                            individuals, the lesser swear words, or mild violence,
                                                                                            R - may contain such things as harsh profanity, intense
                                                                                            violence, nudity, or hard drug use. X: may contain
                                                                                            hardcore sexual imagery or extremely disturbing
                                                                                            violence.

                                                                                            (V 5.3.0.)
------------------------------------------------------------------------------  ----------  -------------------------------------------------------  -----------------------------------------------------
gravatarLocalHost                                                               options     when your site is not connected to the web, select the   0
                                                                                [0, mm,     type of local user picture if no gravatar is found:
                                                                                icon,       0, use normal userpicture on my server (it's connected
                                                                                monsterid,  to web)
                                                                                wavatar,    mm, (mystery-man) a simple, cartoon-style silhouetted
                                                                                retro]      outline of a person (does not vary by email hash)                                            
                                                                                            identicon, a geometric pattern based on an email hash
                                                                                            monsterid, a generated 'monster' with different colors,
                                                                                            faces, etc
                                                                                            wavatar, generated faces with differing features and
                                                                                            backgrounds
                                                                                            retro, awesome generated, 8-bit arcade-style pixelated
                                                                                            faces

                                                                                            (V 5.3.0.)
------------------------------------------------------------------------------  ----------  -------------------------------------------------------  -----------------------------------------------------
acceptTermsCondsOnSubmit                                                        int+        ID of your page with term and conditions, link below
                                                                                            submit button in commenting forms
==============================================================================  ==========  =======================================================  =====================================================

=================================  =========  =======================================================  ===================================================================
Options from setup.txt
=================================  =========  =======================================================  ===================================================================
dateFormatOldStyle                 boolean    Use old style date format:Old style date format is like
                                              "20.08.2012", new style would be like "3 weeks and 4
                                              days ago". See dateFormatMode and dateFormat for old
                                              style
---------------------------------  ---------  -------------------------------------------------------  -------------------------------------------------------------------
enableUrlLog                       boolean    Enable URL log
---------------------------------  ---------  -------------------------------------------------------  -------------------------------------------------------------------
initialViewsCount                  int+       Allows to give initial value to the views counters by
                                              TypoScript
---------------------------------  ---------  -------------------------------------------------------  -------------------------------------------------------------------
initialViewsDate                   timestamp  Allows to give initial value to the first view dates by
                                              TypoScript
---------------------------------  ---------  -------------------------------------------------------  -------------------------------------------------------------------
allowCommentPreview                boolean    Display the "eye" for comment previews and make comment  1
                                              previews on click on the eye
---------------------------------  ---------  -------------------------------------------------------  -------------------------------------------------------------------
allowCommentDeletion               boolean    Logged in users may delete their comments                1
---------------------------------  ---------  -------------------------------------------------------  -------------------------------------------------------------------
nameCommentSeparator               string     The separator string between the commentators name and   -
                                              the subsequent text
---------------------------------  ---------  -------------------------------------------------------  -------------------------------------------------------------------
useNameCommentSeparator            boolean    Use or don't use the separator string between            1
                                              commentators name and the subsequent text
---------------------------------  ---------  -------------------------------------------------------  -------------------------------------------------------------------
loginRequiredIdLoginForm           string     Id of the div holding the login form                     tx-tc-loginform
---------------------------------  ---------  -------------------------------------------------------  -------------------------------------------------------------------
dontuseGIFBUILDER                  boolean    if you dont want to use GIFBUILDER for userpics then     0
                                              set this to 1

                                              (V 5.3.0.)
---------------------------------  ---------  -------------------------------------------------------  -------------------------------------------------------------------
blacklistCrawlerAgentStrings       string     Additional crawlers to be excluded from the commenting   package,curl,AU-MIC,Python,Test,Wotbox,Lipperhey,Traveler,
                                              system and session creation, use comma-separated list.   FDiag,bot,lucid,Mining,crawl,protect,Walker,Checker,DuckDuck,
                                              Identified as Crawlers by default are                    LinkFinder,Ezooms,filterdb,findlinks,monitor,blast,gonzo,htdig,
                                              googlebot, yahoo, baidu, msnbot,                         archiver,jobs,ips-agent,larbin,linkdex,MajesticSEO,Survey,
                                              bingbot, spider, bot.htm, yandex, jeevez                 OpenLinkProfiler,eeker,picmole,Qualidator,ReverseGet,schrein,
                                                                                                       Scooter,search,SEOkicks,sistrix,thunderstone,TinEye,Unister,
                                                                                                       Webinator,Webmaster,xovi,Yeti
                                              unique strings contained in the HTTP_USER_AGENT
                                              (V 7.4.0.)
---------------------------------  ---------  -------------------------------------------------------  -------------------------------------------------------------------
whitelistCrawlerAgentStrings       string     Whitelisted crawlers, not to be excluded from the
                                              commenting system
                                              (V 7.4.0.)
---------------------------------  ---------  -------------------------------------------------------  -------------------------------------------------------------------
protocolCrawlerAgents              boolean    if enabled file pi1/crawlerprotocol.txt will be filled
                                              with a log

                                              (V 7.4.0.)
---------------------------------  ---------  -------------------------------------------------------  -------------------------------------------------------------------
protocolCrawlerAgentsMaxLines      integer    Maximal number of lines for the crawler                  10000
                                              protocol
                                              (V 7.4.0.)
---------------------------------  ---------  -------------------------------------------------------  -------------------------------------------------------------------
protocolBlacklistedIPs             boolean    BlacklistedIPs, if enabled file
                                              pi1/blacklistprotocol.txt will be filled with a
                                              log
                                              (V 7.4.0.)
---------------------------------  ---------  -------------------------------------------------------  -------------------------------------------------------------------
protocolBlacklistedIPsMaxLines     integer    Maximal number of lines for the BlacklistedIPs           10000
                                              protocol
                                              (V 7.4.0.)
---------------------------------  ---------  -------------------------------------------------------  -------------------------------------------------------------------
dontTakeEmptyAgentStringAsCrawler  boolean    mpty HTTP_USER_AGENT are uncool, most possibly crawlers
                                              to be excluded from the commenting system and session
                                              creation
                                              (V 7.4.0.)
=================================  =========  =======================================================  ===================================================================
