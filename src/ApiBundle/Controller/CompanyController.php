<?php

namespace App\ApiBundle\Controller;

use App\AdminBundle\Entity\Company;
use App\AdminBundle\Form\CompanyType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/company")
 */
class CompanyController extends AbstractController
{
    /**
     * Récupération des entreprises actives de type client
     * @Route("/getactivecompanies", name="api_company_getactiveclient", methods={"GET"})
     */
    public function getActifClient()
    {
        $companies = $this->getDoctrine()
            ->getRepository("AdminBundle:Company")
            ->findBy(array("status" => "Client"));


        $data = array("nombre" => count($companies));
        $response = new Response(json_encode($data), 200);
        $response->headers->set('Content-Type', 'application/json');
        return $response;
    }

    /**
     * Récuperation des nouvelles entreprises depuis une période
     * @Route("/getNewCompaniesSince/{since}", name="api_company_getnewcompaniessince", methods={"GET"})
     */
    public function getNewCompaniesSince($since)
    {
        $period = "";
        switch ($since) {
            case "day":
                $period = "-1 days";
                break;
            case "week":
                $period = "-1 week";
                break;
            case "month":
                $period = "-1 month";
                break;
            case "year":
                $period = "-1 year";
                break;
        }
        $query = $this->getDoctrine()->getRepository("AdminBundle:Company")->getNumberNewCompanies($period);
        $result = $query->execute();
        $data = array();
        if (count($result) > 0) {

            foreach ($result as $res) {
                $res_data = array(
                    "date" => $res["createdAt"],
                    "nombre" => $res["nb"],

                );
                array_push($data, $res_data);
            }
            $dataJson = [
                "data" => $data,
                "retour" => "1"
            ];
            $response = new Response(json_encode($dataJson), 200);
            $response->headers->set('Content-Type', 'application/json');
        } else {
            $dataJson = [
                "message" => "Aucune données pour cette plage horaires",
                "retour" => "-1"
            ];
            $response = new Response(json_encode($dataJson), 200);
            $response->headers->set('Content-Type', 'application/json');
        }
        return $response;
    }

    /**
     * Récupération du pourcentage de nouvelles entreprises depuis la dernière periode
     * @Route("/getPourcentSinceLastPeriod/{since}", name="api_company_getpourcentsincelastperiod", methods={"GET"})
     */
    public function getPourcentNewCompanySinceLastPeriod($since)
    {
        $period = "";
        $periodBefore = "";
        switch ($since) {
            case "day":
                $period = "-1 days";
                $periodBefore = "-2 days";
                break;
            case "week":
                $period = "-1 week";
                $periodBefore = "-2 week";
                break;
            case "month":
                $period = "-1 month";
                $periodBefore = "-2 month";
                break;
            case "year":
                $period = "-1 year";
                $periodBefore = "-2 year";
                break;
        }


        $actualNumber = (int)$this->getDoctrine()
            ->getRepository("AdminBundle:Company")
            ->getNumberNewCompaniesSince($period);

        $beforeNumber = (int)$this->getDoctrine()
            ->getRepository("AdminBundle:Company")
            ->getNumberCompaniesBetween($periodBefore, $period);
            
        $pourcentage = number_format(($actualNumber - $beforeNumber) / $beforeNumber * 100, 0, ".", " ");

        $data = array(
            "pourcentage" => $pourcentage
        );

        $dataJson = array(
            "data" => $data,
            "retour" => 1
        );

        $response = new Response(json_encode($dataJson), 200);
        $response->headers->set('Content-Type', 'application/json');
        return $response;
    }

    /**
     * Récupération du nombre de nouvelles entreprises depuis une période
     * @Route("/getNumberNewCompaniesSince/{since}", name="api_company_getNumberNewCompaniesSince", methods={"GET"})
     */
    public function getNumberNewCompaniesSince($since)
    {
        $period = "";
        switch ($since) {
            case "day":
                $period = "-1 days";
                break;
            case "week":
                $period = "-1 week";
                break;
            case "month":
                $period = "-1 month";
                break;
            case "year":
                $period = "-1 year";
                break;
        }
        $numberCompanies = $this->getDoctrine()
            ->getRepository("AdminBundle:Company")
            ->getNumberNewCompaniesSince($period);

        $data = array(
            "nombre" => $numberCompanies
        );

        $dataJson = array(
            "data" => $data,
            "retour" => 1
        );

        $response = new Response(json_encode($dataJson), 200);
        $response->headers->set('Content-Type', 'application/json');
        return $response;
    }
}
