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
            $form = new CadastrarNoticiaForm();

            if ($form->isValid($this->request->getPost())) {
                $titulo = $this->request->getPost('titulo');
                $texto = $this->request->getPost('texto');

                $noticia = new Noticia();
                $noticia->titulo = $titulo;
                $noticia->texto = $texto;

                if ($noticia->save()) {
                    $this->flash->success('Casdastro realizado com sucesso!');
                } else {
                    $this->flash->error('Erro ao cadastrar noticia!');
                }
            }

        }
        return $this->response->redirect(array('for' => 'noticia.lista'));
    }

    public function excluirAction($id)
    {
        return $this->response->redirect(array('for' => 'noticia.lista'));
    }

}
