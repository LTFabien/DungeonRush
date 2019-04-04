<?php
/**
 * Created by PhpStorm.
 * User: slima
 * Date: 03/04/2019
 * Time: 20:56
 */

namespace App\Controller;



use App\Entity\Move;
use App\Repository\CharacterRepository;
use App\Repository\ConsumablesRepository;
use App\Repository\MoveRepository;
use App\Repository\TeamRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MarchandController extends AbstractController
{
    /**
     * @Route("/marchand", name="marchand")
     */
    public function marchand(TeamRepository $teamRepository,ConsumablesRepository $consumablesRepository): Response
    {
        $team=$teamRepository->findOneBy(['user' => $this->getUser()]);
        /*for ($i = 0; $i < 3; $i++) {
            dump($team->getCharacters()->get($i)->getClass()->getAuthorizedMove()->getValues()); //iterations sur les move authorise des joueur
            dump($team->getCharacters()->get($i)->getClass()->getAuthorizedArmors()->getValues()); //iterations sur les armures authorise des joueur
            dump($team->getCharacters()->get($i)->getClass()->getAuthorizedWeapons()->getValues()); //iterations sur les Armes authorise des joueur
        }*/
        $player=$team->getCharacters();

        $moves1=$team->getCharacters()->get(0)->getClass()->getAuthorizedMove()->getValues();
        $moves2=$team->getCharacters()->get(1)->getClass()->getAuthorizedMove()->getValues();
        $moves3=$team->getCharacters()->get(2)->getClass()->getAuthorizedMove()->getValues();

        $weapons1=$team->getCharacters()->get(0)->getClass()->getAuthorizedWeapons()->getValues();
        $weapons2=$team->getCharacters()->get(1)->getClass()->getAuthorizedWeapons()->getValues();
        $weapons3=$team->getCharacters()->get(2)->getClass()->getAuthorizedWeapons()->getValues();

        $armors1=$team->getCharacters()->get(0)->getClass()->getAuthorizedArmors()->getValues();
        $armors2=$team->getCharacters()->get(1)->getClass()->getAuthorizedArmors()->getValues();
        $armors3=$team->getCharacters()->get(2)->getClass()->getAuthorizedArmors()->getValues();
        //$team->getCharacters()->get(2)->addMove($moves[0]);
        //dump($team->getCharacters()->get(2)->getMove()->getValues());
        //dump($consumables=$consumablesRepository->findAll());

        return $this->render('pages/marchand.html.twig',array('player' => $player, 'moves1' => $moves1, 'moves2' => $moves2, 'moves3' => $moves3,
            'weapons1' => $weapons1, 'weapons2' => $weapons2, 'weapons3' => $weapons3,
            'armors1' => $armors1, 'armors2' => $armors2, 'armors3' => $armors3)); //faire passer les array en parametre
    }

    /**
     * @Route("/marchand/move/{id}/buy", name="buy")
     */
    public function buyMove(Move $move, TeamRepository $teamRepository)
    {
;
        //$entityManager = $this->getDoctrine()->getManager();
        //$entityManager->getCharacters()->get(0)->addMove($move);

        return $this->redirectToRoute('pages/marchand.html.twig');
    }
}