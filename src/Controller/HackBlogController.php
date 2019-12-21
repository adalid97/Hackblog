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

    public function nuevaNoticia(Request $request)
    {
        $noticia = new Noticia();

        $form = $this->createFormBuilder($noticia)
        ->add('titular', TextType::class)
        ->add('entradilla', TextType::class)
        ->add('cuerpo', TextType::class)
        ->add('fecha', DateType::class)
        ->add('save', SubmitType::class,
        array('label' => 'Añadir Noticia'))
        ->getForm();

        return $this->render('nuevaNoticia.html.twig', array(
        'form' => $form->createView(),
        ));
    }
}