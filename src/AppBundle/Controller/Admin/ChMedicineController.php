<?php
/**
 * Created by PhpStorm.
 * User: QRG
 * Date: 2018/7/10
 * Time: 20:25
 */

namespace AppBundle\Controller\Admin;


use AppBundle\Entity\ChMedicine;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Cache;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

/**
 * @Route("/admin/chmedicine")
 * @Security("has_role('ROLE_ADMIN')")
 *
 * @author Han Qiriga <QirigaHAN@jxutcm.edu.cn>
 */
class ChMedicineController extends Controller
{
    /**
     * @Route("/dashboard",name="dashboard")
     */
    function dashboardAction()
    {
        return $this->render('/admin/dashboard.twig');
    }


    /**
     * @Route("/",defaults={"page":"1", "_format"="html"},name="chmedicine_index")
     * @Route("/page/{page}", defaults={"_format"="html"}, requirements={"page": "[1-9]\d*"}, name="chmedicine_index_paginated")
     * @Cache(smaxage="10")
     */
    function showListAction($page, $_format)
    {
        $em = $this->getDoctrine()->getManager();
        $chMedicines = $em->getRepository(ChMedicine::class)-> findLatest($page);//findAll();
        ///$chmedicines = $em->getRepository(ChMedicine::class)->findBy(array('meentreprise' => 'ASC'));
        //return new Response('Jarrvie.');
        //dump($meenterpris);
        return $this->render('/chmedicines/entermedicinelist.'.$_format.'.twig', array('chmedicines' => $chMedicines,'page'=>$page));
    }

    /**
     * @Route("/chmedicinedetail/{id}",name="chmedicine_detail")
     * @param $id
     * @return Response
     */
    function showDetailAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $chmedicine = $em->getRepository(ChMedicine::class)->findOneBy(array('id'=>$id));

        return $this->render('/chmedicines/chmedicinedetail.html.twig', array('chmedicine' => $chmedicine));
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
       // return new Response('<script>console.log('.$query.')</script>');

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
                'summary' => htmlspecialchars('生产商：'.$chmedicine->getMeEnterprise()->getName()),
                'url' => $this->generateUrl('chmedicine_detail', ['id' => $chmedicine->getId()]),
            ];
        }

        return $this->json($results);
    }
}