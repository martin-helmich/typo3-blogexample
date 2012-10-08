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
 * Testcase for Tx_BlogExample_Domain_Model_Post.
 *
 * @author Markus Günther <mail@markus-guenther.de>
 *
 * @package BlogExample
 * @subpackage Domain\Model
 *
 * @scope prototype
 * @entity
 */
class PostTest extends \TYPO3\CMS\Extbase\Tests\Unit\BaseTestCase {

	/**
	 * @var \ExtbaseTeam\BlogExample\Domain\Model\Post
	 */
	protected $fixture = NULL;

	public function setUp() {
		$this->fixture = new \ExtbaseTeam\BlogExample\Domain\Model\Post();
	}

	public function tearDown() {
		unset($this->fixture);
	}

	/**
	 * @test
	 */
	public function getBlogInitiallyReturnsNull() {
		$this->assertNull(
			$this->fixture->getBlog()
		);
	}

	/**
	 * @test
	 */
	public function setBlogSetsBlog() {
		$blog = new \ExtbaseTeam\BlogExample\Domain\Model\Blog();

		$this->fixture->setBlog($blog);
		$this->assertSame(
			$blog,
			$this->fixture->getBlog()
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
	public function setDateSetsDate() {
		$date = new \DateTime();
		$this->fixture->setDate($date);

		$this->assertSame(
			$date,
			$this->fixture->getDate()
		);
	}

	/**
	 * @test
	 */
	public function setTagsSetsTags() {
		$tags = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
		$this->fixture->setTags($tags);

		$this->assertEquals(
			$tags,
			$this->fixture->getTags()
		);
	}

	/**
	 * @test
	 */
	public function addTagAddsTag() {
		$tag = new \ExtbaseTeam\BlogExample\Domain\Model\Tag('Foo');
		$this->fixture->addTag($tag);

		$this->assertTrue($this->fixture->getTags()->contains($tag));
	}

	/**
	 * @test
	 */
	public function removeTagRemovesTag() {
		$tag = new \ExtbaseTeam\BlogExample\Domain\Model\Tag('Foo');
		$this->fixture->addTag($tag);

		$this->fixture->removeTag($tag);
		$this->assertFalse($this->fixture->getTags()->contains($tag));
	}

	/**
	 * @test
	 */
	public function removeAllTagsRemovesAllTags() {
		$tag = new \ExtbaseTeam\BlogExample\Domain\Model\Tag('Foo');
		$this->fixture->addTag($tag);

		$this->fixture->removeAllTags();
		$this->assertFalse($this->fixture->getTags()->contains($tag));
	}

	/**
	 * @test
	 */
	public function getAuthorInitiallyReturnsNull() {
		$this->assertNull(
			$this->fixture->getAuthor()
		);
	}

	/**
	 * @test
	 */
	public function setAuthorSetsAuthor() {
		$author = new \ExtbaseTeam\BlogExample\Domain\Model\Person('Foo', 'Bar', 'foo@bar.baz');
		$this->fixture->setAuthor($author);

		$this->assertSame(
			$author,
			$this->fixture->getAuthor()
		);
	}

	/**
	 * @test
	 */
	public function setContentSetsContent() {
		$content = 'Foo bar!';
		$this->fixture->setContent($content);

		$this->assertSame(
			$content,
			$this->fixture->getContent()
		);
	}

	/**
	 * @test
	 */
	public function setCommentsSetsComments() {
		$comments = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
		$this->fixture->setComments($comments);

		$this->assertSame(
			$comments,
			$this->fixture->getComments()
		);
	}

	/**
	 * @test
	 */
	public function addCommentAddsComment() {
		$comment = new \ExtbaseTeam\BlogExample\Domain\Model\Comment();
		$this->fixture->addComment($comment);

		$this->assertTrue($this->fixture->getComments()->contains($comment));
	}

	/**
	 * @test
	 */
	public function removeCommentRemovesComment() {
		$comment = new \ExtbaseTeam\BlogExample\Domain\Model\Comment();
		$this->fixture->addComment($comment);

		$this->fixture->removeComment($comment);
		$this->assertFalse($this->fixture->getComments()->contains($comment));
	}

	/**
	 * @test
	 */
	public function removeAllCommentsRemovesAllComments() {
		$comment = new \ExtbaseTeam\BlogExample\Domain\Model\Comment();
		$this->fixture->addComment($comment);

		$this->fixture->removeAllComments();
		$this->assertFalse($this->fixture->getComments()->contains($comment));
	}

	/**
	 * @test
	 */
	public function setRelatedPostsSetsRelatedPosts() {
		$relatedPosts = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
		$this->fixture->setRelatedPosts($relatedPosts);

		$this->assertSame(
			$relatedPosts,
			$this->fixture->getRelatedPosts()
		);
	}

	/**
	 * @test
	 */
	public function addRelatedPostAddsRelatedPost() {
		$post = new \ExtbaseTeam\BlogExample\Domain\Model\Post();
		$this->fixture->addRelatedPost($post);

		$this->assertTrue($this->fixture->getRelatedPosts()->contains($post));
	}

	/**
	 * @test
	 */
	public function removeAllRelatedPostsRemovesAllRelatedPosts() {
		$post = new \ExtbaseTeam\BlogExample\Domain\Model\Post();
		$this->fixture->addRelatedPost($post);

		$this->fixture->removeAllRelatedPosts();
		$this->assertFalse($this->fixture->getRelatedPosts()->contains($post));
	}
}
?>