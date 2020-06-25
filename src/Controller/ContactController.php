<?php

namespace App\Controller;

use App\Entity\MetaTags;
use App\Form\ContactType;
use App\Service\UploaderHelper;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * @Route("/{_locale}/contact")
 */
class ContactController extends AbstractController
{
    private $session;

    public function __construct(SessionInterface $session)
    {
        $this->session = $session;
    }

    /**
     * @Route("/", name="contact_index", methods={"GET", "POST"})
     */
    public function index(Request $request)
    {
        $message = null;
        if($this->session->has('message')){
            $message = $this->session->get('message');
        }
        $em = $this->getDoctrine()->getManager();
        $metaTagsRepository = $em->getRepository(MetaTags::class);
        $metaTags = $metaTagsRepository->metaTag('contact');
        $url = $this->generateUrl('mail_index');
        $form = $this->createForm(ContactType::class,null,[
            // To set the action use $this->generateUrl('route_identifier')
            'action' => $url,
            'method' => 'POST'
        ]);
        $this->session->clear();
        return $this->render('contact/index.html.twig', [
            'form' => $form->createView(),
            'metaTags' => $metaTags,
            'message' => $message,
        ]);
    }

    /**
     * @Route("/mail", name="mail_index", methods="POST")
     */
    public function mail(Request $request, UploaderHelper $uploaderHelper)
    {
        $form = $this->createForm(ContactType::class);
        $message = 'Письмо не отправлено.';

        if ($request->isMethod('POST')) {
            $form->handleRequest($request);
            $newFilename = [];
            if ($form['file']->getData()) {
                $uploadedFiles = $form['file']->getData();
                    foreach ( $uploadedFiles as $uploadedFile) {
                        $newFilename[] = $uploaderHelper->uploadMailImg($uploadedFile);
                    }
//                dump($newFilename);
            }
            if($form->isValid()){
                if($this->sendEmail($form->getData(), $newFilename)){
                    $message = 'Письмо отправлено.';
                }
            }
        }
        if (($request->isMethod('GET'))){
//            $message = '';
        }

//        return $this->render('contact/mail.html.twig',[
//            'message' => $message,
//        ]);
        $this->session->set('message', $message);
//        return new JsonResponse($message);
        return $this->redirectToRoute('contact_index', [],307);
//        return $this->forward('App\Controller\ContactController::index', ['message' => $message]);
    }

    private function sendEmail($data, $filenames){
        $filesystem = new Filesystem();
        $data['img'] = '';
        $fileUrls = [];
        $EOL = "\r\n";
        $boundary = "--".md5(uniqid(time()));
        if ($filenames){
            foreach ($filenames as $filename) {
                $fileUrl = $filename['targetDir'] . '/' . $filename['newFilename'];
                $fileUrls [] = $fileUrl;
                $name = $filename['newFilename'];
                $filetype = $filename['fileType'];
                $fp = fopen($fileUrl, "r");
                $dataImg = fread($fp, filesize($fileUrl));
                fclose($fp);
                $dataImg = chunk_split(base64_encode($dataImg));
                $data['img'] .= "$EOL--$boundary$EOL";
                $data['img'] .= "Content-Disposition: attachment; filename=\"$name\"$EOL";
                $data['img'] .= "Content-Type: $filetype; name=\"$name\"$EOL";
                $data['img'] .= "Content-Transfer-Encoding: base64$EOL";
                $data['img'] .= $EOL;
                $data['img'] .= $dataImg;
            }
        }
//        dump($data['img']);
        $to = "info@iqdev.com, rivgen@gmail.com";
        $tema = "Форма обратной связи на PHP";
        $message = "Ваше имя: ".$data['name']."<br>";
        $message .= "E-mail: ".$data['email']."<br>";
        $message .= "Сообщение: ".$data['message']."<br>";
        $message .= $data['img']."<br>";
        $headers  = 'MIME-Version: 1.0' . $EOL;
        $headers .= 'Content-type: text/html; charset=utf-8' . $EOL;
        $mail = mail($to, $tema, $message, $headers );
        if ($mail) {
            foreach ($fileUrls as $fileUrl) {
                $filesystem->remove($fileUrl);
            }
            return true;
        } else {return false;}
    }

}