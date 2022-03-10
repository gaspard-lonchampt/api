<?php

namespace App\Controller;

use App\Repository\UserRepository;
use App\Repository\ProgramRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class RemoveController extends AbstractController {

    #[Route ("api/users/{id}/remove/programs/{idProg}", name:"remove") ]
    public function remove (UserRepository $userRepository, ProgramRepository $programRepository, int $id, int $idProg, ManagerRegistry $doctrine)
    {
        $entityManager = $doctrine->getManager();
        $dataUser = $userRepository->find($id);
        $dataProg = $programRepository->find($idProg);

        $dataUser->removeProgram($dataProg);

        $entityManager->flush();
        return $this->json([
            "message" => "Vous ne suivez plus ce programme",
        ]);
    }
    
}