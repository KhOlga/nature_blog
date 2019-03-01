<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;


class ProfilePageController extends AbstractController
{
    /**
     * @Route("/profile/page", name="profile_page")
     */
    public function index()
    {

        return $this->render('profile_page/profile.html.twig', [
            'controller_name' => 'ProfilePageController',
            'number' => $number = random_int(0, 100),
        ]);
    }




}
