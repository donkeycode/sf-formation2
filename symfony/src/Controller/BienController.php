<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use App\Entity\Bien;
use Symfony\Component\HttpFoundation\Request;
use App\Form\BienType;

class BienController extends Controller
{
    /**
     * @Route("/ajouter-un-bien", name="add_bien")
     * @Security("has_role('ROLE_USER')")
     * @Template
     */
    public function add(Request $request)
    {
        $bien = new Bien();
        $bien->setProprietaire($this->getUser());

        $form = $this->createForm(BienType::class, $bien);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($bien);
            $em->flush();
        }

        return [
            'form' => $form->createView(),
        ];
    }
}
