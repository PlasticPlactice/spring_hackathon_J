<!-- 各サイドバーを呼び出すコンポーネント -->
 
@section('side_bar_content')
@auth('admin')
    @component('components.admin-side-bar')
    @endcomponent
@endauth

@auth('teacher')
    @component('components.teacher-side-bar')
    @endcomponent
@endauth


@auth('student')
    @component('components.student-side-bar')
    @endcomponent
@endauth
@endsection