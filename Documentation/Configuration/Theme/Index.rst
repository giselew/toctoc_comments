.. ==================================================
.. FOR YOUR INFORMATION
.. --------------------------------------------------
.. -*- coding: utf-8 -*- with BOM.

.. include:: ../../Includes.txt


.. _configuration-theme:

theme
-----

All theme options are valid per webpage
(W)

============================  ==========  =======================================================  ========================================================
**Property:**                 Data type:  Description:                                             Default:
============================  ==========  =======================================================  ========================================================
selectedTheme                 string      Selected color theme (CSS): Basic                        Default = default
                                          color-palette that is used by the extension in frontend  
                                                                                                   White on Black Theme = black
                                                                                                   
                                                                                                   White on Red Theme = red
                                                                                                   
                                                                                                   Custom Theme = custom
                                                                                                   
                                                                                                   Koogle = koogle
                                                                                                   
                                                                                                   TISQUS = tisqus
                                                                                                   
                                                                                                   Windows = windows
                                                                                                   
                                                                                                   TripAdvisor = tripad
                                                                                                   
                                                                                                   Work theme = work   
----------------------------  ----------  -------------------------------------------------------  --------------------------------------------------------
themeFontFamily               string      Font Family for theme: used for textareas                tahoma,verdana,arial,sans-serif
----------------------------  ----------  -------------------------------------------------------  --------------------------------------------------------
selectedBoxmodel              string      Boxmodel filename: To apply as Boxmodel on the CSS       
                                          select an existing boxmdel here, value like
                                          myboxmodel.txt or myboxmodel
                                          (.txt is no longer needed since v 8.0.0)
----------------------------  ----------  -------------------------------------------------------  --------------------------------------------------------
boxmodelTextareaLineHeight    int+        Textarea height: Height of textareas of forms, 10 - 60.  30 (v 7.2.0.; before: 20)
----------------------------  ----------  -------------------------------------------------------  --------------------------------------------------------
boxmodelTextareaNbrLines      int+        Textarea number of lines: How many lines the textarea    1
                                          contains ? 1 - 6.
----------------------------  ----------  -------------------------------------------------------  --------------------------------------------------------
boxmodelSpacing               int+        Boxmodel element x-spacing:Horizontal spacing between    10 (V7.2.0.; before: 4)
                                          elements in the boxmodel, 0 - 20.
----------------------------  ----------  -------------------------------------------------------  --------------------------------------------------------
boxmodelLineHeight            int+        CSS-Line Height: Lineheight in the plugin, 14 - 40.      20 (V7.2.0.; before: 16)
----------------------------  ----------  -------------------------------------------------------  --------------------------------------------------------
boxmodelLineHeightPreserve    boolean     CSS-Line Height: Preserve original line-height, saves    1
                                          some lines of CSS, but results with ratingstars and
                                          ilike thumbs can be out of mesure.
                                          (ajust CSS manually for this)
----------------------------  ----------  -------------------------------------------------------  --------------------------------------------------------
usethemeFontFamilyForPlugin   boolean     Use themeFontFamily as font-family for the entire        1
                                          plugin.
----------------------------  ----------  -------------------------------------------------------  --------------------------------------------------------
boxmodelLevelIndent           options     Indent for levels: Indent in fraction of user image      2
                                          size, if set to for it's the boxmodelSpacing (very
                                          small, good for mobile solutions)

                                          full=1,half=2,third=3,boxmodelSpacing=4]
----------------------------  ----------  -------------------------------------------------------  --------------------------------------------------------
boxmodelLabelWidth            int+        Width of labels, 50 - 200.                               134
----------------------------  ----------  -------------------------------------------------------  --------------------------------------------------------
boxmodelInputFieldSize        int+        Size of Form Input fields, 12 - 40.                      35
----------------------------  ----------  -------------------------------------------------------  --------------------------------------------------------
boxmodelLabelInputPreserve    boolean     Inputfield design: Uses the old default layouted         1 (V 7.2.0)
                                          (0) - or non layouted (1) design for form input field
                                          and labels.

                                          (V5.1.0)
----------------------------  ----------  -------------------------------------------------------  --------------------------------------------------------
boxmodelButtonPreserve        boolean     For Button design: Uses the old default - layouted(0) -  0
                                          or non layouted(1) design for form
                                          buttons.
                                          To enable non layouted design
                                          option boxmodelLabelInputPreserve has to be set to 1 as
                                          well.

                                          (V 6.0.0)
----------------------------  ----------  -------------------------------------------------------  --------------------------------------------------------
responsiveSteps               string      Screenwidths for responsive design in px: This are the   350,450
                                          window-widths in pixels when **toctoc_comments**
                                          changes the layout to fit in the place on the screen.
                                          Defaults are the original values from the CSS-file.

                                          (V5.1.0)
----------------------------  ----------  -------------------------------------------------------  --------------------------------------------------------
crunchCSS                     boolean     crunch CSS (1) or leave CSS uncompressed (0)             1

                                          ( V5.2.0)
----------------------------  ----------  -------------------------------------------------------  --------------------------------------------------------
useLessToolTips               int+        when set to 1, then on devices smaller than 768 less     0
                                          tooltips are shown, if set to 2 its regardless from
                                          screen width.

                                          ( V5.3.0)
----------------------------  ----------  -------------------------------------------------------  --------------------------------------------------------
emojiNoToolTips               boolean     when set to 1, then smiles and emojis have no tooltips   0

                                          ( V5.3.0)
----------------------------  ----------  -------------------------------------------------------  --------------------------------------------------------
refreshCSSFromLESS            boolean     Create CSS from LESS (1, default) or use traditional     1 
                                          way (CSS, PHP, Boxmodels and Themes) (0)
                                          ( V8.0.0)
----------------------------  ----------  -------------------------------------------------------  --------------------------------------------------------
**Options from setup-only**
----------------------------  ----------  -------------------------------------------------------  --------------------------------------------------------
selectedBoxmodelkoogled       boolean     "Koogled" boxmodels have either the word koogle in the   0
                                          name or set this to 1. This does the following:

                                          \* Margin of comments in comments list get 6 pixels
                                          less margin for the texts in top ratings lists and
                                          charts

                                          \* Usercards get prepared to display a background image
                                          on top

                                          \* The Expand-Icons have more left margin

                                          \* Opacity of form is initialized with 0.5
----------------------------  ----------  -------------------------------------------------------  --------------------------------------------------------
freezeLevelCSS                options     set this to 0 if you want to force CSS-generation, 1     1
                                          for normal mode (changes in boxmodel or conf trigger
                                          refreshs) or 2 for frozen CSS (files must exist!) (S)
                                          (V 5.0.0.)
============================  ==========  =======================================================  ========================================================
