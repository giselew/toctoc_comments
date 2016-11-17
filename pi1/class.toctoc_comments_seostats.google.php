<?php
/**
 * PHP class SEOstats
 *
 *
 *              by methods for http://www.google.{@const:GOOGLE_TLD}
 *
 *  date        author              method: change(s)
 *  2011/08/04  Stephan Schmitz     googleTotal2: Added if condition at return, to fix/avoid
 *                                  errors when estimatedResultCount is not set.
 *  2011/10/07  Stephan Schmitz     Google_PR: Updated the toolbar URL for Pagerank requests.
 *  2012/01/29  Stephan Schmitz     Google_PR: Implemented alternative checksum calculation.
 *                                  performanceAnalysis: Updated request URL.
 *                                  pageSpeedScore: Updated request URL.
 * 2012/05/25   Stephan Schmitz     Merged fix for left shift issue in genhash().
 *                                  Fix provided by James Wade <hm2k@php.net>
 * 2012/11/17   Gisèle Wendl        Reduce for toctoc_comment
 *
 * @class      SEOstats_Google
 * @package    class.seostats
 * @link       https://github.com/eyecatchup/SEOstats/
 * @updated    2012/01/29
 * @author     Stephan Schmitz <eyecatchup@gmail.com>
 * @copyright  2010-present, Stephan Schmitz
 * @license    GNU General Public License (GPL)
 * @filename   ./seostats.google.php
 * @desc       Child class of SEOstats, extending the main class
 * @changelog
 */
class SEOstats_Google extends SEOstats {

	/**
	 * Returns array, containing detailed results for any Google search.
	 *
	 * @param	string		$query      String, containing the search query.
	 * @param	string		$tld        String, containing the desired Google top level domain.
	 * @return	array		Returns array, containing the keys 'URL', 'Title' and 'Description'.
	 * @access private
	 */
    public static function googleArray($query, $lancode='en') {
		$result = array();
		$pages = 1;
		$delay = 0;
		for($start=0;$start<$pages;$start++) {
		    $url = 'http://www.google.com/cse?q='.$query.'&filter=0'.
			   '&num=100'.(($start == 0) ? '' : '&start='.$start.'00&hl='.$lancode.'');
		    $str = SEOstats::cURL($url);
		    if (preg_match('#answer=86640#i', $str)) {
				$e = 'Please read: http://www.google.com/support/websearch/' .
				     'bin/answer.py?&answer=86640&hl=en';
				throw new SEOstatsException($e);
		    } else {
				$html = new DOMDocument();
				@$html->loadHtml($str);
				$xpath = new DOMXPath($html);
				$links = $xpath->query("//div[@class='g']//a");
				$descs = $xpath->query("//td[@class='j']//div[@class='std']");
				$i = 0;
				foreach ($links as $link) {
				    if(!preg_match('#cache#si', $link->textContent) &&
					       !preg_match('#similar#si', $link->textContent)) {
						$result = array(
						    'url' => $link->getAttribute('href'),
						    'title' => utf8_decode($link->textContent),
						    'descr' => utf8_decode($descs->item($i)->textContent)
						);
						$i++;
					}

				}

				if (preg_match('#<div id="nn"><\/div>#i', $str) ||
				     preg_match('#<div id=nn><\/div>#i', $str)) {
				    $pages += 1;
				    $delay += 200000;
				    usleep($delay);
				} else {
				    $pages -= 1;
				}

		    }

		}

		return $result;
    }
}
?>
