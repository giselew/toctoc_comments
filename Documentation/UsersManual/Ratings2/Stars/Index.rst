.. ==================================================
.. FOR YOUR INFORMATION
.. --------------------------------------------------
.. -*- coding: utf-8 -*- with BOM.

.. include:: ../../../Includes.txt


.. _users-manual-ratings1-stars:

Stars
^^^^^

The rating subcomponent "Stars" is a more precise approach for evaluation than the "Like".
 
Users give a value from the range of stars available, with the Like-system the rating granularity is just 0 or 1.
 
Adding the Dislike you can have -1 values.

The "Stars" system is configured by default for 5 stars. 

However it can configure from 2 up to 11 stars.

The default configuration regarding number of stars is done with

::

    ratings.maxValue = 5
    
The **design of the stars** may alter according to the theme used.

If you want to create you own stars in your proper theme you do not
need to care about the **size of the star-images** you design in terms of TypoScript or CSS. 

Important is only the right positioning in the picture itself.

You can take a existing star-image, scale it to the size of your needs. Then position your star images
using positions of the old stars (take Photoshop or any other program able to handle layers in the images).

Image-size is the automatically calculated and handled in *toctoc_comments* PHP so back ported to CSS 

(within common limits for star-image sizes). 
