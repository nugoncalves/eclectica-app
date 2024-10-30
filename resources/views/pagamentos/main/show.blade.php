<x-layout baseRoute={{$baseRoute}}>
    {{-- FLASH MESSAGE --}}
    <x-flashMessage />
    {{-- Title Menu--}}
    <x-mainHeader baseRoute={{$baseRoute}} query={{$query}} title={{$title}}>
        <li class="nav-item">
            @if(session('previous'))
            <a href="{{session('previous')}}" type="submit"
                class="titleMenuButton btn btn-outline-secondary rounded-pill px-4">ProFormas</a>
            @else
            <a href="/pagamentos{{$query}}" type="submit"
                class="titleMenuButton btn btn-outline-secondary rounded-pill px-4">Voltar</a>
            @endif
        </li>
        <li class="nav-item">
            <a href="/pagamentos/imprimir/{{$pagamento->id}}" type="submit" target="_blank"
                class="titleMenuButton btn btn-outline-secondary rounded-pill ms-2 px-4">Imprimir</a>
        </li>

        <li>
            <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#anexos_list"
                class="titleMenuButton btn btn-outline-secondary rounded-pill ms-2 px-4">Adicionar Anexos</a>
        </li>

        <li class=" nav-item">
            <button type="submit" form="main_form"
                class="titleMenuButton btn btn-primary rounded-pill ms-2 px-4">Gravar</button>
        </li>
        <!-- <li class="nav-item">
      <a href="" data-bs-toggle="modal" data-bs-target="#verbetesHelp" class="titleMenuButton btn btn-outline-secondary rounded-circle ms-2"><i class="bi bi-question-lg"></i></a>
    </li> -->
    </x-mainHeader>

    <div class="container mt-3">

        <div class="row justify-content-center">
            <div class="col-12 col-xl-8 mb-4">
                <!-- Main Form (Left Main Col) -->
                @include('pagamentos.main.partials.mainForm')
                @include('pagamentos.main.partials.lotes')
            </div>

            <!-- Other Info (Left Col) -->
            <div class="col-12 col-xl-4">
                @include('pagamentos.main.partials.infoShow')
            </div>

        </div>
    </div>
</x-layout>

@include('pagamentos.modal.list')
