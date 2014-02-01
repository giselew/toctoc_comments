<?php
/***************************************************************
*  Copyright notice
*
*  (c) 2012 2013 Gisele Wendl <gisele.wendl@toctoc.ch>
*  PHP Class SEOstats adapted for toctoc_comments
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
***************************************************************/
/**
 * [CLASS/FUNCTION INDEX of SCRIPT]
 *
 *
 *
 *   50: class SEOstats
 *   72:     public function __construct($url)
 *  113:     public static function cURL($url)
 *  137:     private function valid_url($url)
 *  181:     public function Google_Siteindex_Array($lancode = 'en')
 *  195:     public function Google_Mentions_Array($lancode = 'en')
 *  207:     public function Googletoctoccomments($lancode)
 *
 * TOTAL FUNCTIONS: 6
 * (This index is automatically created/updated by the extension "extdeveval")
 *
 */

include_once('class.toctoc_comments_seostats.google.php');

/**
 * @author	Gisele Wendl <gisele.wendl@toctoc.ch>
 * @package	TYPO3
 * @subpackage	toctoc_comments
 */
class SEOstats
{
	private $countgooglesiteindexarray = 0;
    /**
     * Object URL
     *
     * @access        public
     * @var           string
     */
    public $url;

 /**
  * Constructor
  *
  * Checks for valid URL syntax and server response.
  *
  *                                          object URL.
  *
  * @param	string		$url        String, containing the initialized
  * @return	[type]		...
  * @access public
  */
    public function __construct($url) {
        $url = str_replace(' ', '+', $url);
        $this->url = $url;
        $url_validation = $this->valid_url($this->url);
        if($url_validation == 'valid')
        {
            $valid_response_codes = array('200','301','302');
            $curl_result = '200';
            if(in_array($curl_result, $valid_response_codes))
            {
                $this->host         = parse_url($this->url, PHP_URL_HOST);
                $this->protocol     = parse_url($this->url, PHP_URL_SCHEME);
            }
            elseif($curl_result == '0')
            {
                $e = 'Invalid URL > '.$this->url.' returned no response for a HTTP HEAD request, at all. It seems like the Domain does not exist.';

                throw new SEOstatsException($e);
            }
            else
            {
                $e = 'Invalid Request > '.$this->url.' returned a '.$curl_result.' status code.';

                throw new SEOstatsException($e);
            }
        }
        else
        {
            $e = $url_validation;

            throw new SEOstatsException($e);
        }
    }

	/**
	 * HTTP GET request with curl.
	 *
	 * @param	string		$url        String, containing the URL to curl.
	 * @return	string		Returns string, containing the curl result.
	 * @access private
	 */
    public static function cURL($url) {
        $ch  = curl_init($url);
        curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:15.0) Gecko/20100101 Firefox/15.0.1');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_MAXREDIRS, 2);
        if(strtolower(parse_url($url, PHP_URL_SCHEME)) == 'https')
        {
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 1);
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 1);
        }
        $str = curl_exec($ch);
        curl_close($ch);
        return $str;
    }

	/**
	 * Validates the initialized object URL syntax.
	 *
	 * @param	string		$url        String, containing the initialized object URL.
	 * @return	string		Returns string, containing the validation result.
	 * @access private
	 */
    private function valid_url($url) {
        $allowed_schemes = array('http', 'https');
        $host     = parse_url($url, PHP_URL_HOST);
        $scheme = parse_url($url, PHP_URL_SCHEME);

        if(!isset($url) || empty($url) || $url == '') {
            $e = 'Invalid Object > Requires an URL.';
        } else {
            if(!in_array(strtolower($scheme), $allowed_schemes)) {
                $e = 'Invalid URL > SEOstats supports soley RFC compliant URL\'s with HTTP(/S) protocol.';
            } elseif(empty($host) || $host == '') {
                $e = 'Invalid URL > Hostname undefined (or invalid URL syntax).';
            } else {
                /**
                 *  Regex pattern found in and copied from the Nutch source
                 *  @url    {http://nutch.apache.org/}
                 *
                 *  Fyi: For the following reason, i decided to stay with preg_match.
                 *
                 *  Testing 10k URL's, returned an average execution time (in seconds, per URL) of:
                 *  if(!preg_match($pattern, $this->url))
                 *  0.000104904174805
                 *  if(!filter_var($this->url, FILTER_VALIDATE_URL, FILTER_FLAG_SCHEME_REQUIRED))
                 *  0.000140905380249
                 */
                $pattern  = '([A-Za-z][A-Za-z0-9+.-]{1,120}:[A-Za-z0-9/](([A-Za-z0-9$_.+!*,;/?:@&~=-])';
                $pattern .= '|%[A-Fa-f0-9]{2}){1,333}(#([a-zA-Z0-9][a-zA-Z0-9$_.+!*,;/?:@&~=%-]{0,1000}))?)';
                if(!preg_match($pattern, $this->url)) {
                    $e = 'Invalid URL > Invalid URL syntax.';
                } else {
                    $e = 'valid';
                }
            }
        }
        return $e;
    }

	/**
	 * Limited to 1000 results, due to Google.
	 *
	 * @param	string		$lancode: language code 'de', 'en', 'fr'
	 * @return	array		Returns array, containing foreach 'site:'-search result the keys 'URL', 'Title' and 'Description'.
	 * @access public
	 */
	public function Google_Siteindex_Array($lancode = 'en') {
	      $q = urlencode('site:'.$this->host);
	      $arrsi = SEOstats_Google::googleArray($q, $lancode);
	      $this->countgooglesiteindexarray=count($arrsi);
	      return $arrsi;
	}

	/**
	 * Limited to 1000 results, due to Google.
	 *
	 * @param	string		$lancode: language code 'de', 'en', 'fr'
	 * @return	array		Returns array, containing foreach exact match search result the keys 'URL', 'Title' and 'Description'.
	 * @access public
	 */
	public function Google_Mentions_Array($lancode = 'en') {
		$q = urlencode('"'.$this->host.'" -site:'.$this->host.'');
		$retstr = SEOstats_Google::googleArray($q, $lancode);
		return $retstr;
	}

	/**
	 * returns found information from Google in an array
	 *
	 * @param	string		$lancode: language code 'de', 'en', 'fr'
	 * @return	array		found URL and 2) Siteindexdesription or mentions from Google - in an array
	 */
    public function Googletoctoccomments($lancode) {
    	$all = array(
    			'GOOGLE' => array(
    					'Google_Siteindex_Array'     => $this->Google_Siteindex_Array($lancode),
     					'Google_Mentions_Array'      => ($this->countgooglesiteindexarray ==0) ? $this->Google_Mentions_Array($lancode) : array(),
    			)
    	);
    	return array('OBJECT' => $this->url, 'DATA' => $all);
    }
}
?>
