<?php
/**
 * Created by PhpStorm.
 * User: Vaiva
 * Date: 4/13/14
 * Time: 12:05 PM
 */

namespace Nfq\NomNomBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class RecipesListController extends Controller
{
    public function recipeListAction(Request $request, $page)
    {
        $numberInPage = 9;
        $repository = $this->getDoctrine()->getRepository('NfqNomNomBundle:MyRecipe');

        /**
         * @var \Doctrine\ORM\Query $recipesQuery
         */
        $recipesQuery = $repository->getRecipesQuery();

        $totalRecipesCount = $repository->getRecipesCount();

        $pagesCount = ceil($totalRecipesCount / $numberInPage);

        $offset = ($page - 1) * $numberInPage;

        $recipesQuery->setFirstResult($offset);
        $recipesQuery->setMaxResults($numberInPage);

        $recipes = $recipesQuery->getResult();

        $name = "Recipes";

        $form = $this->createForm('browserecipes');

        $form->handleRequest($request);
        $repository = $this->getDoctrine()->getRepository('NfqNomNomBundle:MyRecipe');
        $ret = NULL;

        if ($form->isSubmitted()) {
            $ret = $repository->filterByCategory(
                $form->getData()['side'],
                $form->getData()['main'],
                $form->getData()['deserts'],
                $form->getData()['soups'],
                $form->getData()['servfrom'],
                $form->getData()['servto'],
                $form->getData()['prepfrom'],
                $form->getData()['prepto']
            );

            return $this->render ('NfqNomNomBundle:Default:test.html.twig', array(
                'error' => '',
                'forma' => $form->createView(),
                'recipes' => $ret,

            ));

        }

        return $this->render(
            'NfqNomNomBundle:recipes:recipesList.html.twig',
            array(
                'recipes' => $recipes,
                'name' => $name,
                'numberOfPages' => $pagesCount,
                'page' => $page,
                'forma' => $form->createView()
            )
        );
    }
}