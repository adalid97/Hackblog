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
        return $this->render('noticiaCreada.html.twig');
    }

    public function verNoticia($id)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $noticia= $entityManager->getRepository(Noticia::class)->find($id);
        if (!$noticia){
        throw $this->createNotFoundException(
            'No existe ninguna noticia con id '.$id
        );
    }
    return $this->render('verNoticia.html.twig', array(
        'noticia' => $noticia,
    ));
    }

    public function listaNoticias()
    {
        // Obtenemos el gestor de entidades de Doctrine
        $entityManager = $this->getDoctrine()->getManager();
        // obtenemos todas las noticias
        $noticias= $entityManager->getRepository(Noticia::class)->findAll();
        return $this->render('listaNoticias.html.twig', array(
            'noticias' => $noticias,
        ));
    }

    public function editarNoticia(Request $request, $id)
    {
        // Obtenemos el gestor de entidades de Doctrine
        $entityManager = $this->getDoctrine()->getManager();
        
        // Obtenenemos el repositorio de noticias y buscamos en el usando la i
        $noticia = $entityManager->getRepository(Noticia::class)->find($id);
        
        // Si la noticia no existe lanzamos una excepción.
        if (!$noticia){
            throw $this->createNotFoundException(
                'No existe ninguna noticia con id '.$id
        );
        }
       
        // Creamos el formulario a partir de $noticia
        $form = $this->createFormBuilder($noticia)
            ->add('titular', TextType::class)
            ->add('entradilla', TextareaType::class)
            ->add('cuerpo', TextareaType::class)
            ->add('fecha', DateType::class)
            ->add('save', SubmitType::class, array('label' => 'Editar Noticia'))
            ->getForm();
          
        $form->handleRequest($request);
       
        if ($form->isSubmitted() && $form->isValid()) {
            // De esta manera podemos sobreescribir la variable $noticia con l
            $noticia = $form->getData();
        
            // Ejecuta las consultas necesarias (UPDATE en este caso)
            $entityManager->flush();
        
            //Redirigimos a la página de ver la noticia editada.
            return $this->redirectToRoute('verNoticia', array('id'=>$id));
        }
        return $this->render('nuevaNoticia.html.twig', array(
            'form' => $form->createView(),
        ));    
    }

    public function borrarNoticia($id)
    {
        // Obtenemos el gestor de entidades de Doctrine
        $entityManager = $this->getDoctrine()->getManager();
        // Obtenenemos el repositorio de Noticia y buscamos en el usando la i
        $noticia= $entityManager->getRepository(Noticia::class)->find($id);
        // Si la noticia no existe lanzamos una excepción.
        if (!$noticia){
            throw $this->createNotFoundException(
                'No existe ninguna noticia con id '.$id
        );
        }
        $entityManager->remove($noticia);
        $entityManager->flush();
        return $this->render('noticiaBorrada.html.twig');
    }

}