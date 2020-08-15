<?php

declare(strict_types=1);
namespace Treupo\CustomDashboardWidgets;

use Treupo\CustomDashboardWidgets\Widgets\PageOverviewWidget;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;
use Symfony\Component\DependencyInjection\Reference;
use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;

return function (ContainerConfigurator $configurator, ContainerBuilder $containerBuilder) {
    $services = $configurator->services();
    if (ExtensionManagementUtility::isLoaded('seo')) {
        $services->set('widgets.dashboard.widget.pagesWithoutMetaDescription')
            ->class(PageOverviewWidget::class)
            ->arg('$dataProvider', new Reference('Treupo\CustomDashboardWidgets\Widgets\Provider\PagesWithoutDescriptionDataProvider'))
            ->arg('$view', new Reference('dashboard.views.widget'))
            ->arg('$buttonProvider', null)
            ->arg('$options', ['template' => 'Widget/PageWithoutMetaDescriptionWidget'])
            ->tag(
                'dashboard.widget',
                [
                    'identifier' => 'widgets-pagesWithoutMetaDescription',
                    'groupNames' => 'seo',
                    'title' => 'LLL:EXT:widgets/Resources/Private/Language/locallang.xlf:widgets.dashboard.widget.pagesWithoutMetaDescription.title',
                    'description' => 'LLL:EXT:widgets/Resources/Private/Language/locallang.xlf:widgets.dashboard.widget.pagesWithoutMetaDescription.description',
                    'iconIdentifier' => 'content-widget-list',
                    'height' => 'large',
                    'width' => 'medium'
                ]
            )
        ;
    }
};
