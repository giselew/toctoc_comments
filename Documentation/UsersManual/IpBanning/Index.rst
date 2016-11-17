.. ==================================================
.. FOR YOUR INFORMATION
.. --------------------------------------------------
.. -*- coding: utf-8 -*- with BOM.

.. include:: ../../Includes.txt


.. _users-manual-ip-banning:

IP banning
----------

.. index::
	single: Setup; IP banning

*toctoc_comments*  uses a local ban list and a static ban list for preventing IPs for commenting.

In the backend you find 2 corresponding tables, the static ban list already pre-filled with data
from spamhaus.org and a local ban list for additional IPs or Subnets you like to ban from commenting

(Local IP blocking list for toctoc_comments)

In both lists there are individual IPs possible and IPs with subnetmask.

.. toctree::
    :maxdepth: 2
    :titlesonly:

    BanningSubnets/Index
    BanningIpOrSubnetsFrom/Index
