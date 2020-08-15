<?php

if (!defined('TYPO3_MODE')) {
    die('Access denied.');
}

call_user_func(static function () {
    if (TYPO3_MODE === 'BE') {
        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTypoScriptSetup(
            '
module.tx_dashboard {
    view {
        templateRootPaths.1597677604 = EXT:custom_dashboard_widgets/Resources/Private/Templates/Widgets
        partialRootPaths.1597677604 = EXT:custom_dashboard_widgets/Resources/Private/Partials/Widgets
        layoutRootPaths.1597677604 = EXT:custom_dashboard_widgets/Resources/Private/Layouts/Widgets
    }
}'
        );
    }
});
