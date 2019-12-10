<?php
// Controller del HackBlog
namespace App\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
class HackBlogController extends AbstractController
{
    public function portada()
    {
        return $this->render('portada.html.twig', [
        ]);
    }
    public function noticia($id_noticia)
    {
        return $this->render('noticia.html.twig', [    
        ]);
    }
}