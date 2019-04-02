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
use App\Entity\Move;
use App\Entity\Player;
use App\Entity\Weapons;
use App\Repository\CharacterClassRepository;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

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


        $encoders = [new JsonEncoder()];
        $normalizers = [new ObjectNormalizer()];


        $serializer = new Serializer($normalizers, $encoders);

        $jsonContent = $serializer->serialize($characterclasses[1], 'json');
        dump($jsonContent);

        $characterclasses[0]->setStats($characterclasses[1]->getStats());
        dump($characterclasses[0]->getStats());

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
                ->add('authorized_weapons', EntityType::class, array(
                    'class'        => Weapons::class,
                    'choice_label' => 'name',
                    'multiple'     => true,
                    'expanded' => true,
                ))
                ->add('authorized_move', EntityType::class, array(
                    'class'        => Move::class,
                    'choice_label' => 'nom',
                    'multiple'     => true,
                    'expanded' => true,
                ))
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