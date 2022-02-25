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
final class ShowResponse implements ApiResponse
{
    /**
     * @var string
     */
    private $ip_pool;

    /**
     * @var string
     */
    private $pool_id;

    private function __construct()
    {
    }

    public static function create(array $data)
    {
        $model = new self();
        $model->ip_pool = $data['name'];
        $model->pool_id = $data['pool_id'];

        return $model;
    }

    /**
     * @return string
     */
    public function getPoolName()
    {
        return $this->ip_pool;
    }

    /**
     * @return string
     */
    public function getPoolId()
    {
        return $this->pool_id;
    }
}
