<?php

class UserIdentity extends CUserIdentity
{
    private $dbid;

    public function authenticate()
    {
        $dbrec = Users::model()->findByAttributes(['username' => $this->username]);
        if (!isset($dbrec->username)) {
            $this->errorCode = self::ERROR_USERNAME_INVALID;
        } elseif (!CPasswordHelper::verifyPassword($this->password, $dbrec->password)) {
            $this->errorCode = self::ERROR_PASSWORD_INVALID;
        } else {
            $this->dbid = $dbrec->id;
            $this->setState('username', $dbrec->username);
            $this->errorCode = self::ERROR_NONE;
            if ($role = $this->getRole()) {
                $this->setState('role', $role);
            }
        }

        return !$this->errorCode;
    }


    public function getRole() {
        return Roles::model()->findByAttributes(['role' => $this->getId()]);
    }

    public function getId()
    {
        return $this->dbid;
    }
}
