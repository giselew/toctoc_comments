.. ==================================================
.. FOR YOUR INFORMATION
.. --------------------------------------------------
.. -*- coding: utf-8 -*- with BOM.

.. include:: ../../Includes.txt


.. _using-ajax-social-network-community-2:

community
---------

In extension **community**  it is possible to use **toctoc_comments**  in the user profile page and
on the user wall. 

The user wall of **tx_community**  still can not be “mixed” with **toctoc_comments** , but the
plugins can be displayed aside.

On the **user profile toctoc_comments**  allows new comments only for friends of the user profile
owner. Only comments made on the user profile are displayed. 

Users who are not friend see the comments on the user profile, but they can not make comments
themselves.

You'll need this "Plugin to table map":

prefix: tx_community
table: fe_users
showUid parameter: user

On the profile page it's needed to run **toctoc_comments**  as USER_INT-object to avoid caching when
changing to another user profile. Set in Page TS-Setup:

::

    plugin.tx_toctoccomments_pi1 = USER_INT
    plugin.tx_toctoccomments_pi1 {
    advanced {        
    reverseSorting = 1
    invertBrowser = 1
    }
    code = FORM,COMMENTS    
    }


The plugin setup just creates a view similar to Facebook with the newest posts and commenting form
on top

::

    \ -- EMPTY CODE LINE --

On the **user wall toctoc_comments**  allows new comments for all fe_users. Only comments made from
the current user and his friends are shown. 

Setting up the plugin on the wall requires the table-to-prefix entry for tx_community to be set.

Additional configuration option for use on the community wall is this: 

::

    \ -- EMPTY CODE LINE --
    plugin.tx_toctoccomments_pi1 {
    advanced {
    wallExtension = 1
    }
    ratings {
    disableIpCheck = 1
    }
    }


(IP check disabled is more fun on the wall)
