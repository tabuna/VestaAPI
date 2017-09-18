<?php

namespace VestaAPI\Services;

trait Cron
{
    /**
     * Cron list.
     *
     * @param string $user
     *
     * @return mixed
     */
    public function listCron($user)
    {
        return $this->setReturnCode(self::RETURN_CODE_NO)->toArray($this->send('v-list-cron-jobs', $user, 'json'));
    }

    /**
     * Add Cron.
     *
     * @param string $user
     * @param        $min
     * @param        $hour
     * @param        $day
     * @param        $month
     * @param        $wday
     * @param        $cmd
     *
     * @return mixed
     */
    public function addCron($user, $min, $hour, $day, $month, $wday, $cmd)
    {
        return $this->toString($this->send('v-add-cron-job', $user, $min, $hour, $day, $month, $wday, $cmd));
    }

    /**
     * Show Cron.
     *
     * @param string $user
     * @param        $job
     *
     * @return mixed
     */
    public function showCron($user, $job)
    {
        return $this->setReturnCode(self::RETURN_CODE_NO)->toArray($this->send('v-list-cron-job', $user, $job, 'json'));
    }

    /**
     * Delete cron.
     *
     * @param string $user
     * @param        $job
     *
     * @return mixed
     */
    public function deleteCron($user, $job)
    {
        return $this->toString($this->send('v-delete-cron-job', $user, $job));
    }

    /**
     * Edit cron.
     *
     * @param string $user
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
    public function editCron($user, $job, $min, $hour, $day, $month, $wday, $cmd)
    {
        return $this->toString($this->send('v-change-cron-job', $user, $job, $min, $hour, $day, $month, $wday, $cmd));
    }
}
