<?php

namespace App\Controller;

use App\Entity\DocumentAudit;
use App\Form\DocumentAuditType;
use App\Repository\DocumentAuditRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/document/audit')]
final class DocumentAuditController extends AbstractController
{
    #[Route(name: 'app_document_audit_index', methods: ['GET'])]
    public function index(DocumentAuditRepository $documentAuditRepository): Response
    {
        return $this->render('document_audit/index.html.twig', [
            'document_audits' => $documentAuditRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_document_audit_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $documentAudit = new DocumentAudit();
        $form = $this->createForm(DocumentAuditType::class, $documentAudit);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($documentAudit);
            $entityManager->flush();

            return $this->redirectToRoute('app_document_audit_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('document_audit/new.html.twig', [
            'document_audit' => $documentAudit,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_document_audit_show', methods: ['GET'])]
    public function show(DocumentAudit $documentAudit): Response
    {
        return $this->render('document_audit/show.html.twig', [
            'document_audit' => $documentAudit,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_document_audit_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, DocumentAudit $documentAudit, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(DocumentAuditType::class, $documentAudit);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_document_audit_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('document_audit/edit.html.twig', [
            'document_audit' => $documentAudit,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_document_audit_delete', methods: ['POST'])]
    public function delete(Request $request, DocumentAudit $documentAudit, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$documentAudit->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($documentAudit);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_document_audit_index', [], Response::HTTP_SEE_OTHER);
    }
}
