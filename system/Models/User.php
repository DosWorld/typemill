<?php

namespace Typemill\Models;

class User extends WriteYaml
{
	public function getUsers()
	{
		$userDir = __DIR__ . '/../../settings/users';
				
		/* check if plugins directory exists */
		if(!is_dir($userDir)){ return array(); }
		
		/* get all plugins folder */
		$users = array_diff(scandir($userDir), array('..', '.'));
				
		$cleanUser	= array();
		foreach($users as $key => $user)
		{
			if($user == '.logins'){ continue; }
			$cleanUser[] = str_replace('.yaml', '', $user);
		}

		return $cleanUser;
	}
	
	public function getUser($username)
	{
		$user = $this->getYaml('settings/users', $username . '.yaml');
		return $user;
	}
	
	public function createUser($params)
	{		
		$userdata = array(
						'username' 	=> $params['username'],
						'email'		=> $params['email'],
						'password'	=> $this->generatePassword($params['password']),
						'userrole' 	=> $params['userrole']
					);

		if(isset($params['firstname']))
		{
			$userdata['firstname'] = $params['firstname'];
		}
		if(isset($params['lastname']))
		{
			$userdata['lastname'] = $params['lastname'];
		}
	
		if($this->updateYaml('settings/users', $userdata['username'] . '.yaml', $userdata))
		{
			return $userdata['username'];
		}
		return false;
	}
	
	public function updateUser($params)
	{
		$userdata = $this->getUser($params['username']);
		
		if(isset($params['password']))
		{
			$params['password'] = $this->generatePassword($params['password']);
		}
		
		$update = array_merge($userdata, $params);
		
		$this->updateYaml('settings/users', $userdata['username'] . '.yaml', $update);

		$_SESSION['user'] 	= $update['username'];
		$_SESSION['role'] 	= $update['userrole'];

		if(isset($update['firstname']))
		{
			$_SESSION['firstname'] = $update['firstname'];
		}
		if(isset($update['lastname']))
		{
			$_SESSION['lastname'] = $update['lastname'];
		}
		
		return $userdata['username'];
	}
	
	public function deleteUser($username)
	{
		if($this->getUser($username))
		{
			unlink('settings/users/' . $username . '.yaml');
		}
	}
	
	public function getUserroles()
	{
		return array('administrator', 'editor');
	}	
	
	public function login($username)
	{
		$user = $this->getUser($username);

		if($user)
		{
			$user['lastlogin'] = time();
			unset($user['password']);
			$this->updateUser($user);

			$_SESSION['user'] 	= $user['username'];
			$_SESSION['role'] 	= $user['userrole'];
			$_SESSION['login'] 	= $user['lastlogin'];

			if(isset($user['firstname']))
			{
				$_SESSION['firstname'] = $user['firstname'];
			}
			if(isset($user['lastname']))
			{
				$_SESSION['lastname'] = $user['lastname'];
			}
		}
	}
	
	public function generatePassword($password)
	{
		return \password_hash($password, PASSWORD_DEFAULT, ['cost' => 10]);
	}	
}