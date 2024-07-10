<?php

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class UserIdentity extends CUserIdentity
{
	private $_id;
	/**
	 * Authenticates a user.
	 * The example implementation makes sure if the username and password
	 * are both 'demo'.
	 * In practical applications, this should be changed to authenticate
	 * against some persistent user identity storage (e.g. database).
	 * @return boolean whether authentication succeeds.
	 */
	public function authenticate()
	{
		$username = $this->username;
		$password = $this->password;

		$account=Account::model()->find(array(
			'condition'=>'username=:username',
			'params'=>array(
				':username'=>$username,
			)
		));

		if(!empty($account))
		{
			$password = $account->hashPassword($password,$account->salt);
			if($password == $account->password)
			{
				$this->_id=$account->id;
				$this->setState('id', $account->id);
           		$this->setState('account_type_id', $account->account_type_id);
           		$this->setState('__name', $account->accountType->type);
				$this->errorCode=self::ERROR_NONE;
			}
			else
			{
				$this->errorCode=self::ERROR_PASSWORD_INVALID;
			}
		}
		else
		{
			$this->errorCode=self::ERROR_USERNAME_INVALID;
		}

		return !$this->errorCode;
	}

	public function getId()
    {
        return $this->_id;
    }
}