<x-layout baseRoute={{$baseRoute}}>

    {{-- Title Menu--}}
    <x-mainHeader baseRoute={{$baseRoute}} query={{$query}} title={{$title}}>

    </x-mainHeader>

    {{-- FLASH MESSAGE --}}
    <x-flashMessage />

    @include('pagamentos.proforma.partials.proformaList')


</x-layout>