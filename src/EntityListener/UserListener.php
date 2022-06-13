<?php
namespace App\EntityListener;

use App\Entity\User;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserListener
{
    private UserPasswordHasherInterface $hasher;

    public function __construct(UserPasswordHasherInterface $hasher)
    {
        $this->hasher = $hasher;
    }
    public function prePersist(User $user)
    {
        $this->encodePassword($user);
    }

    public function preUpdate(User $user)
    {
        $this->encodePassword($user);
    }

    /**
     * encode password base on confirm password
     * 
     * @param User $user
     * @return void
     */
    public function encodePassword(User $user)
    {
        if($user->getConfirmPassword() == null)
        {
            return;
        }

        $user->setPassword(
            $this->hasher->hashPassword(
                $user,
                $user->getConfirmPassword()
            )
        );
    }
}