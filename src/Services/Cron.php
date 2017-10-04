<?php

namespace VestaAPI\Services;

trait Cron
{
    /**
     * Cron list.
     *
     * @return mixed
     */
    public function listCron()
    {
        return $this->setReturnCode(self::RETURN_CODE_NO)->toArray($this->send('v-list-cron-jobs', $this->getUserName(), 'json'));
    }

    /**
     * Add Cron.
     *
     * @param        $min
     * @param        $hour
     * @param        $day
     * @param        $month
     * @param        $wday
     * @param        $cmd
     *
     * @return mixed
     */
    public function addCron($min, $hour, $day, $month, $wday, $cmd)
    {
        return $this->toString($this->send('v-add-cron-job', $this->getUserName(), $min, $hour, $day, $month, $wday, $cmd));
    }

    /**
     * Show Cron.
     *
     * @param        $job
     *
     * @return mixed
     */
    public function showCron($job)
    {
        return $this->setReturnCode(self::RETURN_CODE_NO)->toArray($this->send('v-list-cron-job', $this->getUserName(), $job, 'json'));
    }

    /**
     * Delete cron.
     *
     * @param        $job
     *
     * @return mixed
     */
    public function deleteCron($job)
    {
        return $this->toString($this->send('v-delete-cron-job', $this->getUserName(), $job));
    }

    /**
     * Edit cron.
     *
     * @param        $job
     * @param        $min
     * @param        $hour
     * @param        $day
     * @param        $month
     * @param        $wday
     * @param        $cmd
     *
     * @return mixed
     */
    public function editCron($job, $min, $hour, $day, $month, $wday, $cmd)
    {
        return $this->toString($this->send('v-change-cron-job', $this->getUserName(), $job, $min, $hour, $day, $month, $wday, $cmd));
    }
}
