<?php

namespace App\Controller;

use App\Entity\Registro;
use App\Form\RegistroType;
use App\Form\TareaType;
use App\Repository\RegistroRepository;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


/**
 * @Route("/registro")
 */
class RegistroController extends Controller
{
    /**
     * @Route("/", name="registro_index", methods={"GET"})
     */
    public function index(RegistroRepository $registroRepository, Request $request): Response
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN');

//        $this->addFlash('success','Your changes were saved!');

        return $this->render('registro/index.html.twig', [
            'registros' => $registroRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="registro_new", methods={"GET","POST"})
     */
    public function new(Request $request, \Swift_Mailer $mailer): Response
    {

        $registro = new Registro();
        $form = $this->createForm(RegistroType::class, $registro);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $registro->setToken(rtrim(strtr(base64_encode(random_bytes(32)), '+/', '-_'), '='));
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($registro);
            $entityManager->flush();

            // Correos electrónicos
            $message = (new \Swift_Message('Confirmación Registro'))
                ->setFrom('eyh@matmor.unam.mx')
                ->setTo($registro->getCorreo())
                ->setBcc('eyh@matmor.unam.mx')
                ->setBody(
                    $this->renderView(
                    // templates/emails/registration.html.twig
                        'emails/registro.txt.twig',
                        ['registro' => $registro]
                    ),
                    'text/plain'
                )
            ;
            $mailer->send($message);

            // Correos electrónicos
            $recomendacion = (new \Swift_Message('Solicitud Recomendacion'))
                ->setFrom('eyh@matmor.unam.mx')
                ->setTo($registro->getCorreoProfesor())
                ->setBcc('eyh@matmor.unam.mx')
                ->setBody(
                    $this->renderView(
                        'emails/recomendacion.txt.twig',
                        ['registro' => $registro]
                    ),
                    'text/plain'
                )
            ;

            $mailer->send($recomendacion);

            $this->addFlash(
                'success',
                'Te registraste con éxito!'
            );

            $this->addFlash('success','Se registraron con éxito tus datos!');

            return $this->redirectToRoute('registro_confirmacion', ['slug' => $registro->getSlug()]);
        }

        return $this->render('registro/new.html.twig', [
            'registro' => $registro,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{slug}", name="registro_show", methods={"GET"})
     */
    public function show(Registro $registro): Response
    {

        $this->denyAccessUnlessGranted('ROLE_ADMIN');

        return $this->render('registro/show.html.twig', [
            'registro' => $registro,
        ]);
    }

    /**
     * @Route("/confirmacion/{slug}", name="registro_confirmacion", methods={"GET"})
     */
    public function confirmacion(Registro $registro): Response
    {
        return $this->render('registro/confirmacion.html.twig', [
            'registro' => $registro,
        ]);
    }

    /**
     * @Route("/tarea/{token}", name="registro_tarea", methods={"GET","POST"})
     */
    public function tareaNew(Request $request, Registro $registro): Response
    {
        // Si confirmación is not null
        if($registro->getTareaName() == null) {

            $form = $this->createForm(TareaType::class, $registro);
            $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()) {

                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->flush();

                $this->addFlash('success','Se recibió con éxito la tarea!');

                return $this->render('registro/tareaShow.html.twig', [
                    'registro' => $registro,
                ]);
            }

            return $this->render('registro/tareaNew.html.twig', [
                'registro' => $registro,
                'form' => $form->createView(),
            ]);
        }

        return $this->render('registro/tareaShow.html.twig', [
            'registro' => $registro,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="registro_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Registro $registro): Response
    {
        $form = $this->createForm(RegistroType::class, $registro);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('registro_index');
        }

        return $this->render('registro/edit.html.twig', [
            'registro' => $registro,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="registro_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Registro $registro): Response
    {
        if ($this->isCsrfTokenValid('delete'.$registro->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($registro);
            $entityManager->flush();
        }

        return $this->redirectToRoute('registro_index');
    }
}
