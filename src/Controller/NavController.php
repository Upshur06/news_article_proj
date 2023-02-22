<?php

namespace App\Controller;

use App\Repository\ArticlesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Constraints\Json;

class NavController extends AbstractController
{
    #[Route('/article/top10', name: 'app_top10_articles')]
    public function showTopTenArticles(ArticlesRepository $article): JsonResponse
    {
        $response = $article->topTen();
        return $this->json($response);
    }

    #[Route('/article/randomtopics', name: 'app_article_topics')]
    public function showRandomArtleTopics(ArticlesRepository $article): JsonResponse
    {
        $response = $article->newsTopics();
        return $this->json($response);
    }

    #[Route('/home', name: 'app_nav_home')]
    public function home(ArticlesRepository $articlesRepository): Response
    {
        $articles = $articlesRepository;

        $navbar = ['home', 'about', 'news', 'trend'];
        
        return $this->render("nav/home.html.twig",
            array('navTitle' => $navbar,
                // 'topic' => $topics,
                'topic' => $articles->findAll(),
                // 'news' => $upcomingNews,
            )
        );
    }

    #[Route('/about', name: 'app_nav_about')]
    public function about(): Response
    {
        $navbar = ['home', 'about', 'news', 'trend'];

        return $this->render("nav/about.html.twig",
            array('navTitle' => $navbar));
    }

    #[Route('/article/stories', name: 'app_article_stories')]
    public function findStoryArticles(ArticlesRepository $article): JsonResponse
    {
        $response = $article->findStoryArticles();
        return $this->json($response);
    }

    #[Route('/news/{slug}', name: 'app_nav_news')]
    public function news(ArticlesRepository $articlesRepository, $slug=null): Response
    {
        $articles = $articlesRepository;
        $navbar = ['home', 'about', 'news', 'trend'];
        $category = $slug;

        if($slug){
            return $this->render("nav/category.html.twig",
                array('navTitle' => $navbar,
                'topic' => $articles->findAll(),                
                'category' => $category,
            ));
        }else{
            return $this->render("nav/news.html.twig",
                array('navTitle' => $navbar,
                // 'topic' => $articles->findAll(),
            ));
        }
    }


    #[Route('/trend', name: 'app_nav_trend')]
    public function trend(): Response
    {
        $navbar = ['home', 'about', 'news', 'trend'];

        return $this->render("nav/trend.html.twig",
            array('navTitle' => $navbar));
    }
}
