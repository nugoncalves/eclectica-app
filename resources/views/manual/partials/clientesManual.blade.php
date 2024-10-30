<!-- CONTEÚDO -->
<div class="container mt-3">
  <div class="row justify-content-center">
    <div class="col mb-4">
      <x-formCard>
        <div class="row d-flex justify-content-center">
          <div class="col-12 col-lg-10 px-5 my-3">

            <!-- BEM-VINDO -->
            <div class="userManualAnchor" id="clientes"></div>
            <h2 class="fw-bold">O Módulo de Clientes</h2>
            <p>
              O módulo de Clientes é o responsável pela gestão dos dados pessoais de todos os clientes da Ecléctica.
              É nele que obterá as informações de contacto e onde poderá imprimir as etiquetas para os envios de compras efectuadas nos leilões da Ecléctica.
            </p>
            <p>
              É importante lembrar que este módulo é o único com algumas limitações devido à falta de uma API que permita a comunicação de dados entre a nossa app e a plataforma
              BidSpirit. Apesar dos esforços, não existiu por parte da plataforma BidSpirit nenhuma abertura para a criação de uma API, o que limita as possibilidades
              de desenvolvimento na app Ecléctica.
            </p>
            <div class="alert alert-danger row mx-1 my-3 m-lg-5" role="alert">
              <div class="col-12 col-lg-1 d-flex align-items-center justify-content-center">
                <h1><i class="bi bi-exclamation-circle-fill"></i></h1>
              </div>
              <div class="col-12 col-lg-10">
                <strong>Todas as alterações de dados realizadas na app Ecléctica, serão apagados e substituídos pelos dados da plataforma BidSpirit
                  quando estes forem importados.</strong> É aconselhável que, dados permanentes sejam alterados também na plataforma BidSpirit.
                <br>
                O mesmo é aplicável à criação de novos registos de clientes, devendo só fazê-lo em caso de absoluta necessidade e tendo em conta as informações prestadas em baixo.
              </div>
            </div>
            <hr class="my-5">

            <!-- LISTA -->
            <div class="userManualAnchor" id="lista"></div>
            <h2 class="fw-bold">Lista de Clientes</h2>
            <div class="text-center">
              <img src="{{asset('assets/manual/clientes.png')}}" class="img-fluid img-thumbnail my-3" alt="" srcset="">
            </div>
            <p>
              A lista de clientes apresenta, como em todos os restantes módulos, os primeiros 30 registos em ordem do mais recente para o mais antigo.
            </p>
            <p>
              A pesquisa é realizada sobre os dados NÚMERO DE CLIENTE, NOME, EMAIL e TELEFONE e, como explicado na página de introdução a este manual, procura todas as
              palavras, independentemente da ordem ou o lugar onde estão, em cada registo de cliente que possui todas as palavras.
            </p>
            <p>
              Por exemplo, a pesquisa "nuno oliveira", apresentará os registos que possuam no nome "nuno oliveira", "nuno martins oliveira", "oliveira nuno dos santos" ou ainda registos
              que tenham "nuno" no nome e "oliveira@gmail.com" no endereço de email.
            </p>
            <p>
              O algoritmo de pesquisa permite também procurar por partes de registos. Por exemplo, se queremos obter todos os registos cujo nome seja "nuno" e usem o gmail como
              domínio do seu email, deverá pesquisar com a expressão "nuno gmail". O mesmo é aplicável aos números de telefone, podendo usar apenas parte do número (por exemplo: "963" irá
              mostrar todos os clientes cujo número de telefone possua 963 em qualquer parte do número: "91<strong>963</strong>9900" será encontrado).
            </p>
            <hr class="my-5">

            <!-- NOVO CLIENTE -->
            <div class="userManualAnchor" id="novo"></div>
            <h3 class="fw-bold">Novo Cliente</h3>
            <div class="alert alert-warning row mx-1 my-3 m-lg-5" role="alert">
              <div class="col-12 col-lg-1 d-flex align-items-center justify-content-center">
                <h1><i class="bi bi-exclamation-circle-fill"></i></h1>
              </div>
              <div class="col-12 col-lg-10">
                <strong>Evite criar novos clientes na app Ecléctica.</strong> Como referido anteriormente, a comunicação entre os dados
                existentes na plataforma BidSpirit e a app Ecléctica é feita através da importação daquela, não sendo possível o movimento inverso.
                <br>
                FAÇA-O APENAS SE FOR REALMENTE NECESSÁRIO E SIGA AS INSTRUÇÕES ABAIXO.
              </div>
            </div>
            <div class="text-center">
              <img src="{{asset('assets/manual/clientes_list_menu.png')}}" class="img-fluid img-thumbnail my-3" alt="" srcset="">
            </div>
            <p>
              Para criar um novo registo de cliente, em primeiro lugar, VÁ À PLATAFORMA BIDSPIRIT E CRIE UM NOVO CLIENTE. Depois de o fazer GUARDE O NÚMERO DE CLIENTE GERADO.
              Depois de ter criado um novo cliente na BidSpirit e de guardar o número atribuído na plataforma, <strong>clique no botão NOVO.</strong>
            </p>
            <div class="text-center">
              <img src="{{asset('assets/manual/clientes_novo_modal.png')}}" class="img-fluid img-thumbnail my-3" alt="" srcset="">
            </div>
            <p>
              Aparecerá um modal de confirmação.
            </p>
            <div class="text-center">
              <img src="{{asset('assets/manual/clientes_novo.png')}}" class="img-fluid img-thumbnail my-3" alt="" srcset="">
            </div>
            <p>
              Após confirmar que quer criar um novo registo, no campo NÚMERO DE CLIENTE coloque o mesmo número atribuído pela plataforma BidSpirit e preencha os
              dados seguintes como desejar.
            </p>
            <p class="fw-bold">
              Lembre-se que a plataforma BidSpirit terá prioridade sobre os dados no momento da importação. Ou seja, quando importar, os dados do cliente serão sempre alterados para
              os que existem na plataforma BidSpirit.
            </p>
            <hr class="my-5">

            <!-- ETIQUETA PROVISÓRIA CLIENTE -->
            <div class="userManualAnchor" id="envio-generico"></div>
            <h3 class="fw-bold">Envio Genérico</h3>
            <div class="text-center">
              <img src="{{asset('assets/manual/clientes_envio_generico.png')}}" class="img-fluid img-thumbnail my-3" alt="" srcset="">
            </div>
            <p>
              Caso pretenda imprimir uma etiqueta para um envio de um cliente que não se encontra registado na BidSpirit/App Ecléctica, basta clicar no botão ENVIO GENÉRICO.
            </p>
            <p>
              Irá aparecer um modal com os dados a preencher. Depois de todos os dados preenchidos, bastará carregar em imprimir e uma nova página aparecerá com a etiqueta devidamente preenchida com os dados inseridos.
            </p>
            <div class="text-center">
              <img src="{{asset('assets/manual/clientes_etiqueta_generica.png')}}" class="img-fluid img-thumbnail my-3" alt="" srcset="">
            </div>
            <div class="alert alert-warning row mx-1 my-3 m-lg-5" role="alert">
              <div class="col-12 col-lg-1 d-flex align-items-center justify-content-center">
                <h1><i class="bi bi-exclamation-circle-fill"></i></h1>
              </div>
              <div class="col-12 col-lg-10">
                NOTA IMPORTANTE:
                <br>
                Os dados inseridos não serão gravados na App Ecléctica. Trata-se apenas para uso provisório.
              </div>
            </div>
            <hr class="my-5">

            <!-- IMPORTAR -->
            <div class="userManualAnchor" id="importar"></div>
            <h3 class="fw-bold">Importar da BidSpirit</h3>
            <div class="text-center">
              <img src="{{asset('assets/manual/clientes_importar.png')}}" class="img-fluid img-thumbnail my-3" alt="" srcset="">
            </div>
            <p>
              Para importar os dados existentes na plataforma BidSpirit, clique no botão IMPORTAR.
              De seguida faça o upload do respectivo ficheiro (que deverá ser solicitado ao administrador de sistema da BidSpirit) e carregue em IMPORTAR.
              Em caso de sucesso, aparecerá o respectiva mensagem.
            </p>
            <div class="text-center">
              <img src="{{asset('assets/manual/clientes_importar_sucesso.png')}}" class="img-fluid img-thumbnail my-3" alt="" srcset="">
            </div>
            <div class="alert alert-warning row mx-1 my-3 m-lg-5" role="alert">
              <div class="col-12 col-lg-1 d-flex align-items-center justify-content-center">
                <h1><i class="bi bi-exclamation-circle-fill"></i></h1>
              </div>
              <div class="col-12 col-lg-10">
                Se obtiver um erro, por favor verifique o ficheiro EXCEL enviado. É provável que exista um problema no ficheiro (o mais comum é a existência de uma primeira linha em branco que deve ser apagada). Se o erro persistir, por favor contacte o administrador de sistema.
              </div>
            </div>
            <hr class="my-5">

            <!-- FORMULÁRIO -->
            <div class="userManualAnchor" id="formulario"></div>
            <h2 class="fw-bold">Formulário de Edição</h2>
            <div class="text-center">
              <img src="{{asset('assets/manual/clientes_formulario.png')}}" class="img-fluid img-thumbnail my-3" alt="" srcset="">
            </div>
            <p>
              Ao clicar na respectiva linha do cliente, será enviado para a página de detalhe com os dados desse cliente.
              Nesta página poderá alterar os dados do cliente. Para guardar os dados, basta carregar em "GUARDAR".
              Para imprimir a etiqueta para um envio a esse cliente, basta clicar em "IMPRIMIR ETIQUETA" e a App Ecléctica, automaticamente, decedirá qual das moradas usar.
              Caso o cliente tenha uma morada de envio preenchida, essa será a utilizada. Se, ao contrário, não existir qualquer dado na morada de envio, o sistema assumirá que a morada de envio é a mesma que a morada principal.
            </p>
            <p>
              Para regressar à lista de registos de clientes, clique em CANCELAR.
            </p>
            <hr class="my-5">
          </div>
        </div>
      </x-formCard>
    </div>
  </div>
</div>