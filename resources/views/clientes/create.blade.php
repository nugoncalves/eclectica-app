<x-layout>

    <form method="POST" action="/clientes">
        @csrf
        {{-- Title Menu --}}
        <x-mainHeader baseRoute={{$baseRoute}} query={{$query}} title={{$title}}>
            <li class="nav-item">
                <a href="/clientes{{$query}}" type="submit" class="titleMenuButton btn btn-outline-primary rounded-pill mx-2 px-4">Cancelar</a>
            </li>
            <li class="nav-item">
                <button type="submit" class="titleMenuButton btn btn-primary rounded-pill px-4">Gravar</button>
            </li>
        </x-mainHeader>

        <div class="container mt-3">
            <div class="row justify-content-center">
                <div class="col-8">

                    <x-formCard>

                        <x-input.input class="col12 col-sm-4" type="text" field="id" fieldLabel="N.º Cliente" fieldValue="{{old('id')}}" />

                        <div class="col-12 col-sm-4 form-floating mt-3">
                            <select class="form-select col-12 col-sm-4" aria-label="Default select example" name="seller">
                                <option selected>false</option>
                                <option value="true">true</option>
                                <option value="false">false</option>
                            </select>

                            <label for="seller" class="form-label col-form-label-sm text-info-emphasis ms-2">Fornecedor</label>
                        </div>

                        <!-- <x-input.input class="col12 col-sm-4" type="text" field="seller" fieldLabel="Fornecedor" fieldValue="{{old('seller')}}" /> -->
                        <x-input.input class="col12 col-sm-4" type="text" field="seller_reference" fieldLabel="Referência Fornecedor" fieldValue="{{old('seller_reference')}}" />
                        <x-input.input class="col12 col-sm-6" type="text" field="first_name" fieldLabel="Primeiro Nome" fieldValue="{{old('first_name')}}" />
                        <x-input.input class="col12 col-sm-6" type="text" field="last_name" fieldLabel="Último Nome" fieldValue="{{old('last_name')}}" />
                        <x-input.input class="col12 col-sm-6" type="text" field="email" fieldLabel="Email" fieldValue="{{old('email')}}" />
                        <x-input.input class="col12 col-sm-6" type="text" field="phone" fieldLabel="Telefone" fieldValue="{{old('phone')}}" />

                        <div class="col-12 p-small text-info-emphasis ms-2 mt-5">Morada Principal</div>
                        <x-input.input class="col-12" type="text" field="address" fieldLabel="Morada" fieldValue="{{old('address')}}" />
                        <x-input.input class="col-12 col-lg-5" type="text" field="zip" fieldLabel="Código Postal" fieldValue="{{old('zip')}}" />
                        <x-input.input class="col-12 col-lg-7" type="text" field="city" fieldLabel="Localidade" fieldValue="{{old('city')}}" />
                        <x-input.input class="col-12 col-lg-5" type="text" field="state" fieldLabel="Estado" fieldValue="{{old('state')}}" />
                        <x-input.input class="col-12 col-lg-7" type="text" field="country" fieldLabel="País" fieldValue="{{old('country')}}" />

                    </x-formCard>
                    <!-- Dados de Envio -->
                    <div class="row m-0 p-0" id="shipping">
                        <x-formCard class="mt-3">

                            <div class="col-12 p-small text-info-emphasis ms-2">Dados de Envio</div>

                            <x-input.input class="col-12 mt-0" type="text" field="shipping_name" fieldLabel="Nome de Envio" fieldValue="{{old('shipping_name')}}" />
                            <x-input.input class="col-12" type="text" field="shipping_address" fieldLabel="Morada de Envio" fieldValue="{{old('shipping_address')}}" />
                            <x-input.input class="col-12 col-lg-4" type="text" field="shipping_zip" fieldLabel="Código Postal Envio" fieldValue="{{old('shipping_zip')}}" />
                            <x-input.input class="col-12 col-lg-8" type="text" field="shipping_city" fieldLabel="Cidade de Envio" fieldValue="{{old('shipping_city')}}" />
                            <x-input.input class="col-12 col-lg-7" type="text" field="shipping_state" fieldLabel="Concelho de Envio" fieldValue="{{old('shipping_state')}}" />
                            <x-input.input class="col-12 col-lg-5" type="text" field="shipping_country" fieldLabel="País de Envio" fieldValue="{{old('shipping_country')}}" />

                        </x-formCard>
                    </div>



                </div>


            </div>
            <div class="my-3 row"></div>
        </div>


    </form>
</x-layout>