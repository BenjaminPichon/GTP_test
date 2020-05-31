<?php

namespace App\Controller;

use App\Entity\Employee;
use App\Entity\Task;
use App\Form\EmployeeType;
use App\Form\TaskType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class InterfaceController extends AbstractController
{
    /**
     * @Route("/", name="interfaceAdd")
     */
    public function index(Request $request, EntityManagerInterface $entityManager)
    {
        $employee = new Employee;

        

        $formEmployee = $this->createForm(EmployeeType::class, $employee);
        $formEmployee->handleRequest($request);

        if ($formEmployee->isSubmitted() && $formEmployee->isValid()){
            $employee = $formEmployee->getData();
            $entityManager->persist($employee);
            $entityManager->flush();

            return $this->redirectToRoute('interfaceAdd');
        }
        
        $employeeRepository = $this->getDoctrine()
        ->getRepository(Employee::class)
        ->findAll();
        
        $task = new Task;

        $formTask = $this->createForm(TaskType::class, $task);
        $formTask->handleRequest($request);

        if ($formTask->isSubmitted() && $formTask->isValid()){
            $task = $formEmployee->getData();
            

            $entityManager->persist($task);
            $entityManager->flush();

            return $this->redirectToRoute('interfaceAdd');
        }
        
        

        return $this->render('interface/index.html.twig', [
            'employees' => $employeeRepository,
            'formEmployee' => $formEmployee->createView(),
            'formTask' => $formTask->createView()
        ]);
    }
}
