<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController; //Remplace le Response
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Translation\TranslatorInterface;

use App\Entity\Requetes;
use App\Entity\VerrouEntite;
use App\Entity\Chercheur;

class RequetesController extends AbstractController {

	/**
     * Page queries
     *
     * @Route("/requetes", name="requetes_list")
     */
	 public function index()
     {
        $user = (string)$this->get('security.token_storage')->getToken()->getUser();
        $idChercheur = $this->getDoctrine()->getRepository(Chercheur::class)->findOneBy(['prenomNom' => $user]);

       /* $reqTest = new Requetes();
        $reqTest ->setReqLib("Lib");
        $reqTest -> setReqCorps("Corps");
        $reqTest -> setIdChercheur($idChercheur); //Il faut lui mettre un objet chercheur que tu récupères avec une requete simple

        $em = $this->getDoctrine()->getManager();
        $em -> persist($reqTest);
        $em->flush();*/

        $idChercheur = $idChercheur->getId();
        return $this->render('requetes/index.html.twig',[
            'controller_name' => 'RequetesController',
            'formulaire' => $this->creation_formulaire(),
            'idChercheur' => $idChercheur,
            'user' => $user,
            'breadcrumbs'   => [
                ['label' => 'nav.home', 'url' => $this->generateUrl('home')],
                ['label' => 'requetes.list']
            ]
         ]);
     }
    
    //N'est pas utilisé, mais je le laisse quand même, si jamais j'ai une meilleure solution avec ça au moins j'aurai pas à le réécrire
    public function creation_formulaire(){
            $formulaire = "
            <div class=\"select_div\">
                <span class=\"span_box1\">
                    <select name=\"select_box1\" class=\"select_box1\" onchange=\"secondeBox(this)\">
                        <option value=\"\" selected=\"true\" disabled=\"disabled\"> {{ 'requetes.selection_vide' | trans }} </option>
                        <option value=\"attestation\"> {{ 'attestation.name' | trans }} </option>
                        <option value=\"agent\"> {{ 'agent.name' | trans }} </option>
                        <option value=\"datation\"> {{ 'source.sections.datation' | trans }} </option>
                        <option value=\"element\"> {{ 'element.name' | trans }} </option>
                        <option value=\"localisation\"> {{ 'source.sections.localisation' | trans }} </option>
                        <option value=\"source\"> {{ 'source.name' | trans }} </option>
                    </select>
                </span>
                <span class=\"span_box2\">
                    <select name=\"select_box2\" class=\"select_box2\" style=\"visibility:hidden\" onchange=\"troisiemeBox(this)\">
                        <option value=\"\" selected=\"true\" disabled=\"disabled\"> {{ 'requetes.selection_vide' | trans }} </option>
                    </select>
                </span>
                <span class=\"span_box3\">
                    <select name=\"select_box3\" class=\"select_box3\" style=\"visibility:hidden\" onchange=\"quatriemeBox(this)\">
                        <option value=\"\" selected=\"true\" disabled=\"disabled\"> {{ 'requetes.selection_vide' | trans }} </option>
                    </select>
                </span>
                <span class=\"span_box4\">
                </span>
                <button type=\"button\" class=\"btn btn-danger\" onclick=\"removeFiltre(this)\"> {{ 'generic.delete' | trans }} </button>
            </div>
            <br />";
        return $formulaire;
     }
}



?>