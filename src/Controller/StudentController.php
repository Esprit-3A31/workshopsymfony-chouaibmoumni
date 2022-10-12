<?php

namespace App\Controller;
use App\Repository\StudentRepository;
use App\Entity\Student;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class StudentController extends AbstractController
{
    #[Route('/student', name: 'app_student')]
    public function index(): Response
    {
        return $this->render('student/index.html.twig', [
            'controller_name' => 'StudentController',
        ]);
    }
    #[Route('/students', name: 'app_students')]
    public function listClub(StudentRepository  $repository)
    {
        $students= $repository->findAll();
        return $this->render("student/students.html.twig",
            array('students'=>$students));
    }
}
