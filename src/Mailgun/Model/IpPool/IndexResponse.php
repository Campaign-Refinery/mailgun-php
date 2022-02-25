<?php

/*
 * Copyright (C) 2013 Mailgun
 *
 * This software may be modified and distributed under the terms
 * of the MIT license. See the LICENSE file for details.
 */

namespace Mailgun\Model\IpPool;

use Mailgun\Model\ApiResponse;

/**
 * @author Marcelo Duarte <md@marcelo.xyz>
 */
final class IndexResponse implements ApiResponse
{
    /**
     * @var string[]
     */
    private $items;

    /**
     * @var int
     */
    private $totalCount = 0;

    private function __construct()
    {
    }

    public static function create(array $data)
    {
        $model = new self();
        $model->items = $data['ip_pools'];
        $model->totalCount = count($data['ip_pools']);
        return $model;
    }

    /**
     * @return string[]
     */
    public function getItems()
    {
        return $this->items;
    }

    /**
     * @return int
     */
    public function getTotalCount()
    {
        return $this->totalCount;
    }
}
