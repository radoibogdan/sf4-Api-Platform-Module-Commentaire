<?php


namespace App\Controller\Api;


use App\Entity\Comment;
use Symfony\Component\Security\Core\Security;

class CommentCreateController
{

    /**
     * @var Security
     */
    private $security;

    /**
     * CommentCreateController constructor.
     * Security permet de récupérer le user
     * @param Security $security
     */
    public function __construct(Security $security) {
        $this->security = $security;
    }

    // Le controller contient une classe qui sera invocable, ne renvoie pas une réponse mais les données modifiées.
    public function __invoke(Comment $data): Comment
    {
        // l'entity créée par ApiPlatform est disponible à ce point, elle n'est pas encore persistée
        // On rajoute le user connecté sur le commentaire
        $data->setAuthor($this->security->getUser());
        return $data;
    }

}