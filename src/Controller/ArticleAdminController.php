<?php

namespace App\Controller;



use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Form\ArticleFormType;
use App\Entity\Article;
use App\Repository\ArticleRepository;



class ArticleAdminController extends AbstractController
{
    /**
     * @Route("/admin/article/new")
     */
    public function new(EntityManagerInterface $em, Request $request)
    {
        $form = $this->createForm(ArticleFormType::class);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            /** @var Article $article */
            $article = $form->getData();

            $article->setPublishedAt(new \DateTime(sprintf('-%d days', rand(0, 200))));
            $em->persist($article);
            $em->flush();

            $this->addFlash('success', 'Article Created! WOW!!!');
            return $this->redirectToRoute('admin_article_list');
        }

        return $this->render('admin_article/new.html.twig', [
            'articleForm' => $form->createView()
        ]);
    }

    /**
     * @Route("/admin/article/{id}/edit")
     */
    public function edit(Article $article)
    {
        dd($article);
    }

    /**
     * @Route("/admin/article", name="admin_article_list")
     */
    public function list(ArticleRepository $articleRepo)
    {
        $articles = $articleRepo->findAll();
        return $this->render('admin_article/list.html.twig', [
            'articles' => $articles,
        ]);
    }



}