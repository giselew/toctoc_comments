.. ==================================================
.. FOR YOUR INFORMATION
.. --------------------------------------------------
.. -*- coding: utf-8 -*- with BOM.

.. include:: ../../../Includes.txt


.. _users-manual-ratings1-emo-likes:

emoLikes
^^^^^^^^

emoLikes is *toctoc_comments* designation for what Facebook calls reactions. 
It's the most precise approach for evaluations. 
Users **evaluate** and show their **kind of engagement** at the same time.

Introduction
^^^^^^^^^^^^

With version 9.1 of *toctoc_comments* a new kind of ratings has been added. 

It's called emoLikes, Facebook calls it reactions.
So everybody who knows Facebook's reactions knows what emoLikes are about.

We made the emoLikes configurable: 

Different sets of emoLike-icons are available and new sets may be added. 

The sorting of the icons as well the number of icons in a set may be changed.

Icons are designed by Ivan Artucovich, a very skilled artist living in Switzerland, `www.ivanart.net
<http://www.ivanart.net/>`__ . 

Gisele added a set "music", also "the original" by Facebook is among the 5 included emoLikeSets.

EmoLikeSets
^^^^^^^^^^^

With emoLike-sets you can have different kinds of emoLike-Popups. 

There's a default set and we ship 4 more sets along. 

Select your set with this TypoScript:

::

    ratings.emoLikeSet  = default
    # Available options: Social (Default)=default,Social (Facebook)=facebook,
    # News=news,Foods and restaurants=food,Music=music


**Set Default**

5 emoLike-icons "Love", "Haha", "Wow", "Sad" and "Angry"

Set "default" using theme windows and optional Dislike enabled

.. figure:: /Images/likethemeversion2emoLikes.jpg


**Set news**
Set news is designed to be used as emoLikes on news,
expressing more news-lated emotional reactions than the default set

4 emoLike-icons "Yeah", "Funny", "Yawn" and "Fed up"

Set "news" using theme windows and optional dislike enabled

.. figure:: /Images/likethemeversion2emoLikesnews.jpg


**Set food**

emoLikes for restaurants, menus, meals - the gastronomic emotions

4 emoLike-icons "Yummie", "Hungry", "Not me" and "Yuck"

.. figure:: /Images/likethemeversion2emoLikesfood.jpg



**Set Facebook**

Set Facebook consists of the basic reactions as you see on Facebook. 

Additionally you can add the Dislike-thumb

Like the default set it holds the 5 emoLike-icons "Love", "Haha", "Wow", "Sad" and "Angry"

.. figure:: /Images/likethemeversion2emoLikesfacebook.jpg


**Set Music**

Gisele created set music for her site as DJane and music artist `www.deltarose.org
<http://www.deltarose.org/>`__ . 

Here you see an image of the set using the black theme, no Dislike.

4 emoLike-icons "Love", "Dance", "Sing" and "Ninja"

.. figure:: /Images/likethemeversion2emoLikesmusic.jpg


Emolikes vs. Reactions
^^^^^^^^^^^^^^^^^^^^^^

We did choose the designation "emoLike" as an alternative to "reactions" because 
calling it reactions represents a kind of disinformation of the user: A reaction is a global term and it is somehow not really honest.
 
With emoLikes we have much more than generalized reactions - we get rating values and can 
report more precise than on the base of the former 0/1-likes. 

More than this, with the emotion behind an emoLike we can chart engagements of the people. 

This opens more targeted marketing possibilities, imagine you can reduce the number 
of potential customers in campaigns and increase the conversion-rate at the same time.


Notes on the technical solution
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

The meta data for the emoLikes is in table emoLikes which you should see
after fist touch on the plugin in frontend in your storage Folder.

Each row of the table represents an emoLike icon.

**emoLikes**: 

in **"Set folder"** we have the name of the set. 

It is at the same time the name of the set folder in Resources/Public/Icons/emolike

In this folder for each emoLike-Set is a subfolder, same name.

In each of set-folders you have 3 png-images, which are the base for the emoLike-icons

**"Positionnumber of emoLike-icon in picture"**

We use a position number of the emoLike-icon in the according png-file for the CSS, which displays the icon in frontend.
New images should be created using existing images as template. This allows correct positioning of emoLike-icons in new sets. 

**"Position of emoLike in Popup"**

Position of emoLike in the frontend in the emoLike-popup as well as in the emoLike-reportline.
Please refer to the existing data with the shipped sets, if you encounter difficulties with custom
sorting - much has been tested, but not all possible permutations or leave-outs.

**"LL-key"**

The LL-key refers to the according key with the text-label.
It is found in language file pi1/locallang.xml.
The key begins with 'api_ilike_topline_oneunlike', followed by the LL-Key.
Example for the text-label behind 'Love': The text is in (full) LL-Key 'api_ilike_topline_oneunlikeLove'

**Note**: If you delete existing LL-Keys in the table, then you need to clean
the references in file res/less/toctoc_comments-LESS.2/ratings/emolike.less.

They are used as part of the CSS as well.

Same when you add new keys, don't forget to check the LESS file.

**"Color-code for button text in frontend"**

This is the HTML-Color-code for the button in frontend, note that like and dislike take color-code from theme.

**"Engagement-level from 1 to 9"**

not used yet, we plan to make additional charts on engagement-levels

**"Ratingvalue 1 to 9"**

Ratingvalue, 1 to 9 (highest) also is not used yet. TopemoLike-charts is planned to come with next version
Until we add reports feel free to create reports using according reporting extensions for TYPO3.


The down to screen
^^^^^^^^^^^^^^^^^^

Data from the table is pushed into the CSS.
 
Present LESS-file emolike.less contains CSS-selectors using LL-Keys, 
note that when expanding the system this LESS-file has to be kept in mind.
