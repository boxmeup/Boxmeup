<?php

namespace Boxmeup\Web\Provider;

use Symfony\Component\Security\Core\User\UserProviderInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\Exception\UnsupportedUserException;
use Symfony\Component\Security\Core\Exception\UsernameNotFoundException;
use Doctrine\DBAL\Connection;
use Boxmeup\Web\Transform\UserTransform as User;

class UserProvider implements UserProviderInterface
{
    private $conn;

    /**
     * Construct.
     * 
     * @param Doctrine\DBAL\Connection $conn
     */
    public function __construct(Connection $conn) {
        $this->conn = $conn;
    }

    /**
     * Load the user information by username (in this case email address)
     *
     * @param string $email
     * @return Boxmeup\Web\Transform\User
     */
    public function loadUserByUsername($email) {
        $stmt = $this->conn->executeQuery('SELECT * FROM users WHERE email = ?', [strtolower($email)]);

        if (!$user = $stmt->fetch()) {
            throw new UsernameNotFoundException(sprintf('User with email "%s" does not exist.', $email));
        }

        return new User($user);
    }

    /**
     * Refresh the user information.
     *
     * @param UserInterface $user
     * @return Boxmeup\Web\Transform\User See self::loadUserByUsername
     */
    public function refreshUser(UserInterface $user) {
        if (!$user instanceof User) {
            throw new UnsupportedUserException(sprintf('Instances of "%s" are not supported.', get_class($user)));
        }

        return $this->loadUserByUsername($user->getUsername());
    }

    /**
     * Supported user class.
     *
     * @param string $class
     * @return boolean
     */
    public function supportsClass($class) {
        return $class === 'Boxmeup\Web\Transform\UserTransform';
    }
}
