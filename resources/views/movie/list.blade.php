<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Movies - List</title>
    @vite('resources/css/app.css')
</head>

<body>
    <div class="navbar bg-base-100">
        <div class="navbar-start">
            <a class="btn btn-ghost normal-case text-xl">Movies</a>
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
    <div class="w-[100dvw] h-[100%] grid grid-cols-5 items-center justify-center gap-4 p-[50px]">
        @if ($rec <= 0)
            <span class="font-bold text-[4rem] col-span-4 row-span-2 m-auto">No movie(s) found for the
                selected filter(s)</span>
        @endif
        @foreach ($mov as $m)
            <div class="m-[15px] card bg-base-200 shadow-xl max-w-[15vw]">
                <figure><img class="max-h-[180px] max-h-[100%]" src="{{ url($m->img) }}"
                        alt="Cover for the movie {{ $m->name }}" /></figure>
                <div class="card-body p-5 max-h-[200px]">
                    <h2 class="card-title">{{ $m->name }}</h2>
                    <p class="text-ellipsis overflow-hidden">{{ $m->synopsis }}</p>
                    <div class="card-actions justify-end">
                        <a href="../movie/{{ $m->id }}" class="btn btn-primary py-0 px-2">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="#fff"
                                viewBox="0 0 256 256">
                                <path
                                    d="M247.31,124.76c-.35-.79-8.82-19.58-27.65-38.41C194.57,61.26,162.88,48,128,48S61.43,61.26,36.34,86.35C17.51,105.18,9,124,8.69,124.76a8,8,0,0,0,0,6.5c.35.79,8.82,19.57,27.65,38.4C61.43,194.74,93.12,208,128,208s66.57-13.26,91.66-38.34c18.83-18.83,27.3-37.61,27.65-38.4A8,8,0,0,0,247.31,124.76ZM128,192c-30.78,0-57.67-11.19-79.93-33.25A133.47,133.47,0,0,1,25,128,133.33,133.33,0,0,1,48.07,97.25C70.33,75.19,97.22,64,128,64s57.67,11.19,79.93,33.25A133.46,133.46,0,0,1,231.05,128C223.84,141.46,192.43,192,128,192Zm0-112a48,48,0,1,0,48,48A48.05,48.05,0,0,0,128,80Zm0,80a32,32,0,1,1,32-32A32,32,0,0,1,128,160Z">
                                </path>
                            </svg>
                        </a>
                        @if (Auth::check())
                            <a href="edit/{{ $m->id }}" class="btn btn-accent py-0 px-2">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="#fff"
                                    viewBox="0 0 256 256">
                                    <path
                                        d="M227.31,73.37,182.63,28.68a16,16,0,0,0-22.63,0L36.69,152A15.86,15.86,0,0,0,32,163.31V208a16,16,0,0,0,16,16H92.69A15.86,15.86,0,0,0,104,219.31L227.31,96a16,16,0,0,0,0-22.63ZM92.69,208H48V163.31l88-88L180.69,120ZM192,108.68,147.31,64l24-24L216,84.68Z">
                                    </path>
                                </svg>
                            </a>
                            <a href="delete/{{ $m->id }}" class="btn btn-secondary py-0 px-2">
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
        @endforeach
    </div>
</body>

</html>
