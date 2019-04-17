<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Pokemon;
use AppBundle\Service\PokemonService;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\View\View;
use JMS\Serializer\SerializerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use FOS\RestBundle\Controller\Annotations\Get;
use FOS\RestBundle\Controller\Annotations\Post;


class DefaultController extends AbstractFOSRestController
{
    const POKEMON_NOT_FOUND = 'Pokemon not found';

    protected $serializer;

    public function __construct(SerializerInterface $serializer)
    {
        $this->serializer = $serializer;
    }

    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        // replace this example code with whatever you need
        return $this->render('default/index.html.twig', [
            'base_dir' => 'Not Important',
        ]);
    }

    /**
     * @Post("/add", name="add-pokemon")
     */
    public function postAction(Request $request, PokemonService $pokemonService)
    {
        $pokemon = (new Pokemon())
            ->setName($request->get('name'))
            ->setSpecies($request->get('species'))
            ->setHeight($request->get('height'))
            ->setWeight($request->get('weight'))
            ->setBaseExperience($request->get('baseExperience'))
            ->setOrder($request->get('order'))
            ->setDefault($request->get('default'));

        $pokemonService->save($pokemon);

        $this->redirectToRoute('homepage');
    }

    /**
     * @Get("/species/{speciesId}", name="get-by-species")
     */
    public function findBySpeciesAction($speciesId, PokemonService $pokemonService)
    {
        $pokemonArray = $pokemonService->findBySpecies($speciesId);

        if (empty($pokemonArray))
        {
            return new JsonResponse(['message' => $this::POKEMON_NOT_FOUND], Response::HTTP_NOT_FOUND);
        }

        $this->serializer->serialize($pokemonArray, 'json');

        $view = View::create($pokemonArray);
        $view->setFormat('json');

        return $this->handleView($view);
    }

}
