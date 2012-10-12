<?php
namespace ExtbaseTeam\BlogExample\Domain\Validator;
/***************************************************************
 *  Copyright notice
 *
 *  (c) 2009 Jochen Rau <jochen.rau@typoplanet.de>
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
 * An exemplary Blog validator
 */
class BlogValidator extends \TYPO3\CMS\Extbase\Validation\Validator\AbstractValidator {

	/**
	 * Checks whether the given blog is valid
	 *
	 * @param \ExtbaseTeam\BlogExample\Domain\Model\Blog $blog The blog
	 * @return boolean TRUE if blog could be validated, otherwise FALSE
	 */
	public function isValid($blog) {
		if (strtolower($blog->getTitle()) === 'extbase') {
			$this->addError(\TYPO3\CMS\Extbase\Utility\LocalizationUtility::translate('error.Blog.invalidTitle', 'BlogExample'), 1297418974);
			return FALSE;
		}
		return TRUE;
	}

}
?>