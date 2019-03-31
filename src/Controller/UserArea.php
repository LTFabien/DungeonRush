<?php
/**
 * Created by PhpStorm.
 * User: khatt
 * Date: 31/03/2019
 * Time: 23:59
 */

namespace App\Controller;


use App\Repository\DungeonsRepository;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UserArea extends AbstractController
{
    /**
     * @var DungeonsRepository
     */
    public $repository;

    public $em;

    public function __construct(DungeonsRepository $repository, ObjectManager $em)
    {
        $this->repository = $repository;
        $this->em = $em;
    }

    /**
     * @Route("/UserArea", name="UserArea")
     * @param DungeonsRepository $repository
     * @return Response
     */
    public function index(DungeonsRepository $repository): Response
    {
        $dungeons = $repository->findAll();


        return $this->render('pages/userArea', [
            'dungeon' => $dungeons
        ]);

    }

}