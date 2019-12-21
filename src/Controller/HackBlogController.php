<?php
// Controller del HackBlog
namespace App\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

use App\Entity\Comentario;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;

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

    public function nuevoComentario(Request $request)
    {
        $comentario = new Comentario();

        $form = $this->createFormBuilder($comentario)
        ->add('nombre', TextType::class)
        ->add('comentario', TextType::class)
        ->add('save', SubmitType::class,
        array('label' => 'Añadir Comentario'))
        ->getForm();
        return $this->render('noticia.html.twig', array(
        'form' => $form->createView(),
        ));
    }


}