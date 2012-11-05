<?php
namespace ExtbaseTeam\Tests\Unit\Domain\Model;
/***************************************************************
 *  Copyright notice
 *
 *  (c) 2012 Markus Günther <mail@markus-guenther.de>
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
 *  A copy is found in the textfile GPL.txt and important notices to the license
 *  from the author is found in LICENSE.txt distributed with these scripts.
 *
 *  This script is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 *
 *  This copyright notice MUST APPEAR in all copies of the script!
 ***************************************************************/

/**
 * Testcase for Tx_BlogExample_Domain_Model_Tag.
 *
 * @author Markus Günther <mail@markus-guenther.de>
 *
 * @package BlogExample
 * @subpackage Domain\Model
 *
 * @scope prototype
 * @entity
 */
class TagTest extends \TYPO3\CMS\Extbase\Tests\Unit\BaseTestCase {

	/**
	 * @var \ExtbaseTeam\BlogExample\Domain\Model\Tag
	 */
	protected $fixture = NULL;

	public function setUp() {
		$this->fixture = new \ExtbaseTeam\BlogExample\Domain\Model\Tag('Foo');
	}

	public function tearDown() {
		unset($this->fixture);
	}

	/**
	 * @test
	 */
	public function getNameGetsName() {
		$name = 'foo';
		$this->fixture = new \ExtbaseTeam\BlogExample\Domain\Model\Tag($name);
		$this->assertSame(
			$name,
			$this->fixture->getName()
		);
	}
}
?>