<?php

namespace App\Controller;

use App\Entity\Recomendacion;
use App\Entity\Registro;
use App\Form\RecomendacionType;
use App\Repository\RecomendacionRepository;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/recomendacion")
 */
class RecomendacionController extends Controller
{
    /**
     * @Route("/", name="recomendacion_index", methods={"GET"})
     */
    public function index(RecomendacionRepository $recomendacionRepository): Response
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN');

        return $this->render('recomendacion/index.html.twig', [
            'recomendacions' => $recomendacionRepository->findAll(),
        ]);
    }

    /**
     * @Route("/{token}/new", name="recomendacion_new", methods={"GET","POST"})
     */
    public function new(Request $request, Registro $registro): Response
    {
        if($registro->getRecomendacion() == null) {

            $recomendacion = new Recomendacion();
            $form = $this->createForm(RecomendacionType::class, $recomendacion);
            $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()) {

                $recomendacion->setRegistro($registro);

                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->persist($recomendacion);
                $entityManager->flush();

                return $this->render('recomendacion/show.html.twig', [
                    'recomendacion' => $recomendacion,
                    'registro' => $registro,
                ]);
            }

            return $this->render('recomendacion/new.html.twig', [
                'recomendacion' => $recomendacion,
                'registro' => $registro,
                'form' => $form->createView(),
            ]);
        }

        $recomendacion = $registro->getRecomendacion();

        return $this->render('recomendacion/show.html.twig', [
            'recomendacion' => $recomendacion,
            'registro' => $registro,
        ]);
    }

    /**
     * @Route("/{id}", name="recomendacion_show", methods={"GET"})
     */
    public function show(Recomendacion $recomendacion): Response
    {

        // not used
         $this->denyAccessUnlessGranted('ROLE_ADMIN');

        return $this->render('recomendacion/show.html.twig', [
            'recomendacion' => $recomendacion,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="recomendacion_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Recomendacion $recomendacion): Response
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN');

        $form = $this->createForm(RecomendacionType::class, $recomendacion);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('recomendacion_index');
        }

        return $this->render('recomendacion/edit.html.twig', [
            'recomendacion' => $recomendacion,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="recomendacion_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Recomendacion $recomendacion): Response
    {
        if ($this->isCsrfTokenValid('delete'.$recomendacion->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($recomendacion);
            $entityManager->flush();
        }

        return $this->redirectToRoute('recomendacion_index');
    }
}
