@extends('layouts.base')
@section('title','生徒データ編集・削除')

@component('components.side_bar')
@endcomponent

@section('content')
<div id="students-edit-container">
    <div>
        <h1 class="page-title-h1">生徒データ編集・削除</h1>
        <form action="/student_update/{{$student->id}}" method="post" enctype="multipart/form-data">
            @csrf

            <div>
                ID : {{$student->email}}
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
                    {{$student->name}}
                @endslot
                @slot('input_placeholder')
            @endcomponent

            <div>
                画像 : <input type="file" name="img_data">
                <img src="{{ $student->img_path !== '' ? '/' : ''  }}{{$student->img_path}}" alt="アイコン画像" style="width: 20px; height: 20px;" >
            </div>

            <div>
                学科 : 
                <select name="department" id="">
                    @foreach($department as $item)                       
                        <option value="{{ $item->id }}"  @if($item->id === $student->department->id)  selected  @endif>{{ $item->name }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                入学年度 : 
                <select name="entrance_year" id="">
                    @foreach($years as $year)
                        <option value="{{$year}}" @if($year === $student->entrance_year)  selected  @endif >{{$year}}</option>
                    @endforeach
                </select>
            </div>

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