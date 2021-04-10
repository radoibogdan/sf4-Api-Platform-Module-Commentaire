<?php


namespace App\Security;

use App\Entity\Comment;
use App\Entity\User;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;

class CommentVoter extends Voter
{

    const EDIT = 'EDIT_COMMENT';
    // Utilisé pour vérifier si la permission est supportée
    protected function supports(string $attribute, $subject)
    {
        // On ne votera que si le sujet est un commentaire et que l'attribut est EDIT_COMMENT
        return
        $attribute === self::EDIT &&
        $subject instanceof Comment;
    }

    /**
     * Utilisé pour voter
     * @param string $attribute
     * @param mixed $subject Notre commentaire
     * @param TokenInterface $token Permet de récupérer le user
     * @return bool|void
     */
    protected function voteOnAttribute(string $attribute, $subject, TokenInterface $token)
    {
        // Récupérer l'user avec le tokenInterface
        $user = $token->getUser();

        if (!$user instanceof User || !$subject instanceof Comment) {
            return false;
        }
        // L'utilisateur à la permission (si true) ou NON (si faux)
        return $user->getId() === $subject->getAuthor()->getId();
    }
}