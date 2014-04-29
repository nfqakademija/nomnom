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
    public function recipeListAction()
    {
        $recipes = $this->getDoctrine()->getRepository('NfqNomNomBundle:MyRecipe')->findAll();

        $name = "Recipes";

        return $this->render(
            'NfqNomNomBundle:recipes:recipesList.html.twig',
            array(
                'recipes' => $recipes,
                'name' => $name
            )
        );
    }
}