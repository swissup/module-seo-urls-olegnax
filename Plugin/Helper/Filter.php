<?php

namespace Swissup\SeoUrlsOlegnax\Plugin\Helper;

use Olegnax\LayeredNavigation\Helper\Filter as Subject;

class Filter
{
    private $filter;

    /**
     * @param  \Olegnax\LayeredNavigation\Model\Layer\Filter $filter
     */
    public function __construct(
        \Olegnax\LayeredNavigation\Model\Layer\Filter $filter
    ) {
        $this->filter = $filter;
    }

    public function afterCheckedFilter(
        Subject $subject,
        $result,
        $item,
        $echoselected = ' checked'
    ) {
        return $result . " data-href=\"{$item->getUrl()}\"";
    }

    public function afterGetSelectedSlider(
        Subject $subject,
        $result,
        $filter
    ) {
        $f = clone $filter;
        $filterItem = current($f->getItems());
        $value = $this->filter->getFilterValue($f);
        if ($value) {
            // set pattern for price filter url
            $filterItem->setValue(null);
            $url = str_replace(
                $value,
                "{value.{$f->getRequestVar()}}",
                $filterItem->getUrl()
            );
            $url = str_replace('},', '}', $url);
        } else {
            // reset applied filter
            $filterItem->setRawAppliedOptions('');
            // set pattern for price filter url
            $filterItem->setValue("{value.{$f->getRequestVar()}}");
            $url = $filterItem->getUrl();
        }

        return $result . "\" data-href=\"{$url}\"";
    }
}
