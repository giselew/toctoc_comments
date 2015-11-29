.. ==================================================
.. FOR YOUR INFORMATION
.. --------------------------------------------------
.. -*- coding: utf-8 -*- with BOM.

.. include:: ../../../Includes.txt


.. _users-manual-data-protection-access-on-personal-data-is:

Access on personal data is possible ...
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

**1. locally, on your PC.** Websites can read your cookies create user profiles.

**toctoc_comments**  requires the OK of the user for storage of cookies containing personal data.

**2. during transport of data** between you and the server. Encryption of data protects data during
transport. Encrypted data is hard to spy, data won't be transmitted as readable text

It's recommended to use a HTTPS server protocol for operation of toctoc_comments

**3. accessing data stored on the server.** 

3a) Concerns about the transfer of your personally identifiable data to outside parties as well as
the use of this data for so called marketing purposes must be clearly defined in the privacy policy
of the website running the commenting system.

3b) When data is stored on the own server, referenced as "localhost" - then it is less interesting
for not authorized or "secretly authorized" persons to query this data. Normally there's not much
data and the data does not allow for example to build marketing profiles.

However, it might be interesting to spy at data in dedicated servers, server hosting mass data from
commenting systems: DISQUS, WordPress and Yotpo maintain mass databases which enables the same big
interest for this data like the databases of for example Yahoo, Google. GMX also do.

3c) Storage of data on external MySQL-servers offers bigger chances for unauthorized access to
happen.

**toctoc_comments**  does not save data on central servers. By default data is located on the
web-server running the website.

**4. by search engines:** Storage of comments by search engines like Google or Bing is a problem in
case these comments should disappear from the internet by whatever reason.

**toctoc_comments**  protects comments from indexing by search engines.

**5. Complete security** 

does not exist

**toctoc_comments**  shows the status and recommendations concerning data protection (in the front
end disclaimer).
