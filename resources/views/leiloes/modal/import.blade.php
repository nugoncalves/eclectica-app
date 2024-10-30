<!-- Modal para importar resultados de Leilão -->
<div class="modal fade" id="leilaoImport" tabindex="-1" aria-labelledby="leilaoImport" aria-hidden="true">
    <div class="modal-dialog modal-fullscreen modal-dialog-scrollable">
        <div class="modal-content" style="background-color: var(--body-bg-color);">
            <div class="modal-header">
                <h1 class="modal-title fs-4 fw-bold">Importar Resultados do Leilão {{ $leilao->id }}</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="container">
                    <div class="row justify-content-center">

                        <!-- IMPORT FILES CARD -->
                        <div class="col-12 ">

                            <form hx-post="/leiloes/import/{{ $leilao->id }}" hx-encoding="multipart/form-data"
                                hx-target="#bidsImportContent" hx-swap="innerHTML" hx-indicator="#importPlaceholder">
                                {{-- <form action="/leiloes/import/{{ $leilao->id }}" method="post" enctype="multipart/form-data"> --}}
                                @csrf
                                <x-formCard class="mb-3">
                                    <x-infoCard.title title="Ficheiros de Importação" />
                                    <div class="row ">

                                        <div class="col-12 col-xl-6 ">
                                            <input type="file" class="form-control" name="pre_bids_import"
                                                aria-describedby="pre_bids_import_label" aria-label="Upload">
                                            <div class="form-text">
                                                <span class="fw-bold">PRÉ-BIDS</span><br>O nome do ficheiro deve ser
                                                'pre_bids_eclecticaleiloes_auction_{{ $leilao->id }}'
                                            </div>
                                        </div>
                                        <div class="col-12 col-xl-6 ">
                                            <input type="file" class="form-control" name="live_bids_import"
                                                aria-describedby="live_bids_import_label" aria-label="Upload">
                                            <div class="form-text">
                                                <span class="fw-bold">LIVE BIDS</span><br>O nome do ficheiro deve ser
                                                'live_bids_eclecticaleiloes_auction_{{ $leilao->id }}'
                                            </div>
                                        </div>

                                        <div class="col-12 py-2 text-end ">
                                            <button type="button"
                                                class="btn btn-sm btn-outline-secondary rounded-pill px-4"
                                                data-bs-dismiss="modal" aria-label="Close">Cancelar</button>
                                            <button type="submit" class="btn btn-sm btn-primary rounded-pill px-4">
                                                Importar</button>
                                        </div>

                                    </div>
                                </x-formCard>
                            </form>

                        </div> {{-- END IMPORT FILES CARD --}}

                        <!-- DADOS DE IMPORTAÇÃO -->
                        <div class="col-12" id="bidsImportContent">
                            <!-- PLACEHOLDERS WHILE LOADING -->
                            <div class="htmx-indicator" id="importPlaceholder">
                                <div class="row justify-content-center">
                                    <div class="col-12 placeholder-glow h2 mt-3 px-3"><span
                                            class="placeholder col-4"></span></div>
                                    <!-- Placeholder para Licitações -->
                                    <div class="col-12 col-xl-8 mb-4">
                                        <x-formCard>
                                            <!-- Title -->
                                            <div class="col-12 placeholder-glow h2 mt-3 px-3"><span
                                                    class="placeholder col-4"></span></div>
                                            <!-- Content Placeholder -->
                                            <div class="col-12 py-2 px-4 px-lg-5 mb-4 placeholder-glow">
                                                <div class="col-12 h4 mt-3"><span class="placeholder col-12"></span>
                                                </div>
                                                <div class="col-12 mt-3"><span class="placeholder col-12"></span></div>
                                                <div class="col-12 mt-3"><span class="placeholder col-12"></span></div>
                                                <div class="col-12 mt-3"><span class="placeholder col-12"></span></div>
                                                <div class="col-12 mt-3"><span class="placeholder col-12"></span></div>
                                                <div class="col-12 mt-3"><span class="placeholder col-12"></span></div>
                                            </div>
                                        </x-formCard>
                                    </div>
                                    <!-- Placeholder para Verificações -->
                                    <div class="col-12 col-xl-4 mb-4">
                                        <x-formCard>
                                            <!-- Title -->
                                            <div class="col-12 placeholder-glow h2 mt-3 px-3"><span
                                                    class="placeholder col-4"></span></div>
                                            <!-- Content Placeholder -->
                                            <div class="col-12 py-2 px-4 px-lg-5 mb-4 placeholder-glow">
                                                <div class="col-12 h4 mt-3"><span class="placeholder col-12"></span>
                                                </div>
                                                <div class=" col-12 mt-3"><span class="placeholder col-12"></span></div>
                                                <div class="col-12 mt-3"><span class="placeholder col-12"></span></div>
                                                <div class="col-12 mt-3"><span class="placeholder col-12"></span></div>
                                                <div class="text-end">
                                                    <button
                                                        class="btn btn-sm btn-primary rounded-pill px-4 placeholder disabled col-6"
                                                        type="submit"></button>
                                                </div>
                                            </div>
                                        </x-formCard>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
