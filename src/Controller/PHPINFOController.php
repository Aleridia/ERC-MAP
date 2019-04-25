<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController; //Remplace le Response
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Translation\TranslatorInterface;

class PHPINFOController extends AbstractController {

	/**
     * Page queries
     *
     * @Route("/phpinfo", name="phpinfo")
     */
	 public function index()
     {
         phpinfo();
     }
}



?>