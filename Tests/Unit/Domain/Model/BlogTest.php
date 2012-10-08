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
 * Testcase for Tx_BlogExample_Domain_Model_Blog.
 *
 * @author Markus Günther <mail@markus-guenther.de>
 *
 * @package BlogExample
 * @subpackage Domain\Model
 *
 * @scope prototype
 * @entity
 */
class BlogTest extends \TYPO3\CMS\Extbase\Tests\Unit\BaseTestCase {

	/**
	 * @var \ExtbaseTeam\BlogExample\Domain\Model\Blog
	 */
	protected $fixture = NULL;

	public function setUp() {
		$this->fixture = new \ExtbaseTeam\BlogExample\Domain\Model\Blog();
	}

	public function tearDown() {
		unset($this->fixture);
	}

	/**
	 * @test
	 */
	public function getTitleInitiallyReturnsEmptyString() {
		$this->assertSame(
			'',
			$this->fixture->getTitle()
		);
	}

	/**
	 * @test
	 */
	public function setTitleSetsTitle() {
		$title = 'Foo bar!';
		$this->fixture->setTitle($title);

		$this->assertSame(
			$title,
			$this->fixture->getTitle()
		);
	}

	/**
	 * @test
	 */
	public function getDescriptionInitiallyReturnsEmptyString() {
		$this->assertSame(
			'',
			$this->fixture->getDescription()
		);
	}

	/**
	 * @test
	 */
	public function setDescriptionSetsDescription() {
		$description = 'Foo bar';
		$this->fixture->setDescription($description);

		$this->assertSame(
			$description,
			$this->fixture->getDescription()
		);
	}

	/**
	 * @test
	 */
	public function setLogoSetsLogo() {
		$logo = 'Foo bar';
		$this->fixture->setLogo($logo);

		$this->assertSame(
			$logo,
			$this->fixture->getLogo()
		);
	}

	/**
	 * @test
	 */
	public function addPostAddsPost() {
		$post = new \ExtbaseTeam\BlogExample\Domain\Model\Post();
		$this->fixture->addPost($post);

		$this->assertTrue($this->fixture->getPosts()->contains($post));
	}

	/**
	 * @test
	 */
	public function removePostRemovesPost() {
		$post = new \ExtbaseTeam\BlogExample\Domain\Model\Post();
		$this->fixture->addPost($post);
		$this->assertTrue($this->fixture->getPosts()->contains($post));

		$this->fixture->removePost($post);
		$this->assertFalse($this->fixture->getPosts()->contains($post));
	}

	/**
	 * @test
	 */
	public function removeAllPostsRemovesAllPosts() {
		$post = new \ExtbaseTeam\BlogExample\Domain\Model\Post();
		$secondPost = new \ExtbaseTeam\BlogExample\Domain\Model\Post();
		$this->fixture->addPost($post);
		$this->fixture->addPost($secondPost);

		$this->fixture->removeAllPosts();
		$this->assertFalse($this->fixture->getPosts()->contains($post));
		$this->assertFalse($this->fixture->getPosts()->contains($secondPost));
	}

	/**
	 * @test
	 */
	public function getAdministratorInitiallyReturnsNull() {
		$this->assertNull(
			$this->fixture->getAdministrator()
		);
	}

	/**
	 * @test
	 */
	public function setAdministratorSetsAdministrator() {
		$administrator = new \ExtbaseTeam\BlogExample\Domain\Model\Administrator();

		$this->fixture->setAdministrator($administrator);
		$this->assertSame(
			$administrator,
			$this->fixture->getAdministrator()
		);
	}
}
?>