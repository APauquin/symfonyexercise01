<?php
// src/Controller/ProgramController.php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/program', name: 'program_')]
class ProgramController extends AbstractController
{
    #[Route('/list/{page}', requirements: ['page'=>'\d+'], name: 'program_list')]    
    public function list(int $page = 1): Response
    {
        return $this->render('program/list.html.twig', ['page' => $page]);
    }

    #[Route('/{id}', requirements: ['id'=>'\d+'], methods: ['GET'],  name: 'program_id')]    
    public function show(int $id): Response
    {
        return $this->render('program/show.html.twig', ['id' => $id]);
    }
}
