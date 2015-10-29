.. ==================================================
.. FOR YOUR INFORMATION
.. --------------------------------------------------
.. -*- coding: utf-8 -*- with BOM.

.. include:: ../../../Includes.txt


.. _users-manual-plugin-configuration-rating-options-tab:

Rating options tab
^^^^^^^^^^^^^^^^^^

.. figure:: /Images/image-50.jpg

**Enable only Ratings**  suppresses the display of comments – sharing is not touched.

**enable ratings**  allows to enable or disable all rating functions (voting and liking).

**Template file for ratings.** Allows to specify a different ratings layout

**use voting and show rating stars**  enables basic rating 

**use “My vote”** shows the users individual vote (per IP if logged out, per fe_user if logged
in)

**Use scope(s) for voting** : Assign rating scopes (categories). Rating scopes must be saved first
to table “TocToc scopes for ratings” in the Backend. Once this is done the scopes can be
associated to the rating configuration, allowing ratings on categories belonging to the record.

**Use overall scope for voting**  shows the overall, the sum of category ratings of the record.

**use iLike AND iDislike** enables to basic use of the like-feature. Both, like and dislike are
activated

**use or don't use iDislike**  allows to hide the dislike-feature
