<?php



use Phalcon\Mvc\Model;
use Phalcon\Paginator\Adapter\Model as Paginator;

class Noticia extends Model
{
    public $id;
    public $titulo;
    public $texto;

    public function initialize()
    {
        $this->setSource("noticia");
    }

    
}