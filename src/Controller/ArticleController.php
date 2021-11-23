<?php

namespace App\Controller;

use App\Entity\Article;
use App\Form\ArticleType;
use App\Repository\ArticleRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use App\Service\FileUploader;

/**
 * @Route("/article")
 */
class ArticleController extends AbstractController
{
    /**
     * @Route("/", name="article_index", methods={"GET"})
     */
    public function index(ArticleRepository $articleRepository): Response
    {
        return $this->render('article/index.html.twig', [
            'articles' => $articleRepository->findAll(),
        ]);
    }

    /**
     * @IsGranted("ROLE_ADMIN")
     * @Route("/new", name="article_new", methods={"GET", "POST"})
     */
    public function new(Request $request, EntityManagerInterface $entityManager, FileUploader $fileUploader): Response
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN');
        $article = new Article();
        $form = $this->createForm(ArticleType::class, $article);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            $manuelFile = $form->get('manuel')->getData();
            $picturemainFile = $form->get('picturemain')->getData();
            $picturefrontFile = $form->get('picturefront')->getData();
            $picturebackFile = $form->get('pictureback')->getData();

            if ($manuelFile) {
                $manuel = $fileUploader->upload($manuelFile);
                $article->setManuel($manuel);
            }
            if ($picturemainFile) {
                $picturemain = $fileUploader->upload($picturemainFile);
                $article->setPicturemain($picturemain);
            }
            if ($picturefrontFile) {
                $picturefront = $fileUploader->upload($picturefrontFile);
                $article->setPicturefront($picturefront);
            }
            if ($picturebackFile) {
                $pictureback = $fileUploader->upload($picturebackFile);
                $article->setPictureback($pictureback);
            }
            $entityManager->persist($article);
            $entityManager->flush();
            return $this->redirectToRoute('article_index', [], Response::HTTP_SEE_OTHER);
        }
        return $this->renderForm('article/new.html.twig', [
            'article' => $article,
            'form' => $form,
        ]);
    }


    /**
     * @Route("/{id}", name="article_show", methods={"GET"})
     */
    public
    function show(Article $article): Response
    {
        return $this->render('article/show.html.twig', [
            'article' => $article,
        ]);
    }

    /**
     * @IsGranted("ROLE_ADMIN")
     * @Route("/{id}/edit", name="article_edit", methods={"GET", "POST"})
     */
    public
    function edit(Request $request, Article $article, EntityManagerInterface $entityManager, FileUploader $fileUploader): Response
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN');
        $form = $this->createForm(ArticleType::class, $article);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $manuelFile = $form->get('manuel')->getData();
            $picturemainFile = $form->get('picturemain')->getData();
            $picturefrontFile = $form->get('picturefront')->getData();
            $picturebackFile = $form->get('pictureback')->getData();

            if ($manuelFile) {
                $manuel = $fileUploader->upload($manuelFile);
                $article->setManuel($manuel);
            }
            if ($picturemainFile) {
                $picturemain = $fileUploader->upload($picturemainFile);
                $article->setPicturemain($picturemain);
            }
            if ($picturefrontFile) {
                $picturefront = $fileUploader->upload($picturefrontFile);
                $article->setPicturefront($picturefront);
            }
            if ($picturebackFile) {
                $pictureback = $fileUploader->upload($picturebackFile);
                $article->setPictureback($pictureback);
            }
            $entityManager->flush();
            return $this->redirectToRoute('article_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('article/edit.html.twig', [
            'article' => $article,
            'form' => $form,
        ]);
    }

    /**
     * @IsGranted("ROLE_ADMIN")
     * @Route("/{id}", name="article_delete", methods={"POST"})
     */
    public
    function delete(Request $request, Article $article, EntityManagerInterface $entityManager): Response
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN');
        if ($this->isCsrfTokenValid('delete' . $article->getId(), $request->request->get('_token'))) {
            $entityManager->remove($article);
            $entityManager->flush();
        }
        return $this->redirectToRoute('article_index', [], Response::HTTP_SEE_OTHER);
    }
}
