<?php

namespace App\Models;

use CodeIgniter\Model;
use Faker\Generator;
use Myth\Auth\Authorization\GroupModel;
use App\Entities\User;

/**
 * @method User|null first()
 */
class UserModel extends Model
{
    protected $table = 'users';
    protected $primaryKey = 'id';
    protected $returnType = 'App\Entities\User';
    protected $useSoftDeletes = true;
    protected $allowedFields = [
        'email',
        'username',
        'name',
        'phone',
        'address',
        'password_hash',
        'reset_hash',
        'reset_at',
        'reset_expires',
        'activate_hash',
        'status',
        'status_message',
        'active',
        'force_pass_reset',
        'permissions',
        'deleted_at',
    ];
    protected $useTimestamps = true;
    protected $validationRules = [
        'id' => 'permit_empty',
        'email' => 'required|valid_email|is_unique[users.email,id,{id}]',
        'username' => 'required|alpha_numeric_punct|min_length[3]|max_length[30]|is_unique[users.username,id,{id}]',
        'password_hash' => 'required',
    ];
    protected $validationMessages = [];
    protected $skipValidation = false;
    protected $afterInsert = ['addToGroup'];




    public function countDonatur()
    {
        return $this->db->table('auth_groups_users')->where('group_id', 2)->countAllResults();
    }

    public function findDonatur()
    {
        return $this->select('users.name,users.created_at, users.address, SUM(donasi.nominal) as total')
            ->join('auth_groups_users', 'auth_groups_users.user_id = users.id')
            ->where('auth_groups_users.group_id', 2)
            ->join('donasi', 'donasi.id_donatur = users.id', 'left')
            ->groupBy('users.id')
            ->findAll();
    }

    //menapilahkan jumlah user
    public function getJumlahUser()
    {
        return $this->countAll(); // Menghitung semua baris di tabel user
    }

    /**
     * The id of a group to assign.
     * Set internally by withGroup.
     *
     * @var int|null
     */
    protected $assignGroup;

    /**
     * Logs a password reset attempt for posterity sake.
     */
    public function logResetAttempt(string $email, ?string $token = null, ?string $ipAddress = null, ?string $userAgent = null)
    {
        $this->db->table('auth_reset_attempts')->insert([
            'email' => $email,
            'ip_address' => $ipAddress,
            'user_agent' => $userAgent,
            'token' => $token,
            'created_at' => date('Y-m-d H:i:s'),
        ]);
    }

    /**
     * Logs an activation attempt for posterity sake.
     */
    public function logActivationAttempt(?string $token = null, ?string $ipAddress = null, ?string $userAgent = null)
    {
        $this->db->table('auth_activation_attempts')->insert([
            'ip_address' => $ipAddress,
            'user_agent' => $userAgent,
            'token' => $token,
            'created_at' => date('Y-m-d H:i:s'),
        ]);
    }

    /**
     * Sets the group to assign any users created.
     *
     * @return $this
     */
    public function withGroup(string $groupName)
    {
        $group = $this->db->table('auth_groups')->where('name', $groupName)->get()->getFirstRow();

        $this->assignGroup = $group->id;

        return $this;
    }

    /**
     * Clears the group to assign to newly created users.
     *
     * @return $this
     */
    public function clearGroup()
    {
        $this->assignGroup = null;

        return $this;
    }

    /**
     * If a default role is assigned in Config\Auth, will
     * add this user to that group. Will do nothing
     * if the group cannot be found.
     *
     * @param mixed $data
     *
     * @return mixed
     */
    protected function addToGroup($data)
    {
        if (is_numeric($this->assignGroup)) {
            $groupModel = model(GroupModel::class);
            $groupModel->addUserToGroup($data['id'], $this->assignGroup);
        }

        return $data;
    }

    /**
     * Faked data for Fabricator.
     */
    public function fake(Generator &$faker): User
    {
        return new User([
            'email' => $faker->email,
            'name' => $faker->name,
            'username' => $faker->userName,
            'password' => bin2hex(random_bytes(16)),
        ]);
    }
  
}
