<x-mainHeader baseRoute='' query='' title='Manual do Utilizador: Contratos'></x-mainHeader>


<div class="container mt-3">
  <div class="row justify-content-center">
    <div class="col mb-4">
      <x-formCard>
        <div class="row d-flex justify-content-center">
          <div class="col-12 col-lg-10 px-5 my-3">

            <!-- OVERVIEW -->
            <div class="userManualAnchor" id="contratos"></div>
            <h2 class="fw-bold">O Módulo Contratos</h2>
            <div class="text-center">
              <img src="{{asset('assets/manual/contratos_lista.png')}}" class="img-fluid img-thumbnail my-3" alt="" srcset="">
            </div>
            <p>
              O módulo de Contratos é responsável pela criação e gestão dos contratos realizados entre a Ecléctica e os vendedores. Nele serão guardados os dados referentes às condições particulares do contrato, em particular o tipo de comissão e a sua percentagem, assim como os dados do vendedor obtidos a partir do módulo Clientes.
            </p>
            <hr class="my-5">

            <!-- PESQUISA -->
            <div class="userManualAnchor" id="pesquisa"></div>
            <h2 class="fw-bold">Pesquisa</h2>
            <div class="text-center">
              <img src="{{asset('assets/manual/contratos_pesquisa.png')}}" class="img-fluid img-thumbnail my-3" alt="" srcset="">
            </div>
            <p>
              O módulo de contratos usa os mesmos critérios de pesquisa de toda a aplicação para a pesquisa geral.
            </p>
            <hr class="my-5">

            <!-- NOVO -->
            <div class="userManualAnchor" id="novo"></div>
            <h2 class="fw-bold">Novo</h2>
            <div class="text-center">
              <img src="{{asset('assets/manual/contratos_novo.png')}}" class="img-fluid img-thumbnail my-3" alt="" srcset="">
            </div>
            <p>
              Para criar um novo contrato clique em NOVO e surgirá o respectivo formulário para o novo contrato.
            </p>
            <hr class="my-5">

            <!-- ATRIBUIR FORNECEDOR -->
            <div class="userManualAnchor" id="fornecedor"></div>
            <h2 class="fw-bold">Atribuir Fornecedor</h2>
            <div class="text-center">
              <img src="{{asset('assets/manual/contratos_fornecedor_usar.png')}}" class="img-fluid img-thumbnail my-3" alt="" srcset="">
            </div>
            <p>
              Para atribuir um cliente a um fornecedor, clique em Acções->Atribuir Fornecedor. Irá aparecer um modal onde poderá escolher
              um cliente já existente ou criar um novo cliente, bastando depois clicar em USAR CLIENTE para os dados serem adicionados ao
              contrato.
            </p>
            <div class="alert alert-warning row mx-1 my-2 m-lg-5" role="alert">
              <div class="col-12 col-lg-1 d-flex align-items-center justify-content-center">
                <h1><i class="bi bi-exclamation-circle-fill"></i></h1>
              </div>
              <div class="col-12 col-lg-10">
                Não se esqueça de definir o cliente como fornecedor! No campo 'Fornecedor' escolha 'true'.
              </div>
            </div>
            <hr class="my-5">

            <!-- COMISSÕES -->
            <div class="userManualAnchor" id="comissoes"></div>
            <h2 class="fw-bold">Comissões</h2>
            <p>
              As comissões são um dado muito importante em cada contrato. É a partir desse valor que será cobrada o respectivo valor ao vendedor sobre os preços obtidos em leilão.
            </p>
            <p>
              Existem dois tipos de comissão: fixa e progressiva.
            </p>
            <p>
              A comissão fixa é uma comissão aplicável à totalidade do preço obtido em leilão.
            </p>
            <p>
              A comissão progressiva, ao contrário, é uma comissão que é aplicável de modo variável conforme o valor obtido em leilão. A Ecléctica, neste tipo de comissão, usa os seguintes intervalos: até 300 €; de 301 € a 1.000 €; de 1.001 € a 3.000 €; mais de 3.000 €.
            </p>
            <p>
              Esta comissão é aplicável sobre os seus excedentes. Por exemplo: um lote cujo preço obtido tenha sido de 5.500 €, a comissão final será calculada da seguinte forma:
              (300 x comissão 1) + (700 x comissão 2) + (2.000 x comissão 3) + (2.500 x comissão 4)
            </p>
            <p>
              Caso a comissão seja fixa, preencha apenas a primeira comissão. Se for progressiva, preencha todas as comissões.
            </p>
            <div class="alert alert-warning row mx-1 my-2 m-lg-5" role="alert">
              <div class="col-12 col-lg-1 d-flex align-items-center justify-content-center">
                <h1><i class="bi bi-exclamation-circle-fill"></i></h1>
              </div>
              <div class="col-12 col-lg-10">
                Mesmo que preencha as restantes comissões, num contrato com comissão fixa, serão ignoradas no respectivo.
              </div>
            </div>
            <hr class="my-5">

            <!-- ADICIONAR LOTES -->
            <div class="userManualAnchor" id="add_lotes"></div>
            <h2 class="fw-bold">Adicionar Lotes</h2>
            <div class="text-center">
              <img src="{{asset('assets/manual/contratos_adicionar_lotes.png')}}" class="img-fluid img-thumbnail my-3" alt="" srcset="">
            </div>
            <p>
              Para adicionar novos lotes ao contrato, clique em Acções->Adicionar Lotes. Um novo formulário irá aparecer exclusivamente dedicado ao inventário de lotes desse contrato.
            </p>
            <p>
              Para adicionar um novo lote preencha o campo nome, se desejar adicione uma fotografia do lote e clique em GRAVAR. A lista que está em baixo será actualizada surgindo o novo lote adicionado ao contrato.
            </p>
            <p>
              Caso esteja a usar a aplicação num smartphone, clicando no botão da câmara, abrirá a câmara do seu telefone, podendo depois obter uma imagem do lote e gravá-la no respectivo lote.
            </p>
            <hr class="my-5">

            <!-- IMPRIMIR -->
            <div class="userManualAnchor" id="imprimir"></div>
            <h2 class="fw-bold">Imprimir</h2>
            <div class="text-center">
              <img src="{{asset('assets/manual/contratos_imprimir.png')}}" class="img-fluid img-thumbnail my-3" alt="" srcset="">
            </div>
            <p>
              Para imprimir o contrato, clique em Acções->Imprimir Contrato.
            </p>
            <hr class="my-5">

            <!-- APAGAR -->
            <div class="userManualAnchor" id="apagar"></div>
            <h2 class="fw-bold">Apagar</h2>
            <div class="text-center">
              <img src="{{asset('assets/manual/contratos_apagar.png')}}" class="img-fluid img-thumbnail my-3" alt="" srcset="">
            </div>
            <div class="alert alert-warning row mx-1 my-2 m-lg-5" role="alert">
              <div class="col-12 col-lg-1 d-flex align-items-center justify-content-center">
                <h1><i class="bi bi-exclamation-circle-fill"></i></h1>
              </div>
              <div class="col-12 col-lg-10">
                Não é possível apagar contratos com lotes associados.
              </div>
            </div>
            <p>
              Para apagar um contrato, clique em Acções->Apagar. Surgirá um modal de confirmação. Confirme para apagar.
            </p>
            <hr class="my-5">



          </div>
        </div>
      </x-formCard>
    </div>
  </div>
</div>