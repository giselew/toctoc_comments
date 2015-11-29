.. ==================================================
.. FOR YOUR INFORMATION
.. --------------------------------------------------
.. -*- coding: utf-8 -*- with BOM.

.. include:: ../../Includes.txt


.. _introduction-different-configuration-for:

Different configuration for logged in users.
--------------------------------------------

When a user is logged in the fields to enter first name, last name, email, location are hidden and
filled with the values form the users profile. This is handled by the template. 

In the template-file for comments there are 2 sub-templates for the form – one for logged in
users, one for IP-users (not logged in).

Handling in TS-Setup is best done with
conditional assignment of TypoScript options. 


Often used is the captcha/approval for anonymous (IP)-users and let fe_users post without further
control.

Have a look at this TS
Setup

::

    [usergroup = *]
    plugin.tx_toctoccomments_pi1 {
    ratings {
    enableRatings=1
    useDislike = 1
    }
    spamProtect {
    requireApproval = 0
    useCaptcha = 0
    }
    }
    [else]
    plugin.tx_toctoccomments_pi1 {
    ratings {
    enableRatings=1
    useDislike = 0
    }
    spamProtect {
    requireApproval = 1
    useCaptcha = 1
    }
    }
    [global]

In this example we also enable the Dislike-feature for logged in users only..
