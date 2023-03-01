<?php

namespace App\Controller;

use App\Entity\PostForum;
use App\Form\PostForumType;
use App\Repository\PostForumRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/post/forum')]
class PostForumController extends AbstractController
{
    #[Route('/', name: 'app_post_forum_index', methods: ['GET'])]
    public function index(PostForumRepository $postForumRepository): Response
    {
        return $this->render('post_forum/index.html.twig', [
            'post_forums' => $postForumRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_post_forum_new', methods: ['GET', 'POST'])]
    public function new(Request $request, PostForumRepository $postForumRepository): Response
    {
        $postForum = new PostForum();
        $form = $this->createForm(PostForumType::class, $postForum);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $postForum->setCreatedAt(new \DateTime());
            $postForum->setUserId(1);
            $postForumRepository->save($postForum, true);

            return $this->redirectToRoute('app_post_forum_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('post_forum/new.html.twig', [
            'post_forum' => $postForum,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_post_forum_show', methods: ['GET'])]
    public function show(PostForum $postForum): Response
    {
        return $this->render('post_forum/show.html.twig', [
            'post_forum' => $postForum,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_post_forum_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, PostForum $postForum, PostForumRepository $postForumRepository): Response
    {
        $form = $this->createForm(PostForumType::class, $postForum);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $postForumRepository->save($postForum, true);

            return $this->redirectToRoute('app_post_forum_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('post_forum/edit.html.twig', [
            'post_forum' => $postForum,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_post_forum_delete', methods: ['POST'])]
    public function delete(Request $request, PostForum $postForum, PostForumRepository $postForumRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$postForum->getId(), $request->request->get('_token'))) {
            $postForumRepository->remove($postForum, true);
        }

        return $this->redirectToRoute('app_post_forum_index', [], Response::HTTP_SEE_OTHER);
    }
}
