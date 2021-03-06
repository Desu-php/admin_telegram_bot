@extends('partials.layout')
@section('content')
    <div class="main-content-container container-fluid px-4">
        <!-- Page Header -->
        @include('partials.header', ['title' => 'Статистика канала '.$mainChannel->name])
        <div class="col">
            <div class="card card-small mb-4">
                <div class="card-header border-bottom d-flex justify-content-between">
                    <h6 class="m-0">Статистика канала {{$mainChannel->name}}</h6>
                </div>
                <div class="card-body p-2 pb-3 text-center table-responsive">
                    <table class="table mb-0" id="dataTable">
                        <thead class="bg-light">
                        <tr>
                            <th scope="col" class="border-0">#</th>
                            <th scope="col" class="border-0">Username
                                <input class="form-control filtered" data-column="1">
                            </th>
                            <th scope="col" class="border-0">Имя
                                <input class="form-control filtered" data-column="2">
                            </th>
                            <th scope="col" class="border-0">Фамилия
                                <input class="form-control filtered" data-column="3">
                            </th>
                            <th scope="col" class="border-0">Аватарка
                                <input class="form-control filtered" data-column="4">
                            </th>
                            <th scope="col" class="border-0">ID
                                <input class="form-control filtered" data-column="5">
                            </th>
                            <th scope="col" class="border-0">Статус
                                <input class="form-control filtered" data-column="6">
                            </th>
                            <th scope="col" class="border-0">Реклама
                                <input class="form-control filtered" data-column="7">
                            </th>
                            <th scope="col" class="border-0">Дата и время
                                <input class="form-control filtered" data-column="8">
                            </th>
                            <th scope="col" class="border-0">status
                                <input class="form-control filtered" data-column="9">
                            </th>
                            <th scope="col" class="border-0">scam
                                <input class="form-control filtered" data-column="10">
                            </th>
                            <th scope="col" class="border-0">resricted
                                <input class="form-control filtered" data-column="11">
                            </th>
                            <th scope="col" class="border-0">restriction_reason
                                <input class="form-control filtered" data-column="12">
                            </th>
                            <th scope="col" class="border-0">bot
                                <input class="form-control filtered" data-column="13">
                            </th>
                        </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script>
        var columns =  [
            { data: "id", name: 'id'},
            { data: "username", name: 'username'},
            { data: "first_name", name: 'first_name'},
            { data: "last_name", name: 'last_name'},
            { data: "avatar", name: 'avatar'},
            { data: "user_id", name: 'user_id'},
            { data: "status", name: 'status'},
            { data: "advertisings", name: 'advertisings'},
            { data: "created_at", name: 'created_at'},
            { data: "user_status", name: 'user_status'},
            { data: "scam", name: 'scam'},
            { data: "resricted", name: 'resricted'},
            { data: "restriction_reason", name: 'restriction_reason'},
            { data: "bot", name: 'bot'},
        ]
        var url = "{{route('stats.indexAjax', 'channel='.request()->get('channel'))}}"
        var orderColumn = 8
        var order = "desc"
    </script>
@endpush
