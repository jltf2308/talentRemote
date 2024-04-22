<?php

namespace App\Models;

use CodeIgniter\Model;

class Person extends Model
{
    protected $table = 'people';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $returnType = 'array';
    protected $useSoftDeletes = false;
    protected $protectFields = true;
    protected $allowedFields = [
        'first_name',
        'last_name',
        'type_person'
    ];

    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;

    protected array $casts = [];
    protected array $castHandlers = [];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat = 'datetime';
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
    protected $deletedField = 'deleted_at';

    // Validation
    protected $validationRules = [];
    protected $validationMessages = [];
    protected $skipValidation = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert = [];
    protected $afterInsert = [];
    protected $beforeUpdate = [];
    protected $afterUpdate = [];
    protected $beforeFind = [];
    protected $afterFind = [];
    protected $beforeDelete = [];
    protected $afterDelete = [];

    public function obtenerPerfil($username)
    {
        $db = $this->db;

        $sql = 'SELECT *
                FROM people p
                JOIN users u ON u.person_id = p.id
                WHERE u.email = ?';

        $query = $db->query($sql, [$username]);

        if ($query->getNumRows() > 0) {
            $usuario = $query->getRowArray();
            return $usuario;
        } else {
            return null;
        }
    }
}
