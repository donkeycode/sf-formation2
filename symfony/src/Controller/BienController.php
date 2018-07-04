<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class BienController extends Controller
{
    /**
     * @Route("/ajouter-un-bien", name="add_bien")
     * @Security("has_role('ROLE_BIEN')")
     */
    public function add()
    {
        
    }
}
