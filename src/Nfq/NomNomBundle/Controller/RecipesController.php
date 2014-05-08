<?php
/**
 * Created by PhpStorm.
 * User: Vaiva
 * Date: 4/6/14
 * Time: 12:09 PM
 */

namespace Nfq\NomNomBundle\Controller;

use Nfq\NomNomBundle\Entity\MyRecipe;
use Nfq\NomNomBundle\Entity\MyRecipeProduct;
use Nfq\NomNomBundle\Form\Type\CreateRecipeType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Nfq\NomNomBundle\Entity\MyUserEvent;
use Nfq\NomNomBundle\Entity\MyEventRecipe;
use Nfq\NomNomBundle\Entity\MyRecipeVote;
use Symfony\Component\HttpFoundation\Request;

class RecipesController extends Controller
{
    public function recipeAction($id)
    {
        $error = '';

        $recipe = $this->getDoctrine()
            ->getRepository('NfqNomNomBundle:MyRecipe')
            ->find($id);

        if (!$recipe) {
            $error = 'No recipe found for id ' . $id;
        }

        $products = $recipe->getMyRecipeProducts();
        $logo1 = "bundles/nfqnomnom/images/recipes/clock.jpg";
        $logo2 = "bundles/nfqnomnom/images/recipes/portion.png";
        $logo3 = "bundles/nfqnomnom/images/recipes/category.png";

        return $this->render(
            'NfqNomNomBundle:recipes:recipe.html.twig',
            array(
                'error' => $error,
                //'recipe_preparation' => $preparation,
                'recipe_products' => $products,
                'recipe' => $recipe,
                'logo1_path' => $logo1,
                'logo2_path' => $logo2,
                'logo3_path' => $logo3,


            )
        );
    }

    public function upvoteRecipeAction($userEventId, $eventRecipeId)
    {
        $user = $this->getUser();
        if ($user) {
            $em = $this->getDoctrine()->getManager();
            $userEventRepository = $em->getRepository('NfqNomNomBundle:MyUserEvent');
            $eventRecipeRepository = $em->getRepository('NfqNomNomBundle:MyEventRecipe');
            $recipeVoteRepository = $em->getRepository('NfqNomNomBundle:MyRecipeVote');

            /** @var MyUserEvent $userEvent */
            $userEvent = $userEventRepository->find($userEventId);

            if ($userEvent->getMyUser() == $user) {

                /** @var MyEventRecipe $eventRecipe */
                $eventRecipe = $eventRecipeRepository->find($eventRecipeId);

                if ($eventRecipe->getMyEvent() == $userEvent->getMyEvent()) {

                    $recipeVote = $recipeVoteRepository->findExisting($userEventId, $eventRecipeId);

                    if (empty($recipeVote)) {
                        $recipeVote = new MyRecipeVote();
                        $recipeVote->setMyUserEvent($userEvent);
                        $recipeVote->setMyEventRecipe($eventRecipe);
                        $recipeVote->setVote(1);
                        $em->persist($recipeVote);
                    } else {
                        $recipeVote['0']->setVote(1);
                    }

                    $em->flush();

                    $this->updateVotes($eventRecipe);

                    return $this->redirect($this->generateUrl('Nfq_nom_nom_events',
                        array('eventId' => $userEvent->getMyEvent()->getId())));
                }
                return $this->render('NfqNomNomBundle:Default:index.html.twig',
                    array('error' => 'recipe is not in this event'));
            }
            return $this->render('NfqNomNomBundle:Default:index.html.twig',
                array('error' => 'you ar not participating in this event'));
        }
        return $this->render('NfqNomNomBundle:Default:index.html.twig', array('error' => 'log in  first'));
    }

    public function downvoteRecipeAction($userEventId, $eventRecipeId)
    {
        $user = $this->getUser();
        if ($user) {
            $em = $this->getDoctrine()->getManager();
            $userEventRepository = $em->getRepository('NfqNomNomBundle:MyUserEvent');
            $eventRecipeRepository = $em->getRepository('NfqNomNomBundle:MyEventRecipe');
            $recipeVoteRepository = $em->getRepository('NfqNomNomBundle:MyRecipeVote');

            /** @var MyUserEvent $userEvent */
            $userEvent = $userEventRepository->find($userEventId);

            if ($userEvent->getMyUser() == $user) {

                /** @var MyEventRecipe $eventRecipe */
                $eventRecipe = $eventRecipeRepository->find($eventRecipeId);

                if ($eventRecipe->getMyEvent() == $userEvent->getMyEvent()) {

                    $recipeVote = $recipeVoteRepository->findExisting($userEventId, $eventRecipeId);

                    if (empty($recipeVote)) {
                        $recipeVote = new MyRecipeVote();
                        $recipeVote->setMyUserEvent($userEvent);
                        $recipeVote->setMyEventRecipe($eventRecipe);
                        $recipeVote->setVote(0);
                        $em->persist($recipeVote);
                    } else {
                        $recipeVote['0']->setVote(0);
                    }

                    $em->flush();

                    $this->updateVotes($eventRecipe);

                    return $this->redirect($this->generateUrl('Nfq_nom_nom_events',
                        array('eventId' => $userEvent->getMyEvent()->getId())));
                }
                return $this->render('NfqNomNomBundle:Default:index.html.twig',
                    array('error' => 'recipe is not in this event'));
            }
            return $this->render('NfqNomNomBundle:Default:index.html.twig',
                array('error' => 'you ar not participating in this event'));
        }
        return $this->render('NfqNomNomBundle:Default:index.html.twig', array('error' => 'log in  first'));
    }

    public function updateVotes($eventRecipe)
    {
        //maybe should use lyfecycle callbacks
        $em = $this->getDoctrine()->getManager();
        $recipeVoteRepository = $em->getRepository('NfqNomNomBundle:MyRecipeVote');
        $eventRecipeRepository = $em->getRepository('NfqNomNomBundle:MyEventRecipe');

        $recipeVotes = $recipeVoteRepository->findbyEventRecipe($eventRecipe);
        $votes = 0;
        foreach ($recipeVotes as $recipeVote) {
            $votes += $recipeVote->getVote();
        }

        $eventRecipe->setTotalUpvote($votes);
        $em->flush();
    }

    public function createRecipeAction(Request $request)
    {
        $user = $this->getUser();
        if ($user) {
            $recipe = new MyRecipe();

            $form = $this->createForm(new CreateRecipeType(), $recipe);
            if ($request->isMethod("POST")) {
                $form->submit($request);
                if ($form->isValid()) {
                    $em = $this->getDoctrine()->getManager();
                    foreach ($recipe->getMyRecipeProducts() as $product) {
                        /** @var MyRecipeProduct $product */
                        $product->setMyRecipe($recipe);
                        $em->persist($product);
                    }
                    $em->persist($recipe);
                    $em->flush();
                    //I think it should be persisted cascading
                    //TODO decide where to redirect
                    return $this->redirect($this->generateUrl('nfq_nom_nom_recipe_list'));
                }
            }
            return $this->render('NfqNomNomBundle:recipes:createrecipe.html.twig',
                array('error' => '',
                    'forma' => $form->createView()
                ));
        }
        return $this->render('NfqNomNomBundle:Default:index.html.twig', array('error' => 'log  in first'));
    }
}