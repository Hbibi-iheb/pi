<?php

namespace App\Controller;

use App\Entity\CategoryForum;
use App\Form\CategoryForumType;
use App\Repository\CategoryForumRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/category/forum')]
class CategoryForumController extends AbstractController
{
    #[Route('/', name: 'app_category_forum_index', methods: ['GET'])]
    public function index(CategoryForumRepository $categoryForumRepository): Response
    {
        return $this->render('category_forum/index.html.twig', [
            'category_forums' => $categoryForumRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_category_forum_new', methods: ['GET', 'POST'])]
    public function new(Request $request, CategoryForumRepository $categoryForumRepository): Response
    {
        $categoryForum = new CategoryForum();
        $form = $this->createForm(CategoryForumType::class, $categoryForum);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $categoryForumRepository->save($categoryForum, true);

            return $this->redirectToRoute('app_category_forum_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('category_forum/new.html.twig', [
            'category_forum' => $categoryForum,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_category_forum_show', methods: ['GET'])]
    public function show(CategoryForum $categoryForum): Response
    {
        return $this->render('category_forum/show.html.twig', [
            'category_forum' => $categoryForum,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_category_forum_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, CategoryForum $categoryForum, CategoryForumRepository $categoryForumRepository): Response
    {
        $form = $this->createForm(CategoryForumType::class, $categoryForum);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $categoryForumRepository->save($categoryForum, true);

            return $this->redirectToRoute('app_category_forum_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('category_forum/edit.html.twig', [
            'category_forum' => $categoryForum,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_category_forum_delete', methods: ['POST'])]
    public function delete(Request $request, CategoryForum $categoryForum, CategoryForumRepository $categoryForumRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$categoryForum->getId(), $request->request->get('_token'))) {
            $categoryForumRepository->remove($categoryForum, true);
        }

        return $this->redirectToRoute('app_category_forum_index', [], Response::HTTP_SEE_OTHER);
    }
}
