@extends('partials.layout')
@section('content')
    <div class="main-content-container container-fluid px-4">
        <!-- Page Header -->
        @include('partials.header', ['title' => 'Редактировать рекламу'])
        <div class="col-md-6 col-sm-12 mb-4">
            <div class="stats-small stats-small--1 card card-small">
                <div class="card-body">
                    <form action="{{route('advertisings.update', $data->id)}}" method="put" id="added_form">
                        <div class="form-group">
                            <label for="channel">Канал</label>
                            <select name="channel" class="form-control " style="width: 100%;" id="channel" required>
                                @foreach($channels as $channel)
                                    @if($data->channel_id == $channel->id)
                                        <option value="{{$channel->id}}" selected>{{$channel->name}}</option>
                                    @else
                                        <option value="{{$channel->id}}">{{$channel->name}}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="start_date">Начальная дата</label>
                                <input type="text" class="form-control" id="start_date" name="start_date"
                                       placeholder="Начальная дата" value="{{$data->start_date}}" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="end_date">Конечная дата</label>
                                <input type="text" class="form-control" id="end_date" name="end_date"
                                       placeholder="Конечная дата" value="{{$data->end_date}}" required>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-success">Добавить</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script>
        $('#start_date').datetimepicker();
        $('#end_date').datetimepicker();

        var channels = new vanillaSelectBox("#channel", {
            maxWidth: 500,
            maxHeight: 400,
            minWidth: 300,
            search: true,
            translations: {
                "all": "Все",
                "items": "Город"
            },
            placeHolder: "Все"

        });
    </script>
@endpush
