<?php

namespace App\Controller;

use App\Entity\User;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\CurrentUser;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ApiLoginController extends AbstractController
{
    #[Route('/api/login', name: 'api_login')]
    public function index(#[CurrentUser] ?User $user): Response
    {
       
        if (null === $user) {
                 return $this->json([
                     'message' => 'missing credentials',
                 ], Response::HTTP_UNAUTHORIZED);
        }

        $token = 'eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJzdWIiOiIxMjM0NTY3ODkwIiwibmFtZSI6IkJhcHRpc3RlIiwiaWQiOjU0fQ.1uhXhd1n70J9vlZ--0_NlyqVeQgcmScz2fQd_xeGLdA' ; 

        return $this->json([
            'user' => $user->getUserIdentifier(),
            'id' => $user->getId(),
            'roles' => $user->getRoles(),
            'token' => $token,
        ]);
    }
}
