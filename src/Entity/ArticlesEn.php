<?php

namespace App\Entity;

class ArticlesEn
{
    /**
     * @var string
     *
     * @ORM\Column(name="title_en", type="string", length=250, nullable=true)
     */
    private $titleEn;

    /**
     * @var string|null
     *
     * @ORM\Column(name="text_preview_en", type="text", length=16777215, nullable=true)
     */
    private $textPreviewEn;

    /**
     * @var string|null
     *
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Assert\Length(
     *      max = 255,
     *      maxMessage = "Поле заполнено более чем на {{ limit }} символов")
     */
    private $fullTitleEn;

    /**
     * @var string|null
     *
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Assert\Length(
     *      max = 255,
     *      maxMessage = "Поле заполнено более чем на {{ limit }} символов")
     */
    private $clientEn;

    /**
     * @var string|null
     *
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Assert\Length(
     *      max = 255,
     *      maxMessage = "Поле заполнено более чем на {{ limit }} символов")
     */
    private $technologyEn;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $descriptionEn;

    /**
     * @ORM\Column(type="string", length=80, nullable=true)
     * @Assert\Length(
     *      max = 80,
     *      maxMessage = "Поле заполнено более чем на {{ limit }} символов")
     */
    private $metaTitleEn;

    /**
     * @ORM\Column(type="string", length=180, nullable=true)
     * @Assert\Length(
     *      max = 180,
     *      maxMessage = "Поле заполнено более чем на {{ limit }} символов")
     */
    private $metaDescriptionEn;

}
