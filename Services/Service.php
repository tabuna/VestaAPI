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
        return $this->send('v-restart-dns');
    }

    /**
     * @param $query
     *
     * @return mixed
     */
    public function userSearch($query)
    {
        $this->returnCode = 'no';

        return json_decode($this->send('v-search-user-object', $this->vestaUserName, $query, 'json'), true);
    }

    /**
     * @return array
     */
    public function listStats()
    {
        $this->returnCode = 'no';
        $data = json_decode($this->send('v-list-users-stats', 'json'), true);

        return array_reverse($data, true);
    }

    /**
     * @return mixed
     */
    public function listRRD()
    {
        $this->returnCode = 'no';

        return json_decode($this->send('v-list-sys-rrd', 'json'), true);
    }

    /**
     * @return mixed
     */
    public function listSysInfo()
    {
        $this->returnCode = 'no';

        return json_decode($this->send('v-list-sys-info', 'json'), true);
    }

    /**
     * @return mixed
     */
    public function listSysService()
    {
        $this->returnCode = 'no';

        return json_decode($this->send('v-list-sys-services', 'json'), true);
    }

    /**
     * @param $service
     *
     * @return mixed
     */
    public function restartService($service)
    {
        return $this->send('v-restart-service', $service);
    }

    /**
     * @param $service
     *
     * @return mixed
     */
    public function startService($service)
    {
        return $this->send('v-start-service', $service);
    }

    /**
     * @param $service
     *
     * @return mixed
     */
    public function stopService($service)
    {
        return $this->send('v-stop-service', $service);
    }

    /**
     * @return mixed
     */
    public function listIp()
    {
        $this->returnCode = 'no';

        return json_decode($this->send('v-list-sys-ips', 'json'), true);
    }

    /**
     * @param $ip
     *
     * @return mixed
     */
    public function getIp($ip)
    {
        $this->returnCode = 'no';

        return json_decode($this->send('v-list-sys-ip', $ip, 'json'), true);
    }

    /**
     * @return mixed
     *
     * @internal param string $restart
     */
    public function rebuildWebDomains()
    {
        return $this->send('v-rebuild-web-domains', $this->vestaUserName);
    }

    /**
     * @return mixed
     *
     * @internal param string $restart
     */
    public function rebuildDNSDomains()
    {
        return $this->send('v-rebuild-dns-domains', $this->vestaUserName);
    }

    /**
     * @return mixed
     */
    public function rebuildMailDomains()
    {
        return $this->send('v-rebuild-mail-domains', $this->vestaUserName);
    }

    /**
     * @return mixed
     */
    public function rebuildDataBases()
    {
        return $this->send('v-rebuild-databases', $this->vestaUserName);
    }

    /**
     * @return mixed
     *
     * @internal param string $restart
     */
    public function rebuildCronJobs()
    {
        return $this->send('v-rebuild-cron-jobs', $this->vestaUserName);
    }

    /**
     * @return mixed
     */
    public function updateUserCounters()
    {
        return $this->send('v-update-user-counters', $this->vestaUserName);
    }

    /**
     * @param $package
     *
     * @return mixed
     */
    public function updateSysVesta($package)
    {
        return $this->send('v-update-sys-vesta', $package);
    }
}
