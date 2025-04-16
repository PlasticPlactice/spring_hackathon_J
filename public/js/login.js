document.addEventListener('DOMContentLoaded', function () {
    const loginForm = document.getElementById('loginform');
    if (!loginForm) {
        console.error('Login form not found!');
        return;
    }
    loginForm.addEventListener('submit', function (event) {
        event.preventDefault();
        const roleElement = document.getElementById('role');
        if (!roleElement) {
            console.error('Role element not found!');
            return;
        }
        const role = roleElement.value;
        if (!role) {
            console.error('No role selected!');
            return;
        }
        let actionUrl = '';
        switch (role) {
            case 'admin':
                actionUrl = '/admin_login';
                break;
            case 'teacher':
                actionUrl = '/teacher_login';
                break;
            case 'student':
                actionUrl = '/student_login';
                break;
            default:
                console.error('Invalid role selected');
                return;
        }
        loginForm.action = actionUrl;
        loginForm.submit();
    });
});