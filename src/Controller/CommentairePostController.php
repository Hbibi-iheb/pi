<?php

namespace App\Controller;

use App\Entity\CommentairePost;
use App\Form\CommentairePostType;
use App\Repository\CommentairePostRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/commentaire/post')]
class CommentairePostController extends AbstractController
{
    #[Route('/', name: 'app_commentaire_post_index', methods: ['GET'])]
    public function index(CommentairePostRepository $commentairePostRepository): Response
    {
        return $this->render('commentaire_post/index.html.twig', [
            'commentaire_posts' => $commentairePostRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_commentaire_post_new', methods: ['GET', 'POST'])]
    public function new(Request $request, CommentairePostRepository $commentairePostRepository): Response
    {
        $commentairePost = new CommentairePost();
        $form = $this->createForm(CommentairePostType::class, $commentairePost);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $commentairePost->setCreatedAt(new \DateTime());
            $commentairePost->setUserId(1);
            $commentairePostRepository->save($commentairePost, true);

            return $this->redirectToRoute('app_commentaire_post_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('commentaire_post/new.html.twig', [
            'commentaire_post' => $commentairePost,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_commentaire_post_show', methods: ['GET'])]
    public function show(CommentairePost $commentairePost): Response
    {
        return $this->render('commentaire_post/show.html.twig', [
            'commentaire_post' => $commentairePost,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_commentaire_post_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, CommentairePost $commentairePost, CommentairePostRepository $commentairePostRepository): Response
    {
        $form = $this->createForm(CommentairePostType::class, $commentairePost);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $commentairePostRepository->save($commentairePost, true);

            return $this->redirectToRoute('app_commentaire_post_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('commentaire_post/edit.html.twig', [
            'commentaire_post' => $commentairePost,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_commentaire_post_delete', methods: ['POST'])]
    public function delete(Request $request, CommentairePost $commentairePost, CommentairePostRepository $commentairePostRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$commentairePost->getId(), $request->request->get('_token'))) {
            $commentairePostRepository->remove($commentairePost, true);
        }

        return $this->redirectToRoute('app_commentaire_post_index', [], Response::HTTP_SEE_OTHER);
    }
}
