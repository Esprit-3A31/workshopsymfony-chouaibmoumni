<?php

namespace App\Controller;
use App\Entity\Classroom;
use App\Repository\ClassroomRepository;
use App\Form\ClassroomType;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ClassRoomController extends AbstractController
{
    #[Route('/class/room', name: 'app_class_room')]
    public function index(): Response
    {
        return $this->render('class_room/index.html.twig', [
            'controller_name' => 'ClassRoomController',
        ]);
    }
    #[Route('/classrooms', name: 'app_classroom')]
    public function listClassroom(ClassroomRepository  $repository)
    {
        $classrooms= $repository->findAll();
        return $this->render("class_room/classrooms.html.twig",
            array('classrooms'=>$classrooms));
    }
    #[Route('/addClassroom', name: 'addClassroom')]
    public function addaddClassroom(Request  $request,ManagerRegistry $doctrine)
    {
        $classroom= new  Classroom();
        $form= $this->createForm(ClassroomType::class,$classroom);
        $form->handleRequest($request) ;
        if($form->isSubmitted()){
             $em= $doctrine->getManager();
             $em->persist($classroom);
             $em->flush();
             return  $this->redirectToRoute("addClassroom");
         }
        return $this->renderForm("class_room/add.html.twig",array("FormClassroom"=>$form));
    }
    #[Route('/updateclassroom/{id}', name: 'update_classroom')]
    public function updateClassroom($id,ClassroomRepository  $repository,Request  $request,ManagerRegistry $doctrine)
    {
        $classroom= $repository->find($id);
        $form= $this->createForm(ClassroomType::class,$classroom);
        $form->handleRequest($request) ;
        if($form->isSubmitted()){
            $em= $doctrine->getManager();
            $em->flush();
            return  $this->redirectToRoute("addClassroom");
        }
        return $this->renderForm("class_room/update.html.twig",array("FormClassroom"=>$form));
    }
    #[Route('/removeclassroom/{id}', name: 'remove_classroom')]
    public function remove(ManagerRegistry $doctrine,$id,ClassroomRepository $repository)
    {
        $classroom= $repository->find($id);
        $em= $doctrine->getManager();
        $em->remove($classroom);
        $em->flush();
        return $this->redirectToRoute("addClassroom");
    }
}
