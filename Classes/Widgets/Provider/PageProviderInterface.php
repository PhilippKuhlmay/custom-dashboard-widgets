<?php

declare(strict_types=1);

namespace Treupo\CustomDashboardWidgets\Widgets\Provider;

interface PageProviderInterface
{
    /**
     * @return array
     */
    public function getPages(): array;
}
