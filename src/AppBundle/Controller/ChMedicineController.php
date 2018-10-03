<?php
/**
 * Created by PhpStorm.
 * User: QRG
 * Date: 2018/7/10
 * Time: 20:25
 */

namespace AppBundle\Controller;

use AppBundle\Entity\MEENTREPRISE;
use AppBundle\Entity\CHMEDICINE;
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
        $meentrepris = $em->getRepository(MEENTREPRISE::class)->findAll();
        ///$chmedicines = $em->getRepository(CHMEDICINE::class)->findBy(array('meentreprise' => 'ASC'));
        //dump($meentrepris);

        //return new Response('Jarrvie.');
        return $this->render('/chmedicines/entremedicinelist.html.twig', array('meentrepris' => $meentrepris));
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
        $chmedicine = $em->getRepository(CHMEDICINE::class)->findOneBy(array('id'=>$id));

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
       // return new Response('<script>console.log('.$query.')</script>');


        $chmedicines = $this->getDoctrine()->getRepository(CHMEDICINE::class)->findAll();//findBySearchQuery($query);

        //echo sizeof($chmedicines);
        /*$results = [];
        $results[] = ['title'=>htmlspecialchars(sizeof($chmedicines)),];
        return $this->json($results);*/
        $results = [];
        foreach ($chmedicines as $chmedicine) {
            $results[] = [
                'title' => htmlspecialchars($chmedicine->getBreed()),
                'summary' => htmlspecialchars($chmedicine->getMeentreprise()->getName()),
               // 'url' => $this->generateUrl('chmedicine_detail', ['slug' => $chmedicine->getId()]),
            ];
        }

        return $this->json($results);
    }
}