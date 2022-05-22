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
        //$this->view->categoria = Categoria::find();
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
        date_default_timezone_set('America/Sao_Paulo');
        $date = new DateTime();
        if ($this->request->isPost()) {
            $form = new CadastrarNoticiaForm();

            if ($form->isValid($this->request->getPost())) {
                $titulo = $this->request->getPost('titulo');
                $texto = $this->request->getPost('texto');
                $categorias = $this->request->getPost('categorias');
                $id = $this->request->getPost('id');
                $data_publicacao = $this->request->getPost('data_publicacao');
                $publicado = $this->request->getPost('publicado');

                if ($id) {
                    $noticia = Noticia::findFirst($id);
                    $noticia->setDataUltimaAtualizacao(date("Y-m-d H:i:s"));
                } else {
                    $noticia = new Noticia();
                    $noticia->setDataCadastro(date("Y-m-d H:i:s"));
                    $noticia->setDataUltimaAtualizacao(date("Y-m-d H:i:s"));
                }

                if ($publicado == '1') {
                    $publicado = 'S';
                    $noticia->setDataPublicacao(date("Y-m-d"), strtotime($data_publicacao));
                } else {
                    $publicado = 'N';
                }
                
                $noticia->setPublicado($publicado);
                $categorias = implode(",", $categorias);
                $noticia->setCategoria($categorias);
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
