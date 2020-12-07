<?php

namespace BibliothequeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
/**
 * Mytable
 *
 * @ORM\Table(name="mytable")
 * @ORM\Entity(repositoryClass="BibliothequeBundle\Repository\MytableRepository")
 * @Vich\Uploadable
 */
class Mytable
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idface", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idface;

    /**
     * @Vich\UploadableField(mapping="product_images", fileNameProperty="photo")
     * @var File
     */
    private $imageFile;

    /**
     * @var string
     *
     * @ORM\Column(name="reseau", type="string", length=30, nullable=false)
     */
    private $reseau;

    /**
     * @var string
     *
     * @ORM\Column(name="zone", type="string", length=30, nullable=false)
     */
    private $zone;

    /**
     * @var string
     *
     * @ORM\Column(name="region", type="string", length=30, nullable=false)
     */
    private $region;

    /**
     * @var string
     *
     * @ORM\Column(name="regie", type="string", length=30, nullable=false)
     */
    private $regie;

    /**
     * @var string
     *
     * @ORM\Column(name="support", type="string", length=30, nullable=false)
     */
    private $support;

    /**
     * @var string
     *
     * @ORM\Column(name="format", type="string", length=30, nullable=false)
     */
    private $format;

    /**
     * @var string
     *
     * @ORM\Column(name="type", type="string", length=30, nullable=false)
     */
    private $type;

    /**
     * @var string
     *
     * @ORM\Column(name="code_face", type="string", length=30, nullable=false)
     */
    private $codeFace;

    /**
     * @var string
     *
     * @ORM\Column(name="departement", type="string", length=29, nullable=false)
     */
    private $departement;

    /**
     * @var string
     *
     * @ORM\Column(name="X_panneau", type="decimal", precision=9, scale=6, nullable=false)
     */
    private $xPanneau;

    /**
     * @var string
     *
     * @ORM\Column(name="Y_panneau", type="decimal", precision=9, scale=6, nullable=false)
     */
    private $yPanneau;

    /**
     * @var string
     *
     * @ORM\Column(name="adresse", type="string", length=50, nullable=false)
     */
    private $adresse;

    /**
     * @var string
     *
     * @ORM\Column(name="emplacement", type="string", length=78, nullable=false)
     */
    private $emplacement;

    /**
     * @var string
     *
     * @ORM\Column(name="traffic_routier_2017", type="string", length=30, nullable=false)
     */
    private $trafficRoutier2017;

    /**
     * @var string
     *
     * @ORM\Column(name="map", type="string", length=30, nullable=false)
     */
    private $map;

    /**
     * @var string
     *
     * @ORM\Column(name="photo", type="string", length=255, nullable=true)
     */
    private $photo;

    public function setImageFile(File $image = null)
    {
        $this->imageFile = $image;

        // VERY IMPORTANT:
        // It is required that at least one field changes if you are using Doctrine,
        // otherwise the event listeners won't be called and the file is lost
        if ($image) {
            // if 'updatedAt' is not defined in your entity, use another property
            $this->updatedAt = new \DateTime('now');
        }
    }

    public function getImageFile()
    {
        return $this->imageFile;
    }

    /**
     * @return int
     */
    public function getIdface()
    {
        return $this->idface;
    }

    /**
     * @param int $idface
     */
    public function setIdface($idface)
    {
        $this->idface = $idface;
    }

    /**
     * @return string
     */
    public function getReseau()
    {
        return $this->reseau;
    }

    /**
     * @param string $reseau
     */
    public function setReseau($reseau)
    {
        $this->reseau = $reseau;
    }

    /**
     * @return string
     */
    public function getZone()
    {
        return $this->zone;
    }

    /**
     * @param string $zone
     */
    public function setZone($zone)
    {
        $this->zone = $zone;
    }

    /**
     * @return string
     */
    public function getRegion()
    {
        return $this->region;
    }

    /**
     * @param string $region
     */
    public function setRegion($region)
    {
        $this->region = $region;
    }

    /**
     * @return string
     */
    public function getRegie()
    {
        return $this->regie;
    }

    /**
     * @param string $regie
     */
    public function setRegie($regie)
    {
        $this->regie = $regie;
    }

    /**
     * @return string
     */
    public function getSupport()
    {
        return $this->support;
    }

    /**
     * @param string $support
     */
    public function setSupport($support)
    {
        $this->support = $support;
    }

    /**
     * @return string
     */
    public function getFormat()
    {
        return $this->format;
    }

    /**
     * @param string $format
     */
    public function setFormat($format)
    {
        $this->format = $format;
    }

    /**
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param string $type
     */
    public function setType($type)
    {
        $this->type = $type;
    }

    /**
     * @return string
     */
    public function getCodeFace()
    {
        return $this->codeFace;
    }

    /**
     * @param string $codeFace
     */
    public function setCodeFace($codeFace)
    {
        $this->codeFace = $codeFace;
    }

    /**
     * @return string
     */
    public function getDepartement()
    {
        return $this->departement;
    }

    /**
     * @param string $departement
     */
    public function setDepartement($departement)
    {
        $this->departement = $departement;
    }

    /**
     * @return string
     */
    public function getXPanneau()
    {
        return $this->xPanneau;
    }

    /**
     * @param string $xPanneau
     */
    public function setXPanneau($xPanneau)
    {
        $this->xPanneau = $xPanneau;
    }

    /**
     * @return string
     */
    public function getYPanneau()
    {
        return $this->yPanneau;
    }

    /**
     * @param string $yPanneau
     */
    public function setYPanneau($yPanneau)
    {
        $this->yPanneau = $yPanneau;
    }

    /**
     * @return string
     */
    public function getAdresse()
    {
        return $this->adresse;
    }

    /**
     * @param string $adresse
     */
    public function setAdresse($adresse)
    {
        $this->adresse = $adresse;
    }

    /**
     * @return string
     */
    public function getEmplacement()
    {
        return $this->emplacement;
    }

    /**
     * @param string $emplacement
     */
    public function setEmplacement($emplacement)
    {
        $this->emplacement = $emplacement;
    }

    /**
     * @return string
     */
    public function getTrafficRoutier2017()
    {
        return $this->trafficRoutier2017;
    }

    /**
     * @param string $trafficRoutier2017
     */
    public function setTrafficRoutier2017($trafficRoutier2017)
    {
        $this->trafficRoutier2017 = $trafficRoutier2017;
    }

    /**
     * @return string
     */
    public function getMap()
    {
        return $this->map;
    }

    /**
     * @param string $map
     */
    public function setMap($map)
    {
        $this->map = $map;
    }

    /**
     * @return string
     */
    public function getPhoto()
    {
        return $this->photo;
    }

    /**
     * @param string $photo
     */
    public function setPhoto($photo)
    {
        $this->photo = $photo;
    }


}

