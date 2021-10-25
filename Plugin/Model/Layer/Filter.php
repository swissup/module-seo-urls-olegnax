<?php

namespace Swissup\SeoUrlsOlegnax\Plugin\Model\Layer;

use Olegnax\LayeredNavigation\Model\Layer\Filter as Subject;

class Filter
{
    public function afterGetFilterValue(
        Subject $subject,
        $result,
        $filter,
        $explode = true
    ) {
        if ($explode && is_scalar($result)) {
            return [$result];
        }

        return $result;
    }
}
