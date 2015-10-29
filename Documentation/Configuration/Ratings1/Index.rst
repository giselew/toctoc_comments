.. ==================================================
.. FOR YOUR INFORMATION
.. --------------------------------------------------
.. -*- coding: utf-8 -*- with BOM.

.. include:: ../../Includes.txt


.. _configuration-ratings-1:

ratings
-------

=======================================================  ==============  =======================================================  ============================================================
**Property:**                                            Data type:      Description:                                             Default:
=======================================================  ==============  =======================================================  ============================================================
enableRatings                                            boolean         Enables web site visitors to rate comments. Notice that
                                                                         ratings change is only available if comments are not
                                                                         closed for the item. When comments are closed, ratings
                                                                         automatically become read-only

                                                                         (P – Ratings – Enable ratings)
-------------------------------------------------------  --------------  -------------------------------------------------------  ------------------------------------------------------------
ratingsOnly                                              boolean         Enable ratings only: Use plugin as rating-only
                                                                         version (P – Ratings –
                                                                         enable only
                                                                         Ratings)
-------------------------------------------------------  --------------  -------------------------------------------------------  ------------------------------------------------------------
minValue                                                 integer         Minimum rating value. This must not be changed once      1
                                                                         ratings are in use already. Changing this value also
                                                                         requires CSS adjustments (length of voting bar).
-------------------------------------------------------  --------------  -------------------------------------------------------  ------------------------------------------------------------
maxValue                                                 integer         Maximum rating value. This must not be changed once      5
                                                                         ratings are in use already. Changing this value also
                                                                         requires CSS adjustments (length of voting bar). (S)
-------------------------------------------------------  --------------  -------------------------------------------------------  ------------------------------------------------------------
ratingImageWidth (DROPPED)                               integer         RatingImageWidth has been removed with version 6.0.0. 
                                                                         The width of the image used for ratings (and reviews) 
                                                                         is calculated automatically now from the corresponding 
                                                                         images in the themes/img folder. 
                                                                         Responsible file names: 
                                                                         “toctoc_comments_myrating_star.png” and for the 
                                                                         reviews it's “toctoc_comments_myreview_star.png”

-------------------------------------------------------  --------------  -------------------------------------------------------  ------------------------------------------------------------
mode                                                     auto or static  “auto” means that ratings will operate as they           auto
                                                                         normally do on web sites (user votes and he cannot vote
                                                                         on this item any more). “static” means that the
                                                                         user will not be able to vote: ratings will be
-------------------------------------------------------  --------------  -------------------------------------------------------  ------------------------------------------------------------
disableIpCheck                                           boolean         Disables the IP address check for voting. The IP check   0
                                                                         is made with the userid for logged in users. When the
                                                                         IP check is active (0), then a user on the same IP 
                                                                         can make a vote, but he won’t be able to change it. 
                                                                         When it’s inactive, then the user can change his vote. 
                                                                          
                                                                         (V 6.0.0) With former versions this option allowed 
                                                                         users to vote any number of times on the item - 
                                                                         the feature has been migrated 1:1 from former extension
                                                                         ratings to toctoc_comments.
                                                                         It was useful for testing, but not much more than this.
                                                                         
                                                                         Now it allows to change the vote – this is useful !
-------------------------------------------------------  --------------  -------------------------------------------------------  ------------------------------------------------------------
additionalCSS	                                         string          Allows to change the appearance of ratings without 
                                                                         changing template. Typically ratingImageWidth needs 
                                                                         to be changed too. (W)	 
-------------------------------------------------------  --------------  -------------------------------------------------------  ------------------------------------------------------------
ratingsTemplateFile	                                 string	         Template file for ratings shown in the plugin.           EXT:toctoc_comments/res/template/
                                                                         Accepts either site-relative path or                     toctoccomments_ratings.html
                                                                         extension-related path (EXT: prefix)
                                                                         (P – Ratings – Template file for ratings)
-------------------------------------------------------  --------------  -------------------------------------------------------  ------------------------------------------------------------
useMyVote	                                         boolean         Show the vote of the user                                1
                                                                         (P – Ratings – use “My vote”)
-------------------------------------------------------  --------------  -------------------------------------------------------  ------------------------------------------------------------
useVotes	                                         boolean	 Shows the rating stars and enables voting, if checked.   1
                                                                         (P – Ratings – use voting 
                                                                         and show rating stars)
-------------------------------------------------------  --------------  -------------------------------------------------------  ------------------------------------------------------------
useNumberOfVotes	                                 boolean	 Shows the number of votes: Shows the number of votes,    1 
                                                                         if checked
-------------------------------------------------------  --------------  -------------------------------------------------------  ------------------------------------------------------------
useNumberOfStars	                                 boolean	 Shows the number of stars: Shows the number of stars,    0
                                                                         if checked	 
-------------------------------------------------------  --------------  -------------------------------------------------------  ------------------------------------------------------------
useAvgOfVotes	                                         boolean	 Shows the average of votes: Shows the average value      1
                                                                         of votes, if checked
