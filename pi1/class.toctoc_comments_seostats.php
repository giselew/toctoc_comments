<?php
    /************************************************************************
     * PHP Class SEOstats 2.1.0
     *=======================================================================
     * PHP class to request a bunch of SEO data, such as Backlinkdetails,
     * Traffic Statistics, Pageauthority and much more.
     *=======================================================================
     * @package     class.seostats.2.1.0
     * @link        https://github.com/eyecatchup/SEOstats/
     * @updated     2012/05/12
     * @author      Stephan Schmitz <eyecatchup@gmail.com>
     * @copyright   2010-present, Stephan Schmitz
     * @license     Creative Commons Attribution 3.0 Licence
     * @link        http://creativecommons.org/licenses/by/3.0/legalcode
     *=======================================================================
     * @filename    ./class.seostats.php
     * @description SEOstats main class file that includes the child classes
     *              and the config and contains all public methods.
     *=======================================================================
     * @changelog
     * date         author              method: change(s)
     * 2011/09/06   Stephan Schmitz     Removed Majesticseo methods.
     * 2011/08/04   Stephan Schmitz     Added method Bing_Siteindex_Total()
     *                                  Added method Bing_Siteindex_Array()
     *                                  Added method Bing()
     *                                  Updated constant
     *                                              PAGERANK_CHECKSUM_API_URI
     *                                  Removed pre tags when output of the
     *                                  print_array() method is json
     * 2012/01/30   Stephan Schmitz     New license!
     *                                  Updated constant
     *                                              PAGERANK_CHECKSUM_API_URI
     * 2012/05/12   Stephan Schmitz     Initial commit of new child class:
	 *                                              SEOstats_SEMRush()
     * 2012/11/17   Gisèle Wendl        Reduce for toctoc_comment
     *=======================================================================
     * Note: The above changelog is related to this file only. Each file of
     * the package has it's own changelog in the head section. For a general
     * changelog, please see the CHANGELOG file.
     *=======================================================================
     * Copyright (c) 2010-present, Stephan Schmitz
     * All rights reserved.
     *=======================================================================
     * As of version 2.0.9, SEOstats package is released as 'open source'
     * under the terms of the Creative Commons Attribution 3.0 Licence,
     * which - in short - means that:
     *
     * You are free to :
     *     * copy, distribute and transmit the work.
     *     * adapt the work.
     *     * use the work for any private and/or commercial purpose.
     * Under the following conditions:
     *     * Redistributions of source code must retain the above copyright
     *       notice, this list of conditions and the following disclaimer.
     *     * Any public available service containing the entire or parts
     *       of source code (such as websites), must add a reference link to
     *       https://github.com/eyecatchup/SEOstats.
     *
     * THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS
     * "AS IS" AND ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT
     * LIMITED TO, THE IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS FOR
     * A PARTICULAR PURPOSE ARE DISCLAIMED. IN NO EVENT SHALL THE COPYRIGHT
     * OWNER OR CONTRIBUTORS BE LIABLE FOR ANY DIRECT, INDIRECT, INCIDENTAL,
     * SPECIAL, EXEMPLARY, OR CONSEQUENTIAL DAMAGES (INCLUDING, BUT NOT
     * LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES; LOSS OF USE,
     * DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER CAUSED AND ON ANY
     * THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY, OR TORT
     * (INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE
     * OF THIS SOFTWARE, EVEN IF ADVISED OF THE POSSIBILITY OF SUCH DAMAGE.
     ***********************************************************************/


include_once('class.toctoc_comments_seostats.google.php');

