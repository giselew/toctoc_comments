.. ==================================================
.. FOR YOUR INFORMATION
.. --------------------------------------------------
.. -*- coding: utf-8 -*- with BOM.

.. include:: ../../../Includes.txt


.. _introduction-screenshots-normal-mode:

Normal Mode
^^^^^^^^^^^

Commenting, not logged in
"""""""""""""""""""""""""

This is the plugin operating in normal mode. It displays comments, ratings and sharing
options.

Comments can be entered without captcha-check and without approval. The setting without captcha
would typically apply for logged in users.

Note that you can also require Confirmed Opt-in by e-mail when anonymous users comment. Confirmed
Opt-in sends an email to a first time user and asks him to confirm his email.

The following screen-shots show how to make an entry of a comment and then the approval process.

.. figure:: /Images/image-52.jpg

commenting, not logged in, step 1

After posting a comment the 'useCaptcha' option brings the captchas security question.

Here the plugin uses an internal clone of sr_freecap.

.. figure:: /Images/image-53.jpg

commenting, not logged in, step 2

After the captcha has been resolved the comment has been recorded in the database.

The user is informed to wait until the moderator (administrator) has approved the
comment.

.. figure:: /Images/image-51.jpg

commenting, not logged in, step 3

The comments administrator receives then an e-mail, he can approve, delete or kill the comment (kill
deletes a comment permanently) from the database.

.. figure:: /Images/image-60.jpg

Commenting with approval by administrator

As the admin clicks on approve comment a web page rendered by the extension is presented. The
template for the page and the HTML-mails can be easily adapted to your needs.

.. figure:: /Images/image-59.jpg 

Confirmation web page shown after approval


Commenting when user is logged in
"""""""""""""""""""""""""""""""""

When a user is logged into the website the form data such as email and name are already known, thus
the user just can go ahead and enter his comment without reentering his personal data.

Comment approval is turned off by TypoScript-option

::

    spamProtect.requireApproval = 0


the catcha question is turned off with

::

    spamProtect.useCaptcha = 0


In the screen shots below you see Rolwf Doog make a comment

.. figure:: /Images/image-37.jpg

commenting, logged in, step 1

After submit Rowlf's comment is shown and highlighted

.. figure:: /Images/image-36.jpg 

commenting, logged in, step 2


Commenting, Login required mode
"""""""""""""""""""""""""""""""

You can force users to login before they can post comments

With

::

    advanced.loginRequired = 1


the login required mode becomes active, the forms show up slightly different. Users can login with a
website account or with their Facebook or Google+ account

.. figure:: /Images/image-61.jpg

Commenting, login required, login forms

Users with no website account can create one and are logged in after successful creation of their
new user account

.. figure:: /Images/image-19.jpg

Commenting, login required, login forms and sign up form

Users who forgot their password can start the password change process with the forgot password form.

A mail is sent to the user with a link that shows up the change password form.

.. figure:: /Images/image-18.jpg

Commenting, login required, forgot password form

Login is made with AJAX. 

.. figure:: /Images/image-21.jpg

Commenting, login required, login

When logged in the user can save comments. 

Logout is available just aside the submit button

.. figure:: /Images/image-20.jpg

Commenting, login required, logged in


Rating and voting
"""""""""""""""""

.. figure:: /Images/image-14.jpg

This screenshot shows the plugin with only sharing, iLike and voting enabled.
