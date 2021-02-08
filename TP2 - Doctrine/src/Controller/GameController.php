<?php

namespace App\Controller;


use App\Entity\Game;
use App\FakeData;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class GameController extends AbstractController
{

    public function index(Request $request): Response
    {
        /**
         * @todo lister les jeux de la base
         */
        $games = FakeData::games(15);
        return $this->render("game/index", ["games" => $games]);

    }

    public function add(Request $request, EntityManagerInterface $entityManager): Response
    {
        $em = $entityManager->getRepository(Game::class);
        $game = FakeData::games(1)[0];

        if ($request->getMethod() == Request::METHOD_POST) {
            $game = new Game();
            $game
                ->setName($request->get('name'))
                ->setImage($request->get('image'));

            return $this->redirectTo("/game");
        }
        return $this->render("game/form", ["game" => $game]);
    }


    public function show(int $id): Response
    {
        $game = FakeData::games(1)[0];
        return $this->render("game/show", ["game" => $game]);
    }


    public function edit(int $id, Request $request): Response
    {
        $game = FakeData::games(1)[0];

        if ($request->getMethod() == Request::METHOD_POST) {
            /**
             * @todo enregistrer l'objet
             */
            return $this->redirectTo("/game");
        }
        return $this->render("game/form", ["game" => $game]);


    }

    public function delete(int $id, EntityManagerInterface $entityManager): Response
    {
        $em = $entityManager->getRepository(Game::class);
        $game = $em->find($id);
        $entityManager->remove($game);
        return $this->redirectTo("/game");

    }

}
