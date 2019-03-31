<?php
/**
 * Created by PhpStorm.
 * User: khatt
 * Date: 30/03/2019
 * Time: 23:03
 */

namespace App\Controller;


use App\Entity\Dungeons;
use App\Form\DungeonType;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class DungeonController extends AbstractController
{
    /**
     * @Route("/admin/addDungeon", name="addDungeon")
     */

    public function addDungeon(Request $request, ObjectManager $manager)
    {
        $dungeon = new Dungeons();
        $form= $this->createForm(DungeonType::class, $dungeon);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $manager->persist($dungeon);
            $manager->flush();
            return $this->redirectToRoute('home');
        }

        return $this->render('pages/addDungeon', [
            'formDungeon' =>$form->createView()
        ]);

    }


}
