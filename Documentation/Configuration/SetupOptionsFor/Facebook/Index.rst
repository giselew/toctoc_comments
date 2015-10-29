.. ==================================================
.. FOR YOUR INFORMATION
.. --------------------------------------------------
.. -*- coding: utf-8 -*- with BOM.

.. include:: ../../../Includes.txt


.. _configuration-setup-options-for-facebook:

facebook
^^^^^^^^

When the options for Facebook-login are
setup Facebook becomes visible in the front end

====================  ==========  =====================================================  =============
**Property:**         Data type:  Description:                                           Default:
--------------------  ----------  -----------------------------------------------------  -------------
appId                 string      Facebook app id: The app id of your Facebook
                                  application
                                  How make a facebook app?
                                  Login to Facebook and go
                                  https://developers.facebook.com/apps/
--------------------  ----------  -----------------------------------------------------  -------------
secret                wrap        Facebook secret: The application secret of your
                                  Facebook application
--------------------  ----------  -----------------------------------------------------  -------------
makeSessionPermament  boolean     Make fe_user-session permanent
--------------------  ----------  -----------------------------------------------------  -------------
imageDir              string      Specifies directory where profile image should be set  uploads/pics/
====================  ==========  =====================================================  =============
