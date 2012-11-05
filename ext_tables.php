<?php
if (!defined ('TYPO3_MODE')) die ('Access denied.');

$extensionName = \TYPO3\CMS\Core\Utility\GeneralUtility::underscoredToUpperCamelCase($_EXTKEY);

/**
 * Registers a Plugin to be listed in the Backend. You also have to configure the Dispatcher in ext_localconf.php.
 */
if ($GLOBALS['TYPO3_CONF_VARS']['EXTCONF'][$_EXTKEY]['registerSinglePlugin']) {

	\TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin(
		$_EXTKEY,// The extension name (in UpperCamelCase) or the extension key (in lower_underscore)
		'Pi1', // A unique name of the plugin in UpperCamelCase
		'A Blog Example' // A title shown in the backend dropdown field
	);

	$pluginSignature = strtolower($extensionName) . '_pi1';
	$GLOBALS['TCA']['tt_content']['types']['list']['subtypes_excludelist'][$pluginSignature] = 'select_key';
	$GLOBALS['TCA']['tt_content']['types']['list']['subtypes_addlist'][$pluginSignature] = 'pi_flexform,recursive';
	\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPiFlexFormValue($pluginSignature, 'FILE:EXT:' . $_EXTKEY . '/Configuration/FlexForms/flexform_list.xml');

} else {

	\TYPO3\CMS\Core\Utility\GeneralUtility::loadTCA('tt_content');
	// These dividers are a little trick to group these items in the plugin selector
	$TCA['tt_content']['columns']['list_type']['config']['items'][] = array('Blog Example', '--div--', \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extRelPath($_EXTKEY) . 'ext_icon.gif');
	\TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin(
		$_EXTKEY,
		'BlogList',
		'List of Blogs (BlogExample)'
	);
	\TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin(
		$_EXTKEY,
		'PostList',
		'List of Posts (BlogExample)'
	);
	\TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin(
		$_EXTKEY,
		'PostSingle',
		'Single Post (BlogExample)'
	);
	\TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin(
		$_EXTKEY,
		'BlogAdmin',
		'Admin Plugin (BlogExample)'
	);
	$TCA['tt_content']['columns']['list_type']['config']['items'][] = array('', '--div--');

	$pluginSignature = strtolower($extensionName) . '_postlist';
	$GLOBALS['TCA']['tt_content']['types']['list']['subtypes_excludelist'][$pluginSignature] = 'select_key';
	$GLOBALS['TCA']['tt_content']['types']['list']['subtypes_addlist'][$pluginSignature] = 'pi_flexform,recursive';
	\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPiFlexFormValue($pluginSignature, 'FILE:EXT:' . $_EXTKEY . '/Configuration/FlexForms/flexform_list.xml');

}

if (TYPO3_MODE === 'BE') {

	/**
	* Registers a Backend Module
	*/
	\TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerModule(
		'ExtbaseTeam.' . $_EXTKEY,
		'web', // Make module a submodule of 'web'
		'tx_blogexample_m1', // Submodule key
		'', // Position
		array( // An array holding the controller-action-combinations that are accessible
			'Blog' => 'index,new,create,delete,deleteAll,edit,update,populate', // The first controller and its first action will be the default
			'Post' => 'index,show,new,create,delete,edit,update',
			'Comment' => 'create,delete,deleteAll',
			),
		array(
			'access' => 'user,group',
			'icon' => 'EXT:blog_example/ext_icon.gif',
			'labels' => 'LLL:EXT:' . $_EXTKEY . '/Resources/Private/Language/locallang_mod.xml',
		)
	);

}

