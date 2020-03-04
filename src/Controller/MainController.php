<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

use App\Entity\GalleryImage;

class MainController extends AbstractController
{
    /**
     * @Route("/", name="index")
     */
    public function index()
    {
        $galleryImages = $this->getDoctrine()->getRepository(GalleryImage::class)->findAll();
        return $this->render('main/index.html.twig', [
            'galleryImages' => $galleryImages
        ]);
    }

    /**
    * @Route("/upload", name="upload")
    */
    public function upload(Request $request)
    {
        if ($request->isXMLHttpRequest()){
            $entityManager = $this->getDoctrine()->getManager();

            $galleryImage = new GalleryImage();

            $file = $request->files->get('image');
            // $file is an UploadedFile - https://github.com/symfony/symfony/blob/2.8/src/Symfony/Component/HttpFoundation/File/UploadedFile.php

            // Check valid extensions
            $valid_extensions = array("jpg","jpeg","png");
            $fileExtension = $file->guessExtension();
            if (!in_array($fileExtension,$valid_extensions)) {
                return new JsonResponse(array('error' => 'Invalid image type'));
            }


            $fileName = md5(uniqid()).'.'.$fileExtension;
            $size = getimagesize($file);
            $aliases = $file->getClientOriginalName();

            $galleryImage->setAliases($aliases);

            $file->move($this->getParameter('upload_dir'), $fileName);

            $galleryImage->setName($fileName);

            $galleryImage->setIdGallery(0);

            $galleryImage->setLastUpdate(new \Datetime());

            list($height, $width) = $size;
            $galleryImage->setHeight($height);
            $galleryImage->setWidth($width);

            $entityManager->persist($galleryImage);
            $entityManager->flush();

            return new JsonResponse(array(
                'error' => 'none',
                'id' => $galleryImage->getId(),
                'name' => $fileName,
                'aliases' => $aliases,
                'height' => $height,
                'width' => $width)
            );
        }

        return new JsonResponse(array('error' => 'Request type problem'));
    }

    /**
     * @Route("/delete", name="delete")
     */
    public function delete(Request $request)
    {
        $entityManager = $this->getDoctrine()->getManager();

        $id = $request->request->get('id');

        $galleryImage = $entityManager->getRepository(GalleryImage::class)->find($id);

        $entityManager->remove($galleryImage);
        $entityManager->flush();

        return new JsonResponse(array('error' => 'none', 'aliases' => $galleryImage->getAliases()));
    }

}
