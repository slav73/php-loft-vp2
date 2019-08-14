<?php
namespace App\Model;

class User
{
    private $_id;
    private $_name;
    private $_email;
    private $_passwordHash;

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->_email;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email): void
    {
        $this->_email = $email;
    }

    /**
     * @return mixed
     */
    public function getPasswordHash()
    {
        return $this->_passwordHash;
    }

    /**
     * @param mixed $passwordHash
     */
    public function setPasswordHash($passwordHash): void
    {
        $this->_passwordHash = $passwordHash;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->_id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id): void
    {
        $this->_id = $id;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->_name;
    }

    public function save()
    {
        $db = \Base\Context::i()->getDb();
        $ret = $db->exec(
            "INSERT INTO users (`name`, email, password) VALUES (:name, :email, :pass)",
            __METHOD__,
            ['name' => $this->_name, 'email' => $this->_email, 'pass' => $this->_passwordHash]
        );
        if (!$ret) {
            return false;
        }
        $id = $db->lastInsertId();
        $this->_id = $id;
        return true;
    }

    public function get(int $id)
    {
        $db = \Base\Context::i()->getDb();
        $data = $db->fetchOne("SELECT * FROM users WHERE id = :id", __METHOD__, ['id' => $id]);
        if ($data) {
            $this->loadData($data);
            return true;
        }

        return false;
    }

    public function loadData(array $data, $new = false)
    {
        if (isset($data['id'])) {
            $this->_id = $data['id'];
        }
        $this->_name = $data['name'];
        if ($new) {
            $this->_passwordHash = self::genPasswordHash($data['password']);
        } else {
            $this->_passwordHash = $data['password'];
        }
        $this->_email = $data['email'];
    }

    public static function getList(array $ids)
    {
        $db = \Base\Context::i()->getDb();
        foreach ($ids as &$id) {
            $id = (int)$id;
        }
        $idsStr =  implode(',', $ids);
        $data = $db->fetchAll(
            "SELECT * FROM users WHERE id IN($idsStr)",
            __METHOD__
        );
        if (!$data) {
            return [];
        }

        $res = [];
        foreach ($data as $elem) {
            $model = new self();
            $model->loadData($elem);
            $res[$model->getId()] = $model;
        }

        return $res;
    }

    /**
     * @param mixed $name
     */
    public function setName($name): void
    {
        $this->_name = $name;
    }

    public static function genPasswordHash(string $password)
    {
        return sha1($password . 'd,.speu48sk');
    }

    public function check(&$error = '')
    {
        if (!$this->_name) {
            $error = 'empty name';
            return false;
        }

        return true;
    }
}