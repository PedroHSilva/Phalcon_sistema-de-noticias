<?php 

namespace App\Forms;

use Phalcon\Forms\Element\Text;
use Phalcon\Forms\Form;
use Phalcon\Validation\Validator\PresenceOf;
use Phalcon\Validation\Validator\StringLength;
use Phalcon\Forms\Element\TextArea;
use Phalcon\Forms\Element\Hidden;

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

        
    }
}