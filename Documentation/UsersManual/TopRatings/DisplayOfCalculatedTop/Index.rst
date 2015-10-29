.. ==================================================
.. FOR YOUR INFORMATION
.. --------------------------------------------------
.. -*- coding: utf-8 -*- with BOM.

.. include:: ../../../Includes.txt


.. _users-manual-top-ratings-display-of-calculated-top:

Display of calculated top ratings with the same base of votes
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

For the 2 mixed modes it is possible to calculate the ratings such if every item would have obtained
the maximum votes found in the query. 

Then the missing votes are added as average
value of all votes made. 

This “levels out” differences in numbers of votes,
assuming missing votes to be close to the average voting value already known. 

(see
TypoScript-option topRatings.AlignResultsWithMaxVotesAndAvgVote)
