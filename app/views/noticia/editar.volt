{% extends 'layouts/index.volt' %}

    {% block content %}

        <div id="cadastro_ticket" class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <i class="glyphicon glyphicon-plus"></i>
                        &nbsp;Editar Noticia
                    </div>
                    {{ form('noticias/salvar', 'method': 'post', 'enctype' : 'multipart/form-data', 'name':'cadastrar') }}
                        {{ form.render('id', ['value': noticia.id]) }}
                        {{ form.render('csrf', ['value':security.getToken()]) }}
                        <div class="panel-body">
                            <div class="col-md-12"  id="conteudo">
                                <div class="panel panel-default">
                                    <div class="panel-body">
                                        <div class="row">
                                            <div class="form-group col-sm-12">
                                                <p><strong>Data de Criação:</strong> {{ date("d/m/Y H:i:s", strtotime(noticia.getDataCadastro())) }}</p>
                                                <p><strong>Data da Última Atualização:</strong> {{ date("d/m/Y H:i:s", strtotime(noticia.getDataUltimaAtualizacao())) }}</p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group col-sm-12">
                                                <label for ="Titulo">Título <span class="error">(*)<span></label>
                                                {{ form.render('titulo', ['value': noticia.titulo]) }}
                                                {# <input type="text" value="Texto 1" width='100%' class= "form-control"> #}
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group col-sm-12">
                                                <label for ="Texto">Texto</label>
                                                {{ form.render('texto', ['value': noticia.texto]) }}
                                                {# <textarea class= "form-control">Texto 1</textarea> #}
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group col-sm-12">
                                                <label for ="Publicado">Publicar?</label>
                                                {% if noticia.publicado == 'S' %}
                                                    {{ form.render('publicado', ['checked':true]) }}
                                                {% else %}
                                                    {{ form.render('publicado') }}
                                                {% endif %}
                                            </div>                                
                                        </div>
                                        <div class="row" id="data_publicacao">
                                            <div class="form-group col-sm-12">
                                                <label for ="Publicado">Data Publicação</label>
                                                {{ form.render('data_publicacao') }}
                                            </div>                                
                                        </div>
                                        <div class="row">
                                            <div class="form-group col-sm-12">
                                                <label for ="categorias">Categorias</label>
                                                {{ form.render('categorias[]') }}
                                            </div>
                                        </div>
                                    </div>{#/.panel-body#}
                                </div>{#/.panel#}
                                <div class="row" style="text-align:right;">
                                    <div id="buttons-cadastro" class="col-md-12">
                                        <a href="{{ url(['for':'noticia.lista']) }}" class="btn btn-default">Cancelar</a>
                                        {{ submit_button('Gravar', "class": 'btn btn-primary') }}
                                    </div>
                                </div>
                            </div>{#/.conteudo#}
                        </div>{#/.panel-body#}
                    {{ end_form() }}
                </div>{#/.panel#}
            </div>{#/.col-md-12#}
        </div><!-- row -->

    {% endblock %}

    {%  block extrafooter %}
        
        <script>
            $(document).ready(function(){


            });
        </script>
    {% endblock %}
