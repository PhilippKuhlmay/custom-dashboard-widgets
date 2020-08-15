<?php
declare(strict_types=1);

namespace Treupo\CustomDashboardWidgets\Widgets;

/*
 * (c) 2020 Treupo <typo3@treupo.de>
 *
 * This file is part of the Custom Dashboard Widgets Extension.
 *
 * It is free software; you can redistribute it and/or modify it under
 * the terms of the GNU General Public License, either version 2
 * of the License, or any later version.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 * The TYPO3 project - inspiring people to share!
 */

use Treupo\CustomDashboardWidgets\Widgets\Provider\PageProviderInterface;
use TYPO3\CMS\Core\Authentication\BackendUserAuthentication;
use TYPO3\CMS\Dashboard\Widgets\ListDataProviderInterface;
use TYPO3\CMS\Dashboard\Widgets\WidgetConfigurationInterface;
use TYPO3\CMS\Dashboard\Widgets\WidgetInterface;
use TYPO3\CMS\Fluid\View\StandaloneView;

class MissingSEOTitle implements WidgetInterface
{
    /**
     * @var WidgetConfigurationInterface
     */
    private $configuration;
    /**
     * @var ListDataProviderInterface
     */
    private $dataProvider;
    /**
     * @var StandaloneView
     */
    private $view;
    /**
     * @var null
     */
    private $buttonProvider;
    /**
     * @var array
     */
    private $options;

    public function __construct(
        WidgetConfigurationInterface $configuration,
        PageProviderInterface $dataProvider,
        StandaloneView $view,
        $buttonProvider = null,
        array $options = []
    ) {
        $this->configuration = $configuration;
        $this->dataProvider = $dataProvider;
        $this->view = $view;
        $this->buttonProvider = $buttonProvider;
        $this->options = array_merge(
            [
                'template' => 'Widget/ExtendedListWidget',
            ],
            $options
        );
    }

    public function renderWidgetContent(): string
    {
        $this->view->setTemplate($this->options['template']);

        $this->view->assignMultiple([
            'pages' => $this->dataProvider->getPages(),
            'options' => $this->options,
            'button' => $this->buttonProvider,
            'configuration' => $this->configuration,
            'dateFormat' => $GLOBALS['TYPO3_CONF_VARS']['SYS']['ddmmyy'],
            'timeFormat' => $GLOBALS['TYPO3_CONF_VARS']['SYS']['hhmm'],
        ]);
        return $this->view->render();
    }

    protected function getBackendUser(): BackendUserAuthentication
    {
        return $GLOBALS['BE_USER'];
    }
}
