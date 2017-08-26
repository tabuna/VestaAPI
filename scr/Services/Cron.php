<?php

namespace Tabuna\VestaAPI\Services;

trait Cron
{
    /**
     * Cron list.
     *
     * @return mixed
     */
    public function listCron()
    {
        $this->returnCode = 'no';
        $listDns = $this->send('v-list-cron-jobs', $this->userName, 'json');
        $data = json_decode($listDns, true);

        return $data;
    }

    /**
     * Add Cron.
     *
     * @param $min
     * @param $hour
     * @param $day
     * @param $month
     * @param $wday
     * @param $cmd
     *
     * @return mixed
     */
    public function addCron($min, $hour, $day, $month, $wday, $cmd)
    {
        return $this->send('v-add-cron-job', $this->userName, $min, $hour, $day, $month, $wday,
            $cmd);
    }

    /**
     * Show Cron.
     *
     * @param $job
     *
     * @return mixed
     */
    public function showCron($job)
    {
        $this->returnCode = 'no';
        $request = $this->send('v-list-cron-job', $this->userName, $job, 'json');
        $data = json_decode($request, true);

        return $data;
    }

    /**
     * Delete cron.
     *
     * @param $job
     *
     * @return mixed
     */
    public function deleteCron($job)
    {
        return $this->send('v-delete-cron-job', $this->userName, $job);
    }

    /**
     * Edit cron.
     *
     * @param $job
     * @param $min
     * @param $hour
     * @param $day
     * @param $month
     * @param $wday
     * @param $cmd
     *
     * @return mixed
     */
    public function editCron($job, $min, $hour, $day, $month, $wday, $cmd)
    {
        return $this->send('v-change-cron-job', $this->userName, $job, $min, $hour, $day, $month,
            $wday, $cmd);
    }
}
