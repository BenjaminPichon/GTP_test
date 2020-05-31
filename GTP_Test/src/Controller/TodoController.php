<?php

namespace App\Controller;

use App\Entity\Task;
use App\Entity\User;
use App\Form\TaskType;
use App\Form\UserType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class TodoController extends AbstractController
{
    /**
     * @Route("/index", name="index")
     */
    public function index(Request $request, EntityManagerInterface $entityManager)
    {
        $user = new User();

        $userRepository = $this->getDoctrine()
        ->getRepository(User::class)
        ->findAll();

        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){

            $user = $form->getData();
            $user->setCreatedAt(new \DateTime());
            $entityManager->persist($user);
            $entityManager->flush();

            return $this->redirectToRoute('index');
        }
        return $this->render('todo/index.html.twig', [
           'users' => $userRepository,
           'formUser' => $form->createView()

        ]);
    }

    /**
     * @Route("/tasks", name="tasks")
     */
    public function tasks (Request $request, EntityManagerInterface $entityManager)
    {
        $task = new Task();

        $taskRepository = $this->getDoctrine()
        ->getRepository(Task::class)
        ->findAll();

        $users = $this->getDoctrine()
        ->getRepository(User::class)
        ->findAll();

        $formTask = $this->createForm(TaskType::class, $task);
        $formTask->handleRequest($request);

        if ($formTask->isSubmitted() && $formTask->isValid()){

            $task = $formTask->getData();
            $user = $this->getDoctrine()
                    ->getRepository(User::class)
                    ->find($request->request->get('userId'));
            $task->setUserId($user);
            $entityManager->persist($task);
            $entityManager->flush();

            return $this->redirectToRoute('tasks');
        }

        return $this->render('todo/tasks.html.twig', [
           'tasks' => $taskRepository,
           'taskForm' => $formTask->createView(),
           'users' => $users
        ]);
    }

    /**
     * @Route("/interface1", name="interface1")
     */
    public function interface1() {
        $allTask = $this->getDoctrine()
        ->getRepository(Task::class)
        ->findAll();

        return $this->render('todo/interface1.html.twig', [
            'tasks' => $allTask,
        ]);
    }
    
    /**
     * @Route("/interface2", name="interface2")
     */
    public function interface2() {
        $allTask = $this->getDoctrine()
        ->getRepository(Task::class)
        ->findAll();

        return $this->render('todo/interface2.html.twig', [
            'tasks' => $allTask,
        ]);
    }


    /**
     * @Route("/todo/remove/{id}", name="removeTasks")
     */
    public function remove($id, EntityManagerInterface $entityManager){

        $task = $this->taskRepository = $this->getDoctrine()
                        ->getRepository(Task::class)->find($id);
        $entityManager->remove($task);
        $entityManager->flush();
        return $this->redirectToRoute('interface1');
    }


}
