<?php

use App\Forms\CadastrarNoticiaForm;

class NoticiaController extends ControllerBase
{
    private $mensagemDeErro = '';

    public function listaAction()
    {
        $this->view->noticias = Noticia::find();
        $this->view->pick("noticia/listar");
    }

    public function cadastrarAction()
    {
        $form = new CadastrarNoticiaForm();
        $this->view->pick("noticia/cadastrar");
        $this->view->form = $form;
    }

    public function editarAction($id)
    {
        $this->view->pick("noticia/editar");
    }

    public function salvarAction()
    {
        if ($this->request->isPost()) {
            
        }
        return $this->response->redirect(array('for' => 'noticia.lista'));
    }

     public function excluirAction($id)
     {
        return $this->response->redirect(array('for' => 'noticia.lista'));
     }

}
