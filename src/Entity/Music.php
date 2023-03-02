<?php

namespace App\Entity;

use App\Repository\MusicRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\File\UploadedFile ;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

#[ORM\Entity(repositoryClass: MusicRepository::class)]
#[vich\Uploadable]
class Music
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $title = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $link = null;

    #[ORM\ManyToOne(inversedBy: 'music')]
    private ?Category $category = null;

    #[ORM\Column(length: 255)]
    private ?string $img_song = null;

    /**
     * @Vich\UploadableField(mapping="music", fileNameProperty="image")
     * @var File
     */
    private $imageFile;
     /**
     * @Vich\UploadableField(mapping="music", fileNameProperty="song")
     * @var File
     */
    private $songFile;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getLink(): ?string
    {
        return $this->link;
    }

    public function setLink(string $link): self
    {
        $this->link = $link;

        return $this;
    }
    /**
    * @return File|null
    */
    public function getSongFile(): ?File
    {
        return $this->songFile;
    }
    
    /**
    * @return File|null $songFile
    */
    public function setSongFile(?File $songFile= null )
    {
         $this->songFile = $songFile;
    }

    public function getCategory(): ?Category
    {
       
        return $this->category;
    }

    public function setCategory(?Category $category): self
    {
        $this->category = $category;

        return $this;
    }

    public function getImgSong(): ?string
    {
        return $this->img_song;
    }

    public function setImgSong(string $img_song): self
    {
        $this->img_song = $img_song;

        return $this;
    }

    /**
    * @return File|null
    */
    public function getImageFile(): ?File
    {
        return $this->imageFile;
    }
    
    /**
    * @return File|null $imageFile
    */
    public function setImageFile(?File $imageFile= null )
    {
         $this->imageFile = $imageFile;
    }


 
}