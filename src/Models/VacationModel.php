<?php

namespace App\Models;

use App\Model;

class VacationModel extends Model
{

    public $author;
    public $start;
    public $end;

    private $table = 'vacation';

    public function getData()
    {
        return $this->get($this->table)->fetchAll(\PDO::FETCH_CLASS);
    }

    public function save()
    {
        $this->insert($this->table, ['author' => $this->author,'start' => $this->start,'end' => $this->end]);
    }

    public function editCheck($id)
    {
        if ($id) {
            $this->update($this->table, $id);
        }
    }
}
