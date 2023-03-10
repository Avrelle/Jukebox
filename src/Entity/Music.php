<?php

namespace App\Entity;

use App\Repository\MusicRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
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
    private ?string $imgSong = null;

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

    #[ORM\ManyToMany(targetEntity: User::class, inversedBy: 'favoris')]
    private Collection $favoris;

    public function __construct()
    {
        $this->favoris = new ArrayCollection();
    }

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
        return $this->imgSong;
    }

    public function setImgSong(string $imgSong): self
    {
        $this->imgSong = $imgSong;

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

    /**
     * @return Collection<int, User>
     */
    public function getFavoris(): Collection
    {
        return $this->favoris;
    }

    public function addFavori(User $favori): self
    {
        if (!$this->favoris->contains($favori)) {
            $this->favoris->add($favori);
        }

        return $this;
    }

    public function removeFavori(User $favori): self
    {
        $this->favoris->removeElement($favori);

        return $this;
    }


 
}
?>