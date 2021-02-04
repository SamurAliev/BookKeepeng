
{!! Form::open(['route'=>'bills.index', 'method'=>'GET']) !!}
<div class="sidebar mt-5 border p-3">
    <div class="form-group">
        <label for="type">Показать только</label>
        {!! Form::select('type', $types, null, ['placeholder' => 'Все', 'class' => 'form-control', 'id'=>'type']) !!}
        @error('type')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror
    </div>

    <button class="btn btn-success" type="submit">Показать</button>
</div>
{!! Form::close() !!}

{{--@section('js')--}}
{{--    <script>--}}
{{--        jQuery(document).ready(function ($) {--}}

{{--            $("#type>option").click(function () {--}}

{{--                if ($("#category").val() == {{$lastCategoryId}}) {--}}

{{--                    if (!$(".new-category").html()) {--}}
{{--                        createNewCategory();--}}
{{--                    }--}}

{{--                } else {--}}
{{--                    $(".new-category").remove();--}}
{{--                }--}}
{{--            });--}}

{{--        });--}}
{{--    </script>--}}

{{--@endsection--}}

