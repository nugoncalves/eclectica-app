<!-- COLOCAÇÕES [Items Leilão] -->

<!-- LEILÃO NÃO TERMINADO: Permite edições -->
<!-- Apagar Colocação -->
@include('lotes.partials.colocacaoDelete')
<!-- Editar Colocação -->
@include('lotes.partials.colocacaoEdit')

<!-- LEILÃO TERMINADO: Resultados [não permite edições] -->
@include('lotes.partials.colocacaoFinal')