.. ==================================================
.. FOR YOUR INFORMATION
.. --------------------------------------------------
.. -*- coding: utf-8 -*- with BOM.

.. include:: ../../Includes.txt


.. _using-ajax-social-network-use-in-other-pi1extensions:

Use in other pi1-extensions
---------------------------

Extension authors can place calls to
**toctoc_comments**  anywhere in their PHP-code where they want their records being commented or
rated.

You call **toctoc_comments**  in “**hook-mode** ”. 

You can render the plugin directly to a marker in your code and then display the marker.
**toctoc_comments**  can be called with the uid of your record and your extensions externalPrefix
(Key of “Plug-in-to-Table map”)

In TS-Setup of your extension you can overwrite the default setup of **toctoc_comments** 

::

    tx_yourextension_pi1.toctoc_comments {
        (place usual toctoc_comments TS Setup here)
    }

In your PHP-Code, where you want to get the Plugins output, the following conditions must be
met:

1. You need a cObj if you don't have one yet:

::

    $this->cObj = t3lib_div::makeInstance('tslib_cObj');
    $this->cObj->start('', '');


2. Check if toctoc_Comments is installed and loaded

::

    if (t3lib_extMgm::isLoaded('toctoc_comments')) { …



3. Make sure that a Plugin-to-Table map
exists for your extension in table

::

    $where = 'pi1_table="' . $your_extension_recordtable .'"';
    $rows = $GLOBALS['TYPO3_DB']->exec_SELECTgetRows(
            'tx_toctoc_comments_prefixtotable.pi1_key AS pi1_key, tx_toctoc_comments_prefixtotable.pi1_table AS pi1_table',
            'tx_toctoc_comments_prefixtotable',
            $where,
            '',
            '',
            ''
    );

    if (count($rows)>0) {
    // Plug-to-table map exists already

    } else {
    // Insert your record
    ...
    } 



If this is ok, the following code will call the output of a **toctoc_comments** 
plugin instance:

::

    // Make a reference on toctoc_comments pi1-PHP-file
    include_once (t3lib_extMgm::extPath('toctoc_comments', 'pi1/class.toctoc_comments_pi1.php'));
    $lib = new tx_toctoccomments_pi1;

    //Get the default configuration of toctoc_comments
    $conftc=array();
    $conftc= $GLOBALS['TSFE']->tmpl->setup['plugin.']['tx_toctoccomments_pi1.'];

    // In your extension you can set TS-Options for toctoc_comments
    // In TypoScript Setup this can be done by setting up
    // tx_yourextension.toctoc_comments {
    //    externalPrefix = your Plugin-to-table-map-Key
    // advanced {...}
    // }
    // Also, in PHP-code you can setup the values in your $pObj->conf['toctoc_comments.'] directly

    if (is_array($pObj->conf['toctoc_comments.'])) {
        // merge default configuration and your extensions configuration

        $conftc = array_replace_recursive($conftc, $pObj->conf['toctoc_comments.']);
    }

    // $row['uid'] is the record you want to let make comments or ratings on

    $toctocHTML = $lib->main($content, $conftc, 'tx_your_extension', $row['uid'],$this->cObj);

    // $content can be an empty string


