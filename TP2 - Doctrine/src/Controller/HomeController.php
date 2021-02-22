<?php

namespace App\Controller;

use App\Repository\ScoreRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{

    #[Route('/', name:'home')]
    public function index(ScoreRepository $scoreRepository): Response
    {
        $startDate = date("d/m", strtotime("-6 days", time()));
        $now = date('d/m');

        return $this->render("home/index.html.twig", [
            "popularGamesOfWeek" => $scoreRepository->getPopularGamesOfWeek(),
            "startDate" => $startDate,
            "now" => $now,
        ]);
    }
}
