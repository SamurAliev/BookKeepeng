@extends('layout')

@section('content')
    @if (session('status'))
        <div class="alert alert-success w-100">
            {{ session('status') }}
        </div>
    @endif



    <div class="col-3">
        @include('sidebar')
    </div>
    <div class="col-9">
        <div class="d-flex mt-5 w-100">
            <a class="btn btn-success w-50 mr-2" href="{{route('bills.create', ['type'=> 1])}}">Добавить доход</a>
            <a class="btn btn-warning w-50 ml-2" href="{{route('bills.create', ['type'=> 2])}}">Добавить расход</a>
        </div>

        <table class="table table-striped">
            <thead>
            <tr>
                <th scope="col">Тип</th>
                <th scope="col">Категория</th>
                <th scope="col">Дата</th>
                <th scope="col">Сумма</th>
                <th scope="col">Итого</th>
                <th scope="col">Комментарий</th>
            </tr>
            </thead>
            <tbody>
            @foreach($bills as $bill)
                <tr>
                    <td>{{$bill->type->title}}</td>
                    <td>{{$bill->category->title}}</td>
                    <td>{{ \Carbon\Carbon::parse($bill->date)->format('d.m.Y') }}</td>
                    <td>{{number_format($bill->sum, 0, ',',' ')}}</td>
                    <td>
                        @if($bill->type_id == 1)
                            {{$total += $bill->sum}}
                        @else
                            {{$total -= $bill->sum}}
                        @endif
                    </td>
                    <td>{{$bill->comment}}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>




@endsection
