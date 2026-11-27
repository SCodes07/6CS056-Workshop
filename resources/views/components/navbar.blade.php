<nav>
    @auth
        <a href="{{ route('courses.index') }}">Courses</a>
        |
        <a href="{{ route('students.index') }}">Students</a>
        |

        <form action="{{ route('logout') }}" method="POST" style="display:inline;">
            @csrf
            <button type="submit">Log Out</button>
        </form>
    @endauth

    @guest
        <a href="{{ route('register') }}">Register</a>
        |
        <a href="{{ route('login') }}">Login</a>
    @endguest
</nav>

<hr>
