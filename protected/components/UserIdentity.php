<?php

class UserIdentity extends CUserIdentity
{
    private $dbid;

    public function authenticate()
    {
        $users = Users::model()->findByAttributes(['username' => $this->username]);

        $this->dbid = $users->id;

        if (!isset($this->username)) {
            $this->errorCode = self::ERROR_USERNAME_INVALID;
        } elseif ('Administrator' !== $this->getRole()) {
            $this->errorCode = self::ERROR_PASSWORD_INVALID;
        } elseif ($this->password == $users->password) {
            $this->errorCode = self::ERROR_NONE;
        } else {
            $this->errorCode = self::ERROR_PASSWORD_INVALID;
        }

        return !$this->errorCode;
    }

    public function getRole()
    {
        $res = Roles::model()->findByAttributes(['id' => $this->dbid]);
        return $res->name;
    }
}


