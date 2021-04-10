<?php


namespace App\Controller\Api;


use Symfony\Component\HttpFoundation\Response;

/**
 * Un faux controller pour que l'user ne puisse accèder à l'IRI api/posts/{id}
 * @package App\Controller\Api
 */
class EmptyController
{

    public function __invoke()
    {
        // Renvoyer une réponse vide;
        return new Response();
    }

}