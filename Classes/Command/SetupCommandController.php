<?php
namespace ExtbaseTeam\BlogExample\Command;

class SetupCommandController extends \TYPO3\CMS\Extbase\Mvc\Controller\CommandController {

	/**
	 * @var \ExtbaseTeam\BlogExample\Domain\Repository\BlogRepository
	 */
	protected $blogRepository;

	/**
	 * @param \ExtbaseTeam\BlogExample\Domain\Repository\BlogRepository $blogRepository
	 * @return void
-	 */
	public function injectBlogRepository(\ExtbaseTeam\BlogExample\Domain\Repository\BlogRepository $blogRepository) {
		$this->blogRepository = $blogRepository;
	}

	/**
	 * Creates some sample blogs with dummy data
	 *
	 * @param integer $numberOfBlogs number of new blogs to create
	 * @return string
	 */
	public function createDataCommand($numberOfBlogs = 5) {
		$numberOfExistingBlogs = $this->blogRepository->countAll();
		$blogFactory = $this->objectManager->get('ExtbaseTeam\\BlogExample\\Domain\\Service\\BlogFactory');
		for ($blogNumber = $numberOfExistingBlogs + 1; $blogNumber < ($numberOfExistingBlogs + $numberOfBlogs); $blogNumber++) {
			$blog = $blogFactory->createBlog($blogNumber);
			$this->blogRepository->add($blog);
		}

		return sprintf('Created %d blogs!', $numberOfBlogs);
	}
}

?>