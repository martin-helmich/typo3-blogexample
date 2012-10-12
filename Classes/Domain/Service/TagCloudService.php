<?php
namespace ExtbaseTeam\BlogExample\Domain\Service;
/***************************************************************
 *  Copyright notice
 *
 *  (c) 2011 Bastian Waidelich <bastian@typo3.org>
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
 * A simple blog factory to create sample data
 */
class TagCloudService implements \TYPO3\CMS\Core\SingletonInterface {

	/**
	 * @param \ExtbaseTeam\BlogExample\Domain\Model\Blog $blog
	 * @param integer $numberOfTagSizes
	 * @return array
	 */
	public function createTagCloud(\ExtbaseTeam\BlogExample\Domain\Model\Blog $blog, $numberOfTagSizes = 5) {
		$minAndMaxNumberOfTags = $this->getMinAndMaxNumberOfTags($blog);
		$minNumberOfTags = (integer)$minAndMaxNumberOfTags['min'];
		$maxNumberOfTags = (integer)$minAndMaxNumberOfTags['max'];
		$maxRelativeAmount = $maxNumberOfTags - $minNumberOfTags;
		$tags = $this->getGroupedTags($blog);
		foreach($tags as &$tag) {
			$relativeAmount = (integer)$tag['amount'] - $minNumberOfTags;
			$tag['popularity'] = round(($relativeAmount / $maxRelativeAmount) * ($numberOfTagSizes - 1)) + 1;
		}
		return $tags;
	}

	/**
	 * @param \ExtbaseTeam\BlogExample\Domain\Model\Blog $blog
	 * @return array in the format array('min' => <min number of tags>, 'max' => <max number of tags>)
	 */
	protected function getMinAndMaxNumberOfTags(\ExtbaseTeam\BlogExample\Domain\Model\Blog $blog) {
		$subSelect = $GLOBALS['TYPO3_DB']->SELECTquery(
			'COUNT(*) amount',
			'tx_blogexample_post_tag_mm pt INNER JOIN tx_blogexample_domain_model_tag t ON (pt.uid_foreign = t.uid) INNER JOIN tx_blogexample_domain_model_post p ON (pt.uid_local = p.uid)',
			'p.blog = ' . (integer)$blog->getUid(),
			't.name'
		);
		$minMaxTagCount = $GLOBALS['TYPO3_DB']->exec_SELECTgetRows(
			'MAX(amount) max, MIN(amount) min',
			'(' . $subSelect . ') subquery',
			'1'
		);
		return current($minMaxTagCount);
	}

	/**
	 * @param \ExtbaseTeam\BlogExample\Domain\Model\Blog $blog
	 * @return array in the format array(array('tag' => 'Foo', 'amount' => 123), array('tag' => 'Bar', 'amount' => 100), ...);
	 */
	protected function getGroupedTags(\ExtbaseTeam\BlogExample\Domain\Model\Blog $blog) {
		$tagGroups = $GLOBALS['TYPO3_DB']->exec_SELECTgetRows(
			't.name name, COUNT(*) amount',
			'tx_blogexample_post_tag_mm pt INNER JOIN tx_blogexample_domain_model_tag t ON (pt.uid_foreign = t.uid) INNER JOIN tx_blogexample_domain_model_post p ON (pt.uid_local = p.uid)',
			'p.blog = ' . (integer)$blog->getUid(),
			't.name',
			't.name'
		);
		return $tagGroups;
	}

}