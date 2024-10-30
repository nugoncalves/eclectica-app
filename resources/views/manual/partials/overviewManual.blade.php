<!-- TITLE HEADER -->
<x-mainHeader baseRoute='' query='' title='Manual do Utilizador'>

  <li class="nav-item dropdown">
    <button class="titleMenuButton btn btn-primary rounded-pill dropdown-toggle ms-2 px-4" role="button" data-bs-toggle="dropdown" aria-expanded="false">
      Índice
    </button>
    <ul class="dropdown-menu">
      <li>
        <a class="dropdown-item fw-bold" href="#log-in">Log In</a>
      </li>
      <li>
        <a class="dropdown-item fw-bold" href="#responsive">Uma App Responsiva</a>
      </li>
      <li>
        <hr class="dropdown-divider">
      </li>
      <li>
        <a class="dropdown-item fw-bold" href="#arrumacao-geral">Arrumação Geral da App</a>
      </li>
      <li class="ps-3">
        <a class="dropdown-item text-secondary" href="#menu">Menu</a>
      </li>
      <li class="ps-3">
        <a class="dropdown-item text-secondary" href="#conteudos">Conteúdo</a>
      </li>
      <li class="ps-3">
        <a class="dropdown-item text-secondary" href="#pesquisas">Pesquisas</a>
      </li>
      <li class="ps-3">
        <a class="dropdown-item text-secondary" href="#modais">Modais e Offcanvas</a>
      </li>
      <li>
        <hr class="dropdown-divider">
      </li>
      <li>
        <a class="dropdown-item fw-bold" href="#ajuda">Obter Ajuda e Log Out</a>
      </li>
    </ul>
  </li>
</x-mainHeader>

