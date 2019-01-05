<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class CreatePostController extends AbstractController
{
    /**
     * @Route("/create/post", name="create_post")
     */
    public function index()
    {
        return $this->render('create_post/index.html.twig', [
            'controller_name' => 'CreatePostController',
        ]);
    }
}
