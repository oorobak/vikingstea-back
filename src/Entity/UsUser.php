<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * UsUser
 *
 * @ORM\Table(name="us__User", uniqueConstraints={@ORM\UniqueConstraint(name="id_UNIQUE", columns={"id"})})
 * @ORM\Entity
 */
class UsUser implements UserInterface, \Serializable
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="login", type="string", length=45, nullable=false)
     */
    private $login;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=45, nullable=false)
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(name="password", type="string", length=64, nullable=false)
     */
    private $password;

    /**
     * @var string
     *
     * @ORM\Column(name="roles", type="string", length=64, nullable=false, options={"default"="ROLE_USER"})
     */
    private $roles = 'ROLE_USER';

    /**
     * @var bool
     *
     * @ORM\Column(name="isVerified", type="boolean", nullable=false)
     */
    private $isverified = '0';

    /**
     * @var bool
     *
     * @ORM\Column(name="isActive", type="boolean", nullable=false)
     */
    private $isactive = '0';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="regDate", type="datetime", nullable=false)
     */
    private $regdate;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="update", type="datetime", nullable=false)
     */
    private $update;

    /**
     * @var string|null
     *
     * @ORM\Column(name="apiKey", type="string", length=64, nullable=true)
     */
    private $apikey;



    /**
     * Get the value of id
     *
     * @return  int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Get the value of login
     *
     * @return  string
     */
    public function getLogin()
    {
        return $this->login;
    }

    /**
     * Set the value of login
     *
     * @param  string  $login
     *
     * @return  self
     */
    public function setLogin(string $login)
    {
        $this->login = $login;

        return $this;
    }

    /**
     * Get the value of password
     *
     * @return  string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set the value of password
     *
     * @param  string  $password
     *
     * @return  self
     */
    public function setPassword(string $password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Get the value of email
     *
     * @return  string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set the value of email
     *
     * @param  string  $email
     *
     * @return  self
     */
    public function setEmail(string $email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get the value of roles
     *
     * @return  string
     */
    public function getRoles()
    {
        $roles[] = $this->roles;
        if($this->roles !== 'ROLE_USER')
            $roles[] = 'ROLE_USER';

        return array_unique($roles);
        //return $this->roles;
    }

    /**
     * Set the value of roles
     *
     * @param  string  $roles
     *
     * @return  self
     */
    public function setRoles(string $roles)
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * Get the value of isverified
     *
     * @return  bool
     */
    public function getIsverified()
    {
        return $this->isverified;
    }

    /**
     * Set the value of isverified
     *
     * @param  bool  $isverified
     *
     * @return  self
     */
    public function setIsverified(bool $isverified)
    {
        $this->isverified = $isverified;

        return $this;
    }

    /**
     * Get the value of isactive
     *
     * @return  bool
     */
    public function getIsactive()
    {
        return $this->isactive;
    }

    /**
     * Set the value of isactive
     *
     * @param  bool  $isactive
     *
     * @return  self
     */
    public function setIsactive(bool $isactive)
    {
        $this->isactive = $isactive;

        return $this;
    }

    /**
     * Get the value of regdate
     *
     * @return  \DateTime
     */
    public function getRegdate()
    {
        return $this->regdate;
    }

    /**
     * Set the value of regdate
     *
     * @param  \DateTime  $regdate
     *
     * @return  self
     */
    public function setRegdate(\DateTime $regdate)
    {
        $this->regdate = $regdate;

        return $this;
    }

    /**
     * Get the value of update
     *
     * @return  \DateTime
     */
    public function getUpdate()
    {
        return $this->update;
    }

    /**
     * Set the value of update
     *
     * @param  \DateTime  $update
     *
     * @return  self
     */
    public function setUpdate(\DateTime $update)
    {
        $this->update = $update;

        return $this;
    }

    /**
     * Get the value of apikey
     *
     * @return  string|null
     */
    public function getApikey()
    {
        return $this->apikey;
    }

    /**
     * Set the value of apikey
     *
     * @param  string|null  $apikey
     *
     * @return  self
     */
    public function setApikey($apikey)
    {
        $this->apikey = $apikey;

        return $this;
    }

    public function getUsername()
    {
        return $this->login;
    }

    public function getSalt()
    {
        return null;
    }

    public function isEnabled()
    {
        return $this->isactive;
    }

    public function serialize()
    {
        return serialize(array(
            $this->id,
            $this->login,
            $this->email,
            $this->password,
            $this->apikey,
            $this->isactive
        ));
    }

    public function unserialize($serialized)
    {
        list (
            $this->id,
            $this->login,
            $this->email,
            $this->password,
            $this->apikey,
            $this->isactive
        ) = unserialize($serialized, array('allowed_classes' => false));
    }

    public function eraseCredentials()
    {
        return true;
    }
}