<!-- CONTEÚDO PRINCIPAL -->
<div class="container mt-3">
  <div class="row justify-content-center">
    <div class="col mb-4">
      <x-formCard>
        <div class="row d-flex justify-content-center">
          <div class="col-12 col-lg-10 px-5 my-3">
            <!-- BEM-VINDO -->
            <h2 class="fw-bold" id="bem-vindo">Bem Vindo</h2>
            <p>
              Bem vindo à App Ecléctica, o software usado para gerir toda a actividade leiloeira da nossa
              empresa.
            </p>
            <p>
              Criada internamente, tem como objectivo tornar o nosso trabalho o mais simples e intuitivo
              possível, reduzindo tempo na realização de tarefas, optimizando a obtenção de resultados,
              análise, na comunicação entre a plataforma de leilões ou na gestão financeira da empresa.
            </p>
            <p>Esta primeira página do Manual do Utilizador procurará dar-lhe uma visão geral da aplicação, os
              seus principais componentes e as principais funcionalidades.
              Para cada módulo haverá uma página dedicada onde se explicará o mais detalhadamente possível
              cada uma das funcionalidades.
            </p>
            <hr class="my-5">

            <!-- RESPONSIVE -->

            <div class="userManualAnchor" id="responsive"></div>
            <h2 class="fw-bold" id="responsive">Uma App Responsiva</h2>
            <div class="ratio ratio-16x9 my-3">
              <video loop autoplay controls>
                <source src="{{asset('assets/manual/responsive.mp4')}}" type="video/mp4">
                É possível que o seu browser não suporte vídeos.
              </video>
            </div>
            <p>
              A app Ecléctica é responsiva, estando preparada para ser usada nos vários tipos de dispositivos, sejam computadores pessoais portáteis ou desktop,
              tablets de alta ou baixa resolução e ainda smart phones.
            </p>
            <p>
              Claro que não é possível prever todas as resoluções existentes, mas tirando casos demasiado específicos para serem experimentados,
              a app estará perfeitamente apta a ser usada num alargado leque de dispositivos, bastando um browser com ligação à internet para a poder usar.
            </p>
            <hr class="my-5">

            <!-- LOG IN -->
            <div class="userManualAnchor" id="log-in"></div>
            <h2 class="fw-bold">Log In</h2>
            <div class="text-center">
              <img src="{{asset('assets/manual/log-in.png')}}" class="img-fluid img-thumbnail my-3" alt="" srcset="">
            </div>
            <p>
              Se está a ver esta página, é porque conseguiu efectuar o seu log in com sucesso através das
              credenciais (user name e password) que o administrador de sistema lhe deu. Apenas deixamos umas
              notas importantes sobre as suas credenciais.
            </p>
            <div class="alert alert-warning row mx-1 my-3 m-lg-5" role="alert">
              <div class="col-12 col-lg-1 d-flex align-items-center justify-content-center">
                <h1><i class="bi bi-info-circle-fill"></i></h1>
              </div>
              <div class="col-12 col-lg-10">
                Se está a usar a nossa DEMO APP, saiba que não é possível a criação de utilizadores senão pelo
                administrador de sistema. A razão prende-se, exclusivamente, a uma opção. Tratando-se de uma
                micro-empresa familiar, com apenas dois utilizadores, e sendo o criador da aplicação o filho dos
                sócios, remover essa possibilidade de criação de contas ou de alteração de passwords, foi uma
                decisão interna.
              </div>
            </div>
            <div class="alert alert-danger row mx-1 my-3 m-lg-5" role="alert">
              <div class="col-12 col-lg-1 d-flex align-items-center justify-content-center">
                <h1><i class="bi bi-exclamation-circle-fill"></i></h1>
              </div>
              <div class="col-12 col-lg-10">
                <h3 class="fw-bold">IMPORTANTE</h3>
                Não é possível recuperar a sua password. Se a perder, por favor contacte o administrador de
                sistema.
              </div>
            </div>
            <hr class="my-5">

            <!-- ARRUMAÇÃO GERAL DA APP -->
            <div class="userManualAnchor" id="arrumacao-geral"></div>
            <h2 class="fw-bold">A Arrumação Geral da App</h2>

            <div class="text-center">
              <img src="{{asset('assets/manual/clientes.png')}}" class="img-fluid img-thumbnail my-3" alt="" srcset="">
            </div>

            <p>
              Depois de efectuado o log-in, a primeira página que aparece é a do módulo de CLIENTES.
              Sirvamo-nos dela para lhe dar conta de como é que a aplicação está arrumada.
            </p>
            <div class="userManualAnchor" id="menu"></div>
            <h3 class="fw-bold text-secondary">Menu</h3>
            <div class="ratio ratio-16x9 my-3">
              <video loop autoplay controls>
                <source src="{{asset('assets/manual/menu_fechar_abrir.mp4')}}" type="video/mp4">
                É possível que o seu browser não suporte vídeos.
              </video>
            </div>
            <p>
              À esquerda do ecrã encontra o MENU PRINCIPAL da aplicação. A partir dele poderá navegar pelos
              vários módulos que compõem a aplicação. Em baixo, encontra o seu nome de utilizador e um menu
              através do qual pode fazer o seu LOGOUT ou abrir esta página de ajuda.
            </p>
            <p>
              Para entrar em cada um dos módulos, bastará clicar no respectivo botão.
            </p>
            <p>
              Saiba que, para ecrãs mais pequenos (alguns tablets ou smartphones), este MENU se esconde
              automaticamente. Para o revelar ou fechar, basta clicar no botão que encontra em cima, à
              direita do MENU. Se desejar ocultá-lo também na versão em ecrãs de maior resolução, poderá
              fazê-lo com recurso ao mesmo botão.
            </p>
            <p>
              Este MENU, se assim o desejar, também poderá ser fechado ou revelado para que tenha mais
              espaço no seu ecrã
            </p>

            <div class="userManualAnchor" id="conteudos"></div>
            <h3 class="fw-bold text-secondary">Conteúdos</h3>
            <p>
              À direita, ocupando a maioria do ecrã, encontrará o espaço onde passará o maior tempo durante
              a utilização da app.
              Esta secção de conteúdos tem duas partes principais:
            </p>
            <h4 class="fw-bold text-secondary ms-3" id="area-titulos">Área de Títulos</h4>
            <div class="text-center">
              <img src="{{asset('assets/manual/menu-modulo.png')}}" class="img-fluid img-thumbnail my-3" alt="" srcset="">
            </div>
            <p>
              Esta área inclui o título do módulo em que está a trabalhar do lado esquerdo e, à sua
              direita, um conjunto de botões com que poderá realizar algumas operações.
            </p>
            <h4 class="fw-bold text-secondary ms-3" id="area-conteudos">Área de Conteúdos</h4>
            <p>
              A área de conteúdos é onde estará toda a informação referente ao módulo com que está a
              trabalhar, seja uma lista de registos (no exemplo a de clientes), seja no modo formulário.
            </p>

            <h5 class="fw-bold text-secondary ms-5" id="modo-lista">Modo Lista</h5>
            <div class="text-center">
              <img src="{{asset('assets/manual/area-conteudos.png')}}" class="img-fluid img-thumbnail my-3" alt="" srcset="">
            </div>
            <p>
              O modo lista é composto pela lista de dados do respectivo módulo. Em todos os módulos,
              terá um campo para realizar pesquisas específicas de dados para aquele módulo (veja, mais
              à frente informações sobre como a aplicação realiza as pesquisas).
            </p>
            <div class="text-center">
              <img src="{{asset('assets/manual/paginacao.png')}}" class="img-fluid img-thumbnail my-3" alt="" srcset="">
            </div>
            <p>
              As listas e resultados de pesquisas serão divididas em páginas de 30 registos, podendo
              navegar entre elas na parte inferior da mesma.
            </p>
            <p>
              Clicando no respectivo registo entrará no modo FORMULÁRIO onde poderá obter informações
              mais detalhadas e editá-las.
            </p>
            <h5 class="fw-bold text-secondary ms-5" id="modo-formulario">Modo Formulário</h5>
            <div class="text-center">
              <img src="{{asset('assets/manual/formulario_clientes.png')}}" class="img-fluid img-thumbnail my-3" alt="" srcset="">
            </div>
            <p>
              Neste modo serão mostrados todos os dados referentes ao registo que está a ser visualizado
              e poderá executar operações de alteração, criação e visualização de registos ou outras
              acções como importação ou exportação de registos.
            </p>
            <div class="userManualAnchor" id="pesquisas"></div>
            <h3 class="fw-bold text-secondary">Pesquisas</h3>
            <div class="text-center">
              <img src="{{asset('assets/manual/pesquisa_clientes.png')}}" class="img-fluid img-thumbnail my-3" alt="" srcset="">
            </div>
            <p>
              As pesquisas são todas realizadas nas respectivas listas de registos no respectivo "input"
              que encontra no cabeçalho.
              Para realizar uma pesquisa, basta preencher com os respectivos critérios e pressionar ENTER
              ou clicar com o rato no botão da lupa.
              As pesquisas são realizadas procurando as respectivas palavras no registo, variando o que
              procura de acordo com o módulo onde se encontra [veja a respectiva secção em cada módulo].
            </p>

            <div class="alert alert-warning row mx-1 my-3 m-lg-5" role="alert">
              <div class="col-12 col-lg-1 d-flex align-items-center justify-content-center">
                <h1><i class="bi bi-info-circle-fill"></i></h1>
              </div>
              <div class="col-12 col-lg-10">
                As pesquisas são feitas em todos os campos, procurando todas as palavras, independentemente
                do lugar onde se encontram. Por exemplo: Em CLIENTES se procurar "nuno oliveira", a
                aplicação encontrará registos contendo "Nuno Oliveira", "Nuno Martins Oliveira", "João Nuno
                dos Santos Oliveira", etc.
                Em termos leigos, escrever "nuno oliveira" no campo de pesquisa indicará à aplicação para
                procurar todos os clientes que tenham no seu nome "nuno" E "oliveira", qualquer que seja a
                sua posição.
              </div>
            </div>
            <div class="userManualAnchor" id="modais"></div>
            <h3 class="fw-bold text-secondary">Modais</h3>
            <div class="text-center">
              <img src="{{asset('assets/manual/leiloes_apagar_modal.png')}}" class="img-fluid img-thumbnail my-3" alt="" srcset="">
            </div>
            <p>
              Algumas acções vão requerer confirmação da acção desejada. Essas aparecerão em forma de
              MODAL como o do exemplo acima.
              Será também na forma de MODAL que aparecerá a ajuda referente apenas a esse módulo, que
              poderá aceder clicando no botão respectivo que encontra em todas as páginas da aplicação.
            </p>
            <h3 class="fw-bold text-secondary">Off Canvas</h3>
            <div class="text-center">
              <img src="{{asset('assets/manual/leiloes_lote_offcanvas.png')}}" class="img-fluid img-thumbnail my-3" alt="" srcset="">
            </div>
            <p>
              Outro modo fundamental que vai encontrar várias vezes, seja para obter informações
              complementares, seja para executar algumas acções específicas, é o que chamamos de
              OFFCANVAS, uma secção que aparece no lado direito do ecrã.
              Estes OFFCANVAS chamados por acções específicas, poderão ser escondidos com a tecla ESC,
              caso não esteja a escrever nada em nenhum campo ou usando o botão <i class="fa-solid fa-arrow-right-to-bracket"></i> que se encontra do
              canto superior direito.
            </p>
            <hr class="my-5">

            <!-- OBTER AJUDA -->
            <div class="userManualAnchor" id="ajuda"></div>
            <h2 class="fw-bold">Obter Ajuda e Log-Out</h2>
            <div class="text-center">
              <img src="{{asset('assets/manual/log-out_help.png')}}" class="img-fluid img-thumbnail my-3" alt="" srcset="">
            </div>
            <p>
              Se está a ver este Manual do Utilizador, já sabe como chegar aqui: clicando no botão "Manual do
              Utilizador" que se encontra na parte inferior do MENU, junto ao seu nome de utilizador.
              Também poderá obter ajuda específica para cada módulo. Para isso, em todas as páginas da
              aplicação, encontrará um botão de ajuda [?] através do qual aparecerá um MODAL com a ajuda o
              específica a esse módulo.
            </p>
            <p>
              Para sair da Aplicação, clique no menu Utilizador (canto inferior esquerdo) e clique em LOG OUT.
            </p>


          </div>
        </div>

      </x-formCard>
    </div>

    <div class="row my-3"></div>
  </div>
</div>