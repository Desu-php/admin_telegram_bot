@extends('partials.layout')
@section('content')
    <div class="main-content-container container-fluid px-4">
        <!-- Page Header -->
        @include('partials.header', ['title' => 'Список реклам'])
        <div class="col">
            <div class="card card-small mb-4">
                <div class="card-header border-bottom d-flex justify-content-between">
                    <h6 class="m-0">Список реклам</h6>
                    <a href="{{route('advertisings.create')}}" class="btn btn-success" >Добавить</a>
                </div>
                <div class="card-body p-2 pb-3 text-center table-responsive">
                    <table class="table mb-0" id="dataTable">
                        <thead class="bg-light">
                        <tr>
                            <th scope="col" class="border-0">#</th>
                            <th scope="col" class="border-0">Название</th>
                            <th scope="col" class="border-0">Название канала</th>
                            <th scope="col" class="border-0">Диапазон времени</th>
                            <th scope="col" class="border-0">для фильтра</th>
                            <th scope="col" class="border-0">Действие</th>
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
            { data: "name", name: 'name'},
            { data: "channel.name", name: 'channel.name'},
            { data: "range_time", name: 'start_date'},
            { data: "end_date", name: 'end_date', visible:false},
            { data: 'action', name: 'action', orderable: false, searchable: false, width:400}
        ]
    </script>
@endpush
