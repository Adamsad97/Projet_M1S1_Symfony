<?php
namespace App\Security;

use App\Entity\User;
use Symfony\Component\Security\Core\Exception\CustomUserMessageAccountStatusException;
use Symfony\Component\Security\Core\User\UserCheckerInterface;
use Symfony\Component\Security\Core\User\UserInterface;

class UserChecker implements UserCheckerInterface
{
    public function checkPreAuth(UserInterface $user): void
    {
        if ($user instanceof User && !$user->isVerified()) {
            throw new CustomUserMessageAccountStatusException('Votre compte n\'est pas vérifié. Veuillez vérifier votre email.');
        }
        if (in_array('ROLE_BANNED', $user->getRoles(), true)) {
            throw new CustomUserMessageAccountStatusException('Votre compte a été suspendu.');
        }
    }

    public function checkPostAuth(UserInterface $user): void
    {
        // Rien à faire ici
    }
}
