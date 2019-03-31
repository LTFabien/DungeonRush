<?php
/**
 * Created by PhpStorm.
 * User: khatt
 * Date: 27/03/2019
 * Time: 21:41
 */

namespace App\Controller;


use App\Entity\CharacterClass;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class ClassDetails extends AbstractController
{
    /**
     * @Route("/classes/{id}/classDetails", name="classDetails")
     */

    public function ShowDetails($id){
        $characterClass = $this->getDoctrine()
            ->getRepository(CharacterClass::class)
            ->find($id);

        if (!$characterClass) {
            throw $this->createNotFoundException(
                'Aucune classe trouvée pour cet id :( '.$id
            );
        }

        return $this->render('pages/classDetails', array('characterclass' => $characterClass));
    }

}