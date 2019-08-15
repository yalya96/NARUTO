<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\AuthentificationType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use App\Controller\JWTEncoderInterface;
use Lexik\Bundle\JWTAuthenticationBundle\Encoder\JWTEncoderInterface as LexikJWTEncoderInterface;
use Symfony\Component\HttpFoundation\JsonResponse;

/**
     * @Route("/auth", name="authentification")
     */
class AuthentificationController extends AbstractController
{
    /**
     * @Route("/", name="authentification")
     */
    public function index()
    {
        return $this->render('authentification/index.html.twig', [
            'controller_name' => 'AuthentificationController',
        ]);
    }
    /**
     * @Route("/login", name="login", methods={"POST"})
     * @param JWTEncoderInterface $JWTEncoder
     * @return JsonResponse
     * @throws \Lexik\Bundle\JWTAuthenticationBundle\Exception\JWTEncodeFailureException
     */
    public function login(Request $request,LexikJWTEncoderInterface $JWTEncoder)
    {
        $user= new User();
        $form = $this->createForm(AuthentificationType::class, $user);
        $form->handleRequest($request);
        $reception=$request->request->all();
        $form->submit($reception);
       //var_dump($reception);die();
       $user = $this->getDoctrine()->getRepository(User::class)->findOneBy([
        'username' => $reception['username']
    ]);
       $token = $JWTEncoder->encode([
        'username' => $user->getUsername(),
        'exp' => time() + 3600 // 1 hour expiration
    ]);
    //return $token;
    return new JsonResponse(['token' => $token]);
    // return new JsonResponse(['token' => $token]);
        // $user = $this->getUser();
        // return $this->json([
        //     'username' => $user->getUsername(),
        //     'roles' => $user->getRoles()
        // ]);
    }
}
