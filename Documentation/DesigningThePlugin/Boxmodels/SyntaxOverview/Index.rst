.. ==================================================
.. FOR YOUR INFORMATION
.. --------------------------------------------------
.. -*- coding: utf-8 -*- with BOM.

.. include:: ../../../Includes.txt


.. _designing-the-plugin-boxmodels-syntax-overview:

Syntax overview
^^^^^^^^^^^^^^^

The syntax of the boxmodels allows for properties to be set to new values or to calculated values. 

Calculations can be specified with formulas, you can identify property values as variables or use
system-css-options.

You can use the following TS-Option as boxmodel-TS-Options:

::

    {boxmodelTextareaLineHeight} => theme.boxmodelTextareaLineHeight
    {boxmodelTextareaHeight} => theme.boxmodelTextareaLineHeight * theme.boxmodelTextareaNbrLines
    {boxmodelSpacing} => theme.boxmodelSpacing
    {boxmodelLineHeight} => theme.boxmodelLineHeight
    {boxmodelLineHeightHalf} => round((theme.boxmodelLineHeight-16)/2,0)
    {boxmodelSpacingHalf} => round(theme.boxmodelSpacing)/2,0);

    {boxmodelInputFieldSize} => theme.boxmodelInputFieldSize
    {boxmodelLabelWidth} => theme.boxmodelLabelWidth

    {userImageSize} => userImageSize
    {picUploadMaxDimX} => attachments.picUploadMaxDimX

    {ratingImageWidth} => calculated width of the ratings image
    {reviewImageWidth} => calculated width of the reviews image
    {reviewMarginTop} => (theme.boxmodelLineHeight - {reviewImageWidth})/2;
    {ratingMarginTop} => (theme.boxmodelLineHeight – {ratingImageWidth})/2;

    Bit more conditional: 
    {reviewlineheight} => ratings.reviewImageWidth
    if ({reviewlineheight < theme.boxmodelLineHeight ) {
        {reviewlineheight} => theme.boxmodelLineHeight
    }

    {ratinglineheight} => ratings.ratingImageWidth
    if ({ratinglineheight < theme.boxmodelLineHeight ) {
        {ratinglineheight} => theme.boxmodelLineHeight
    }

    {reviewTextMargin} => 0.5*(ratings.reviewImageWidth-theme.boxmodelLineHeight)
    if ((ratings.reviewImageWidth-theme.boxmodelLineHeight)>0) {
        {reviewTextMargin} => 0.5*(ratings.reviewImageWidth-theme.boxmodelLineHeight)
    }

    {ratingTextMargin} => 0
    if ((ratings.ratingImageWidth-theme.boxmodelLineHeight)>0) {
        {ratingTextMargin} => ratings.ratingImageWidth-theme.boxmodelLineHeight
    }


Properties can be added, changed and new selctors can be added
