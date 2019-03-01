<?php

namespace App\Controller;

use App\Entity\Article;

use Doctrine\ORM\EntityManagerInterface;

use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;




class ArticleController extends AbstractController
{
    /**
     * @Route("/", name="app_homepage")
     */
    public function homepage()
    {
        return $this->render('article\homepage.html.twig');
    }

    public function index()
    {
        // you can fetch the EntityManager via $this->getDoctrine()
        // or you can add an argument to your action: index(EntityManagerInterface $entityManager)
        $entityManager = $this->getDoctrine()->getManager();

        $article = new Article();
        $article->setTitle('Keyboard');
        $article->setSlug(1999);
        $article->setContent('Ergonomic and stylish!');

        // tell Doctrine you want to (eventually) save the Product (no queries yet)
        $entityManager->persist($article);

        // actually executes the queries (i.e. the INSERT query)
        $entityManager->flush();

        return new Response('Saved new product with id '.$article->getId());
    }

    /**
     * @Route("/news/{id}", name="article_show")
     */
    public function showArticle($id)
    {
        $id = rand(2, 8);
        $article = $this->getDoctrine()
            ->getRepository(Article::class)
            ->find($id);



        if (!$article) {
            throw $this->createNotFoundException(
                'No product found for id '.$id
            );
        }

        #return new Response('Check out this great product: '.$article->getTitle());
        return $this->render('article/show.html.twig', ['article' => $article]);


    }

    /**
     * @Route("/news/all", name="show_all_news")
     */
    public function showAllArticles($id)
    {
        $article = $this->getDoctrine()
            ->getRepository(Article::class)
            ->findAll($id);


        #return new Response('Check out this great product: '.$article->getTitle());
        return $this->render('article/show_all.html.twig', ['article' => $article]);


    }



}