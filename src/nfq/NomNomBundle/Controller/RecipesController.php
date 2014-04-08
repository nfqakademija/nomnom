<?php
/**
 * Created by PhpStorm.
 * User: Vaiva
 * Date: 4/6/14
 * Time: 12:09 PM
 */

namespace Nfq\NomNomBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class RecipesController extends Controller
{
    public function recipeAction($id)
    {
        $error='';

        $recipe = $this->getDoctrine()
            ->getRepository('NfqNomNomBundle:MyRecipe')
            ->find($id);

        if (!$recipe) {
            $error='No recipe found for id '.$id;
        }

        $photo_path = $recipe->getPhotoUrl();
        $products = $recipe->getMyRecipeProducts();
        $logo1="bundles/nfqnomnom/images/recipes/clock.jpg";
        $logo2="bundles/nfqnomnom/images/recipes/portion.png";
        $logo3="bundles/nfqnomnom/images/recipes/category.png";

        return $this->render(
            'NfqNomNomBundle:Recipes:recipe.html.twig',
            array(
                'recipe_photo_path' => $photo_path,
                'error'=>$error,
                //'recipe_preparation' => $preparation,
                'recipe_products' => $products,
                'recipe' => $recipe,
                'logo1_path' => $logo1,
                'logo2_path' => $logo2,
                'logo3_path' => $logo3,


            )
        );
    }
}