@extends('layout')

@section('content')


        <div class="col-5 mt-5 ml-auto mr-auto">
            {!! Form::open([
                'route'=> 'bills.store',
                'method'=>'post',
                'class' => 'bills'
            ] ) !!}
            <h2>{!! $type->title!!}</h2>
            {!! Form::hidden('lastId', $lastCategoryId) !!}
            {!! Form::hidden('typeId', $type->id) !!}
            <div class="category">
                <div class="form-group">
                    <label for="category">Категория</label>
                    {!! Form::select('category', $categories, null, ['placeholder' => 'Выберите категорию', 'class' => 'form-control', 'id'=>'category']) !!}
                    @error('category')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="form-group">
                <label for="date">Дата</label>
                {!! Form::date('date', \Carbon\Carbon::now(),['class'=>'form-control']) !!}
                @error('date')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                {{Form::label('sum', 'Сумма')}}
                {{ Form::text('sum', old('sum'), ['class' => 'form-control', 'id'=> 'sum'])}}
                @error('sum')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                {{Form::label('comment', 'Комментарий')}}
                {{ Form::text('comment', old('comment'), ['class' => 'form-control', 'id'=> 'comment'])}}
                @error('comment')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>


            <button type="submit" class="btn btn-primary d-block mt-5">Добавить</button>
            {!! Form::close() !!}


        </div>







@endsection

@section('js')
    <script>
        function createNewCategory() {
            $(".category").after(
                "<div class=\"new-category\">\n" +
                "                <div class=\"form-group\">\n" +
                "                    <label for=\"new_category\">Другая категория</label>\n" +
                '                    {!! Form::text('new_category', old('new_category') ,['class' => 'form-control','placeholder' => 'Новая категория', 'id'=>'new_category']); !!}\n' +
                "                    @error('new_category')\n" +
                "                    <div class=\"alert alert-danger\">{{ $message }}</div>\n" +
                "                    @enderror\n" +
                "                </div>\n" +
                "            </div>"
            );
        }

        @if( old('category') == $lastCategoryId )
        createNewCategory();

        @endif


        jQuery(document).ready(function ($) {
            if ($("#category").val() == {{$lastCategoryId}}) {
                if (!$(".new-category").html()) {
                    createNewCategory();
                }
            }

            $("#category>option").click(function () {

                if ($("#category").val() == {{$lastCategoryId}}) {

                    if (!$(".new-category").html()) {
                        createNewCategory();
                    }

                } else {
                    $(".new-category").remove();
                }
            });

        });
    </script>

@endsection





