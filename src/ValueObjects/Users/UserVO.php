<?php
/**
 * notifyapp - UserVO.php
 *
 * Initial version by: Toamsz Solik
 * Initial version created on: 11.06.20 / 09:52
 */

namespace App\ValueObjects\Users;

use App\Repository\Users\UsersRepository;

class UserVO
{
    private $role;
    private $email;
    private $username;
    private $password;
    private $salt;
    private $createdAt;
    private $updatedAt;
    private $blocked;
    private $test;
    private $ghost;

    /**
     * UserVO constructor.
     * @param int $role
     * @param string $email
     * @param string $username
     * @param string $password
     * @param string $salt
     * @param \DateTime|null $createdAt
     * @param \DateTime|null $updatedAt
     * @param bool $blocked
     * @param bool $test
     * @param bool $ghost
     */
    public function __construct(
        int $role = UsersRepository::ROLE_USER,
        string $email = '',
        string $username = '',
        string $password = '',
        string $salt = '',
        \DateTime $createdAt = null,
        \DateTime $updatedAt = null,
        bool $blocked = false,
        bool $test = false,
        bool $ghost = false
    ) {
        $this->role = $role;
        $this->email = $email;
        $this->username = $username;
        $this->password = $password;
        $this->salt = $salt;
        $this->createdAt = $createdAt;
        $this->updatedAt = $updatedAt;
        $this->blocked = $blocked;
        $this->test = $test;
        $this->ghost = $ghost;
    }

    /**
     * @return int|int
     */
    public function getRole()
    {
        return $this->role;
    }

    /**
     * @param int|int $role
     */
    public function setRole($role)
    {
        $this->role = $role;
    }

    /**
     * @return string|string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param string|string $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * @return string|string
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @param string|string $username
     */
    public function setUsername($username)
    {
        $this->username = $username;
    }

    /**
     * @return string|string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param string|string $password
     */
    public function setPassword($password)
    {
        $this->password = $password;
    }

    /**
     * @return string|string
     */
    public function getSalt()
    {
        return $this->salt;
    }

    /**
     * @param string|string $salt
     */
    public function setSalt($salt)
    {
        $this->salt = $salt;
    }

    /**
     * @return \DateTime|null
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * @param \DateTime|null $createdAt
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;
    }

    /**
     * @return \DateTime|null
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * @param \DateTime|null $updatedAt
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;
    }

    /**
     * @return bool|bool
     */
    public function getBlocked()
    {
        return $this->blocked;
    }

    /**
     * @param bool|bool $blocked
     */
    public function setBlocked($blocked)
    {
        $this->blocked = $blocked;
    }

    /**
     * @return bool|bool
     */
    public function getTest()
    {
        return $this->test;
    }

    /**
     * @param bool|bool $test
     */
    public function setTest($test)
    {
        $this->test = $test;
    }

    /**
     * @return bool|bool
     */
    public function getGhost()
    {
        return $this->ghost;
    }

    /**
     * @param bool|bool $ghost
     */
    public function setGhost($ghost)
    {
        $this->ghost = $ghost;
    }
}