<?php


namespace App\Controller;

use App\Entity\User;
use App\Form\RegistrationType; 
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class RegistrationController extends AbstractController
{
    #[Route('/registration', name: 'app_registration')]
    public function register(Request $request, EntityManagerInterface $entityManager): Response
    {
        // Créez une nouvelle entité User
        $user = new User();
        
        // Créez le formulaire d'inscription
        $form = $this->createForm(RegistrationType::class, $user);

        // Traitez la requête du formulaire
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // Hachez le mot de passe
            $user->setPassword(password_hash($user->getPassword(), PASSWORD_BCRYPT));

            // Sauvegardez l'utilisateur dans la base de données
            $entityManager->persist($user);
            $entityManager->flush();
            
            // Optionnel : Ajoutez un message flash pour confirmer l'inscription
            $this->addFlash('success', 'Inscription réussie !');
            
            // Redirigez vers la page de connexion ou une autre page
            // return $this->redirectToRoute('app_login');
        }

        // Renvoyez le formulaire à la vue Twig
        return $this->render('registration/index.html.twig', [
            'form' => $form->createView(), // Passez le formulaire à la vue Twig
        ]);
    }
}
