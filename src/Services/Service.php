<?php

namespace VestaAPI\Services;

trait Service
{
    /**
     * Restart dns server.
     *
     * @return mixed
     */
    public function restartDNSServer()
    {
        return $this->toString($this->send('v-restart-dns'));
    }

    /**
     * @param $query
     *
     * @return mixed
     */
    public function userSearch($query)
    {
        return $this->setReturnCode(self::RETURN_CODE_NO)->toArray($this->send('v-search-user-object', $this->getUserName(), $query, 'json'));
    }

    /**
     * @return array
     */
    public function listStats()
    {
        $data = $this->setReturnCode(self::RETURN_CODE_NO)->toArray($this->send('v-list-users-stats', 'json'));
        return array_reverse($data, true);
    }

    /**
     * @return mixed
     */
    public function listRRD()
    {
        return $this->setReturnCode(self::RETURN_CODE_NO)->toArray($this->send('v-list-sys-rrd', 'json'));
    }

    /**
     * @return mixed
     */
    public function listSysInfo()
    {
        return $this->setReturnCode(self::RETURN_CODE_NO)->toArray($this->send('v-list-sys-info', 'json'));
    }

    /**
     * @return mixed
     */
    public function listSysService()
    {
        return $this->setReturnCode(self::RETURN_CODE_NO)->toArray($this->send('v-list-sys-services', 'json'));
    }

    /**
     * @param $service
     *
     * @return mixed
     */
    public function restartService($service)
    {
        return $this->toString($this->send('v-restart-service', $service));
    }

    /**
     * @param $service
     *
     * @return mixed
     */
    public function startService($service)
    {
        return $this->toString($this->send('v-start-service', $service));
    }

    /**
     * @param $service
     *
     * @return mixed
     */
    public function stopService($service)
    {
        return $this->toString($this->send('v-stop-service', $service));
    }

    /**
     * @return mixed
     */
    public function listIp()
    {
        return $this->setReturnCode(self::RETURN_CODE_NO)->toArray($this->send('v-list-sys-ips', 'json'));
    }

    /**
     * @param $ip
     *
     * @return mixed
     */
    public function getIp($ip)
    {
        return $this->setReturnCode(self::RETURN_CODE_NO)->toArray($this->send('v-list-sys-ip', $ip, 'json'));
    }

    /**
     * @param $user
     *
     * @return mixed
     * @internal param string $restart
     */
    public function rebuildWebDomains($user)
    {
        return $this->toString($this->send('v-rebuild-web-domains', $user));
    }

    /**
     * @param $user
     *
     * @return mixed
     * @internal param string $restart
     */
    public function rebuildDNSDomains($user)
    {
        return $this->toString($this->send('v-rebuild-dns-domains', $user));
    }

    /**
     * @param $user
     *
     * @return mixed
     */
    public function rebuildMailDomains($user)
    {
        return $this->toString($this->send('v-rebuild-mail-domains', $user));
    }

    /**
     * @param $user
     *
     * @return mixed
     */
    public function rebuildDataBases($user)
    {
        return $this->toString($this->send('v-rebuild-databases', $user));
    }

    /**
     * @param $user
     *
     * @return mixed
     * @internal param string $restart
     */
    public function rebuildCronJobs($user)
    {
        return $this->toString($this->send('v-rebuild-cron-jobs', $user));
    }

    /**
     * @param $user
     *
     * @return mixed
     */
    public function updateUserCounters($user)
    {
        return $this->toString($this->send('v-update-user-counters', $user));
    }

    /**
     * @param $package
     *
     * @return mixed
     */
    public function updateSysVesta($package)
    {
        return $this->toString($this->send('v-update-sys-vesta', $package));
    }
}
