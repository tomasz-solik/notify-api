<?php

namespace App\Controller\App;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AppController extends AbstractController
{
    /**
     * @Route("/", defaults={"any"=null}, requirements={"any"=".*"}, name="app_index")
     */
    public function index()
    {
        return new Response(
            file_get_contents($this->getParameter('kernel.project_dir').'/public/index.html')
        );
    }
}
