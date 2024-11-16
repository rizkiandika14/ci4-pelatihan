<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AccessTrainingRequirement extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'training_id' => [
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => true,
            ],
            'requirement_id' => [
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => true,
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('training_id', 'trainings', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('requirement_id', 'requirements', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('access_training_requirements');
    }

    public function down()
    {
        $this->forge->dropTable('access_training_requirements');
    }
}
