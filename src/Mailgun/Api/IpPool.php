<?php
/*
 * Copyright (C) 2013 Mailgun
 *
 * This software may be modified and distributed under the terms
 * of the MIT license. See the LICENSE file for details.
 */

namespace Mailgun\Api;

use Mailgun\Assert;
use Mailgun\Model\IpPool\IndexResponse;
use Mailgun\Model\IpPool\ShowResponse;
use Mailgun\Model\IpPool\UpdateResponse;
use Psr\Http\Message\ResponseInterface;

/**
 * {@link https://documentation.mailgun.com/en/latest/api-ip-pools.html}.
 *
 * @author Marcelo Duarte <md@marcelo.xyz>
 */
class IpPool extends HttpApi
{
    /**
     * Returns a list of IP pools.
     *
     * @return IndexResponse|ResponseInterface
     * @throws \Exception
     */
    public function index()
    {
        $response = $this->httpGet('/v1/ip_pools');
        return $this->hydrateResponse($response, IndexResponse::class);
    }

    /**
     * Links an IP Pool to a sending domain. Linking an IP Pool to a domain will replace any IPs already assigned
     * (shared or dedicated) with the IPs assigned to the pool. Only a pool with dedicated IPs can be linked to
     * a sending domain.
     *
     * @param string $domain
     * @param string $pool_id
     *
     * @return UpdateResponse|ResponseInterface
     * @throws \Exception
     */
    public function link_pool($domain, $pool_id)
    {
        Assert::stringNotEmpty($domain);
        Assert::stringNotEmpty($pool_id);

        $params   = ['pool_id' => $pool_id];
        $response = $this->httpPost(sprintf('/v3/domains/%s/ips', $domain), $params);

        return $this->hydrateResponse($response, UpdateResponse::class);
    }

    /**
     * Removes an IP Pool from a domain. You will need to supply a replacement IP option (shared, dedicated or
     * another IP Pool).
     *
     * @param string $domain
     * @param string $pool_id Required if the param $ip is not provided.
     * @param string $ip Required if the param $pool_id is not provided.
     *
     * @return UpdateResponse|ResponseInterface
     * @throws \Exception
     */
    public function unlink_pool($domain, $pool_id='', $ip='')
    {
        Assert::stringNotEmpty($domain);

        if (empty($pool_id)) {
            Assert::ip($ip);
            $params = ['ip' => $ip];
            $param  = "ip=$ip";
        } else {
            Assert::stringNotEmpty($pool_id);
            $params = ['pool_id' => $pool_id];
            $param  = "pool_id=$pool_id";
        }

        $response = $this->httpDelete(sprintf('/v3/domains/%s/ips/ip_pool?'. $param, $domain), $params);

        return $this->hydrateResponse($response, UpdateResponse::class);
    }
}
