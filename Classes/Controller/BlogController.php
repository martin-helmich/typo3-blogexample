<?php
namespace ExtbaseTeam\BlogExample\Controller;
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
 * The blog controller for the BlogExample extension
 */
class BlogController extends AbstractController {

	/**
	 * @var \ExtbaseTeam\BlogExample\Domain\Repository\BlogRepository
	 * @inject
	 */
	protected $blogRepository;

	/**
	 * @var \ExtbaseTeam\BlogExample\Domain\Repository\AdministratorRepository
	 * @inject
	 */
	protected $administratorRepository;

	/**
	 * Index action for this controller. Displays a list of blogs.
	 *
	 * @return void
	 */
	public function indexAction() {
		$this->view->assign('blogs', $this->blogRepository->findAll());
	}

	/**
	 * Displays a form for creating a new blog
	 *
	 * @param \ExtbaseTeam\BlogExample\Domain\Model\Blog $newBlog A fresh blog object taken as a basis for the rendering
	 * @return void
	 * @dontvalidate $newBlog
	 */
	public function newAction(\ExtbaseTeam\BlogExample\Domain\Model\Blog $newBlog = NULL) {
		$this->view->assign('newBlog', $newBlog);
		$this->view->assign('administrators', $this->administratorRepository->findAll());
	}

	/**
	 * Creates a new blog
	 *
	 * @param \ExtbaseTeam\BlogExample\Domain\Model\Blog $newBlog A fresh Blog object which has not yet been added to the repository
	 * @return void
	 */
	public function createAction(\ExtbaseTeam\BlogExample\Domain\Model\Blog $newBlog) {
		// TODO access protection
		$this->blogRepository->add($newBlog);
		$this->addFlashMessage('created');
		$this->redirect('index');
	}

	/**
	 * Displays a form for editing an existing blog
	 *
	 * @param \ExtbaseTeam\BlogExample\Domain\Model\Blog $blog The blog to be edited. This might also be a clone of the original blog already containing modifications if the edit form has been submitted, contained errors and therefore ended up in this action again.
	 * @return void
	 * @dontvalidate $blog
	 */
	public function editAction(\ExtbaseTeam\BlogExample\Domain\Model\Blog $blog) {
		$this->view->assign('blog', $blog);
		$this->view->assign('administrators', $this->administratorRepository->findAll());
	}

	/**
	 * Updates an existing blog
	 *
	 * @param \ExtbaseTeam\BlogExample\Domain\Model\Blog $blog A not yet persisted clone of the original blog containing the modifications
	 * @return void
	 */
	public function updateAction(\ExtbaseTeam\BlogExample\Domain\Model\Blog $blog) {
		// TODO access protection
		$this->blogRepository->update($blog);
		$this->addFlashMessage('updated');
		$this->redirect('index');
	}

	/**
	 * Deletes an existing blog
	 *
	 * @param \ExtbaseTeam\BlogExample\Domain\Model\Blog $blog The blog to delete
	 * @return void
	 */
	public function deleteAction(\ExtbaseTeam\BlogExample\Domain\Model\Blog $blog) {
		// TODO access protection
		$this->blogRepository->remove($blog);
		$this->addFlashMessage('deleted', \TYPO3\CMS\Core\Messaging\FlashMessage::INFO);
		$this->redirect('index');
	}

	/**
	 * Deletes an existing blog
	 *
	 * @return void
	 */
	public function deleteAllAction() {
		// TODO access protection
		$this->blogRepository->removeAll();
		$this->redirect('index');
	}

	/**
	 * Creates a several new blogs
	 *
	 * @return void
	 */
	public function populateAction() {
		// TODO access protection
		$numberOfExistingBlogs = $this->blogRepository->countAll();
		$blogFactory = $this->objectManager->get('ExtbaseTeam\\BlogExample\\Domain\\Service\\BlogFactory');
		for ($blogNumber = $numberOfExistingBlogs + 1; $blogNumber < ($numberOfExistingBlogs + 5); $blogNumber++) {
			$blog = $blogFactory->createBlog($blogNumber);
			$this->blogRepository->add($blog);
		}
		$this->addFlashMessage('populated');
		$this->redirect('index');
	}
}

?>