<?php

namespace App\Controller;

use App\Form\ContactType;
use App\Service\UploaderHelper;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/contact")
 */
class ContactController extends AbstractController
{
    /**
     * @Route("/", name="contact_index", methods="GET")
     */
    public function index()
    {
        $url = $this->generateUrl('mail_index');
        $form = $this->createForm(ContactType::class,null,[
            // To set the action use $this->generateUrl('route_identifier')
            'action' => $url,
            'method' => 'POST'
        ]);
        return $this->render('contact/index.html.twig', [
            'form' => $form->createView()
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
            $newFilename = '';
            if ($form['file']->getData()) {
                $uploadedFile = $form['file']->getData();
                $newFilename = $uploaderHelper->uploadMailImg($uploadedFile);
            }
            if($form->isValid()){
                if($this->sendEmail($form->getData(), $newFilename)){
                    $message = 'Письмо отправлено.';
                }
            }
        }
        if (($request->isMethod('GET'))){
            $message = '';
        }

        return $this->render('contact/mail.html.twig',[
            'message' => $message,
        ]);
    }

    private function sendEmail($data, $filename){
        $filesystem = new Filesystem();
        $data['img'] = '';
        $fileUrl = $filename['targetDir'].'/'.$filename['newFilename'];
        if ($filename){

            $fp =    fopen($fileUrl,"r");
            $data['img'] =  fread($fp,filesize($fileUrl));
            fclose($fp);
            $data['img'] = chunk_split(base64_encode($data['img']));
        }
        $to = "rivgen@gmail.com";
        $tema = "Форма обратной связи на PHP";
        $message = "Ваше имя: ".$data['name']."<br>";
        $message .= "E-mail: ".$data['email']."<br>";
        $message .= "Сообщение: ".$data['message']."<br>";
        $message .= $data['img']."<br>";
        $headers  = 'MIME-Version: 1.0' . "\r\n";
        $headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";
        $mail = mail($to, $tema, $message, $headers );
        if ($mail) {
            $filesystem->remove($fileUrl);
            return true;
        } else {return false;}
    }

}