<!-- CONTEÚDO -->
<div class="container mt-3">
  <div class="row justify-content-center">
    <div class="col mb-4">
      <x-formCard>
        <div class="row d-flex justify-content-center">
          <div class="col-12 col-lg-10 px-5 my-3">


            <!-- BEM-VINDO -->
            <div class="userManualAnchor" id="leiloes"></div>
            <h2 class="fw-bold">O Módulo de Leilões</h2>
            <div class="text-center">
              <img src="{{asset('assets/manual/leiloes_lista.png')}}" class="img-fluid img-thumbnail my-3" alt="" srcset="">
            </div>
            <p>
              O módulo de Leilões é um dos mais importantes de toda a aplicação. Nele poderá criar novos leilões, exportar o catálogo para
              carregar na plataforma BidSpirit e importar os resultados da plataforma BidSpirit. É também útil para, com facilidade, obter algumas
              informações sobre os lotes vendidos, compradores e fornecedores.
            </p>
            <hr class="my-5">

            <!-- PESQUISA -->
            <div class="userManualAnchor" id="pesquisa"></div>
            <h2 class="fw-bold">Pesquisa</h2>
            <p>
              O módulo de leilões usa os mesmos critérios de pesquisa de toda a aplicação, incluindo-se o número de leilão e o título.
            </p>
            <hr class="my-5">

            <!-- NOVO -->
            <div class="userManualAnchor" id="novo"></div>
            <h2 class="fw-bold">Novo</h2>
            <div class="text-center">
              <img src="{{asset('assets/manual/leiloes_novo.png')}}" class="img-fluid img-thumbnail my-3" alt="" srcset="">
            </div>
            <p>
              Para criar um novo leilão, clique no botão NOVO. Irá surgir um pequeno modal para inserir os dados do novo leilão.
              Ao pressionar GRAVAR, irá ser criado um novo leilão e será redireccionado para ele.
            </p>
            <hr class="my-5">

            <!-- ESTADO DO LEILÃO -->
            <div class="userManualAnchor" id="estados"></div>
            <h2 class="fw-bold">Os Estados de Leilão</h2>
            <p>
              Cada leilão pode ter quatro estados:
            </p>
            <dl class="row">
              <dt class="col-sm-3 text-warning text-sm-end">ESPERA</dt>
              <dd class="col-sm-9">um leilão que está criado e aguarda início;</dd>

              <dt class="col-sm-3 text-danger text-sm-end">DECORRER</dt>
              <dd class="col-sm-9">um leilão que está aberto a licitações, mas ainda não terminou</dd>

              <dt class="col-sm-3 text-primary text-sm-end">TERMINADO</dt>
              <dd class="col-sm-9">um leilão já terminado, mas cujos resultados ainda não foram importados;</dd>

              <dt class="col-sm-3 text-sm-end">PROCESSADO</dt>
              <dd class="col-sm-9">um leilão terminado e devidamente processado.</dd>
            </dl>
            <p>
              A grande diferença está nos detalhes apresentados. Caso um leilão já tenha sido processado, apresentará os
              respectivos resultados, não sendo possível realizar operações de exportação/importação de dados. Se ainda
              não tiver sido processado, obviamente que não constarão os respectivos resultados, quer para os lotes, quer
              para a globalidade do leilão.
            </p>
            <hr class="my-5">

            <!-- LEILÃO NÃO PROCESSADO -->
            <div class="userManualAnchor" id="nao-processado"></div>
            <h2 class="fw-bold">Leilão Não Processado</h2>
            <div class="text-center">
              <img src="{{asset('assets/manual/leiloes_formulario.png')}}" class="img-fluid img-thumbnail my-3" alt="" srcset="">
            </div>

            <p>
              Na página de detalhe do leilão encontrará três secções diferentes
            </p>
            <h4 class="fw-bold text-secondary">Dados do Leilão</h4>
            <p>Nesta secção encontrará os dados relativos ao leilão, em particular o seu título, número, data de início [a data em que o leilão abrirá a licitações] e data do fim [data do leilão], comissão aplicada ao comprador nesse leilão e o estado.</p>
            <h4 class="fw-bold text-secondary">Lista de Lotes</h4>
            <p>Abaixo dos dados de leilão, encontra os lotes que estão atribuídos a esse leilão. É possível efectuar pesquisas nessa lista, sempre com os critérios usados pela aplicação, nos dados número do lote e título do lote.</p>
            <h4 class="fw-bold text-secondary">Dados do Lote</h4>
            <div class="text-center">
              <img src="{{asset('assets/manual/leiloes_lote_nao_processado.png')}}" class="img-fluid img-thumbnail my-3" alt="" srcset="">
            </div>
            <p>Se o leilão ainda não terminou, é possível alterar os registos referentes a esse lote, nomeadamente o leilão a que está atribuído [ALTERAR O LEILÃO A QUE ESSE LOTE PERTENCE IRÁ REMOVÊ-LO DO LEILÃO ACTUAL E ADICIONAR AO NOVO], o número de lote e os dados financeiros de base de licitação (preço inicial) e estimativas mínima e máxima.</p>
            <h4 class="fw-bold text-secondary">Outras Informações</h4>
            <p>À direita, encontra outra secção onde poderá ver outras informações referentes a esse leilão, nomeadamente o total de lotes, valor total das estimativas e das bases de licitação.</p>
            <hr class="my-5">

            <!-- EXPORTAR -->
            <div class="userManualAnchor" id="exportar"></div>
            <h2 class="fw-bold">Exportar</h2>
            <p>
              Para carregar os respectivos lotes para a plataforma BidSpirit é necessário exportar os dados para o formato EXCEL.
              Para o fazer, basta clicar no botão ACÇÕES->EXPORTAR. Ao fazê-lo o sistema irá criar um ficheiro excel que poderá guardar no seu computador para depois importar para a plataforma [Veja, na plataforma BidSpirit, como o fazer].
            </p>
            <hr class="my-5">

            <!-- IMPORTAR -->
            <div class="userManualAnchor" id="importar"></div>
            <h2 class="fw-bold">Importar</h2>
            <div class="text-center">
              <img src="{{asset('assets/manual/leiloes_importacao.png')}}" class="img-fluid img-thumbnail my-3" alt="" srcset="">
            </div>
            <p>
              Para importar os resultados e respectivas licitações da plataforma BidSpirit para a App Ecléctica, clique no botão ACÇÕES->PROCESSAR.
              Será direccionado para um modal onde poderá carregar dois ficheiros: o primeiro com as "pre-bids" [assim chamadas pela BidSpirit às licitações que são anteriores ao leilão] e com as "live bids" [as licitações durante o leilão e onde se encontram as licitações ganhadoras].
              Esses dois ficheiros encontram-se na pasta de relatórios existente na plataforma BidSpirit [veja a respectiva documentação na plataforma BidSpirit].
            </p>
            <div class="alert alert-warning row mx-1 my-3 m-lg-5" role="alert">
              <div class="col-12 col-lg-1 d-flex align-items-center justify-content-center">
                <h1><i class="bi bi-exclamation-circle-fill"></i></h1>
              </div>
              <div class="col-12 col-lg-10">
                Não altere os nomes dos ficheiros da plataforma BidSpirit. Serão usados para a primeira verificação de importação como indicado em baixo.
                Carregue os respectivos ficheiros para os lugares adequados, tal como indicado [ficheiro de pre-bids à esquerda, ficheiro de live-bids à direita] e carregue em importar.
              </div>
            </div>
            <p>
              Irão ser realizadas várias verificações para garantir que os dados serão importados correctamente:
            </p>

            <dl class="row">
              <dt class="col-sm-3 text-secondary text-sm-end">FICHEIROS</dt>
              <dd class="col-sm-9">
                O sistema irá certificar-se que está a importar os ficheiros correctos, procurando que o número de leilão corresponde aos dos ficheiros importados, e se está a importar as respectivas "pre-bids" e "live-bids";
              </dd>

              <dt class="col-sm-3 text-secondary text-sm-end">RESULTADOS</dt>
              <dd class="col-sm-9">
                Após o sucesso na verificação dos ficheiros, os dados são provisoriamente importados apresentando, no lado direito, um conjunto de quatro verificações, nomeadamente, VALOR TOTAL; NÚMERO DE LOTES; NÚMERO DE LOTES VENDIDOS; NÚMERO DE CLIENTES COMPRADORES. Confronte esses dados com os que são apresentados na plataforma da BidSpirit. Caso estejam correctos, assinale em cada um dos pontos e clique em IMPORTAR.
              </dd>
            </dl>
            <div class="alert alert-warning row mx-1 my-3 m-lg-5" role="alert">
              <div class="col-12 col-lg-1 d-flex align-items-center justify-content-center">
                <h1><i class="bi bi-exclamation-circle-fill"></i></h1>
              </div>
              <div class="col-12 col-lg-10">
                SE ACONTECER ALGUM ERRO NA IMPORTAÇÃO POR FAVOR CONTACTE O ADMINISTRADOR DE SISTEMA.
              </div>
            </div>
            <hr class="my-5">

            <!-- LEILÃO PROCESSADO  -->
            <div class="userManualAnchor" id="processado"></div>
            <h2 class="fw-bold">Leilão Processado</h2>
            <div class="text-center">
              <img src="{{asset('assets/manual/leiloes_processado.png')}}" class="img-fluid img-thumbnail my-3" alt="" srcset="">
            </div>
            <p>
              A grande diferença deste modo para o anterior, prende-se com a apresentação de resultados. Em vez de estar presente a secção com outras informações, aparecerá a lista dos vendedores, dos licitantes, assinalando-se os compradores com [ícone de taça].
              Ao clicar no respectivo cliente, aparecerá os seus dados globais, podendo, se necessário, navegar para o respectivo registo de cliente.
            </p>
            <div class="text-center">
              <img src="{{asset('assets/manual/leiloes_lote_offcanvas.png')}}" class="img-fluid img-thumbnail my-3" alt="" srcset="">
            </div>
            <p>
              No caso de leilões processados, ao clicar no lote irá surgir um offcanvas com os resultados obtidos para esse lote,
              nomeadamente o valor de venda, nome e dados do comprador e lista de licitantes.
            </p>
            <hr class="my-5">

          </div>
        </div>
      </x-formCard>
    </div>
  </div>
</div>