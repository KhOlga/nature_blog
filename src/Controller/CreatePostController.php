<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use App\Form\CreatePostFormType;

class CreatePostController extends AbstractController
{
    /**
     * @Route("/create/post", name="create_post")
     */
    public function new(EntityManagerInterface $em)
    {
        $form = $this->createForm(CreatePostFormType::class);
        return $this->render('create_post/index.html.twig', [
            'createPostForm' => $form->createView()
        ]);
    }

}
