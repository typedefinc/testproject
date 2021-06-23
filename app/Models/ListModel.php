<?php

namespace App\Models;

use App\Base\Model;

class ListModel extends Model
{

    public $author;
    public $start;
    public $end;

    public function getData()
    {
        return Model::get('vacation')->fetchAll(\PDO::FETCH_CLASS);
    }
    public function save()
    {
        Model::set('vacation', ['author' => $this->author,'start' => $this->start,'end' => $this->end]);
    }
    public static function editCheck($id)
    {
        if ($id) {
            Model::edit("vacation", $id);
        }
    }
}
