<?php

namespace App\Controller;

use App\Entity\User;
use Lcobucci\JWT\Signer\Rsa;
use Lcobucci\JWT\Configuration;
use Lcobucci\JWT\Signer\Hmac\Sha256;
use Lcobucci\JWT\Signer\Key\InMemory;
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

        $configuration = Configuration::forSymmetricSigner(
            // You may use any HMAC variations (256, 384, and 512)
            new Sha256(),
            // replace the value below with a key of your own!
            InMemory::base64Encoded('mBC5v1sOKVvbdEitdSBenu59nfNfhwkedkJVNabosTw=')
            // You may also override the JOSE encoder/decoder if needed by providing extra arguments here
        );
    
        $token = $configuration->verificationKey(); ; // somehow create an API token for $user

        return $this->json([
            'user' => $user->getUserIdentifier(),
            'token' => $token,
        ]);
    }
}
