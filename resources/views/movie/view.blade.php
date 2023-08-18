<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Movies - View</title>
    @vite('resources/css/app.css')
</head>

<body>
    <div class="navbar bg-base-100 absolute">
        <div class="navbar-start">
            <a href="/movies/list" class="btn btn-ghost normal-case text-xl">Movies</a>
        </div>
        <div class="navbar-center">
            <form action="/movies/list" method="POST">
                @csrf
                <div class="join">
                    <div>
                        <div>
                            <input name="year" class="input input-bordered join-item" placeholder="Release date" />
                        </div>
                    </div>
                    <select name="category_id" class="select select-bordered join-item">
                        <option disabled selected>Filter</option>
                        @foreach ($cat as $c)
                            <option value="{{ $c->id }}">{{ $c->name }}</option>
                        @endforeach
                    </select>
                    <div class="indicator">
                        <button class="btn btn-ghost btn-circle join-item">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                        </button>
                    </div>
                </div>
            </form>
        </div>
        <div class="navbar-end">

            @if (Auth::check())
                <div class="dropdown dropdown-end">
                    <label tabindex="0" class="btn btn-ghost btn-circle">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 6h16M4 12h16M4 18h7" />
                        </svg>
                    </label>
                    <ul tabindex="0"
                        class="mt-3 z-[1] p-2 shadow menu menu-sm dropdown-content bg-base-100 rounded-box w-52">
                        <li><a href="/movies/add">Add Movies</a></li>
                        <li><a href="/logout">Logout</a></li>
                    </ul>
                </div>
            @else
                <div>
                    <a href="/register" class="btn btn-primary normal-case text-md">Register</a>
                    <a href="/login" class="btn btn-ghost normal-case text-md">Login</a>
                </div>
            @endif
        </div>
    </div>
    <div class="w-[100dvw] h-[100dvh] flex flex-row items-center justify-center gap-4 px-[50px]">

        <div class="w-[30vw] ml-0 h-full flex">
            <img src="{{ url($mov->img) }}" class="w-[90%] my-auto" alt="">
        </div>
        <div class="w-[50vw] ml-0 h-full">
            <object class="absolute top-[64px]" width="960" height="540"
                data="http://www.youtube.com/v/{{ $mov->link }}" type="application/x-shockwave-flash">
                <param name="src" value="http://www.youtube.com/v/Ahg6qcgoay4" />
            </object>
            <div
                class="w-[50vw] h-[350px] absolute bottom-0  bg-zinc-800 border-0 text-white p-10 flex flex-col gap-4 text-2xl">
                <div>Name: {{ $mov->name }}
                    <hr>
                </div>
                <div>Year: {{ $mov->year }}
                    <hr>
                </div>
                <div>Category: {{ $sc }}
                    <hr>
                </div>
                <div>Synopsis: {{ $mov->synopsis }}</div>
                <div class="self-end">
                    @if (Auth::check())
                        <a href="/movies/edit/{{ $mov->id }}" class="btn btn-accent py-0 px-2">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="#fff"
                                viewBox="0 0 256 256">
                                <path
                                    d="M227.31,73.37,182.63,28.68a16,16,0,0,0-22.63,0L36.69,152A15.86,15.86,0,0,0,32,163.31V208a16,16,0,0,0,16,16H92.69A15.86,15.86,0,0,0,104,219.31L227.31,96a16,16,0,0,0,0-22.63ZM92.69,208H48V163.31l88-88L180.69,120ZM192,108.68,147.31,64l24-24L216,84.68Z">
                                </path>
                            </svg>
                        </a>
                        <a href="/movies/delete/{{ $mov->id }}" class="btn btn-secondary py-0 px-2">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="#fff"
                                viewBox="0 0 256 256">
                                <path
                                    d="M216,48H176V40a24,24,0,0,0-24-24H104A24,24,0,0,0,80,40v8H40a8,8,0,0,0,0,16h8V208a16,16,0,0,0,16,16H192a16,16,0,0,0,16-16V64h8a8,8,0,0,0,0-16ZM96,40a8,8,0,0,1,8-8h48a8,8,0,0,1,8,8v8H96Zm96,168H64V64H192ZM112,104v64a8,8,0,0,1-16,0V104a8,8,0,0,1,16,0Zm48,0v64a8,8,0,0,1-16,0V104a8,8,0,0,1,16,0Z">
                                </path>
                            </svg>
                        </a>
                    @endif
                </div>
            </div>
        </div>
    </div>
</body>

</html>
