@extends('layouts.app')

@section('content')
<div class="container">
    <div id="crud" class="row justify-content-center">
        <div class="col-xs-12">
            <h1 class="page-header">Lista de usuarios</h1>
            <div class="card">
                <div class="col-xs-7 mb-2">
                    <a href="#" class="btn btn-primary pull-right btn-sm" title="Añadir">
                        <i class="fa fa-plus"></i> Añadir</a>
                </div>
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <users-table-component></users-table-component>
            </div>
        </div>
    </div>
</div>
@endsection
