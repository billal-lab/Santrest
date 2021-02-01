<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\SantRepository;
class SantsController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    
    public function index(SantRepository $SantRepository): Response
    {    
        $sants = $SantRepository->findAll();
        return $this->render('sants/index.html.twig',compact('sants'));
    }
}
