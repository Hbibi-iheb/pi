<?php

namespace App\Controller;

use App\Entity\CommentairePost;
use App\Repository\CategoryForumRepository;
use App\Repository\CommentairePostRepository;
use App\Repository\PostForumRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

use Symfony\Component\Routing\Annotation\Route;

class FrontOfficeController extends AbstractController
{
    #[Route('/index', name: 'app_front_office')]
    public function index(CategoryForumRepository $rep): Response
    {
        return $this->render('front_office/index.html.twig', [
            'categories' => $rep->findAll(),
        ]);
    }
    #[Route('/details/{id}', name: 'app_front_details')]
    public function details($id,PostForumRepository $rep,CategoryForumRepository $repo): Response
    {
        return $this->render('front_office/details.html.twig', [
            'posts' => $rep->findBy(['categorie'=>$repo->find($id)]),
        ]);
    }
    #[Route('/post/details/{id}', name: 'front_post_details')]
    public function post_details($id,PostForumRepository $rep): Response
    {
        return $this->render('front_office/post_details.html.twig', [
            'post' => $rep->find($id),
        ]);
    }
    #[Route('/comment/{id}', name: 'post_comment', methods: ['GET'])]
    public function comment($id, Request $request,PostForumRepository $repository,CommentairePostRepository $rep,ManagerRegistry $doctrine){
        $comment = new CommentairePost();
        $comment->setContenu($request->get("comment"));
        $comment->setPost($repository->find($request->get("id")));
        $comment->setUserId(1);
        $comment->setCreatedAt(new \DateTime());
        $em = $doctrine->getManager();
        $em->persist($comment);
        $em->flush();
        return $this->redirectToRoute('front_post_details', [
            'id' => $id,
        ]);
    }
}
