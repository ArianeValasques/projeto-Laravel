@extends('layouts.app')
@section('htmlheader_titulo', 'Cadastrar Cliente')
@section('scripts_adicionais')
  <script type="text/javascript" src=" {{asset('plugins/maskedinput/jquery.maskedinput.min.js')}}"></script>
  <script  type="text/javascript" >
    $(document).ready( function($){
        $("#cpf").mask("999.999.999-99");
    }); 
    $(document).ready( function($){
        $("#telefone").mask("99-99999-9999");
    });    
  </script>
@endsection
@section('conteudo')
  <div class="card">
      <div class="card-body">
        <div class="container">
          <section class="content-header">
            <div class="col-sm-12">
              <h2>  Cadastro de Clientes </h2>
            </div>
          </section>
          @if(Session::has('mensagem')) 
            <div class="alert alert-danger alert-dismissible">
                <!-- data-dismiss - clas para fechar o button que abrir sem precisar de nada  -->
                <button type="button" class="close" data-dismiss="alert">x</button>
                <h5><i class="icon fas fa-ban"></i>Atenção!</h5>
                {{Session::get('mensagem')}}
            </div>
          @endif
          <form action='/cliente' id="cadCliente" method='POST'>
            @csrf
            <div class="form-row">
              <div class="form-group col-3">
                <label>Nome</label><br>
                <input type="text" name='nome' class="form-control 
                @error('nome') is-invalid @enderror" value="{{ old('nome') }}" ><br>
                @error('nome')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{$message}}</strong>
                    </span>
                @enderror
              </div>
              <div class="form-group col-2">
                <label>CPF</label><br>
                <input type="text" id = 'cpf' name='cpf' class="form-control  @error('cpf') is-invalid @enderror" value="{{ old('cpf') }}"><br>
                @error('cpf')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{$message}}</strong>
                    </span>
                @enderror
              </div>
              <div class="form-group col-2">
                <label>Telefone</label><br>
                <input type="text" id = 'telefone' name='telefone' class="form-control @error('telefone') is-invalid @enderror" value="{{ old('telefone') }}"><br>
                @error('telefone')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{$message}}</strong>
                    </span>
                @enderror
              </div>
              <div class="form-group col-2">
              <label>Nascimento</label><br>
                <input type="date" name='nascimento' class="form-control @error('nascimento') is-invalid @enderror" value="{{ old('nascimento') }}"><br>
                @error('nascimento')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{$message}}</strong>
                    </span>
                @enderror
              </div>
              <div class="form-group col-3">
              <label>email</label><br>
                <input type="text" name='email' class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}"><br>
                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{$message}}</strong>
                    </span>
                @enderror
              </div>
              <div> 
                <button type="submit" form="cadCliente" class="btn btn-info float-right" style="margin:32px 0 0 50px;">Enviar</button>
              </div>
            </div>      
          </form>
        </div>
      </div>
  </div>
@endsection
