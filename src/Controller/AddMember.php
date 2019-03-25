<?php
/**
 * Created by PhpStorm.
 * User: khatt
 * Date: 23/03/2019
 * Time: 19:02
 */

namespace App\Controller;


use App\Entity\User;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AddMember extends AbstractController
{

    /**
     * @Route("/admin/addMember", name="addMember")
     */
    public function addMember(Request $request, ObjectManager $manager, UserPasswordEncoderInterface $encoder){
        $user=new User();
        $form = $this->createFormBuilder($user)
            ->add('username')
            ->add('email')
            ->add('password', PasswordType::class)
            ->add('confirm_password', PasswordType::class)
            ->getForm();

        return $this->render('pages/addMember.html.twig', [
            'formMember' => $form->createView()
        ]);
    }

}