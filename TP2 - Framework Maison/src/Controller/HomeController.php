<?php


namespace App\Controller;


use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class HomeController
{

    function index(Request $request): Response
    {
        return new Response("it works");
    }

}
