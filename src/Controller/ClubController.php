<?php

namespace App\Controller;
use App\Entity\Club;
use App\Repository\ClubRepository;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ClubController extends AbstractController
{
    #[Route('/club', name: 'app_club')]
    public function index(): Response
    {
        return $this->render('club/index.html.twig', [
            'controller_name' => 'ClubController',
        ]);
    }
    #[Route('/clubs', name: 'app_clubs')]
    public function listClub(ClubRepository  $repository)
    {
        $clubs= $repository->findAll();
        return $this->render("club/clubs.html.twig",
            array('clubs'=>$clubs));
    }

}
