<?php

use Phalcon\Mvc\Model;
use Phalcon\Paginator\Adapter\Model as Paginator;

class Noticia extends Model
{
    public $id;
    public $titulo;
    public $texto;
    public $categoria;
    public $data_cadastro;
    public $data_ultima_atualizacao;
    public $data_publicacao;
    public $publicado;

    public function initialize()
    {
        $this->setSource("noticia");
    }

    public function setDataCadastro($dataCadastro)
    {
        $this->data_cadastro = $dataCadastro;
        return $this;
    }

    public function getDataCadastro()
    {
        return $this->data_cadastro;
    }

    public function setDataUltimaAtualizacao($dataUltimaAtualizacao)
    {
        $this->data_ultima_atualizacao = $dataUltimaAtualizacao;
        return $this;
    }

    public function getDataUltimaAtualizacao()
    {
        return $this->data_ultima_atualizacao;
    }

    public function setCategoria($categorias)
    {
        $this->categoria = $categorias;
        return $this;
    }

    public function getCategoria()
    {
        return $categoria;
    }

    public function setDataPublicacao($dataPublicacao)
    {
        $this->data_publicacao = $dataPublicacao;
        return $this;
    }

    public function getDataPublicacao()
    {
        return $this->data_publicacao;
    }

    public function setPublicado($publicado)
    {
        $this->publicado = $publicado;
        return $this;
    }

    public function getPublicado()
    {
        return $this->publicado;
    }

    
}