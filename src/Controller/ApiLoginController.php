<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\User;
use Symfony\Component\Security\Http\Attribute\CurrentUser;

class ApiLoginController extends AbstractController
{
    
    public function index(#[CurrentUser] ?User $user): Response
    {
    	  // dd($user);

    	 if (null === $user) {
            return $this->json([
                'message' => 'missing credentials',
            ], Response::HTTP_UNAUTHORIZED);
       }


       $token = "";

        return $this->json([
            'message' => 'Welcome to your new controller!',
            'path' => 'src/Controller/ApiLoginController.php',
             'user'  => $user->getUserIdentifier(),
           'token' => $token,
        ]);
    }
}