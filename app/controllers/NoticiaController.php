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
        $form = new CadastrarNoticiaForm();
        $this->view->form = $form;
        
        $noticia = Noticia::findFirstById($id);

        $this->view->noticia = $noticia;
        $this->view->pick("noticia/editar");
    }

    public function salvarAction()
    {
        if ($this->request->isPost()) {
            $form = new CadastrarNoticiaForm();

            if ($form->isValid($this->request->getPost())) {
                $titulo = $this->request->getPost('titulo');
                $texto = $this->request->getPost('texto');
                $id = $this->request->getPost('id');

                if ($id) {
                    $noticia = Noticia::findFirst($id);
                } else {
                    $noticia = new Noticia();
                }
                
                $noticia->titulo = $titulo;
                $noticia->texto = $texto;

                if ($noticia->save()) {
                    if ($id) {
                        $this->flash->success('Atualizado com sucesso!');
                    } else {
                        $this->flash->success('Casdastro realizado com sucesso!');
                    }
                } else {
                    if ($id) {
                        $this->flash->error('Erro ao atualizar noticia!');
                    } else {
                        $this->flash->error('Erro ao cadastrar noticia!');
                    }
                }
            } else {
                foreach ($form->getMessages() as $msg) {
                    $this->flash->error($msg);

                }
                return $this->response->redirect(array('for' => 'noticia.cadastrar'));
            }

        }
        return $this->response->redirect(array('for' => 'noticia.lista'));
    }

    public function excluirAction($id)
    {
        $noticia = Noticia::findFirstById($id);

        if (!$noticia) {
            $this->flash->error("Noticia não localizada!");
            return $this->response->redirect(array('for' => 'noticia.lista'));
        }

        if (!$noticia->delete()) {
            $this->flash->error("Erro ao tentar deletar!");
            return $this->response->redirect(array('for' => 'noticia.lista'));
        }
        $this->flash->success("Deletado com sucesso!");
        return $this->response->redirect(array('for' => 'noticia.lista'));
    }

}
