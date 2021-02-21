<?php

namespace App\Controller;


use App\Entity\Game;
use App\Entity\Player;
use App\FakeData;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class GameController extends AbstractController
{

    public function index(Request $request, EntityManagerInterface $entityManager): Response
    {
        $games = $entityManager
            ->getRepository(Game::class)
            ->findAll();
        return $this->render("game/index", ["games" => $games]);

    }

    public function add(Request $request, EntityManagerInterface $entityManager): Response
    {

        //$game = FakeData::games(1)[0];
        $game = (new Game())
            ->setName('GAME 1')
            ->setImage('https://fakeimg.pl/256x256/b0aae1/615b39/?text=GAME+1');

        if ($request->getMethod() == Request::METHOD_POST) {

            $game
                ->setName($request->get('name'))
                ->setImage($request->get('image'));

            $entityManager->persist($game);
            $entityManager->flush();


            return $this->redirectTo("/game");
        }
        return $this->render("game/form", ["game" => $game]);
    }


    public function show(int $id, EntityManagerInterface $entityManager): Response
    {
        $game = $entityManager->getRepository(Game::class)->find($id);

        return $this->render("game/show", ["game" => $game]);
    }


    public function edit(int $id, Request $request, EntityManagerInterface $entityManager): Response
    {
        $game = $entityManager->getRepository(Game::class)->find($id);
        $owner = $entityManager->getRepository(Player::class)->find(5);

        if ($request->getMethod() == Request::METHOD_POST) {
            $game
                ->setName($request->get('name'))
                ->setImage($request->get('image'))
                ->setOwned($owner);

            $entityManager->persist($game);
            $entityManager->flush();
            return $this->redirectTo("/game");
        }
        return $this->render("game/form", ["game" => $game]);


    }

    public function delete(int $id, EntityManagerInterface $entityManager): Response
    {
        $game = $entityManager->getRepository(Game::class)->find($id);
        $entityManager->remove($game);
        $entityManager->flush();
        return $this->redirectTo("/game");

    }

}
