<?php

namespace Boxmeup\Web\Provider;

use Symfony\Component\Security\Core\User\UserProviderInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\Exception\UnsupportedUserException;
use Symfony\Component\Security\Core\Exception\UsernameNotFoundException;
use Boxmeup\Web\Transform\UserTransform as User;
use Boxmeup\Exception\NotFoundException;
use Boxmeup\Repository\UserRepository;

class UserProvider implements UserProviderInterface
{
    protected $userRepo;

    /**
     * Construct.
     *
     * @param UserRepository $userRepo
     */
    public function __construct(UserRepository $userRepo)
    {
        $this->userRepo = $userRepo;
    }

    /**
     * Load the user information by username (in this case email address)
     *
     * @param  string $email
     * @return User
     */
    public function loadUserByUsername($email)
    {
        try {
            return User::transform($this->userRepo->byEmail($email));
        } catch (NotFoundException $e) {
            throw new UsernameNotFoundException(sprintf('User with email "%s" does not exist.', $email));
        }
    }

    /**
     * Refresh the user information.
     *
     * @param  UserInterface $user
     * @return User          See self::loadUserByUsername
     */
    public function refreshUser(UserInterface $user)
    {
        if (!$user instanceof User) {
            throw new UnsupportedUserException(sprintf('Instances of "%s" are not supported.', get_class($user)));
        }

        return $this->loadUserByUsername($user->getUsername());
    }

    /**
     * Supported user class.
     *
     * @param  string  $class
     * @return boolean
     */
    public function supportsClass($class)
    {
        return $class === 'Boxmeup\Web\Transform\UserTransform';
    }
}
