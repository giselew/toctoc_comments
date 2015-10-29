.. ==================================================
.. FOR YOUR INFORMATION
.. --------------------------------------------------
.. -*- coding: utf-8 -*- with BOM.

.. include:: ../../Includes.txt


.. _configuration-topratings:

topRatings
----------

=====================  ==========  =================================================================  ========
**Property:**          Data type:  Description:                                                       Default:
=====================  ==========  =================================================================  ========
topRatingsMode         options]    Show top ratings for likes, votes or both together                 2

                                   [likes=0,votes=1,both by rating=2,both by likes=3 (P
                                   – General, Top ratings – Show top ratings for)
---------------------  ----------  -----------------------------------------------------------------  --------
RatingsDays            int+        Number of days for top ratings: How many days should be            30
                                   checked for top ratings (P – General, Top ratings –
                                   Number of past days for top ratings)
---------------------  ----------  -----------------------------------------------------------------  --------
RatedItemsListCount    int+        Items in list for top ratings: How many should be shown            10
                                   in top ratings (P – General, Top ratings – Number
                                   of top ratings)
---------------------  ----------  -----------------------------------------------------------------  --------
NumberOfVotesRequired  int+        Number of votes required to appear in top ratings,                 3
                                   minimum is 1 vote (P – General, Top ratings –
                                   minimum of votes required)
---------------------  ----------  -----------------------------------------------------------------  --------
TextCropLength         int+        Number of characters after a top ratings text is                   100
                                   cropped. 10 - 250
=====================  ==========  =================================================================  ========

==================================  =======  =======================================================  ========
Options from setup.txt
==================================  =======  =======================================================  ========
topRatingsrestrictToExternalPrefix  options  All=0 or empty, Only comments=comments, Only             0
                                             content=content, Custom prefix=custom (P – General,
                                             Top ratings – Restrict to triggering prefix for top
                                             ratings)
----------------------------------  -------  -------------------------------------------------------  --------
topRatingsExternalPrefix            int+     Uid of the entry in plugin-to-table-map (P – General,
                                             Top ratings – Custom triggering prefix for top
                                             ratings )
----------------------------------  -------  -------------------------------------------------------  --------
topratingsimagesize                 int+     Size of the image for links from the top ratings in      54
                                             pixel
----------------------------------  -------  -------------------------------------------------------  --------
topratingsnumberwidth               int+     With of the ranking-field in the list in pixel           20
----------------------------------  -------  -------------------------------------------------------  --------
topRatingsOriginalLangDisplay       boolean  If displaying items in an alternative language, setting
                                             this option to 1 will make display of title, image and
                                             dates from the original language version of the item,
                                             not the translated version. The item long text
                                             (description) will still be displayed in the
                                             alternative language, if present.
----------------------------------  -------  -------------------------------------------------------  --------
AlignResultsWithMaxVotesAndAvgVote  boolean  If set to 1, then the calculation of top ratings
                                             change: Top ratings with number of
                                             votes lower than the maximum found are given additional
                                             votes such all have the same number of votes.
                                             The average value added is the
                                             average value of all votes found in current
                                             configuration (days back and minimum votes required) (P
                                             – General, Top ratings – Align results with the
                                             result with most votes)
----------------------------------  -------  -------------------------------------------------------  --------
showMinimumVotesinTitle             boolean  Show text for minimum of votes required in the title of  0
                                             the plugin
----------------------------------  -------  -------------------------------------------------------  --------
showAlignCommentinTitle             boolean  If AlignResultsWithMaxVotesAndAvgVote is enabled, show
                                             text how the votes are aligned to the same level of
                                             votes.
----------------------------------  -------  -------------------------------------------------------  --------
showCountTopViewsLastView           boolean  Enable last viewed date                                  1
==================================  =======  =======================================================  ========