-------------------------------------------------------  --------------  -------------------------------------------------------  ------------------------------------------------------------
useScopesForVote	                                 string	         List of scopes to be used for voting: A list of uids 
                                                                         for scopes, separated by commas 
                                                                         (P – Ratings – Use scope(s) for voting) 
-------------------------------------------------------  --------------  -------------------------------------------------------  ------------------------------------------------------------
useOverallScopeForVote	                                 boolean	 For scoped ratings, show overall: if checked             1
                                                                         overall will be visible.
                                                                         (P – Ratings – Use overall for scoped voting)
-------------------------------------------------------  --------------  -------------------------------------------------------  ------------------------------------------------------------
enableOverallScopeForVote	                         boolean	 For scoped ratings, enable overall: if checked overall   0
                                                                         will be clickable	 
-------------------------------------------------------  --------------  -------------------------------------------------------  ------------------------------------------------------------
useLikeDislike	                                         boolean	 Show Like and Dislike Features, if checked both are      1
                                                                         active.
                                                                         (P – Ratings – use iLike AND iDislike )
-------------------------------------------------------  --------------  -------------------------------------------------------  ------------------------------------------------------------
useDislike	                                         boolean	 Show Dislike Features; makes only sense in connection    1
                                                                         with useLikeDislike.
                                                                         (P – Ratings – use or don’t use iDislike)
-------------------------------------------------------  --------------  -------------------------------------------------------  ------------------------------------------------------------
useTopVotes	                                         boolean	 Shows the rating stars and enables voting,               1
                                                                         if checked on top of the plugin
-------------------------------------------------------  --------------  -------------------------------------------------------  ------------------------------------------------------------
useTopLikeDislike	                                 boolean	 Show Like and Dislike Features on top of the plugin	  1
-------------------------------------------------------  --------------  -------------------------------------------------------  ------------------------------------------------------------
useLikeDislikeStyle	                                 options	 Show Like and Dislike Features in alternative 
                                                                         representation: Short display (1) shows thumbs 
                                                                         for iLike above comment, only numbers are displayed. 
                                                                         Also the voting stars are place above the comment
                                                                         [only below comment=0,short display and separate 
                                                                         thumbs=1]
 
-------------------------------------------------------  --------------  -------------------------------------------------------  ------------------------------------------------------------
dlikeCtsNotifLvl	                                 int+	         Send notification to admin if level is reached:          5
                                                                         An email will be sent to admins mailbox 
                                                                         (spamProtect.notificationEmail), when this number 
                                                                         of dislikes is been reached	
-------------------------------------------------------  --------------  -------------------------------------------------------  ------------------------------------------------------------
dlikeCtsNotifIdlTime	                                 int+	         Time in minutes after a dislike notification without     10 
                                                                         new notifications on the dislike: Only after this 
                                                                         time an email will be sent to admins mailbox 
                                                                         (spamProtect.notificationEmail), when this number of 
                                                                         dislikes is been reached
-------------------------------------------------------  --------------  -------------------------------------------------------  ------------------------------------------------------------
useShortTopLikes	                                 boolean	 Show short form for Like and Dislike Features on top     0
                                                                         of the plugin Like and Dislike on top of the plugin 
                                                                         are displayed in short form	 
-------------------------------------------------------  --------------  -------------------------------------------------------  ------------------------------------------------------------
allowedNumberOfRatings	                                 int+	         Maximum number of ratings allowed in a certain time:     10
                                                                         After this number of ratings the system checks 
                                                                         if they have been made in the time allowed for this.
                                                                         If it was faster than this time, the user is prevented
                                                                         from making ratings for some time
                                                                         (V 6.0.0)
-------------------------------------------------------  --------------  -------------------------------------------------------  ------------------------------------------------------------
timeForAllowedNumberOfRatings	                         int+            Time in minutes that is allowed for the allowed number   2 
                                                                         of ratings: If more ratings than allowed have been 
                                                                         made in this time, the user will be prevented from 
                                                                         placing new ratings for a certain time 
                                                                         (V 6.0.0)
-------------------------------------------------------  --------------  -------------------------------------------------------  ------------------------------------------------------------
allowedNumberOfRatingsExceededBlocktime                  int+	         Time in minutes that a user is blocked if he made to     13
                                                                         many ratings - the wait penalty: After the last rating 
                                                                         made the user has to wait for this time until he will 
                                                                         be able to make more ratings or change ghis ratings
                                                                         (V 6.0.0)
-------------------------------------------------------  --------------  -------------------------------------------------------  ------------------------------------------------------------
useIPsInLikeDislike                                      boolean	 Show resolved IP-addresses in tiptexts for Likes and     1
                                                                         iLikes (if a user name is not present):
                                                                         1 IPs will be shown,
                                                                         0 IPs will be counted in “Others” and 
                                                                         won’t be shown in tip-texts
                                                                         (V 7.0.1)
=======================================================  ==============  =======================================================  ============================================================


                                                                         