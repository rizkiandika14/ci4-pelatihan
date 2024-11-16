<?php

namespace App\Models;

use CodeIgniter\Model;

class AccessTrainingRequirementModel extends Model
{
    protected $table            = 'access_training_requirements';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'object';
    protected $protectFields    = true;
    protected $allowedFields    = ['training_id', 'requirement_id'];
    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

}
