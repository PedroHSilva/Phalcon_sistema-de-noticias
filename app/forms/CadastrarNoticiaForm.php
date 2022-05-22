<?php

namespace App\Forms;

use Phalcon\Forms\Element\Hidden;
use Phalcon\Forms\Element\Text;
use Phalcon\Forms\Element\TextArea;
use Phalcon\Forms\Element\Select;
use Phalcon\Forms\Element\Date;
use Phalcon\Forms\Element\Check;
use Phalcon\Forms\Form;
use Phalcon\Validation\Validator\PresenceOf;
use Phalcon\Validation\Validator\StringLength;
use Phalcon\Validation\Validator\Identical;

class CadastrarNoticiaForm extends Form
{
    public function initialize()
    {
        //Campo titulo da noticia
        $titulo = new Text('titulo');

        $titulo->addValidator(new PresenceOf([
            'message' => 'O Campo título é obrigatório',
        ]));

        $titulo->addValidator(new StringLength([
            'max' => 255,
            'messageMaximum' => 'O campo titulo deve ter no máximo 255 caracteres',
        ]));

        $titulo->setAttribute('width', '100%');
        $titulo->setAttribute('class', 'form-control');
        $this->add($titulo);

        //Campo Texto da noticia
        $texto = new TextArea('texto');
        $texto->setAttribute('class', 'form-control tinymce-editor');
        $this->add($texto);

        //id
        $id = new Hidden('id');
        $this->add($id);

        //Categorias
        $categorias = new Select(
            'categorias[]',
            [
                'Finanças'      => 'Finanças', 
                'Tecnologia'    => 'Tecnologia', 
                'Saúde'         => 'Saúde', 
                'Esporte'       => 'Esporte', 
                'Política'      => 'Política',
            ],
            [
                'multiple' => true,
                'class' => 'form-control',
            ]
        );
        $this->add($categorias);

        // checkbox publicado
        $publicado = new Check('publicado', ['value' => '1']);
        $publicado->setDefault('0');
        $publicado->addFilter('bool');
        $publicado->setAttribute('id', 'publicado');
        $publicado->setAttribute('onclick', 'check_publicado(publicado)');
        $this->add($publicado);

        $data_publicacao = new Date('data_publicacao');
        $data_publicacao->setAttribute('class', 'form-control');
        $this->add($data_publicacao);

        $csrf = new Hidden('csrf');
        $csrf->addValidator(new Identical([
            'value'     => $this->security->getSessionToken(),
            'message'   => 'Acesso não autorizado',
        ]));
        $this->add($csrf);
    }
}
