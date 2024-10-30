<!-- CONTEÚDO -->
<div class="container mt-3">
  <div class="row justify-content-center">
    <div class="col mb-4">
      <x-formCard>
        <div class="row d-flex justify-content-center">
          <div class="col-12 col-lg-10 px-5 my-3">


            <!-- BEM-VINDO -->
            <div class="userManualAnchor" id="verbetes"></div>
            <h2 class="fw-bold">O Módulo de Verbetes</h2>
            <div class="text-center">
              <img src="{{asset('assets/manual/verbetes_lista.png')}}" class="img-fluid img-thumbnail my-3" alt="" srcset="">
            </div>
            <p>
              O módulo de verbetes é onde a aplicação guarda os templates de todos os títulos que já passaram pela Ecléctica. É assim
              como uma bibliografia própria onde guardará cada título alguma vez catalogado pela Ecléctica e que poderá usar na descrição
              dos lotes a colocar em leilão. Quantos mais títulos houverem neste módulo, mais rápido e eficiente será o seu trabalho de
              catalogação. Portanto, use o mais possível este módulo, aqui ou na versão integrada no módulo lotes.
            </p>
            <hr class="my-5">

            <!-- PROCURA -->
            <div class="userManualAnchor" id="pesquisa"></div>
            <h2 class="fw-bold">Pesquisa</h2>
            <div class="text-center">
              <img src="{{asset('assets/manual/verbetes_pesquisa.png')}}" class="img-fluid img-thumbnail my-3" alt="" srcset="">
            </div>
            <p>
              O módulo de verbetes usa os mesmos critérios de pesquisa de toda a aplicação para a pesquisa geral.
            </p>
            <hr class="my-5">

            <!-- NOVO -->
            <div class="userManualAnchor" id="novo"></div>
            <h2 class="fw-bold">Novo</h2>
            <div class="text-center">
              <img src="{{asset('assets/manual/verbetes_novo.png')}}" class="img-fluid img-thumbnail my-3" alt="" srcset="">
            </div>
            <p>
              A maioria dos verbetes serão criados quando estiver a catalogar lotes para leilões, mas também o poderá fazer no respectivo
              módulo clicando no botão NOVO.
              Ao fazê-lo aparecerá o respectivo formulário, clicando em GRAVAR quando estiver satisfeito.
            </p>
            <hr class="my-5">

            <!-- FORMULÁRIO -->
            <div class="userManualAnchor" id="formulário"></div>
            <h2 class="fw-bold">Formulário</h2>
            <div class="text-center">
              <img src="{{asset('assets/manual/verbetes_formulario.png')}}" class="img-fluid img-thumbnail my-3" alt="" srcset="">
            </div>
            <p>
              O formulário de edição/visualização de verbete possui, além dos dados relativos ao verbete, algumas informações importantes
              à direita do seu ecrã.
            </p>
            <h4 class="fw-bold text-secondary">HISTÓRICO</h4>
            <p>
              O histórico contém todas as colocações desse título ao longo dos mais de 20 anos de história da Ecléctica. Ao clicar em
              cada uma delas obterá os resultados, comprador e lista de licitantes.
            </p>
            <h4 class="fw-bold text-secondary">COMPRADORES E LICITANTES</h4>
            <p>
              Em baixo do Histórico, tem a lista de todos os compradores e de todos os licitantes desse título.
            </p>
            <hr class="my-5">

            <!-- IMPRIMIR -->
            <div class="userManualAnchor" id="imprimir"></div>
            <h2 class="fw-bold">Imprimir</h2>
            <div class="text-center">
              <img src="{{asset('assets/manual/verbetes_imprimir.png')}}" class="img-fluid img-thumbnail my-3" alt="" srcset="">
            </div>
            <p>
              Se desejar imprimir um relatório completo deste título, clique em Acções->Imprimir. A aplicação abrirá uma nova página com uma
              versão de impressão contendo a ficha bibliográfica e uma lista de todas as colocações e resultados obtidos.
            </p>
            <hr class="my-5">

            <!-- APAGAR -->
            <div class="userManualAnchor" id="apagar"></div>
            <h2 class="fw-bold">Apagar</h2>
            <div class="text-center">
              <img src="{{asset('assets/manual/verbetes_apagar.png')}}" class="img-fluid img-thumbnail my-3" alt="" srcset="">
            </div>
            <p>
              Para apagar um verbete, clique em Acções->Apagar, após confirmar o verbete será apagado.
            </p>
            <hr class="my-5">

          </div>
        </div>
      </x-formCard>
    </div>
  </div>
</div>