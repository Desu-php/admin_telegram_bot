@extends('partials.layout')
@section('content')
    <div class="main-content-container container-fluid px-4">
        <!-- Page Header -->
    @include('partials.header', ['title' => 'Мои каналы'])
        <div class="col-md-6 col-sm-12 mb-4">
            <div class="stats-small stats-small--1 card card-small">
                <div class="card-body">
                    <form action="{{route('main_channels.store')}}" method="post" id="added_form">
                        <div class="form-group">
                            <label for="url">Ссылка</label>
                            <input type="text" class="form-control" id="url" name="url" placeholder="Ссылка" value="" required>
                        </div>
                        <button type="submit" class="btn btn-success">Добавить</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
