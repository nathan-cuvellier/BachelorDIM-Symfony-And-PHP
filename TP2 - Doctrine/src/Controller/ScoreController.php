<?php

namespace App\Controller;


use App\Entity\Game;
use App\Entity\Player;
use App\Entity\Score;
use App\FakeData;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/score', name:'score_')]
class ScoreController extends AbstractController
{

    #[Route('', name:'index')]
    public function index(EntityManagerInterface $entityManager): Response
    {
        $scores = $entityManager
            ->getRepository(Score::class)
            ->findAll();

        $games = $entityManager
            ->getRepository(Game::class)
            ->findAll();

        $players = $entityManager
            ->getRepository(Player::class)
            ->findAll();

        return $this->render("score/index.html.twig", ["scores" => $scores,
            "games" => $games, "players" => $players]);
    }

    #[Route('/add', name:'add')]
    public function add(Request $request, EntityManagerInterface $entityManager): Response
    {
        if ($request->getMethod() == Request::METHOD_POST) {
            $game = $entityManager->getRepository(Game::class)->find($request->get('game'));
            $player = $entityManager->getRepository(Player::class)->find($request->get('player'));

            $score = (new Score())
                ->setCreatedAt(new \DateTime())
                ->setGame($game)
                ->setPlayer($player)
                ->setScore(10);

            $entityManager->persist($score);
            $entityManager->flush();

            return $this->redirectTo("/score");
        }
    }

    #[Route('/delete', name:'delete')]
    public function delete(int $id, EntityManagerInterface $entityManager) : Response
    {
        $score = $entityManager->getRepository(Score::class)->find($id);
        $entityManager->remove($score);
        $entityManager->flush();
        return $this->redirectTo("/score");
    }

}
