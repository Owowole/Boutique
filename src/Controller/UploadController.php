<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class UploadController extends AbstractController
{
    #[Route('/admin/upload-image', name: 'admin_upload_image', methods: ['POST'])]
    public function uploadImage(Request $request): JsonResponse
    {
        /** @var UploadedFile|null $file */
        $file = $request->files->get('upload'); // IMPORTANT: 'upload' attendu par CKEditor

        if (!$file) {
            return $this->json(['error' => ['message' => 'No file uploaded']], 400);
        }

        $filename = uniqid().'.'.$file->guessExtension();
        $file->move($this->getParameter('kernel.project_dir').'/public/uploads/ckeditor', $filename);

        // CKEditor attend: { "url": "..." }
        return $this->json([
            'url' => '/uploads/ckeditor/'.$filename,
        ]);
    }
}
