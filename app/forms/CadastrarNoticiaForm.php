<?php 

namespace App\Forms;

use Phalcon\Forms\Element\Text;
use Phalcon\Forms\Form;
use Phalcon\Validation\Validator\PresenceOf;
use Phalcon\Validation\Validator\StringLength;
use Phalcon\Forms\Element\TextArea;

class CadastrarNoticiaForm extends Form 
{
    public function initialize()
    {
        //Campo titulo da noticia
        $titulo = new Text('titulo');

        $titulo->addValidator(new PresenceOf([
            'message' => 'Campo obrigatório',
        ]));

        $titulo->addValidator(new StringLength([
            'max' => 255,
            'message' => 'O campo titulo deve ter no máximo 255 caracteres',
        ]));

        $titulo->setAttribute('width', '100%');
        $titulo->setAttribute('class', 'form-control');
        $this->add($titulo);

        //Campo Texto da noticia 
        $texto = new TextArea('texto');
        $texto->setAttribute('class', 'form-control tinymce-editor');
        $this->add($texto);
        
    }
}