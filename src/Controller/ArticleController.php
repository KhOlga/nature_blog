<?php

namespace App\Controller;

use Michelf\MarkdownInterface;
use Psr\Log\LoggerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Cache\Adapter\AdapterInterface;


class ArticleController extends AbstractController
{
    /**
     * @Route("/", name="app_homepage")
     */
    public function homepage()
    {
        return $this->render('article\homepage.html.twig');
    }


    /**
     * @Route("/news/{slug}", name="article_show")
     */
    public function show($slug, MarkdownInterface $markdown, AdapterInterface $cache)
    {
        $comments = [
            'I ate a normal rock once. It did NOT taste like bacon!',
            'Woohoo! I\'m going on an all-asteroid diet!',
            'I like bacon too! Buy some from my site! bakinsomebacon.com',
        ];

        $articleContent = <<<EOF
**Vivamus accumsan**, quam a feugiat varius, elit arcu tincidunt magna,
non molestie risus dolor sit amet risus. Sed pulvinar, purus sit amet aliquam semper, massa velit egestas arcu, 
sollicitudin congue lectus ex eu metus. Quisque elit nisi, consectetur vel pharetra nec, semper sit amet elit. 
Sed quis mauris commodo, mollis est hendrerit, lacinia nulla. Aenean ante metus, varius vitae fermentum consequat,
auctor vitae diam. Pellentesque purus odio, tincidunt sit amet tempor sit amet, sagittis et tellus.
Aenean sed tincidunt ante, elementum semper dolor. Duis id luctus nisi, a rhoncus tortor. 
Nunc malesuada lacus ultricies, ultrices mauris volutpat, tincidunt purus. Suspendisse finibus magna id malesuada faucibus.
Vivamus accumsan, leo nec consectetur suscipit, odio orci rhoncus leo, a lobortis justo metus nec neque.
Sed non velit sed felis molestie lobortis quis in quam. **Morbi pulvinar** ollis urna, et commodo orci.
Proin a libero ut ex maximus suscipit vel in mi. Aenean facilisis enim non felis lobortis rutrum. Vestibulum efficitur diam felis,
vel commodo lorem varius ut. Nam et nunc sed mauris accumsan consectetur. Suspendisse molestie quis augue sed ullamcorper.
Ut elementum, nunc eget blandit egestas, ex orci pretium purus, at finibus nulla felis eget nunc. Proin nisi erat,
pellentesque ut blandit sit amet, tincidunt nec enim. Mauris bibendum, enim eget gravida pulvinar, nulla velit porttitor purus,
a commodo eros massa tempus felis. Sed lorem risus, maximus vel diam sit amet, ultricies porta metus.
Nulla tincidunt turpis sed sapien tincidunt imperdiet eu sed leo. Integer consectetur urna et erat luctus,
at varius nulla convallis. Duis venenatis ligula eget tortor rhoncus hendrerit. Pellentesque habitant morbi tristique
senectus et netus et malesuada fames ac turpis egestas.
EOF;

        $item = $cache->getItem('markdown_'.md5($articleContent));
        if (!$item->isHit()) {
            $item->set($markdown->transform($articleContent));
            $cache->save($item);
        }
        $articleContent = $item->get();





        return $this->render('article/show.html.twig', [
            'title' => ucwords(str_replace('-', ' ', $slug)),
            'comments' => $comments,
            'slug' => $slug,
            'articleContent' => $articleContent,
        ]);

    }

    /**
     * @Route("/news/{slug}/heart", name="article_toggle_heart", methods={"POST"})
     */
    public function toggleArticleHeart($slug, LoggerInterface $logger)
    {
        // TODO - actually heart/unheart the article!
        return new JsonResponse(['hearts' => rand(5, 100)]);
        #return $this->json(['hearts' => rand(5, 100)]);
        $logger->info('Article is being hearted!');
    }

}