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

class PlayerController extends AbstractController
{


    public function index(Request $request, EntityManagerInterface $entityManager): Response
    {
        $players = $entityManager
            ->getRepository(Player::class)
            ->findAll();

        //d($players);

        //$players = FakeData::players(25);

        return $this->render("player/index.html.twig", ["players" => $players]);

    }

    public function add(Request $request, EntityManagerInterface $entityManager): Response
    {
        //$player = FakeData::players(1)[0];
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


    public function show(int $id, EntityManagerInterface $entityManager): Response
    {
        $player = $entityManager->getRepository(Player::class)
            ->find($id);

        return $this->render("player/show.html.twig", ["player" => $player, "availableGames" => FakeData::games()]);
    }


    public function edit($id, Request $request, EntityManagerInterface $entityManager): Response
    {
        $player = $entityManager->getRepository(Player::class)
            ->find($id);

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

    public function delete(int $id, EntityManagerInterface $entityManager): Response
    {
        $player = $entityManager->getRepository(Player::class)->find($id);

        $entityManager->remove($player);

        $entityManager->flush();

        return $this->redirectTo("/player");

    }

    public function addgame($id, Request $request): Response
    {
        if ($request->getMethod() == Request::METHOD_POST) {
            /**
             * @todo enregistrer l'objet
             */
            return $this->redirectTo("/player");
        }
    }

}
