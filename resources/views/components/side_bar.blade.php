<!-- 各サイドバーを呼び出すコンポーネント -->
@auth('admin')
    @component('components.admin-side-bar')
    @endcomponent
@endauth

@auth('teacher')
    @component('components.teacher-side-bar')
    @endcomponent@endauth

@auth('student')
    @component('components.student-side-bar')
    @endcomponent
@endauth