<x-flashMessage />

{{-- <form method="POST" action="/clientes/modal/{{ $cliente->id }}" target="_blank"> --}}
<form hx-put="/clientes/modal/{{ $cliente->id }}" hx-target="#clienteContent" hx-swap="innerHTML" hx-trigger="submit delay:1s">
    @csrf
    @method('PUT')

    <div class="col-12 mb-3 text-end gap-3">
        <button type="button" class="btn btn-sm btn-outline-primary rounded-pill px-4" data-bs-target="#cliente_list" data-bs-toggle="modal">Cancelar</button>
        <button type="submit" class="btn btn-sm btn-primary rounded-pill px-4">Gravar</button>
    </div>

    <div class="container mt-3">
        <div class="row justify-content-center">
            <!-- Main Form (Left Main Col) -->
            <div class="col-12">
                <div class="row m-0 p-0">
                    <!-- {{-- Campos Escondidos para Passar no POST e gravar dados --}} -->
                    <input type="hidden" class="form-control" id="id" name="id" placeholder="" value="{{ $cliente->id }}" />

                    @include('clientes.partials.mainData')

                    @include('clientes.partials.mainAddress')

                </div>

            </div>

        </div>
        <div class="row my-3"></div>
    </div>

</form>

<script src="https://unpkg.com/htmx.org@1.4.1"></script>