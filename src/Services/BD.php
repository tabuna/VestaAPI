<?php

namespace VestaAPI\Services;

trait BD
{
    /**
     * List data base.
     *
     * @return mixed
     */
    public function listBD()
    {
        $this->returnCode = 'no';

        return json_decode($this->send('v-list-databases', $this->userName, 'json'), true);
    }

    /**
     * Change user database.
     *
     * @param $database
     * @param $dbuser
     *
     * @return mixed
     */
    public function changeDbUser($database, $dbuser)
    {
        return $this->send('v-change-database-user', $this->userName, $database, $dbuser);
    }

    /**
     * Change data base password.
     *
     * @param $database
     * @param $password
     *
     * @return mixed
     */
    public function changeDbPassword($database, $password)
    {
        return $this->send('v-change-database-password', $this->userName, $database, $password);
    }

    /**
     * List Only BD.
     *
     * @param $database
     *
     * @return mixed
     */
    public function listOnlyBD($database)
    {
        $this->returnCode = 'no';
        $listBd = $this->send('v-list-database', $this->userName, $database, 'json');
        $data = json_decode($listBd, true);

        return $data;
    }

    /**
     * Add date base.
     *
     * @param        $database
     * @param        $dbuser
     * @param        $password
     * @param string $type
     * @param        $charset
     *
     * @return mixed
     */
    public function addDateBase($database, $dbuser, $password, $type, $charset)
    {
        return $this->send('v-add-database', $this->userName, $database, $dbuser, $password, $type,
            'localhost', $charset);
    }

    /**
     * Delete data base.
     *
     * @param $database
     *
     * @return mixed
     */
    public function deleteDateBase($database)
    {
        return $this->send('v-delete-database', $this->userName, $database);
    }
}
