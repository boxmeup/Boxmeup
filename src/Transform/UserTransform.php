<?php

namespace Boxmeup\Web\Transform;

use Symfony\Component\Security\Core\User\UserInterface;
use Boxmeup\User\User;
use Boxmeup\Web\Util\Configure;

class UserTransform extends User implements UserInterface
{

	/**
	 * Get an array of roles for this user.
	 *
	 * Roles aren't really utilized in this app, so just hardcoding.
	 *
	 * @return array
	 */
	public function getRoles() {
		return ['ROLE_USER'];
	}

	/**
	 * Get the "username" of the user.
	 *
	 * In this case, it is an email address.
	 *
	 * @return string
	 */
	public function getUsername() {
		return (string)$this['email'];
	}

	/**
	 * Get the encoded password.
	 *
	 * @return string
	 */
	public function getPassword() {
		return $this['password'];
	}

	/**
	 * Salt used to encode the password.
	 * 
	 * @return string
	 * @todo Implement a stronger salt algorythm
	 */
	public function getSalt() {
		// This is temporary to support legacy users.
		return Configure::get('Security.salt_base');
	}

	/**
	 * Erase sensitive information from this user object.
	 *
	 * This is a no-op for now, but revisit if we start storing sensitive things.
	 * 
	 * @return void
	 */
	public function eraseCredentials() {
	}

}
