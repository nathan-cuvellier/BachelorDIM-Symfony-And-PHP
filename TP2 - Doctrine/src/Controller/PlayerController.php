<?php

namespace App\Controller;


use App\Entity\Player;
use App\FakeData;
use App\Repository\PlayerRepository;
use Doctrine\ORM\AbstractQuery;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Internal\Hydration\ArrayHydrator;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/player', name:'player_')]
class PlayerController extends AbstractController
{


    #[Route('', name:'index')]
    public function index(PlayerRepository $playerRepository): Response
    {
        return $this->render("player/index.html.twig", ["players" => $playerRepository->findAll()]);

    }

    #[Route('/add', name:'add')]
    public function add(Request $request, EntityManagerInterface $entityManager): Response
    {
        $player = new Player();

        if ($request->getMethod() == Request::METHOD_POST) {
            $player
                ->setEmail($request->get('email'))
                ->setUsername($request->get('username'));

            $entityManager->persist($player);
            $entityManager->flush();

            return $this->redirectTo("/player");
        }
        return $this->render("player/form.html.twig", ["player" => $player]);
    }


    #[Route('/show/{player}', name:'show')]
    public function show(Player $player): Response
    {
        return $this->render("player/show.html.twig", ["player" => $player]);
    }


    #[Route('/edit/{player}', name:'edit')]
    public function edit(Player $player, Request $request, EntityManagerInterface $entityManager): Response
    {
        if ($request->getMethod() == Request::METHOD_POST) {
            $player
                ->setUsername($request->get('username'))
                ->setEmail($request->get('email'));

            $entityManager->persist($player);
            $entityManager->flush();
            return $this->redirectTo("/player");
        }
        return $this->render("player/form.html.twig", ["player" => $player]);


    }

    #[Route('/delete/{player}', name:'delete')]
    public function delete(Player $player, EntityManagerInterface $entityManager): Response
    {
        $entityManager->remove($player);
        $entityManager->flush();

        return $this->redirectTo("/player");

    }

    #[Route('/addgame', name:'addgame')]
    public function addgame($id, Request $request): Response
    {
        if ($request->getMethod() == Request::METHOD_POST) {

            return $this->redirectTo("/player");
        }
    }

}
