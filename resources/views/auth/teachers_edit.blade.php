@extends('layouts.base')
@section('title','教師データ編集・削除')

@component('components.side_bar')
@endcomponent

@section('content')
<div style="margin-left:100px;">
    <div>
        <h1 class="page-title-h1">教師データ編集・削除</h1>
        <form action="/teacher_update/{{$teacher->id}}" method="post" enctype="multipart/form-data">
            @csrf

            <div>
                ID : {{$teacher->email}} 
            </div>

            @component('components.checkbox-with-label')
                @slot('label')
                    パスワード
                @endslot
                @slot('checkbox_name')
                    password-reset
                @endslot
                @slot('message')
                    リセットする
                @endslot
            @endcomponent


            @component('components.input_with_label')
                @slot('label')
                    名前 : 
                @endslot
                @slot('input_type')
                    text
                @endslot
                @slot('input_name')
                    name
                @endslot
                @slot('input_value')
                    {{$teacher->name}}
                @endslot
                @slot('input_placeholder')
                @endslot
            @endcomponent

          

         

            <input type="submit" value="更新" class="button">
        </form>

            <!-- バリデーションエラーの一覧表示 -->
            @if ($errors->any())
            <div>
                <h4>入力エラーがあります:</h4>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif
    </div>
</div>
@endsection

