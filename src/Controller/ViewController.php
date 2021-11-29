<?php

namespace App\Controller;

use App\Entity\Test;
use App\Repository\TestRepository;
use Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Constraints\Url;
use Symfony\Flex\Path;
use Symfony\Component\Validator\Constraints\Address;
use Symfony\Component\Validator\Constraints\phone_number;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\Name;
class ViewController extends AbstractController
{
    #[Route('/view', name: 'view')]

    public function listAll(TestRepository $testRepository):Response
    {
        

        // $manager = $this->getDoctrine()->getManager();

        // $getTest = $manager->getRepository(Test::class)->findAll();

        return $this->render('view/index.html.twig', [
            'a'=> $testRepository->findAll(),
        ]);
    }

    #[Route('/delete/{id}', name: 'delete')]
    public function Delete($id,TestRepository $testRepository):Response
    {
         $manager = $this->getDoctrine()->getManager();
        //  $getTest = $manager->getRepository(Test::class)->find($_GET['id']);

         
         $getTest = $manager->getRepository(Test::class)->find($id);

         //remove the given id data from the database
         $manager->remove($getTest);
         $manager->flush();

        return $this->render('view/index.html.twig',[
            'a' => $testRepository->findAll(),
        ]);
    }
    #[Route('/edit/{id}', name:'edit')]
    public function Edit($id):Response{
        $manager = $this->getDoctrine()->getManager();

        // $getTest = $manager->getRepository(Test::class)->find($_GET['id']);
        
        $getTest = $manager->getRepository(Test::class)->find($id);

        return $this->render('edit/index.html.twig',[
            'a' => $getTest
            ,
        ]);
    }

    #[Route('/search', name:'search')]
    public function search(){
        
        $manager = $this->getDoctrine()->getManager();
        $getTest = $manager->getRepository(Test::class)->find($_POST['id']);


        if($getTest === null){
            throw $this->createNotFoundException("This Id does not Exist!!!");
        }


        return $this->render('view/search.html.twig',[
            'i' => $getTest
            ,
        ]);
       
       
    }

   
}
