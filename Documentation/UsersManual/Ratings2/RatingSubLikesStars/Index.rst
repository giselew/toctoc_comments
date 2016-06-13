.. ==================================================
.. FOR YOUR INFORMATION
.. --------------------------------------------------
.. -*- coding: utf-8 -*- with BOM.

.. include:: ../../../Includes.txt


.. _users-manual-ratings1-rating-sub-likes-stars:

Rating subcomponents "Likes" and "Stars"
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

The rating component has two subcomponents. 
One subcomponent is the rating system with Likes, it has been expanded by emoLikes in version 9.1.0.

.. figure:: /Images/likethemeversion2emoLikes.jpg


The other subcomponent is the rating system using stars. 

.. figure:: /Images/starratingssimple.jpg


Star ratings may have scopes. 

.. figure:: /Images/starratingsscoped.jpg

Star ratings in reviews are different from star ratings in comments. 

In reviews the star rating by record, content element or page is always shown as part of the users review, including
the sum and average of review-ratings on top of the plugin.

In comments users are not forced to vote, so the star rating by record, content element or page is only  shown on top of the plugin.

Both sub components can be combined. For ratings on comments the emoLikes are not available.

The following TypoScript-options (options are also available in the TYPO3 backend plugin) allow to enable or disable the components. (here with the default values)

::

    # Enable or disable star ratings
        ratings.useVotes = 1
    # Enable or disable Like and Dislike
        ratings.useLikeDislike = 1
    # Enable or disable Dislike
        ratings.useDislike = 1


