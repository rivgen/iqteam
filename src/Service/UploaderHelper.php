<?php

namespace App\Service;

use Symfony\Component\HttpFoundation\File\UploadedFile;
use Gedmo\Sluggable\Util\Urlizer;

class UploaderHelper
{
    const ARTICLE_IMAGE = '/images/articles/';

    private $uploadsPath = '/public';

    public function __construct(string $uploadsPath)
    {
        $this->uploadsPath = $uploadsPath;
    }

    public function uploadIcon(UploadedFile $uploadedFile, $id): string
    {
        $destination = $this->uploadsPath .'/public'. self::ARTICLE_IMAGE . $id . '/';
//        dd($destination);
        $originalFilename = pathinfo($uploadedFile->getClientOriginalName(), PATHINFO_FILENAME);
        $newFilename = Urlizer::urlize($originalFilename) . '.' . $uploadedFile->guessExtension();
        $uploadedFile->move(
            $destination,
            $newFilename
        );

        return $newFilename;
    }

    public function getPublicPath($id, $imgName): string
    {
        return UploaderHelper::ARTICLE_IMAGE.$id.'/'.$imgName;
    }
}