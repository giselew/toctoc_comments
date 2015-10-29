.. ==================================================
.. FOR YOUR INFORMATION
.. --------------------------------------------------
.. -*- coding: utf-8 -*- with BOM.

.. include:: ../../Includes.txt


.. _users-manual-reviews-1:

Reviews
-------

When option advanced.commentReview is set
to 1, then commenting is considered as reviewing.


For reviews, please consider the
following:

- A review is a rating with a comment.
  First you vote, then you write a comment on the vote – both together represent the users
  review.
- Only logged in users can write
  reviews.
- Reviews can be commented and rated like
  normal comments. 
- At the base reviews comments work like
  normal comments, but the rules how they are handled are different: The review of the current user
  is always displayed first in the list and there's only one review per user (and
  plugin)
- For reviews you can specify a different
  crop length for the texts than for comments. Default is at 512 characters. TypoScript option
  advanced.reviewCropLength
- Existing comment streams can be
  redefined as reviews. When you do this the rule “only one review” per user may be broken –
  the newest “converted” comment on level 0 will be “the review” on
  top.
  
Also there might be reviews without review-rating, they will be shown as “not yet rated by ...”
And of course, if before anonymous users wrote comments – also those will be shown as reviews 
(but like for comments – the anonymous user cannot edit or delete reviews.

.. figure:: /Images/image-38.jpg
