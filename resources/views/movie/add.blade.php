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
    <div class="w-[100dvw] h-[100dvh] flex items-center justify-center flex-col">

        <h1 class="text-3xl mb-[2rem] text-primary font-bold ">Add a Movie</h1>

        @if ($errors)
            <div class="toast toast-top toast-end">
                @foreach ($errors->all() as $err)
                    <div class="alert alert-error">
                        <span class="flex flex-row gap-2"><svg xmlns="http://www.w3.org/2000/svg" width="25"
                                height="25" fill="#000000" viewBox="0 0 256 256">
                                <path
                                    d="M236.8,188.09,149.35,36.22h0a24.76,24.76,0,0,0-42.7,0L19.2,188.09a23.51,23.51,0,0,0,0,23.72A24.35,24.35,0,0,0,40.55,224h174.9a24.35,24.35,0,0,0,21.33-12.19A23.51,23.51,0,0,0,236.8,188.09ZM222.93,203.8a8.5,8.5,0,0,1-7.48,4.2H40.55a8.5,8.5,0,0,1-7.48-4.2,7.59,7.59,0,0,1,0-7.72L120.52,44.21a8.75,8.75,0,0,1,15,0l87.45,151.87A7.59,7.59,0,0,1,222.93,203.8ZM120,144V104a8,8,0,0,1,16,0v40a8,8,0,0,1-16,0Zm20,36a12,12,0,1,1-12-12A12,12,0,0,1,140,180Z">
                                </path>
                            </svg> {{ $err }}</span>
                    </div>
                @endforeach
            </div>
        @endif

        @if (session('err'))
        @endif

        <form action="{{ url()->current() }}" method="post" enctype="multipart/form-data"
            class="grid grid-cols-2 grid-rows-auto grid-flow-row gap-2 w-[50vw]">
            @csrf
            <div class="form-control w-full max-w-lg">
                <input value="{{ old('name', $newData->name ?? '') }}" type="text" name="name"
                    placeholder="Movie's name" class="input input-bordered w-full max-w-lg" />
            </div>
            <input value="{{ old('year', $newData->year ?? '') }}" type="text" maxlength="4" minlength="4"
                name="year" placeholder="Year of Publication" class="input input-bordered w-full max-w-lg" />
            <div class="form-control w-full max-w-lg">
                <select value="{{ old('category_id', $newData->category_id ?? '') }}" name="category_id"
                    class="select select-bordered w-full max-w-lg">
                    <option disabled selected>Category</option>
                    @foreach ($categories as $c)
                        <option value="{{ $c->id }}">{{ $c->name }}</option>
                    @endforeach
                </select>
            </div>
            <div value="{{ old('link', $newData->link ?? '') }}" class="form-control w-full max-w-lg">
                <input type="text" name="link" placeholder="Trailer's Link"
                    class="input input-bordered w-full max-w-lg" />
            </div>
            <textarea value="{{ old('synopsis', $newData->synopsis ?? '') }}" class="textarea textarea-bordered col-span-2"
                name="synopsis" placeholder="Synopsis"></textarea>
            <input value="{{ old('img', $newData->img ?? '') }}" type="file" name='img'
                class="file-input file-input-bordered w-full col-span-2 file-input-primary" />
            <input type="submit" value="Submit" class="btn bg-primary w-full mt-2 col-span-2" />
        </form>
    </div>
</body>

</html>
