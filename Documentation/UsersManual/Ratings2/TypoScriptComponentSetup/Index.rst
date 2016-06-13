.. ==================================================
.. FOR YOUR INFORMATION
.. --------------------------------------------------
.. -*- coding: utf-8 -*- with BOM.

.. include:: ../../../Includes.txt


.. _users-manual-ratings1-typo-script-component-setup:

TypoScript-options for component setup
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

The following TypoScript-options (options are also available in the TYPO3 backend plugin) 
allow to enable or disable the components. (here with the default values) 

::

    # Enable or disable ratings 
        ratings.enableRatings = 1
    # Use plugin only for ratings
        ratings.ratingsOnly = 0
    # Enable or disable sharing
        sharing.useSharing = 1
    # Use plugin only for sharing
        sharing.useOnlySharing = 0

Now how are "Only"-conflicts resolved?

Sharing wins, have a look at this PHP-code:

::

    if (intval($this->conf['sharing.']['useOnlySharing']) == 1) {
        $this->conf['ratings.']['ratingsOnly'] = 1;
        $this->conf['ratings.']['enableRatings'] = 0;
    }


So this here is the correct set-up  for **ratings only**

::

    # Enable ratings 
        ratings.enableRatings = 1
    # Use plugin only for ratings
        ratings.ratingsOnly = 1
    # Disable sharing
        sharing.useSharing = 0
    # No plugin only for sharing
        sharing.useOnlySharing = 0

