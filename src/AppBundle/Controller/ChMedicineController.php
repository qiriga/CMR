<?php
/**
 * Created by PhpStorm.
 * User: QRG
 * Date: 2018/7/10
 * Time: 20:25
 */

namespace AppBundle\Controller;

use AppBundle\Entity\MeEnterprise;
use AppBundle\Entity\ChMedicine;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

/**
 * @Route("/admin/chmedicine")
 * @Security("has_role('ROLE_ADMIN')")
 *
 * @author Han Qiriga <qiriga@gmail.com>
 */
class ChMedicineController extends Controller
{
    /**
     * @Route("/allshow",name="chmedicine_list")
     */
    function showListAction()
    {
        $em = $this->getDoctrine()->getManager();
        $meenterpris = $em->getRepository(MeEnterprise::class)->findAll();
        ///$chmedicines = $em->getRepository(ChMedicine::class)->findBy(array('meentreprise' => 'ASC'));
        //dump($meentrepris);

        //return new Response('Jarrvie.');
        return $this->render('/chmedicines/entermedicinelist.html.twig', array('meenterpris' => $meenterpris));
    }

    /**
     * @Route("/chmedicinedetail/{id}",name="chmedicine_detail")
     * @param $id
     * @return Response
     */
    function showDetailAction($id)
    {
        //return new Response($id);
        $em = $this->getDoctrine()->getManager();
        $chmedicine = $em->getRepository(ChMedicine::class)->findOneBy(array('id'=>$id));

        return $this->render('/chmedicines/chimedicinedetail.html.twig', array('chmedicine' => $chmedicine));
    }


    /**
     * @Route("/chmedicinesearch", name="chmedicine_search")
     * @Method("GET")
     *
     * @return Response|JsonResponse
     */
    public function searchchmedicineAction(Request $request)
    {
        if (!$request->isXmlHttpRequest()) {
                return $this->render('/chmedicines/search.html.twig');
            }

        $query = $request->query->get('q', '');
        //return $this->render('/chmedicines/abc.html.twig',array('abc'=>$query));
       // return new Response('<script>console.log('.$query.')</scri
        //pt>');

        //find('c1bbb8e7-79e1-11e8-8a01-00ffe398c4c3');
        $chmedicines = $this->getDoctrine()->getRepository(ChMedicine::class)->findBySearchQuery($query);

        //echo sizeof($chmedicines);
        /*$results = [];
        $results[] = ['title'=>htmlspecialchars(sizeof($chmedicines)),];
        return $this->json($results);*/
        $results = [];
        foreach ($chmedicines as $chmedicine) {
            $results[] = [
                'title' => htmlspecialchars($chmedicine->getBreed()),
                'summary' => htmlspecialchars($chmedicine->getMeEnterprise()->getName()),
               // 'url' => $this->generateUrl('chmedicine_detail', ['slug' => $chmedicine->getId()]),
            ];
        }

        return $this->json($results);
    }
}