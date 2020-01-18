<?php
// Controller del HackBlog
namespace App\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

use App\Entity\Noticia;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
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
        ->add('entradilla', TextareaType::class)
        ->add('cuerpo', TextareaType::class)
        ->add('fecha', DateType::class)
        ->add('save', SubmitType::class,
        array('label' => 'Añadir Noticia'))
        ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $noticia = $form->getData();
            // Obtenemos el gestor de entidades de Doctrine
            $entityManager = $this->getDoctrine()->getManager();
            // Le decimos a doctrine que nos gustaría almacenar
            // el objeto de la variable en la base de datos
            $entityManager->persist($noticia);
            // Ejecuta las consultas necesarias
            $entityManager->flush();
            //Redirigimos a una página de confirmación.
            return $this->redirectToRoute('noticiaCreada');
        }

        return $this->render('nuevaNoticia.html.twig', array(
        'form' => $form->createView(),
        ));
    }

    public function noticiaCreada()
    {
        return $this->render('sorteo/noticiaCreada.html.twig');
    }
}