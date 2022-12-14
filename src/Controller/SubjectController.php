<?php

namespace App\Controller;

use App\Entity\Subject;
use Symfony\Component\Routing\Route;
use App\Repository\SubjectRepository;
use Symfony\Bridge\Doctrine\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


#[Route('/subject')]
class SubjectController extends AbstractController
{
    #[IsGranted('ROLE_ADMIN')]
    #[Route('/index', name: 'subject_index')]
    public function SubjectIndex()
    {
        $subjects = $this -> getDoctrine() -> getRepository(Subject::class) -> findAll();
        return $this->render('subject/index.html.twig',
        [
            'subjects' => $subjects
        ]);
    }

    #[IsGranted('ROLE_ADMIN')]
    #[Route('/detail/{id}', name: 'subject_detail_admin')]
    public function SubjectDetailAdmin ($id, SubjectRepository $subjectRepository) {
    $subject = $subjectRepository->find($id);
    if ($subject== null) 
    {
        $this->addFlash('Warning', 'Invalid subject id !');
        return $this->redirectToRoute('subject_index');
    }
    return $this->render('subject/detail.html.twig',
        [
            'subject' => $subject
        ]);
    }

    #[IsGranted('ROLE_USER')]
    #[Route('/detail/{id}', name: 'subject_detail')]
    public function SubjectDetail ($id, SubjectRepository $subjectRepository) 
    {
        $subject = $subjectRepository->find($id);
        if ($subject == null)
        {
            $this->addFlash('Warning', 'Invalid subject id !');
            return $this->redirectToRoute('home');
        }
        return $this->render('subject/detail.html.twig',
        [
            'subject' => $subject
        ]);
    }

    #[IsGranted('ROLE_ADMIN')]
    #[Route('/delete/{id}', name: 'subject_delete')]
    public function SubjectDelete ($id, ManagerRegistry $managerRegistry) 
    {
        $subject = $managerRegistry->getRepository(Subject::class)->find($id);
        if ($subject == null) 
        {
            $this->addFlash('Warning', 'Subject not existed !');
        } 
        else 
        {
            $manager = $managerRegistry->getManager();
            $manager->remove($subject);
            $manager->flush();
            $this->addFlash('Info', 'Delete subject successfully !');
        }
        return $this->redirectToRoute('subject_index');
    }

    #[IsGranted('ROLE_ADMIN')]
    #[Route('/add', name: 'subject_add')]
    public function SubjectAdd (Request $request) 
    {
        $subject = new Subject;
        $form = $this->createForm(SubjectType::class, $subject);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) 
        {
            $manager = $this->getDoctrine()->getManager();
            $manager->persist($subject);
            $manager->flush();
            $this->addFlash('Info','Add subject successfully !');
            return $this->redirectToRoute('subject_index');
        }
        return $this->renderForm('subject/add.html.twig',
        [
            'subjectForm' => $form
        ]);
    }

    #[Route('/edit/{id}', name: 'subject_edit')]
    public function subjectEdit ($id, Request $request) 
    {
        $subject = $this->getDoctrine()->getRepository(Subject::class)->find($id);
        if ($subject == null) 
        {
            $this->addFlash('Warning', 'Subject not existed !');
            return $this->redirectToRoute('subject_index');
        } 
        else 
        {   
            $form = $this->createForm(SubjectType::class, $subject);
            $form->handleRequest($request);
            if ($form->isSubmitted() && $form->isValid()) 
            {
                $manager = $this->getDoctrine()->getManager();
                $manager->persist($subject);
                $manager->flush();
                $this->addFlash('Info','Add subject successfully !');
                return $this->redirectToRoute('subject_index');
            }
        }        
        return $this->renderForm('subject/edit.html.twig',
        [
            'subjectForm' => $form
        ]);
    }
}