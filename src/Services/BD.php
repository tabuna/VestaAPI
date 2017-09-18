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
        $this->setReturnCode('no');

        return json_decode($this->send('v-list-databases', $this->getUserName(), 'json'), true);
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
        return $this->send('v-change-database-user', $this->getUserName(), $database, $dbuser);
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
        return $this->send('v-change-database-password', $this->getUserName(), $database, $password);
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
        $this->setReturnCode('no');
        $listBd = $this->send('v-list-database', $this->getUserName(), $database, 'json');
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
        return $this->send('v-add-database', $this->getUserName(), $database, $dbuser, $password, $type,
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
        return $this->send('v-delete-database', $this->getUserName(), $database);
    }
}
