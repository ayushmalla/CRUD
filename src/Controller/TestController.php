<?php

namespace App\Controller;

use App\Entity\Test;
use Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TestController extends AbstractController
{
    #[Route('/test', name: 'test')]
    public function index(Request $request)
    {
    
        //Creating entity object
        $test = new Test();
        //set value in the entity class

        try{
        $test->setName($_POST["name"]);
        $test->setPhoneNumber($_POST["phoneNumber"]);
        $test->setAddress($_POST["address"]);
        $test->setEmail($_POST["email"]);

        $manager = $this->getDoctrine()->getManager();
        
        //tell doctrine to save value
        $manager->persist($test);
        
        //execute the insert query
        $manager->flush();
        $this->addFlash("success", "Account Created successfully!!!");
         }catch(Exception $e){
            $e->getMessage();
        }

        return $this->render('test/index.html.twig', [
            'controller_name' => 'TestController',
        ]);
    }
}