/**
 * Add labels for context sensitive help (CSH)
 */
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('_MOD_web_BlogExampleTxBlogexampleM1', 'EXT:' . $_EXTKEY . '/Resources/Private/Language/locallang_csh.xml');

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addStaticFile($_EXTKEY, 'Configuration/TypoScript', 'BlogExample setup');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addStaticFile($_EXTKEY, 'Configuration/TypoScript/DefaultStyles', 'BlogExample CSS Styles (optional)');

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_blogexample_domain_model_blog');
$TCA['tx_blogexample_domain_model_blog'] = array (
	'ctrl' => array (
		'title'    => 'LLL:EXT:blog_example/Resources/Private/Language/locallang_db.xml:tx_blogexample_domain_model_blog',
		'label' => 'title',
		'tstamp' => 'tstamp',
		'crdate' => 'crdate',
		'versioningWS' => 2,
		'versioning_followPages' => true,
		'origUid' => 't3_origuid',
		'languageField' => 'sys_language_uid',
		'transOrigPointerField' => 'l18n_parent',
		'transOrigDiffSourceField' => 'l18n_diffsource',
		'delete' => 'deleted',
		'enablecolumns' => array(
			'disabled' => 'hidden'
			),
		'dynamicConfigFile' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extPath($_EXTKEY) . 'Configuration/TCA/Blog.php',
		'iconfile' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extRelPath($_EXTKEY) . 'Resources/Public/Icons/icon_tx_blogexample_domain_model_blog.gif'
	)
);

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_blogexample_domain_model_post');
$TCA['tx_blogexample_domain_model_post'] = array (
	'ctrl' => array (
		'title'    => 'LLL:EXT:blog_example/Resources/Private/Language/locallang_db.xml:tx_blogexample_domain_model_post',
		'label' => 'title',
		'label_alt' => 'author',
		'label_alt_force' => TRUE,
		'tstamp'   => 'tstamp',
		'crdate'   => 'crdate',
		'versioningWS' => 2,
		'versioning_followPages' => true,
		'origUid' => 't3_origuid',
		'languageField' => 'sys_language_uid',
		'transOrigPointerField' => 'l18n_parent',
		'transOrigDiffSourceField' => 'l18n_diffsource',
		'delete'   => 'deleted',
		'enablecolumns'  => array(
			'disabled' => 'hidden'
		),
		'dynamicConfigFile' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extPath($_EXTKEY) . 'Configuration/TCA/Post.php',
		'iconfile'   => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extRelPath($_EXTKEY) . 'Resources/Public/Icons/icon_tx_blogexample_domain_model_post.gif'
	)
);

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_blogexample_domain_model_comment');
$TCA['tx_blogexample_domain_model_comment'] = array (
	'ctrl' => array (
		'title'    => 'LLL:EXT:blog_example/Resources/Private/Language/locallang_db.xml:tx_blogexample_domain_model_comment',
		'label' => 'date',
		'label_alt' => 'author',
		'label_alt_force' => TRUE,
		'tstamp'   => 'tstamp',
		'crdate'   => 'crdate',
		'delete'   => 'deleted',
		'enablecolumns'  => array (
			'disabled' => 'hidden'
		),
		'dynamicConfigFile' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extPath($_EXTKEY) . 'Configuration/TCA/Comment.php',
		'iconfile'   => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extRelPath($_EXTKEY) . 'Resources/Public/Icons/icon_tx_blogexample_domain_model_comment.gif'
	)
);

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_blogexample_domain_model_person');
$TCA['tx_blogexample_domain_model_person'] = array (
	'ctrl' => array (
		'title'    => 'LLL:EXT:blog_example/Resources/Private/Language/locallang_db.xml:tx_blogexample_domain_model_person',
		'label' => 'lastname',
		'label_alt' => 'firstname',
		'label_alt_force' => TRUE,
		'tstamp' => 'tstamp',
		'crdate' => 'crdate',
		'versioningWS' => 2,
		'versioning_followPages' => true,
		'origUid' => 't3_origuid',
		'prependAtCopy' => 'LLL:EXT:lang/locallang_general.xml:LGL.prependAtCopy',
		'delete' => 'deleted',
		'enablecolumns' => array(
			'disabled' => 'hidden'
			),
		'dynamicConfigFile' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extPath($_EXTKEY) . 'Configuration/TCA/Person.php',
		'iconfile' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extRelPath($_EXTKEY) . 'Resources/Public/Icons/icon_tx_blogexample_domain_model_person.gif'
	)
);

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_blogexample_domain_model_tag');
$TCA['tx_blogexample_domain_model_tag'] = array (
	'ctrl' => array (
		'title'    => 'LLL:EXT:blog_example/Resources/Private/Language/locallang_db.xml:tx_blogexample_domain_model_tag',
		'label' => 'name',
		'tstamp'   => 'tstamp',
		'crdate'   => 'crdate',
		'delete'   => 'deleted',
		'enablecolumns'  => array (
			'disabled' => 'hidden'
		),
		'dynamicConfigFile' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extPath($_EXTKEY) . 'Configuration/TCA/Tag.php',
		'iconfile'   => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extRelPath($_EXTKEY) . 'Resources/Public/Icons/icon_tx_blogexample_domain_model_tag.gif'
	)
);

\TYPO3\CMS\Core\Utility\GeneralUtility::loadTCA('fe_users');
if (is_array($TCA['fe_users']['columns']['tx_extbase_type'])) {
	$TCA['fe_users']['types']['Tx_BlogExample_Domain_Model_Administrator'] = $TCA['fe_users']['types']['0'];
	array_push($TCA['fe_users']['columns']['tx_extbase_type']['config']['items'], array('LLL:EXT:blog_example/Resources/Private/Language/locallang_db.xml:fe_users.tx_extbase_type.Tx_BlogExample_Domain_Model_Administrator', 'Tx_BlogExample_Domain_Model_Administrator'));
}
?>