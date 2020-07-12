<?php namespace App\Controller;

use App\Entity\Proyecto;
use App\Form\ProyectoType;
use App\Repository\ProyectoRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\Filesystem\Filesystem;


/**
 * @Route("/proyecto")
 */
class ProyectoController extends AbstractController {
    

    /**
     * @Route("/", name="proyecto_index", methods={"GET"})
     */
    public function index(ProyectoRepository $proyectoRepository): Response { 
        $ruta= $this->getParameter('fotos_directory');
            
        return $this->render('proyecto/index.html.twig', [ 'proyectos'=> $proyectoRepository->findAll(),'ruta'=>$ruta
            ]);
    }

    /**
     * @Route("/new", name="proyecto_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response {
        $proyecto=new Proyecto();
        $form=$this->createForm(ProyectoType::class, $proyecto); //PAPU ACA ES COMO SE CREAR EL FORM 
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $brochureFile=$form->get('foto')->getData();

            if ($brochureFile) {

                $originalFilename=pathinfo($brochureFile->getClientOriginalName(), PATHINFO_FILENAME);
                // this is needed to safely include the file name as part of the URL
                $safeFilename=iconv('UTF-8', 'ASCII//TRANSLIT', $originalFilename);
                $newFilename=$safeFilename.'-'.uniqid().'.'.$brochureFile->guessExtension();

                // Move the file to the directory where brochures are stored
                try {
                    $brochureFile->move($this->getParameter('fotos_directory'),
                        $newFilename);
                }

                catch (FileException $e) {
                    // ... handle exception if something happens during file upload

                    throw new \Exception('Error al cargar el archivo');
                }

                // updates the 'brochureFilename' property to store the PDF file name
                // instead of its contents
                $proyecto->setFoto($newFilename);
            }




            $entityManager=$this->getDoctrine()->getManager();
            $entityManager->persist($proyecto);
            $entityManager->flush();

            return $this->redirectToRoute('proyecto_index');
        }

        return $this->render('proyecto/new.html.twig', [ 'proyecto'=> $proyecto,
            'form'=> $form->createView(),
            ]);
    }

    /**
     * @Route("/{id}", name="proyecto_show", methods={"GET"})
     */
    public function show(Proyecto $proyecto): Response {
        return $this->render('proyecto/show.html.twig', [ 'proyecto'=> $proyecto,
            ]);
    }

    /**
     * @Route("/{id}/edit", name="proyecto_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Proyecto $proyecto): Response {
        $fotoABorrar=$proyecto->getFoto();
        //dump($fotoABorrar);
        //die();
        $form=$this->createForm(ProyectoType::class, $proyecto);
        $form->handleRequest($request);
       
        if ($form->isSubmitted() && $form->isValid()) {
            
            $ruta= $this->getParameter('fotos_directory');
            
            unlink($ruta.'/'.$fotoABorrar);
            
            


            $brochureFile=$form->get('foto')->getData();

            if ($brochureFile) {

                $originalFilename=pathinfo($brochureFile->getClientOriginalName(), PATHINFO_FILENAME);
                // this is needed to safely include the file name as part of the URL
                $safeFilename=iconv('UTF-8', 'ASCII//TRANSLIT', $originalFilename);
                $newFilename=$safeFilename.'-'.uniqid().'.'.$brochureFile->guessExtension();

                // Move the file to the directory where brochures are stored
                try {
                    $brochureFile->move($this->getParameter('fotos_directory'),
                        $newFilename);
                }

                catch (FileException $e) {
                    // ... handle exception if something happens during file upload

                    throw new \Exception('Error al cargar el archivo');
                }

                // updates the 'brochureFilename' property to store the PDF file name
                // instead of its contents
                $proyecto->setFoto($newFilename);
            }

            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('proyecto_index');
        }

        return $this->render('proyecto/edit.html.twig', [ 'proyecto'=> $proyecto,
            'form'=> $form->createView(),
            ]);
    }

    /**
     * @Route("/{id}", name="proyecto_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Proyecto $proyecto): Response {
        if ($this->isCsrfTokenValid('delete'.$proyecto->getId(), $request->request->get('_token'))) {
            $fotoABorrar=$proyecto->getFoto();
            $ruta= $this->getParameter('fotos_directory');
             unlink($ruta.'/'.$fotoABorrar);


            $entityManager=$this->getDoctrine()->getManager();
            $entityManager->remove($proyecto);
            $entityManager->flush();
        }

        return $this->redirectToRoute('proyecto_index');
    }
}