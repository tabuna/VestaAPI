<?php

namespace VestaAPI\Services;

trait Db
{
    /**
     * List data base.
     *
     * @param string $user
     *
     * @return mixed
     */
    public function listBD($user)
    {
        return $this->setReturnCode(self::RETURN_CODE_NO)->toArray($this->send('v-list-databases', $user, 'json'));
    }

    /**
     * Change user database.
     *
     * @param string $user
     * @param $database
     * @param $dbUser
     *
     * @return mixed
     */
    public function changeDbUser($user, $database, $dbUser)
    {
        return $this->toString($this->send('v-change-database-user', $user, $database, $dbUser));
    }

    /**
     * Change data base password.
     *
     * @param string $user
     * @param $database
     * @param $password
     *
     * @return mixed
     */
    public function changeDbPassword($user, $database, $password)
    {
        return $this->toString($this->send('v-change-database-password', $user, $database, $password));
    }

    /**
     * List Only BD.
     *
     * @param $database
     *
     * @return mixed
     */
    public function listOnlyBD($user, $database)
    {
        return  $this->setReturnCode(self::RETURN_CODE_NO)->toArray($this->send('v-list-database', $user, $database, 'json'));
    }

    /**
     * Add date base.
     *
     * @param        $user
     * @param        $database
     * @param        $dbuser
     * @param        $password
     * @param string $type
     * @param        $charset
     *
     * @return mixed
     */
    public function addDateBase($user, $database, $dbuser, $password, $type, $charset)
    {
        return $this->toString($this->send('v-add-database', $user, $database, $dbuser, $password, $type,
            'localhost', $charset));
    }

    /**
     * Delete data base.
     *
     * @param string $user
     * @param        $database
     *
     * @return mixed
     */
    public function deleteDateBase($user, $database)
    {
        return $this->toString($this->send('v-delete-database', $user, $database));
    }
}
