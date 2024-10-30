<div class="container mt-3">
  <div class="row justify-content-center">
    <div class="col mb-4">
      <x-formCard>
        <div class="row d-flex justify-content-center">
          <div class="col-12 col-lg-10 px-5 my-3">

            <!-- BEM-VINDO -->
            <div class="userManualAnchor" id="lotes"></div>
            <h2 class="fw-bold">O Módulo de Lotes</h2>
            <div class="text-center">
              <img src="{{asset('assets/manual/lotes_lista.png')}}" class="img-fluid img-thumbnail my-3" alt="" srcset="">
            </div>
            <p>
              O Módulo de lotes é o coração da aplicação de gestão da Ecléctica. Provavelmente é neste módulo que passará
              mais tempo a trabalhar, criando os lotes, escrevendo as respectivas descrições e colocando-os em leilões. Tudo isso é
              possível fazer sem sair do módulo, sem necessidade de navegar de módulo em módulo até concretizar a tarefa desejada.
            </p>
            <p>
              Especialmente o módulo Verbetes está intimimamente ligado aos Lotes e todas as acções possíveis de realizar naquele
              módulo, vai poder realizar aqui.
            </p>
            <p>
              Este módulo é composto por dois dados relacionados: os lotes e as colocações. O primeiro, diz respeito a todos os
              lotes entregues pelos vendedores à leiloeira. Nele constam o número do contrato, o número de ordem nesse contrato e
              as respectivas descrições. O segundo diz respeito às colocações em leilão, onde se registam todas as vezes que o lote
              foi colocado em leilão. Sempre que teve uma venda bem sucedida - ou seja, uma licitação vencedora devidamente paga e
              levantada pelo comprador - não haverá lugar a mais colocações. Se uma colocação foi mal sucedida - ou seja, porque um
              lote não obteve qualquer licitação ou porque um comprador não pagou ou levantou o lote - é possível voltar a colocar
              noutro leilão futuro.
            </p>
            <hr class="my-5">

            <!-- PESQUISA -->
            <div class="userManualAnchor" id="pesquisa"></div>
            <h2 class="fw-bold">Pesquisa</h2>
            <p>
              O módulo de lotes usa os mesmos critérios de pesquisa de toda a aplicação para a pesquisa geral. No entanto, dado o seu
              carácter mais abrangente, há algumas coisas que precisa saber.
            </p>
            <div class="text-center">
              <img src="{{asset('assets/manual/lotes_pesquisa.png')}}" class="img-fluid img-thumbnail my-3" alt="" srcset="">
            </div>
            <h4 class="fw-bold text-secondary">Pesquisa Geral</h4>
            <p>
              Na pesquisa geral [alt+f] é feita uma pesquisa pelo nome do lote (Sumário da Descrição) e pelo seu número de contrato
              e número de ordem. Deste modo, é possível, rapidamente, procurar por um lote cuja referência de contrato seja, por exemplo,
              contrato n.º 122, ordem n.º 34 usando "122-34". É possível, portanto, combinar as pesquisas. Por exemplo, "122 teatro" irá
              retornar os lotes cujo contrato seja o n.º 122 e tenham no sumário a palavra "teatro".
            </p>
            <div class="text-center">
              <img src="{{asset('assets/manual/lotes_codigos.png')}}" class="img-fluid img-thumbnail my-3" alt="" srcset="">
            </div>
            <h4 class="fw-bold text-secondary">Pesquisa por Códigos</h4>
            <p>
              A pesquisa por códigos será a mais usada neste módulo. Ao clicar em "Pesquisar por Códigos" [alt+shit+f], surgirá um modal onde
              pode pesquisar um lote pelas suas referências de contrato ou pelas suas referências de leilão usando o número do leilão e o
              número do catálogo.
            </p>
            <hr class="my-5">

            <!-- NOVO LOTE -->
            <div class="userManualAnchor" id="novo"></div>
            <h2 class="fw-bold">Novo Lote</h2>
            <div class="text-center">
              <img src="{{asset('assets/manual/lotes_novo.png')}}" class="img-fluid img-thumbnail my-3" alt="" srcset="">
            </div>
            <p>
              Para adicionar um novo lote, basta clicar em NOVO [alt+n] e surgirá um formulário simples onde poderá preencher os dados do
              contrato e o nome do lote. Ao seleccionar o número do contrato da lista, a app irá preencher por si os dados relativos ao
              contrato: número de ordem, comissões e vendedor. O número de ordem, em caso de erro, poderá ser alterado ou preenchido
              manualmente, os dados do vendedor e comissões NÃO PODEM SER ALTERADOS
            </p>
            <div class="alert alert-warning row mx-1 my-3 m-lg-5" role="alert">
              <div class="col-12 col-lg-1 d-flex align-items-center justify-content-center">
                <h1><i class="bi bi-exclamation-circle-fill"></i></h1>
              </div>
              <div class="col-12 col-lg-10">
                Se, ao preencher o número do contrato, os restantes dados não forem preenchidos automaticamente, por favor cancele a criação
                de novo lote e tente de novo. Se o problema persistir contacte o administrador de sistema.
              </div>
            </div>
            <hr class="my-5">

            <!-- FORMULÁRIO -->
            <div class="userManualAnchor" id="formulario"></div>
            <h2 class="fw-bold">Formulário</h2>
            <div class="text-center">
              <img src="{{asset('assets/manual/lotes_formulario.png')}}" class="img-fluid img-thumbnail my-3" alt="" srcset="">
            </div>
            <p>
              Como em todos os restantes módulos, no formulário encontrará, à esquerda, os dados referentes ao lote e à direita algumas
              informações importantes. A primeira relativa às colocações desse lote em leilão. Caso existam, surjirá a seguir um
              conjunto de outras colocações do mesmo título. Seguem-se um conjunto de informações gerais relativas ao lote.
            </p>
            <hr class="my-5">

            <!-- ESTADO DOS LOTES -->
            <div class="userManualAnchor" id="estado"></div>
            <h2 class="fw-bold">Estado dos Lotes</h2>
            <p>
              Cada lote possui seis estados possíveis:
            </p>
            <dl class="row">
              <dt class="col-sm-3 text-success text-sm-end">DISPONÍVEL</dt>
              <dd class="col-sm-9">lotes que estão disponíveis para serem colocados ou recolocados em leilão</dd>

              <dt class="col-sm-3 text-warning text-sm-end">COLOCADO</dt>
              <dd class="col-sm-9">lotes que estão colocados em leilão, mas cuja venda ainda não terminou</dd>

              <dt class="col-sm-3 text-warning text-sm-end">PAGO</dt>
              <dd class="col-sm-9">lotes vendidos e devidamente pagos pelo comprador</dd>

              <dt class="col-sm-3 text-danger text-sm-end">NÃO PAGO</dt>
              <dd class="col-sm-9">lotes vendidos, mas não pagos pelo comprador</dd>

              <dt class="col-sm-3 text-secondary text-sm-end">FECHADO</dt>
              <dd class="col-sm-9">lotes vendidos e pagos ao vendedor, portanto cujo ciclo de vida na Ecléctica terminou</dd>

              <dt class="col-sm-3 text-secondary text-sm-end">DEVOLVIDO</dt>
              <dd class="col-sm-9"> lotes cuja devolução foi solicitada pelo vendedor, portanto cujo ciclo de vida na Ecléctica terminou</dd>
            </dl>
            <hr class="my-5">

            <!-- VERBETES -->
            <div class="userManualAnchor" id="verbetes"></div>
            <h2 class="fw-bold">Usar Verbetes como Template da Descrição</h2>
            <p>
              Para escrever as respectivas descrições completas de cada lote, estão disponíveis no módulo de lotes todas as ferramentas para
              copiar, criar e editar os seus respectivos verbetes.
            </p>
            <div class="text-center">
              <img src="{{asset('assets/manual/lotes_verbete_pesquisa.png')}}" class="img-fluid img-thumbnail my-3" alt="" srcset="">
            </div>
            <p>
              Para o fazer, basta clicar no botão Acções->Atribuir Verbete [alt+v] e aparecerá um modal com um campo de pesquisa e um botão
              para criar um novo verbete.
            </p>
            <p>
              Pesquise pelo título do livro a descrever e irá surgir uma lista de verbetes de acordo com a pesquisa realizada.
            </p>
            <p>
              Caso o verbete para o lote não esteja disponível, clique em NOVO para aparecer o formulário de criação de um novo verbete
              (igual ao que encontra no módulo Verbetes), preencha os respectivos dados e clique em GRAVAR quando terminar, aparecendo então
              a pŕe-visualização do que irá ser gravado no seu lote.
            </p>
            <p>
            <div class="text-center">
              <img src="{{asset('assets/manual/lotes_verbete_previsualizacao.png')}}" class="img-fluid img-thumbnail my-3" alt="" srcset="">
            </div>
            Caso o verbete esteja disponível, basta clicar e aparecerá um formulário com uma pré-visualização do que irá ser gravado
            no seu lote.
            </p>
            <p>
              Daqui tem três caminhos possíveis:
            </p>
            <ul>
              <li>
                Se está satisfeito com a descrição produzida, clique em USAR VERBETE e o conteúdo será devidamente copiado para o lote.
              </li>
              <li>
                Se verificar que o verbete possui algum erro, poderá clicar em Acções -> Alterar onde pode alterar os dados que julgar necessários e clicar em GRAVAR após estar satisfeito.
              </li>
              <li>
                Se preferir, pode fazer as alterações que quiser nesta pré-visualização e clicar depois em USAR VERBETE ou clicar primeiro em USAR VERBETE e fazer as alterações necessárias já no lote.
              </li>
            </ul>
            <hr class="my-5">


            <!-- COLOCAÇÕES -->
            <div class="userManualAnchor" id="colocacoes"></div>
            <h2 class="fw-bold">Colocações</h2>
            <div class="text-center">
              <img src="{{asset('assets/manual/lotes_colocacoes_nova.png')}}" class="img-fluid img-thumbnail my-3" alt="" srcset="">
            </div>
            <p>
              Depois de ter escrito a descrição do lote, é tempo de o colocar num leilão. Para o fazer, clique em Acções->Nova Colocação [alt+l].
              Irá aparecer um modal onde poderá escolher o leilão em que quer colocar o lote. Depois de escolher, o sistema irá preencher
              por si o número de catálogo, atribuindo o próximo número disponível. Preencha os valores para Base de Licitação, Estimativa Mínima
              e Estimativa Máxima, e clique em GRAVAR.
            </p>
            <p>
              A colocação criada irá aparecer na respectiva lista.
            </p>
            <p>
              Se o leilão ainda estiver em estado "Espera", é possível editar a respectiva colocação, em todos os seus dados. Se o leilão
              estiver noutro estado, aparecerá o respectivo resultado, compradores e lista de licitantes se o leilão já estiver terminado,
              ou apenas a informação sobre a colocação.
            </p>
            <hr class="my-5">

            <!-- IMPRIMIR ETIQUETA -->
            <div class="userManualAnchor" id="etiqueta"></div>
            <h2 class="fw-bold">Imprimir Etiqueta</h2>
            <div class="text-center">
              <img src="{{asset('assets/manual/lotes_etiqueta.png')}}" class="img-fluid img-thumbnail my-3" alt="" srcset="">
            </div>
            <p>
              Depois de criada a colocação, pode imprimir a respectiva etiqueta no botão ETIQUETA. Este botão imprime a última colocação do lote.
            </p>
            <hr class="my-5">

            <!-- IMPRIMIR FICHA -->
            <div class="userManualAnchor" id="ficha"></div>
            <h2 class="fw-bold">Imprimir Ficha Bibliográfica</h2>
            <div class="text-center">
              <img src="{{asset('assets/manual/lotes_imprimir_ficha.png')}}" class="img-fluid img-thumbnail my-3" alt="" srcset="">
            </div>
            <p>
              Se, por alguma razão, desejar imprimir a ficha bibliográfica, clique em Acções->Imprimir Ficha Bibliográfica.
            </p>
            <hr class="my-5">

            <!-- EDITAR DADOS CONTRATO -->
            <div class="userManualAnchor" id="contrato"></div>
            <h2 class="fw-bold">Editar Dados do Contrato</h2>
            <p>
              Por razões de segurança, os dados do contrato não são editáveis directamente no formulário do lote. Se precisar de corrigir
              algum dado relativo ao contrato clique em Acções->Editar Dados de Contrato para o poder fazer.
            </p>
            <hr class="my-5">

            <!-- APAGAR -->
            <div class="userManualAnchor" id="apagar"></div>
            <h2 class="fw-bold">Apagar</h2>
            <div class="text-center">
              <img src="{{asset('assets/manual/lotes_apagar.png')}}" class="img-fluid img-thumbnail my-3" alt="" srcset="">
            </div>
            <div class="alert alert-warning row mx-1 my-2 m-lg-5" role="alert">
              <div class="col-12 col-lg-1 d-flex align-items-center justify-content-center">
                <h1><i class="bi bi-exclamation-circle-fill"></i></h1>
              </div>
              <div class="col-12 col-lg-10">
                Só é possível apagar lotes que não possuam qualquer colocação.
              </div>
            </div>
            <p>
              Para apagar um lote, clique em Acções->Apagar e confirme que quer mesmo apagar o lote
            </p>
            <hr class="my-5">

          </div>
        </div>
      </x-formCard>
    </div>
  </div>
</div>