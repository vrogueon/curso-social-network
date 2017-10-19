<?php
/**
 * Created by PhpStorm.
 * User: vrodriguez
 * Date: 10/09/2017
 * Time: 04:10 PM
 */

namespace AppBundle\Controller;

use AppBundle\Form\RegisterType;
use AppBundle\Form\UserType;
use BackendBundle\Entity\User;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;


class UserController extends Controller{

    private $session;
    public function __construct(){
        $this->session = new Session();
    }


    public function holaAction(){
        return $this->json(["Prueba" => "hola"]);
    }

    public function loginAction(Request $request){
        if (is_object($this->getUser())) {
            return $this->redirect('home');
        }
        $authenticationUtils = $this->get('security.authentication_utils');
        $error = $authenticationUtils->getLastAuthenticationError();
        $lastUserName = $authenticationUtils->getLastUserName();
        return $this->render('AppBundle:User:login.html.twig',
            ['last_username' => $lastUserName,
                'error'     => $error]);
    }

    public function registerAction(Request $request){
        if (is_object($this->getUser())) {
            return $this->redirect('home');
        }
        $user = new User();
        $form = $this->createForm(RegisterType::class, $user);

        $form->handleRequest($request);
        if ($form->isSubmitted()){
            if ($form->isValid()){
                $em = $this->getDoctrine()->getManager();
                $user_repo = $em->getRepository('BackendBundle:User');

                $query = $em->createQuery('Select u from BackendBundle:User u Where u.email = :email OR u.nick = :nick')
                            ->setParameter('email', $form->get('email')->getData())
                            ->setParameter('nick', $form->get('nick')->getData());

                $user_isset = $query->getResult();

                if (count($user_isset) == 0){
                    $factory = $this->get("security.encoder_factory");
                    $encoder = $factory->getEncoder($user);
                    $password = $encoder->encodePassword($form->get('password')->getData(), $user->getSalt());

                    $user->setImage(null);
                    $user->setPassword($password);
                    $user->setRole("ROLE_USER");

                    $em->persist($user);
                    $flush = $em->flush();

                    if ($flush == null){
                        $status = "Te has registrado correctamente.";
                        $this->session->getFlashBag()->add("status",$status);
                        return $this->redirect("login");
                    } else {
                        $status = "No te has registrado correctamente.";
                    }
                } else {
                    $status = "El usuario ya existe.";
                }
            } else {
                $status = "No te has registrado correctamente.";
            }
            $this->session->getFlashBag()->add("status",$status);
        }
        return $this->render('AppBundle:User:register.html.twig', ["form" => $form->createView()]);
    }
    public function nickTestAction(Request $request){
        $nick = $request->get('nick');
        $em = $this->getDoctrine()->getManager();
        $user_isset = $em->getRepository('BackendBundle:User')->findOneBy(['nick' => $nick]);
        $result = 'used';
        if (count($user_isset) >= 1 && is_object($user_isset)){
            $result = 'used';
        } else {
            $result = 'unused';
        }

        return new Response($result);
    }

    public function editUserAction(Request $request){
        $user = $this->getUser();
        $user_image = $user->getImage();
        $form = $this->createForm(UserType::class, $user);

        $form->handleRequest($request);
        if ($form->isSubmitted()){
            if ($form->isValid()){
                $em = $this->getDoctrine()->getManager();
                $user_repo = $em->getRepository('BackendBundle:User');

                $query = $em->createQuery('Select u from BackendBundle:User u Where u.email = :email OR u.nick = :nick')
                            ->setParameter('email', $form->get('email')->getData())
                            ->setParameter('nick', $form->get('nick')->getData());

                $user_isset = $query->getResult();

                if (($user->getEmail() == $user_isset[0]->getEmail() && $user->getNick() == $user_isset[0]->getNick()) || count($user_isset) == 0){                    
                    //Upload file
                    $file = $form["image"]->getData();
                    if (!empty($file) && $file != null) {
                        $ext = $file->guessExtension();
                        if ($ext == 'jpeg' || $ext == 'jpg' || $ext == 'png' || $ext == 'gif') {
                            $file_name = $user->getId().time().'.'.$ext;
                            $file->move('uploads/users',$file_name);
                            $user->setImage($file_name);
                        }
                    } else {
                        $user->setImage($user_image);
                    }             
                                            
                    $em->persist($user);
                    $flush = $em->flush();

                    if ($flush == null){
                        $status = "Has modificado tus datos correctamente.";
                        $this->session->getFlashBag()->add("status",$status);                        
                    } else {
                        $status = "No has modificado correctamente.";
                    }
                } else {
                    $status = "El usuario ya existe.";
                }
            } else {
                $status = "No se han actualizado tus datos";
            }        
            return $this->redirect('my-data');
        }

        return $this->render('AppBundle:User:edit_user.html.twig',['form' => $form->createView()]);
    }

    public function usersAction(Request $request)
    {
        var_dump("users_Action"); die();
    }

}