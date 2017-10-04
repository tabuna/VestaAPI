<?php

namespace VestaAPI\Services;

trait Db
{
    /**
     * List data base.
     *
     * @return mixed
     */
    public function listBD()
    {
        return $this->setReturnCode(self::RETURN_CODE_NO)->toArray($this->send('v-list-databases', $this->getUserName(), 'json'));
    }

    /**
     * Change user database.
     *
     * @param $database
     * @param $dbUser
     *
     * @return mixed
     */
    public function changeDbUser($database, $dbUser)
    {
        return $this->toString($this->send('v-change-database-user', $this->getUserName(), $database, $dbUser));
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
        return $this->toString($this->send('v-change-database-password', $this->getUserName(), $database, $password));
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
        return  $this->setReturnCode(self::RETURN_CODE_NO)->toArray($this->send('v-list-database', $this->getUserName(), $database, 'json'));
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
        return $this->toString($this->send('v-add-database', $this->getUserName(), $database, $dbuser, $password, $type,
            'localhost', $charset));
    }

    /**
     * Delete data base.
     *
     * @param        $database
     *
     * @return mixed
     */
    public function deleteDateBase($database)
    {
        return $this->toString($this->send('v-delete-database', $this->getUserName(), $database));
    }
}
