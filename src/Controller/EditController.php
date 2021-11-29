<?php

namespace App\Controller;

use App\Entity\Test;
use Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class EditController extends AbstractController
{
    #[Route('/edited', name: 'edited')]
    public function index(): Response
    {
        $test = $this->getDoctrine()->getRepository(Test::class)->find($_POST['id']);
        // if(isset($_POST["submit"])){
        //set value in the entity class
        try{
        $test->setName($_POST["name"]);
        $test->setPhoneNumber($_POST["phoneNumber"]);
        $test->setAddress($_POST["address"]);
        $test->setEmail($_POST["email"]);

        $manager = $this->getDoctrine()->getManager();
        
        $manager->persist($test);
        $manager->flush();
        $this->addFlash("success", "Account Updated successfully!!!");
        }catch(Exception $e){
            $e->getMessage();
        }
        return $this->render('test/index.html.twig', [
            'controller_name' => 'EditController',
        ]);
    }
}
