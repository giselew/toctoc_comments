.. ==================================================
.. FOR YOUR INFORMATION
.. --------------------------------------------------
.. -*- coding: utf-8 -*- with BOM.

.. include:: ../../Includes.txt


.. _introduction-domain-social-network-components:

Domain "Social Network Components"
----------------------------------

Defining a TYPO3 extension is related to a the characterization of its domain, for which the extension
then acts as a solution provider. 

Typical examples are news, calendars, galleries or quotes. 

Technical point of view
^^^^^^^^^^^^^^^^^^^^^^^

Because finally all has to be stored in a database, data with same entity type result
in a logical design of tables and relations between these tables. 

This restricts the possible definitions of the application domain, it gives focus
on the goal of an extension from a very systematic and technical point of view.

Business domain point of view
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

The other approach to define a domain results from requirements regarding solutions
provided in a defined business domain.

Payments, Bookings, Social networks, Entertainment, Gaming, each of these domains has
requirements regarding the application solutions needed for operation of the domain.


System concept
^^^^^^^^^^^^^^

*toctoc_comments* focuses tools for social networks.

Social networks are defined in depth. For the definition of *toctoc_comments* application domain
the following properties of social networks are important:

- Social networks consist of **groups of humans**
- Social networks have **infrastructure components**
- Social network **application components** represent the tools for the people to add their contributions (such as comments, pictures, ratings, shares)  to the infrastructure components


**Examples for applications**:

1. Post a comment on the community-wall 
2. Rate and evaluate a post or a comment
3. Share a post, so it's referenced from another place

Certainly there are many other actions of users performed on the infrastructure,
but these 3 components are used in the context of almost every infrastructure component in social networks.


Conceptual background
^^^^^^^^^^^^^^^^^^^^^

From the family network to the buddies network in the pub, nation-wide networks,
online networks - these 3 components are important that the network is able to operate.

These components represent typical human behavior regarding communication on networks, 
at some point their conceptual roles in the communication flow enable us humans to act as a community:


We comment and talk, we rate and evaluate and in the end we try to show it to others.


With these 3 components - commenting, rating and sharing, we can define quite
precisely the domain of **social network components**.

Tools representing **social network components** are strongly interoperable with the networks infrastructure,
this means they must be used in plenty of contexts provided by the infrastructure.

We can take this up as a very systematic basic description of the tools needed for social networks.
Networking and the use of exactly these 3 components as tools make social networks operate -
this is old like human history.

We humans started it sitting together around the fire, nowadays we emerge in new infrastructure on electronic devices.


Infrastructure environment
^^^^^^^^^^^^^^^^^^^^^^^^^^

Now in generalized domains regarding social networking, the tools which bring the
ocial network components functionality, this depends on the environment.

We are on electronic devices like **PCs, Tablets or Handies**, in other words restricted to an 
interface composed by visual and sensual, sometime audio inputs and outputs. 
We contribute and interact with cams and screens, our hands, we use speakers and microphones for audio.

So there's no universal tool set suitable for all kinds of networks.


IP- or computer-based based environments
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

Computer based social networks run on different environments. 
Tools covering needs of business domains typically attach to 3rd level environments. 
Environments in terms of computer system layers regarding inheritance of programming languages:

1. C or C# are **1st level**. 
2. PHP, Visual Basic, JavaScript run on C, these Scripting Languages are **2nd level**. 
3. CMS are based on PHP, Visual Basic, JavaScript – this is the **3rd level**.
4. *toctoc_comments* is on a **4th level** inside CMS TYPO3. 

*toctoc_comments* domain reveals as a helper, as a general service to add value for other domains on the 4th level.


Build communities
^^^^^^^^^^^^^^^^^

*toctoc_comments* goal is to bring the win of social networks to the other domains present as website content:

 
    **People talk about, they evaluate and rise the popularity.**


So social network components are tools which help to build communities for any content presented to a larger public.


Quality concept
^^^^^^^^^^^^^^^

To make this possible the tools need to be of good quality, they must offer plenty of flexibilities,
including monitoring, reporting add-ons - all what helps to operate a social network and win knowledge from it.
The goal of high quality components is to add value to the infrastructure of other domains, such as articles, products or services.


Results of the conceptual vision
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

This conceptual vision on the purpose of toctoc_comments guided and defined the roll-out of developments done since 2012.

 
-*toctoc_comments* first took over existing extensions for ratings and commenting, added a sharing component and added AJAX
-Initial goal was to keep alive commenting and rating plug-ins
-These features are success critical feature for any CMS, if not present in TYPO3, then TYPO3 could lose market shares

Method of domain definition
^^^^^^^^^^^^^^^^^^^^^^^^^^^

So initially the domain of toctoc_comments was found **bottom-up**.

Comments, testimonials, reviews, ratings, likes, sharing formed a collection of individual tools.
 
Researching a classification for this packet brought up "Social network components" as the domain associated to the TYPO3-extension.
 
Verifying the concept **top down**, as I did in the first part of this chapter reveals:

 
    **Almost every other domains can have more success using social network components**


Example: The more people talk about news, more the news editor is successful.
 
Recommendation
^^^^^^^^^^^^^^

It's a useful thing to verify any business for the presence of social network components as a general concept to enhance success.

Breaking it down to TYPO3: Use *toctoc_comments* \:\-\)
