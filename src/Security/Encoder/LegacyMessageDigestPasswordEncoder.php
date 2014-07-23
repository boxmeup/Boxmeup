<?php

namespace Boxmeup\Web\Security\Encoder;

use Symfony\Component\Security\Core\Encoder\MessageDigestPasswordEncoder;
use Boxmeup\Web\Util\Configure;

/**
 * This is a temporary class to support legacy encoded passwords.
 *
 * This is basically a duplication of CakePHP's default password hashing.
 */
class LegacyMessageDigestPasswordEncoder extends MessageDigestPasswordEncoder {

	/**
	 * Demerges a merge password and salt string.
	 *
	 * @param string $mergedPasswordSalt The merged password and salt string
	 *
	 * @return array An array where the first element is the password and the second the salt
	 */
	protected function demergePasswordAndSalt($mergedPasswordSalt) {
		$saltBase = Configure::get('Security.salt_base');
		return [
			str_replace($saltBase, '', $mergedPasswordSalt),
			$saltBase
		];
	}

	/**
	 * Merges a password and a salt.
	 *
	 * @param string $password the password to be used
	 * @param string $salt     the salt to be used
	 * @return string a merged password and salt
	 */
	protected function mergePasswordAndSalt($password, $salt) {
		return $salt . $password;
	}

}
