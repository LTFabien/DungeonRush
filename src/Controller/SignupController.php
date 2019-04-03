<?php

namespace App\Controller;

use App\Form\RegistrationType;
use Doctrine\Common\Persistence\ObjectManager;
use PhpParser\Node\Expr\Cast\Object_;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\User;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;


class SignupController extends AbstractController
{
    /**
     * @Route("/signup", name="signup")
     */
    public function registration(Request $request, ObjectManager $manager, UserPasswordEncoderInterface $encoder){ //request et OM pour récup et envoyer dans notre base de données., UPEI pour hash notre mdp
        $user=new User();

        $form= $this->createForm(RegistrationType::class, $user);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){ //dans User.php les conditions
            $hash=$encoder->encodePassword($user, $user->getPassword());
            $user->setPassword($hash);
            $manager->persist($user);
            $manager->flush();
            return $this->redirectToRoute('login');
        }

        return $this->render('pages/signup.html.twig', [
            'form' =>$form->createView()
        ]);

    }


}
