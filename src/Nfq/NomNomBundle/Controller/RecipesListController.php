<?php
/**
 * Created by PhpStorm.
 * User: Vaiva
 * Date: 4/13/14
 * Time: 12:05 PM
 */

namespace Nfq\NomNomBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class RecipesListController extends Controller
{
    public function recipeListAction($page)
    {
        $numberInPage = 9;
        $repository = $this->getDoctrine()->getRepository('NfqNomNomBundle:MyRecipe');

        /**
         * @var \Doctrine\ORM\Query $recipesQuery
         */
        $recipesQuery = $repository->getRecipesQuery();

        $totalRecipesCount = $repository->getRecipesCount();

        $pagesCount = floor($totalRecipesCount / $numberInPage);


        $offset = ($page - 1) * $numberInPage;

        $recipesQuery->setFirstResult($offset);
        $recipesQuery->setMaxResults($numberInPage);

        $recipes = $recipesQuery->getResult();

        $name = "Recipes";

        return $this->render(
            'NfqNomNomBundle:recipes:recipesList.html.twig',
            array(
                'recipes' => $recipes,
                'name' => $name,
                'numberOfPages' => $pagesCount,
                'page' => $page
            )
        );
    }
}