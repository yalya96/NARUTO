<?php

namespace App\Controller;

use App\Entity\Profil;
use App\Entity\User;
use App\Form\ProfilType;
use App\Form\UserType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\PasswordEncoderInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class SystemeController extends AbstractController
{
    /**
     * @Route("/systeme", name="systeme")
     */
    public function index()
    {
        return $this->render('systeme/index.html.twig', [
            'controller_name' => 'SystemeController',
        ]);
    }
    /**
     * @Route("/profil")
     */
    public function addprofil(Request $request, EntityManagerInterface $entityManagerInterface)
    {
        $profil = new Profil();
        $form = $this->createForm(ProfilType::class, $profil);
        $form->handleRequest($request);
        $reception=$request->request->all();
        $form->submit($reception);
        $nom=$reception['libeller'];
        $nom=$this->controleprofil($nom);
        $nom=strtoupper($nom);
        //$nom='["ROLE_'.$nom.'"]';
        $profil->setLibeller($nom);

            $entityManagerInterface->persist($profil);
            $entityManagerInterface->flush();
            $data = [
                'status' => 201,
                'message' => 'merci'
            ];
            return new JsonResponse($data, 201);
    }
    /**
     * @Route("/ajoutsysteme")
     */
    public function addsys(Request $request, EntityManagerInterface $entityManagerInterface, UserPasswordEncoderInterface $passwordEncoder)
    {
        $systeme = new User();
        $form = $this->createForm(UserType::class, $systeme);
        $form->handleRequest($request);
        $reception=$request->request->all();
        $form->submit($reception);
        $profil= new Profil(); 
        $form1 = $this->createForm(ProfilType::class, $profil);
        $form1->handleRequest($request);
        $reception1=$request->request->all();
        $form1->submit($reception);
        $e=$reception1['libeller'];
        $repository = $this->getDoctrine()->getRepository(Profil::class);
       // $rien = $repository->findOneBy(['libeller' => $e]);
        $rien = $repository->find($e);
        $a=$rien->getLibeller();
        //var_dump(gettype(["ROLE_'.$a.'"]));die();
        $systeme->setRoles(["ROLE_$a"]);
        $systeme->setStatut("ACTIF");
        $systeme->setPassword($passwordEncoder->encodePassword($systeme, "welcome"));
       // $image=$request->file()->get('image');
        $file= $request->files->get('image');
        $extension=$file->guessExtension();
        $name=(md5(uniqid())).".".$extension;
        $file->move($this->getParameter('fichier'),$name);
        $systeme->setImage($name);
        $entityManagerInterface->persist($systeme);
        $entityManagerInterface->flush();
        //var_dump($file->guessExtension());die();
        
    }
    function controleprofil($test)
    {

        $taille=strlen($test);
        $test=strtolower($test);
        $yaya="";
        for ($i=0; $i < $taille; $i++) 
        {
            if (ord($test[$i])==97 || ord($test[$i])==98 || ord($test[$i])==99 || ord($test[$i])==100 || ord($test[$i])==101
            || ord($test[$i])==102 || ord($test[$i])==103 || ord($test[$i])==104 || ord($test[$i])==105 || ord($test[$i])==106
            || ord($test[$i])==107 || ord($test[$i])==108 || ord($test[$i])==109 || ord($test[$i])==110 || ord($test[$i])==111
            || ord($test[$i])==112 || ord($test[$i])==113 || ord($test[$i])==114 || ord($test[$i])==115 || ord($test[$i])==116
            || ord($test[$i])==117 || ord($test[$i])==118 || ord($test[$i])==118 || ord($test[$i])==119 || ord($test[$i])==120
            || ord($test[$i])==121 || ord($test[$i])==122
                
                ) 
             {
                    $yaya=$yaya.$test[$i];
            }
        }
        return $yaya;
    }
}
