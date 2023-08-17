<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Movies - Add</title>
    @vite('resources/css/app.css')
</head>

<body>
    <div class="navbar bg-base-100">
        <div class="navbar-start">
            <div class="dropdown">
                <label tabindex="0" class="btn btn-ghost btn-circle">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h7" />
                    </svg>
                </label>
                <ul tabindex="0"
                    class="menu menu-sm dropdown-content mt-3 z-[1] p-2 shadow bg-base-100 rounded-box w-52">
                    <li><a>Movies</a></li>
                    <li><a>Portfolio</a></li>
                    <li><a>About</a></li>
                </ul>
            </div>
        </div>
        <div class="navbar-center">
            <a class="btn btn-ghost normal-case text-xl">Movies</a>
        </div>
        <div class="navbar-end">
            <form action="{{ url()->current() }}" method="POST">
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
    </div>
    <div class="w-[100dvw] h-[100%] grid grid-cols-4 items-center justify-center gap-4 p-[50px]">
        @if ($rec <= 0)
            <span class="font-bold text-[4rem] col-span-4 row-span-2 m-auto">No movie(s) found for the selected filter(s)</span>
        @endif
        @foreach ($mov as $m)
            <div class="m-[15px] card card-side bg-base-100 shadow-xl max-w-[20vw]">
                <figure><img class="max-h-[180px]" src="{{url('storage/'.$m->img)}}" alt="Cover for the movie {{ $m->name }}" /></figure>
                <div class="card-body">
                    <h2 class="card-title">{{ $m->name }}</h2>
                    <p>{{ $m->synopsis }}</p>
                    <div class="card-actions justify-end">
                        <button class="btn btn-primary">Watch</button>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</body>

</html>
