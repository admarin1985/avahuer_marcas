<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Estructura;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * Estructura controller.
 *
 */
class EstructuraController extends Controller
{
    /**
     * Lists all estructura entities.
     *
     *
     * @Route("/", name="estructura_index")
     * @Method({"GET", "POST"})
     */
    public function indexAction(Request $request)
    {
        $form = $this->createForm('AppBundle\Form\BusquedaType');
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $filtros = $form->getData();
            $em = $this->getDoctrine()->getManager();
            $estructuras = $em->getRepository('AppBundle:Estructura')->buscar($filtros);
            return $this->render('estructura/index.html.twig', array(
                'estructuras' => $estructuras,
                'form' => $form->createView(),
            ));
        }
        else
        {
            $em = $this->getDoctrine()->getManager();

            $estructuras = $em->getRepository('AppBundle:Estructura')->findAll();

            return $this->render('estructura/index.html.twig', array(
                'estructuras' => $estructuras,
                'form' => $form->createView(),
            ));
        }
    }

    /**
     * Finds and displays a estructura entity.
     *
     * @Route("/estructura/{id}", name="estructura_show")
     * @Method("GET")
     */
    public function showAction(Estructura $estructura)
    {

        return $this->render('estructura/show.html.twig', array(
            'estructura' => $estructura,
        ));
    }
}
