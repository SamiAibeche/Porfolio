<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Translation\TranslatorInterface;


class DefaultController extends AbstractController
{
    /**
     * @Route("/", name="default")
     */
    public function index(TranslatorInterface $translator)
    {

        $translated = $translator->trans('symfony.is.great');

        return $this->render('default/index.html.twig', [
            'controller_name' => 'DefaultController',
            'msg' => $translated
        ]);
    }

    /**
     * @Route("/admin")
     */
    public function admin()
    {
        return $this->render('admin/default/index.html.twig', [
            'controller_name' => 'AdminController',
        ]);
    }
}
