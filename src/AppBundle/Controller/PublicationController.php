<?php
/**
 * Created by PhpStorm.
 * User: vrodriguez
 * Date: 10/09/2017
 * Time: 04:10 PM
 */

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class PublicationController extends Controller{

    public function indexAction(Request $request){
        return $this->render('AppBundle:Publication:home.html.twig');            
    }

}