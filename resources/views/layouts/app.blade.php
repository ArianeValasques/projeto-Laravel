<!DOCTYPE html>
<html lang="pt-br">
    @section('htmlheader')
        @include('layouts.htmlheader')
        @yield('links_adicionais') 
        @yield('scripts_adicionais')
    @show
<body>
    @yield('conteudo')
    @include('layouts.footer')
</body>
</html>