class SEOstats
{
	var $countgooglesiteindexarray = 0;
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
    public function __construct($url)
    {
        $url = str_replace(' ', '+', $url);
        $this->url = $url;
        $url_validation = $this->valid_url($this->url);
        if($url_validation == 'valid')
        {
            $valid_response_codes = array('200','301','302');
            $curl_result = '200';
            if(in_array($curl_result,$valid_response_codes))
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
    public static function cURL($url)
    {
        $ch  = curl_init($url);
        curl_setopt($ch, CURLOPT_USERAGENT,'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:15.0) Gecko/20100101 Firefox/15.0.1');

      /*   curl_setopt($ch,CURLOPT_USERAGENT,'SEOstats '. self::BUILD_NO .'
          https://github.com/eyecatchup/SEOstats' ); */
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
        curl_setopt($ch,CURLOPT_CONNECTTIMEOUT,5);
        curl_setopt($ch,CURLOPT_FOLLOWLOCATION,1);
        curl_setopt($ch,CURLOPT_MAXREDIRS,2);
        if(strtolower(parse_url($url, PHP_URL_SCHEME)) == 'https')
        {
            curl_setopt($ch,CURLOPT_SSL_VERIFYPEER,1);
            curl_setopt($ch,CURLOPT_SSL_VERIFYHOST,1);
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
    private function valid_url($url)
    {
        $allowed_schemes = array('http','https');
        $host     = parse_url($url, PHP_URL_HOST);
        $scheme = parse_url($url, PHP_URL_SCHEME);

        if(!isset($url) || empty($url) || $url = '')
        {
            $e = 'Invalid Object > Requires an URL.';
        }
        else
        {
            if(!in_array(strtolower($scheme),$allowed_schemes))
            {
                $e = 'Invalid URL > SEOstats supports soley RFC compliant URL\'s with HTTP(/S) protocol.';
            }
            elseif(empty($host) || $host == '')
            {
                $e = 'Invalid URL > Hostname undefined (or invalid URL syntax).';
            }
            else
            {
                /**
                 *  Regex pattern found in and copied from the Nutch source
                 *  @url    {http://nutch.apache.org/}
                 *
                 *  Fyi: For the following reason, i decided to stay with preg_match.
                 *
                 *  Testing 10k URL's, returned an average execution time (in seconds, per URL) of:
                 *  if(!preg_match($pattern,$this->url))
                 *  0.000104904174805
                 *  if(!filter_var($this->url, FILTER_VALIDATE_URL, FILTER_FLAG_SCHEME_REQUIRED))
                 *  0.000140905380249
                 */
                $pattern  = '([A-Za-z][A-Za-z0-9+.-]{1,120}:[A-Za-z0-9/](([A-Za-z0-9$_.+!*,;/?:@&~=-])';
                $pattern .= '|%[A-Fa-f0-9]{2}){1,333}(#([a-zA-Z0-9][a-zA-Z0-9$_.+!*,;/?:@&~=%-]{0,1000}))?)';
                if(!preg_match($pattern,$this->url))
                {
                    $e = 'Invalid URL > Invalid URL syntax.';
                }
                else
                {
                    $e = 'valid';
                }
            }
        }
        return $e;
    }
	 /**
 * Limited to 1000 results, due to Google.
 *
 * @param	[type]		$lancode: ...
 * @return	array		Returns array, containing foreach 'site:'-search result the keys 'URL', 'Title' and 'Description'.
 * @access public
 */
	 public function Google_Siteindex_Array($lancode = 'en')
	  {
	      $q = urlencode('site:'.$this->host);
	      $arrsi = SEOstats_Google::googleArray($q,$lancode);
	      $this->countgooglesiteindexarray=count($arrsi);
	      return $arrsi;
	  }
	 /**
 * Limited to 1000 results, due to Google.
 *
 * @param	[type]		$lancode: ...
 * @return	array		Returns array, containing foreach exact match search result the keys 'URL', 'Title' and 'Description'.
 * @access public
 */
	public function Google_Mentions_Array($lancode = 'en') {
		$q = urlencode('"'.$this->host.'" -site:'.$this->host.'');
		return SEOstats_Google::googleArray($q,$lancode);
	}

	/**
	 * [Describe function...]
	 *
	 * @param	[type]		$lancode: ...
	 * @return	[type]		...
	 */
    public function Googletoctoccomments($lancode)
    {
    	$all = array(
    			'GOOGLE' => array(
    					'Google_Siteindex_Array'     => $this->Google_Siteindex_Array(),
     					'Google_Mentions_Array'      => ($this->countgooglesiteindexarray ==0) ? $this->Google_Mentions_Array() : array(),
    			)
    	);
    	return array('OBJECT' => $this->url, 'DATA' => $all);
    }
}
?>
