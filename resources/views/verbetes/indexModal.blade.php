<div wire:ignore.self class="modal fade" id="verbeteList" data-bs-backdrop="static" aria-hidden="true" aria-labelledby="verbeteListLabel" tabindex="-1">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="verbeteListLabel">Lista de Verbetes</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div>
          <input id="searchVerbetes" name="searchVerbetes" onfocusout="verbeteSearchModal()" type="text" placeholder="Procurar Verbetes..." />
          <div id="verbetesListContent">
            ...
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button class="btn btn-primary" data-bs-target="#verbeteForm" data-bs-toggle="modal">Open second modal</button>
      </div>
    </div>
  </div>
</div>
{{-- <div class="modal fade" id="verbeteForm" data-bs-backdrop="static" aria-hidden="true" aria-labelledby="verbeteFormLabel" tabindex="-1">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="verbeteFormLabel">Verbete Form</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body" id="verbetesFormContent">
        ...
      </div>
      <div class="modal-footer">
        <button class="btn btn-primary" data-bs-target="#verbeteList" data-bs-toggle="modal">Back to first</button>
      </div>
    </div>
  </div>
</div> --}}
