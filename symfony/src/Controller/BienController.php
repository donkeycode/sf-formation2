<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use App\Entity\Bien;
use App\Entity\BienModification;
use Symfony\Component\HttpFoundation\Request;
use App\Form\BienType;
use App\Repository\BienRepository;
use App\Repository\BienModificationRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;

class BienController extends Controller
{
    /**
     * @Route("/biens", name="all_biens")
     * @Template
     */
    public function all(BienRepository $bienRepository, BienModificationRepository $bienModificationRepository)
    {
        return [
            'biens' => $bienRepository->findPublished(),
            'own_biens' => $bienModificationRepository->findByProprietaire($this->getUser()),
        ];
    }

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

            return $this->redirectToRoute('all_biens');
        }

        return [
            'form' => $form->createView(),
        ];
    }

    /**
     * @Route("/bien/{id}", name="edit_bien")
     * @ParamConverter("bienModification", class="App\Entity\BienModification")
     * @Security("is_granted('edit', bienModification)")
     * @Template
     */
    public function edit(Request $request, BienModification $bienModification)
    {
        $form = $this->createForm(BienType::class, $bienModification);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $bienModification->setState('in_review');

            $em = $this->getDoctrine()->getManager();
            $em->persist($bienModification);
            $em->flush();

            return $this->redirectToRoute('all_biens');
        }

        return [
            'form' => $form->createView(),
        ];
    }


}
