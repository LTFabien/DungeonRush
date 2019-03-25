<?php
/**
 * Created by PhpStorm.
 * User: Fabien
 * Date: 19/02/2019
 * Time: 18:15
 */

namespace App\Controller;
//$characterClass = new CharacterClass();
//        $characterClass->setName('Guerrier')
//            ->setDescription('Les guerriers de Kabylie sont très habiles');
//        $em = $this->getDoctrine()->getManager(); //em = entityManager
//        $em->persist($characterClass);
//        $em->flush();

use App\Entity\CharacterClass;
use App\Repository\CharacterClassRepository;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CharacterClassController extends AbstractController
{
    /**
     * @var CharacterClassRepository
     */
    public $repository;

    public $em;

    public function __construct(CharacterClassRepository $repository, ObjectManager $em)
    {
        $this->repository = $repository;
        $this->em = $em;
    }

    /**
     * @Route("/classes", name="characterclass.index")
     * @param CharacterClassRepository $repository
     * @return Response
     */
    public function index(CharacterClassRepository $repository): Response
    {
        $characterclasses = $repository->findAll();
        return $this->render('property/index.html.twig', [
            'characterclasses' => $characterclasses
        ]);

    }

    /**
     * @Route("/classes/{id}/modifyClass", name="modify_class")
     */
    public function modifyClass(CharacterClass $characterClass, Request $request, ObjectManager $manager){

            $form = $this->createFormBuilder($characterClass)
                ->add('name')
                ->add('description', TextareaType::class)
                ->getForm();

            $form->handleRequest($request);

            if($form->isSubmitted() && $form->isValid()){
                $manager->persist($characterClass);
                $manager->flush();
                return $this->redirectToRoute('home');
            }

        return $this->render('pages/modifyClass.html.twig', [
            'formModifyClass' => $form->createView()
        ]);
        }

    /**
     * @Route("/classes/{id}/removeClass", name="remove_class")
     */
        public function removeClass(CharacterClass $characterClass){
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($characterClass);
            $entityManager->flush();
            return $this->redirectToRoute('characterclass.index');

        }
}