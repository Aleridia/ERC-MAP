<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController; //Remplace le Response
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Translation\TranslatorInterface;

use App\Entity\Requetes;
use App\Entity\VerrouEntite;

class RequetesController extends AbstractController {

	/**
     * Page queries
     *
     * @Route("/requetes", name="requetes_list")
     */
	 public function index()
     {
         return $this->render('requetes/index.html.twig',[
            'controller_name' => 'RequetesController',
            'formulaire' => $this->creation_formulaire(),
            'breadcrumbs'   => [
                ['label' => 'nav.home', 'url' => $this->generateUrl('home')],
                ['label' => 'requetes.list']
            ]
         ]);
     }
      
    public function creation_formulaire(){
            $formulaire = "<div class=\"select_div\">
            <span class=\"span_box1\">
            <select id=\"select_box1\" name=\"select_box1\" class=\"select_box1\" onchange=\"secondeBox(this)\">
                <option value=\"\" selected=\"true\" disabled=\"disabled\">-- Please Select --</option>
                <option value=\"attestation\"> Attestation </option>
                <option value=\"agent\"> Agent </option
                <option value=\"biblio\"> Bibliographie </option>
                <option value=\"datation\"> Datation </option>
                <option value=\"element\"> Element </option>
                <option value=\"localisation\"> Localisation </option>
                <option value=\"source\"> Source </option>
            </select>
            </span>
            <span class=\"span_box2\">
            <select name=\"select_box2\" class=\"select_box2\" style=\"visibility:hidden\">
                <option value=\"\" selected=\"true\" disabled=\"disabled\">-- Please Select --</option>
            </select>
            </span>
            <button type=\"button\" class=\"btn btn-danger\" onclick=\"removeFiltre(this)\">Supprimer</button>
            </div>
            <br />";

            //Juste le début du formulaire (Les grandes catégories qui ne sont PAS dynamiques)
        return $formulaire;
     }
}



?>