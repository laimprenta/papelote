<?php

namespace ApiBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class AdminController extends Controller
{
    /*
     * Esto es un comentario de dos
    */
    public function adminMenuAction()
    {
        return $this->render('ApiBundle:Templates:menuAdmin.html.twig');
    }
}
