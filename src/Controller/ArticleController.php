<?php

namespace App\Controller;

use App\Form\ArticleType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Entity\Articles;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ArticleController extends AbstractController
{
    #[Route('/create_article', name:'create_article')]
    #[Assert\NotBlank()]
    public function article(Request $request): Response
    {
        $navbar = ['home', 'about', 'news', 'trend'];

        $request->get("category");
        $request->get("title");
        $request->get("image");
        $request->get("author");
        $request->get("publish_date");
        $request->get("story");

        $article = new Articles();
        
        $form = $this->createFormBuilder($article)
            ->setAction($this->generateUrl('article'))
            ->setMethod("POST")
            ->add("category", TextType::class, [])
            ->add("title", TextType::class)
            ->add("image", FileType::class)
            ->add("author", TextType::class)
            ->add("publish_date", DateType::class, ['label' => "published"])
            ->add("story", TextareaType::class, ['label' => "article"])
            ->add('save', SubmitType::class, ['label' => "Submit"])
            ->getForm();

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $article = $form->getData();

            return $this->redirectToRoute('article');
        }
        
        return $this->render('article/form.html.twig', 
            array('navTitle' => $navbar)
        );
    }

    #[Route('/article', name:'article')]
    public function createArticle(ManagerRegistry $doctrine): Response
    {
        $navbar = ['home', 'about', 'news', 'trend'];
        
        $entityManager = $doctrine->getManager();

        $category = $_POST['category'];
        $title = $_POST['title'];
        $story = $_POST['story'];
        $image = $_POST['image'];
        $author = $_POST['author'];
        $publishDate = $_POST['publish_date'];
        
    
        $article = new Articles();
        $article->setCategory($category);
        $article->setTitle($title);
        $article->setStory($story);
        $article->setImage($image);        
        $article->setAuthor($author);
        $article->setPublishDate($publishDate);

        $entityManager->persist($article);

        $entityManager->flush();

        return $this->render('article/confirm.html.twig', 
            array('navTitle' => $navbar, 'artlicleID' => $article->getId(),)
        );
    }

    // #[Route('/confirm_article', name: 'confirm_article')]
    // public function articleConfrimed(): Response
    // {
    //     $category1 = $_POST['title'];
    //     $category2 = $_POST['category'];
    //     $category3 = $_POST['author'];
    //     $category4 = $_POST['publish_date'];
    //     $cat = $_POST['story'];
        
    //     return new Response('Save new article with ' . $category1 . " " . $category2 . " " .$category3 . " " .$category4 . " " .$cat);
    // }
}
