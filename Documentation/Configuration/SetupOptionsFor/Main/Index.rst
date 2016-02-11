.. ==================================================
.. FOR YOUR INFORMATION
.. --------------------------------------------------
.. -*- coding: utf-8 -*- with BOM.

.. include:: ../../../Includes.txt


.. _configuration-setup-options-for-main:

Main
^^^^

====================  ==========  =======================================================  ========
**Property:**         Data type:  Description:                                             Default:
--------------------  ----------  -------------------------------------------------------  --------
refreshIdList         string      CSS-ids that should be refreshed from AJAX outside the
                                  plugin after logouts or logins.

                                  When an Id is not present in the new state, then the
                                  Ids HTML is set to '';

                                  Format as comma-separated list: example: c256, c342,
                                  idUserLink
--------------------  ----------  -------------------------------------------------------  --------
pageTypeRefreshs      int+        page type for faster refreshs on page part refreshs.

                                  You can use a pagetype which renders only the needed
                                  body html.
--------------------  ----------  -------------------------------------------------------  --------
watermark             boolean     Watermark fields instead of leaving input form field
                                  with labels
--------------------  ----------  -------------------------------------------------------  --------
hideIfFaceBookActive  boolean     Hides the site login if Facebook login is active

                                  refer to section facebook. Below for more options
                                  regarding Facebook
--------------------  ----------  -------------------------------------------------------  --------
policyPid             int+        Puts a link to the page where you present your data
                                  policy or privacy declaration. The link is down on the
                                  bottom of the left part of the login form.
--------------------  ----------  -------------------------------------------------------  --------
sendBack              boolean     sends back the user to the originating page after login  1
                                  or logout using window.history.back()

                                  V 7.2.0
====================  ==========  =======================================================  ========

Additionally the following wraps are available :

::

    welcomeMessage_stdWrap {
    wrap = |
    }
    welcomeHeader_stdWrap {
    wrap = |
    }

    successMessage_stdWrap {
    wrap = |
    }
    successHeader_stdWrap {
    wrap = |
    }

    logoutMessage_stdWrap {
    wrap = |
    }
    logoutHeader_stdWrap {
    wrap = |
    } 

    errorMessage_stdWrap {
    wrap = <span class="tx-tc-required-error">|</span>
    }
    errorHeader_stdWrap {
    wrap = |
    }

    forgotMessage_stdWrap {
    wrap = |
    }
    forgotHeader_stdWrap {
    wrap = |
    }
    forgotResetMessageEmailSentMessage_stdWrap {
    wrap = |
    }


    signupMessage_stdWrap {
    wrap = |
    }
    signupHeader_stdWrap {
    wrap = |
    }
    signupErrorMessage_stdWrap {
    wrap = <span class="tx-tc-required-error">|</span>
    }
    signupOkMessage_stdWrap {
    wrap = |
    }

    newUserTooShortMessage_stdWrap {
    wrap = <span class="tx-tc-required-error">|</span>
    }
    newUserFirstnameRequiredMessage_stdWrap {
    wrap = <span class="tx-tc-required-error">|</span>
    }
    newUserLastnameRequiredMessage_stdWrap {
    wrap = <span class="tx-tc-required-error">|</span>
    }
    newEmailTooShortMessage_stdWrap {
    wrap = <span class="tx-tc-required-error">|</span>
    }
    newEmailInvalidMessage_stdWrap {
    wrap = <span class="tx-tc-required-error">|</span>
    }
    newUserDataHasErrorsMessage_stdWrap {
    wrap = <span class="tx-tc-required-error tx-tc-error-title">|</span>
    }

    changePasswordMessage_stdWrap {
    wrap = |
    }
    changePasswordHeader_stdWrap {
    wrap = |
    }
    changePasswordNotValidMessage_stdWrap {
    wrap = <span class="tx-tc-required-error">|</span>
    }
    changePasswordTooShortMessage_stdWrap {
    wrap = <span class="tx-tc-required-error">|</span>
    }
    changePasswordNotEqualMessage_stdWrap {
    wrap = <span class="tx-tc-required-error">|</span>
    }
    changePasswordDoneMessage_stdWrap {
    wrap = |
    }

    cookieWarning_stdWrap {
    wrap = <span class="tx-tc-required-error">|</span>
    }
