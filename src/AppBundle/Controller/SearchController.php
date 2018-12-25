<?php
/**
 * Created by PhpStorm.
 * User: QRG
 * Date: 2018/12/21
 * Time: 21:22
 */

namespace AppBundle\Controller;




use AppBundle\Entity\ChMedicine;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Cache;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;


/**
 * @Route("/")
 *
 * @author Han Qiriga <QirigaHAN@jxutcm.edu.cn>
 */
class SearchController extends Controller
{
    /**
     * @Route("/searchlist", name="searchlist")
     *
     */
    public function searchchmedicinebuttonAction(Request $request)
    {
        if ('POST' != $request->getMethod()) {
            return $this->render('/chmedicines/homepage.html.twig');
        }
        if (!is_null($_POST['q'])) {
            $query = $_POST['q'];//$request->('q', '');
            $searchType = $_POST['t'];//$request->query->get('t', '');
            $chmedicines = $this->getDoctrine()->getRepository(ChMedicine::class)->findBySearchQuery($query, $searchType);
            //var_dump($query,$searchType,$chmedicines);
            return $this->render('/search/searchlist.html.twig', array('chmedicines' => $chmedicines, 'keyword' => $query));
        }
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
            return $this->render('/search/homepage.html.twig');
        }
        $query = $request->query->get('q', '');
        $searchType = $request->query->get('t', '');

        $chmedicines = $this->getDoctrine()->getRepository(ChMedicine::class)->findBySearchQuery($query,$searchType);

        $results = [];
        foreach ($chmedicines as $chmedicine) {
            $results[] = [
                'title' => htmlspecialchars($chmedicine->getBreed()),
                'summary' => htmlspecialchars('生产企业：' . $chmedicine->getMeEnterprise()->getName()),
                //'id' => htmlspecialchars('生产企业：'.$chmedicine->getMeEnterprise()->getId()),
                'url' => $this->generateUrl('chmedicine_detail', ['id' => $chmedicine->getId()]),
            ];
        }

        return $this->json($results);
    }
}