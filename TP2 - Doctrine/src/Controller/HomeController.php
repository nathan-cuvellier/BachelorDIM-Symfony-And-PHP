<?php

namespace App\Controller;

use App\Entity\Game;
use App\Entity\Score;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;

class HomeController extends AbstractController
{

    public function index(EntityManagerInterface $entityManager): Response
    {
        $startDate = date("d/m", strtotime("-6 days", time()));
        $now = date('d/m');

        return $this->render("home/index.html.twig", [
            "popularGamesOfWeek" => $entityManager->getRepository(Score::class)->getPopularGamesOfWeek(),
            "startDate" => $startDate,
            "now" => $now,
        ]);
    }
}
