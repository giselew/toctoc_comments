<?php
namespace GiseleWendl\ToctocComments\Hooks;
/**
 * ************************************************************
 *  Copyright notice
 *
 *  (c) 2012 - 2017 Gisele Wendl <gisele.wendl@toctoc.ch>
 *  All rights reserved
 *
 *  This script is part of the TYPO3 project. The TYPO3 project is
 *  free software; you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation; either version 2 of the License, or
 *  (at your option) any later version.
 *
 *  The GNU General Public License can be found at
 *  http://www.gnu.org/copyleft/gpl.html.
 *
 *  This script is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 *
 *  This copyright notice MUST APPEAR in all copies of the script!
 * **************************************************************/

class RealUrl {

	/**
	 * Main hook function.
	 * Generates an entire RealURL configuration.
	 *
	 *        	array		Main parameters. Typically, 'config' is the
	 *        	existing RealURL configuration thas has been
	 *        	generated to this point and 'extKey' is unique
	 *        	that this hook used when it was registered.
	 *
	 * @param	array		$params
	 * @param	object		$parentObj: unused
	 * @return	array		$config
	 */
	public function addRealURLConfig(&$params, $parentObj) {
		$config = &$params['config'];
		$unusedObj = $parentObj;
		if (! is_array($config['postVarSets']['_DEFAULT'])) {
			$config['postVarSets']['_DEFAULT'] = array();
		}
		$config['postVarSets']['_DEFAULT'] = array_merge($config['postVarSets']['_DEFAULT'], $this->addPostVarSets());
		return $config;
	}


	/**
	 * Adds the postVarSets (not specific to a page) to the RealURL config.
	 *
	 * @return	array		configuration element.
	 */
	private function addPostVarSets() {
		$postVarSets = array();
		$postVarSets['comment'] = array(
				0 => array(
						'GETvar' => 'toctoc_comments_pi1[anchor]'
				)
		);

		return $postVarSets;
	}

	/**
	 * ***********************************************************************
	 *
	 * Helper functions for generating common RealURL config elements.
	 *
	 * **********************************************************************
	 */

	/**
	 * Adds a RealURL config element for simple GET variables.
	 *
	 * array( 'GETvar' => 'toctoc_comments_pi1[f1]'),
	 *
	 * @param	string		The GET variable.
	 * @return	array		config element.
	 */
	private function addSimple($key) {
		return array(
				'GETvar' => $key
		);
	}

	/**
	 * Adds RealURL config element for table lookups.
	 *
	 * array(
	 * 'GETvar' => 'tx_ttnews[tt_news]',
	 * 'lookUpTable' => array(
	 * 'table' => 'tt_news',
	 * 'id_field' => 'uid',
	 * 'alias_field' => 'title',
	 * 'addWhereClause' => ' AND NOT deleted',
	 * 'useUniqueCache' => 1,
	 * 'useUniqueCache_conf' => array(
	 * 'strtolower' => 1,
	 * 'spaceCharacter' => '_',
	 * )
	 * )
	 * )
	 *
	 * @param	string		$key, The GET variable.
	 * @param	string		$table, The name of the table.
	 * @param	string		$aliasField =The field in the table to be used in the URL.
	 * @param	boolean		$condForPrevious = Previous GET variable that must be present for this rule to be evaluated.
	 * @param	string		$where: ...
	 * @return	array		config element.
	 */
	private function addTable($key, $table, $aliasField = 'title', $condForPrevious = FALSE, $where = ' AND NOT deleted') {
		$configArray = array();

		if ($condForPrevious) {
			$configArray['cond'] = array(
					'prevValueInList' => $condForPrevious
			);
		}

		$configArray['GETvar'] = $key;
		$configArray['lookUpTable'] = array(
				'table' => $table,
				'id_field' => 'uid',
				'alias_field' => $aliasField,
				'addWhereClause' => $where,
				'useUniqueCache' => 1,
				'useUniqueCache_conf' => array(
						'strtolower' => 1,
						'spaceCharacter' => '_'
				)
		);

		return $configArray;
	}

	/**
	 * Adds RealURL config element for value map.
	 * array(
	 * 'GETvar' => 'sub',
	 * 'valueMap' => array(
	 * 'subscribe' => '1',
	 * 'unsubscribe' => '2',
	 * ),
	 * 'noMatch' => 'bypass',
	 * )
	 *
	 * @param	string		$key, The GET variable.
	 * @param	array		$valueMapArray, Associative array with label and value.
	 * @param	string		$noMatch = noMatch behavior.
	 * @return	array		config element.
	 */
	private function addValueMap($key, $valueMapArray, $noMatch = 'bypass') {
		$configArray = array();
		$configArray['GETvar'] = $key;

		if (is_array($valueMapArray)) {
			foreach($valueMapArray as $key => $value) {
				$configArray['valueMap'][$key] = $value;
			}
		}

		$configArray['noMatch'] = $noMatch;
		return $configArray;
	}

	/**
	 * Adds RealURL config element for single type.
	 *
	 * array(
	 * 'type' => 'single',
	 * 'keyValues' => array(
	 * 'tx_newloginbox_pi1[forgot]' => 1,
	 * )
	 * )
	 *
	 * @param	array		$keyValueArray Associative array of GET variables and values.	All values must be matched.
	 * @return	array		config element.
	 */
	private function addSingle($keyValueArray) {
		$configArray = array();
		$configArray['type'] = 'single';

		if (is_array($keyValueArray)) {
			foreach($keyValueArray as $key => $value) {
				$configArray['keyValues'][$key] = $value;
			}
		}

		return $configArray;
	}
}

?>