<?php

namespace App\Controller;

use App\Entity\Resident;
use App\Repository\CaregiverRepository;
use App\Repository\CategoryRepository;
use App\Repository\ResidentRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Constraints\NotNull;

/**
 * @Route("/caregiver")
 */

class CaregiverController extends AbstractController
{
    /**
     * @Route("/", name="caregiver")
     */
    public function index(ResidentRepository $resident): Response
    {
        return $this->render('caregiver/index.html.twig', [
            'residents' => $resident->findAll(),
        ]);
    }

    /**
     * @Route("/r-{id}", name="categories", methods={"GET","POST"})
     */

     public function category(Resident $resident, CategoryRepository $categoryRepository): Response
     {
        
        $categories = $categoryRepository->findAll();
        
       


        // function buildTree(array $elements, $parentId = 0) {
        //     $branch = array();
        
        //     foreach ($elements as $element) {
        //         if ($element['parent_id'] == $parentId) {
        //             $children = buildTree($elements, $element['id']);
        //             if ($children) {
        //                 $element['children'] = $children;
        //             }
        //             $branch[] = $element;
        //         }
        //     }
        
        //     return $branch;
        // }
        
        //     foreach ($category as $element) {
        //         if ($element->getParent()) {
        //             dd($element);
        //         }
        //     }
        // $tree = buildTree($category);

      
        
        // function buildTree(array &$elements, $parentId = 0) {
        //     $branch = array();
        
        //     foreach ($elements as $element) {
        //         if ($element['parent_id'] == $parentId) {
        //             $children = buildTree($elements, $element['id']);
        //             if ($children) {
        //                 $element['children'] = $children;
        //             }
        //             $branch[$element['id']] = $element;
        //             unset($elements[$element['id']]);
        //         }
        //     }
        //     return $branch;
        // }
        
        // $tree = buildTree($categories);
       
        
        return $this->render('caregiver/categories.html.twig', [
            'resident' => $resident,
            'categories' => $categories
        ]);
     }
}
