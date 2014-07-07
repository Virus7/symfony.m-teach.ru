<?php
namespace Test\TestBundle\Entity;

use Symfony\Component\Validator\Constraints as Assert;

class UserFormEntity
{

	private $email;

	private $password;

	private $confirm;

	protected $gender;

	protected $birthday;
	
	protected $about;

	protected $newsletter;
	
	
	public function getEmail()
	{
			return $this->email;
	}
	public function setEmail($email)
	{
			$this->email = $email;
	}

	public function getPassword()
	{
			return $this->password;
	}
	public function setPassword($password)
	{
			$this->password = $password;
	}
	public function isPasswordConfirmed()
	{
			return ($this->password === $this->confirm) ? true:false;
	}
	
	public function getConfirm()
	{
			return $this->confirm;
	}
	public function setConfirm($confirm)
	{
			$this->confirm = $confirm;
	}
	
	public function getGender()
	{
			return $this->gender;
	}
	public function setGender($gender)
	{
			$this->gender = $gender;
	}
		
	public function getBirthday()
	{
			return $this->birthday;
	}
	public function setBirthday($birthday)
	{
			$this->birthday = $birthday;
	}
	
	public function getAbout()
	{
			return $this->about;
	}
	public function setAbout($about)
	{
			$this->about = $about;
	}
	
	public function getNewsletter()
	{
			return $this->newsletter;
	}
	public function setNewsletter($newsletter)
	{
			$this->newsletter = $newsletter;
	}
}
