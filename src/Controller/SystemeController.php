<?php

namespace App\Controller;

use App\Entity\Profil;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

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
        $nom=strtoupper($nom);
        $nom='["ROLE_'.$nom.'"]';
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
    public function addsys(Request $request, EntityManagerInterface $entityManagerInterface)
    {
        
    }
}
