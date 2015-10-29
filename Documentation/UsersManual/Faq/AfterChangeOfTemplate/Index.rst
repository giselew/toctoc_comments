.. ==================================================
.. FOR YOUR INFORMATION
.. --------------------------------------------------
.. -*- coding: utf-8 -*- with BOM.

.. include:: ../../../Includes.txt


.. _users-manual-faq-after-change-of-template:

After change of template, changes are not visible in frontend, what to do?
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

You need to clear the internal session cache of **toctoc_comments**  as well. 

This is done by calling the page using GET-Paramenter **?purge_cache=1** .

Alternatively, while doing configuration changes, it is recommended to switch off
**toctoc_comments**  session cache. This is done by setting

::

    advanced.useSessionCache = 0
