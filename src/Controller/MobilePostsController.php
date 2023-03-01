<?php

namespace App\Controller;

use App\Repository\CategoryForumRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

#[Route('/posts/mobile')]
class MobilePostsController extends AbstractController
{

    #[Route('/categories',)]
    public function index(CategoryForumRepository $rep, NormalizerInterface $normalizer): Response
    {
        $categories = $rep->findAll();
        $jsonData= $normalizer->normalize($categories, 'json', ['groups'=>'categories:read']);
        return new Response(json_encode($jsonData));
    }


}