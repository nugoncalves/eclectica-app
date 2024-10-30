<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ecléctica App</title>

    <link rel="icon" type="image/x-icon" href="{{ asset('assets/logo/ELeiloes-simbolo-cor.png') }}">

    <!-- STYLES CSS -->

    <!-- BOOTSTRAP CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

    <!-- BOOTSTRAP ICONS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

    <!-- FONT AWESOME ICONS -->
    <script src="https://kit.fontawesome.com/075e68d52a.js" crossorigin="anonymous"></script>

    <!-- MATERIAL ICONS -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">

    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">

</head>

<body>

    {{-- HEADER --}}

    <div class="row d-flex align-items-center py-3">
        <div class="col-6">
            <img src="{{ asset('assets/logo/ELeiloes_logo_print.png') }}" alt="" width="60%">
        </div>
        <div class="col-6 h3 fw-bold text-end">
            Pagamento a Fornecedor
        </div>
    </div>

    <div class="row d-flex justify-content-between mt-5">
        <div class="col-5">
            <table class="table-print p-xtra-small p-0 m-0">
                <tr>
                    <td><strong>#</strong></td>
                    <td>{{$pagamento->id}}</td>
                </tr>
                <tr>
                    <td><strong>Data:</strong></td>
                    <td>{{$pagamento->date}}</td>
                </tr>
                <tr>
                    <td><strong>Pago por:</strong></td>
                    <td>{{$pagamento->modo}}</td>
                </tr>
                <tr>
                    <td><strong>Leilão:</strong></td>
                    <td>{{$pagamento->leilao_id}}. {{$leilao->name}}</td>
                </tr>

            </table>
        </div>
        <div class="col-5">
            <table class="table-print table-borderless p-xtra-small">
                <tr>
                    <td><strong>Dados do Cliente</strong></td>
                </tr>
                <tr>
                    <td>{{$fornecedor->full_name}}</td>
                </tr>
                <tr>
                    <td>{{$fornecedor->address}}</td>
                </tr>
                <tr>
                    <td>{{$fornecedor->zip}} {{$fornecedor->city}}</td>
                </tr>
                <tr>
                    <td>NIF: {{$fornecedor->nif}} </td>
                </tr>
            </table>
        </div>
    </div>

    {{-- BODY --}}

    <div class="row mt-4">
        <div class="col-12">
            <table class="table table-sm table-borderless p-xtra-small">
                <thead class="border-bottom">
                    <tr>
                        <th>Lote</th>
                        <th>Descricão</th>
                        <th class="text-end">Martelo</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($lotes as $lote)
                    <tr>
                        <td>{{$lote->itemsLeilaoLast->leilao_lote}}</td>
                        <td>{{$lote->main_lang_name}}</td>
                        <td class="text-end">{{Number::currency($lote->itemsLeilaoLast->price, in:'EUR', locale:'pt')}}
                        </td>
                    </tr>
                    @endforeach
                    <tr class="table-light fw-bold">
                        <td colspan="2" class="text-end">Total</td>
                        <td class="text-end">{{$totais['martelo']}}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    {{-- DECLARAÇÃO --}}

    <div class="row mt-4">
        <div class="col-8 p-xtra-small">
            Declaramos que recebemos nesta data o valor de {{$totais['martelo']}} referente à venda em leilão dos lotes
            acima
            indicados, ao qual
            foi deduzido o valor de {{$totais['deducao']}} referente a comissões.
            <hr class="mt-5">
        </div>
    </div>

</body>
<!-- ABRE O DIALOG DE IMPRESSÃO FECHA A TAB DE IMPRESSÃO DEPOIS DE IMPRIMIR OU CANCELAR -->
<script type="text/javascript">
    window.onafterprint = window.close;
  window.print();
</script>

</html>