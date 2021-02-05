<?php

namespace App\Controller;

use App\Entity\Sant;
use App\Form\SantType;
use App\Repository\SantRepository;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\FormBuilderInterface;

use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\String\Slugger\SluggerInterface;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class SantsController extends AbstractController
{
    /**
     * @Route("/", name="app_home_index")
     * @Route("/sants", name="app_home_sants")
     */
    
    public function index(SantRepository $SantRepository): Response
    {    
        $sants = $SantRepository->findBy([],['createdAt'=>'DESC']);
        return $this->render('sants/index.html.twig',compact('sants'));
    }

     /**
     * @Route("/sants/{id<[0-9]+>}", name="app_sant_show")
     */
    
    public function show(Sant $sant): Response
    {    
        return $this->render('sants/show.html.twig',compact('sant'));
    }

     /**
     * @Route("/sants/create", name="app_sants_create", methods={"GET", "POST"})
     */
    
    public function create(Request $request, EntityManagerInterface $em, UserRepository $ur): Response
    {    
        $sant = new Sant;
        $form = $this->createForm(SantType::class, $sant);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid())
        {
            $sant = $form->getData();
            $sant->setUser($this->getUser());
            $em->persist($sant);
            $em->flush();
            $this->addFlash('success', 'sant created !');
            return $this->redirectToRoute('app_home_index');
        }
        return $this->render('sants/create.html.twig',[
            "form" => $form->createView()
        ]);
    }

    /**
    * @Route("/sants/{id<[0-9]+>}/edit", name="app_sant_edit", methods={"GET", "PUT"})
    */
    
    public function edit(Sant $sant, Request $request , EntityManagerInterface $em): Response
    { 
        $form = $this->createForm(SantType::class, $sant,[
            'method' => 'PUT'
        ]);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid())
        {   
            $sant = $form->getData();
            $em->flush();
            $this->addFlash('success', 'sant edited !');
            return $this->redirectToRoute('app_home_index');
        }
        return $this->render('sants/edit.html.twig',[
            "form" => $form->createView()
        ]);
    }

     /**
     * @Route("/sants/{id<[0-9]+>}/delete", name="app_sant_delete", methods={"DELETE"})
     */
    public function delete(Sant $sant, EntityManagerInterface $em): Response
    { 
        $em->remove($sant);
        $em->flush();
        $this->addFlash('success', 'sant removed !');
        return $this->redirectToRoute('app_home_index');
    }
}
