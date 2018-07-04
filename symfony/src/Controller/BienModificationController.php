<?php

namespace App\Controller;

use App\Entity\BienModification;
use App\Form\BienModificationType;
use App\Repository\BienModificationRepository;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Workflow\Registry;

/**
 * @Route("/admin/biens")
 */
class BienModificationController extends Controller
{
    /**
     * @Route("/", name="bien_modification_index", methods="GET")
     */
    public function index(BienModificationRepository $bienModificationRepository): Response
    {
        return $this->render('bien_modification/index.html.twig', ['bien_modifications' => $bienModificationRepository->findAll()]);
    }

    /**
     * @Route("/{bien}/apply/{transition}", name="bien_modification_apply", methods="GET|POST")
     */
    public function apply(Registry $workflows, BienModification $bienModification, $transition): Response
    {
        $workflow = $workflows->get($bienModification);

        $workflow->apply($bienModification, $transition);
        $em = $this->getDoctrine()->getManager();
        $em->flush();

        return $this->redirectToRoute('bien_modification_index');
    }

    /**
     * @Route("/new", name="bien_modification_new", methods="GET|POST")
     */
    public function new(Request $request): Response
    {
        $bienModification = new BienModification();
        $form = $this->createForm(BienModificationType::class, $bienModification);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($bienModification);
            $em->flush();

            return $this->redirectToRoute('bien_modification_index');
        }

        return $this->render('bien_modification/new.html.twig', [
            'bien_modification' => $bienModification,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{bien}", name="bien_modification_show", methods="GET")
     */
    public function show(BienModification $bienModification): Response
    {
        return $this->render('bien_modification/show.html.twig', ['bien_modification' => $bienModification]);
    }

    /**
     * @Route("/{bien}/edit", name="bien_modification_edit", methods="GET|POST")
     */
    public function edit(Request $request, BienModification $bienModification): Response
    {
        $form = $this->createForm(BienModificationType::class, $bienModification);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('bien_modification_edit', ['bien' => $bienModification->getBien()]);
        }

        return $this->render('bien_modification/edit.html.twig', [
            'bien_modification' => $bienModification,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{bien}", name="bien_modification_delete", methods="DELETE")
     */
    public function delete(Request $request, BienModification $bienModification): Response
    {
        if ($this->isCsrfTokenValid('delete'.$bienModification->getBien(), $request->request->get('_token'))) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($bienModification);
            $em->flush();
        }

        return $this->redirectToRoute('bien_modification_index');
    }
}
