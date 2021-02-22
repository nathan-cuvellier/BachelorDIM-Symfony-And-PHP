<?php

namespace App\Controller;


use App\Entity\Game;
use App\Entity\Player;
use App\Repository\GameRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/game', name:'game_')]
class GameController extends AbstractController
{

    #[Route('', name:'index')]
    public function index(GameRepository $game): Response
    {
        return $this->render("game/index.html.twig", ["games" => $game->findAll()]);

    }

    #[Route('/add', name:'add')]
    public function add(Request $request, EntityManagerInterface $entityManager): Response
    {
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
        return $this->render("game/form.html.twig", ["game" => $game]);
    }


    #[Route('/show/{game}', name:'show')]
    public function show(Game $game, Request $test): Response
    {
        return $this->render("game/show.html.twig", ["game" => $game]);
    }


    #[Route('/edit/{game}', name:'edit')]
    public function edit(Game $game, Request $request, EntityManagerInterface $entityManager): Response
    {
        $owner = $entityManager->getRepository(Player::class)->findAll()[0];

        if ($request->getMethod() == Request::METHOD_POST) {
            $game
                ->setName($request->get('name'))
                ->setImage($request->get('image'))
                ->setOwned($owner);

            $entityManager->persist($game);
            $entityManager->flush();
            return $this->redirectTo("/game");
        }
        return $this->render("game/form.html.twig", ["game" => $game]);


    }

    #[Route('/delete/{game}', name:'delete')]
    public function delete(Game $game, EntityManagerInterface $entityManager): Response
    {
        $entityManager->remove($game);
        $entityManager->flush();
        return $this->redirectTo("/game");

    }

}
