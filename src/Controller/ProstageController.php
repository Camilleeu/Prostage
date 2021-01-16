<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use App\Entity\Formation;
use App\Entity\Entreprise;
use App\Entity\Stage;

class ProstageController extends AbstractController
{
    /**
     * @Route("/", name="accueil")
     */
    public function index()
    {
        $lesStages = $this->getDoctrine()->getRepository(Stage::class)->findAll();
        return $this->render("prostage/index.html.twig", [
          'stages' => $lesStages,
        ]);
    }

    /**
     * @Route("/formations", name="formations")
     */
    public function listeFormations()
    {
        $listeFormations = $this->getDoctrine()->getRepository(Formation::class)->findAll();
      return $this->render("prostage/formations.html.twig", [
        'listeFormations'=> $listeFormations,
      ]);
    }

    /**
     * @Route("/stage/{id}", name="stage")
     */
    public function stage(int $id)
    {
      $leStage = $this->getDoctrine()->getRepository(Stage::class)->find($id);
      return $this->render("prostage/stage.html.twig", [
        'stage' => $leStage,
      ]);
    }

    /**
     * @Route("/entreprises", name="entreprises")
     */
    public function listeEntreprises()
    {
      $listeEntreprises = $this->getDoctrine()->getRepository(Entreprise::class)->findAll();
      return $this->render("prostage/entreprises.html.twig", [
        'listeEntreprises'=> $listeEntreprises,
      ]);
    }
}
