<?php

namespace Nidiap\BlogBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * Arquivo
 *
 * @ORM\Table(name="arquivo")
 * @ORM\Entity(repositoryClass="Nidiap\BlogBundle\Repository\ArquivoRepository")
 * @Vich\Uploadable
 */
class Arquivo
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * NOTE: This is not a mapped field of entity metadata, just a simple property.
     *
     * @Vich\UploadableField(mapping="arquivo_d", fileNameProperty="arquivoName")
     *
     * @var File
     */
    private $arquivoFile;

    /**
     * @ORM\Column(type="string", length=255)
     *
     * @var string
     */
    private $arquivoName;


    /**
     * @ORM\Column(type="datetime")
     *
     * @var \DateTime
     */
    private $updatedAt;



    /**
     * Get id.
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * If manually uploading a file (i.e. not using Symfony Form) ensure an instance
     * of 'UploadedFile' is injected into this setter to trigger the update. If this
     * bundle's configuration parameter 'inject_on_load' is set to 'true' this setter
     * must be able to accept an instance of 'File' as the bundle will inject one here
     * during Doctrine hydration.
     *
     * @param File|\Symfony\Component\HttpFoundation\File\UploadedFile $arquivoFile
     */
    public function setArquivoFile(?File $arquivoFile = null): void
    {
        $this->arquivoFile = $arquivoFile;

        if (null !== $arquivoFile) {
            // It is required that at least one field changes if you are using doctrine
            // otherwise the event listeners won't be called and the file is lost
            $this->updatedAt = new \DateTimeImmutable();
        }
    }

    public function getArquivoFile(): ?File
    {
        return $this->arquivoFile;
    }

    public function setArquivoName(?string $arquivoName): void
    {
        $this->arquivoName = $arquivoName;
    }

    public function getArquivoName(): ?string
    {
        return $this->arquivoName;
    }

}
