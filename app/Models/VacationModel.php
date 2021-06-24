<?php

namespace App\Models;

use App\Base\Model;

class VacationModel extends Model
{

    public $author;
    public $start;
    public $end;

    public function getData()
    {
        return $this->get('vacation')->fetchAll(\PDO::FETCH_CLASS);
    }

    public function save()
    {
        $this->insert('vacation', ['author' => $this->author,'start' => $this->start,'end' => $this->end]);
    }

    public function editCheck($id)
    {
        if ($id) {
            $this->update("vacation", $id);
        }
    }

}
