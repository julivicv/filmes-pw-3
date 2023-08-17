<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
    @vite('resources/css/app.css')
</head>

<body>
    @if (session('err'))
        <div class="toast toast-top toast-end">
            <div class="alert alert-error">
                <span class="flex flex-row gap-2"><svg xmlns="http://www.w3.org/2000/svg" width="25" height="25"
                        fill="#000000" viewBox="0 0 256 256">
                        <path
                            d="M236.8,188.09,149.35,36.22h0a24.76,24.76,0,0,0-42.7,0L19.2,188.09a23.51,23.51,0,0,0,0,23.72A24.35,24.35,0,0,0,40.55,224h174.9a24.35,24.35,0,0,0,21.33-12.19A23.51,23.51,0,0,0,236.8,188.09ZM222.93,203.8a8.5,8.5,0,0,1-7.48,4.2H40.55a8.5,8.5,0,0,1-7.48-4.2,7.59,7.59,0,0,1,0-7.72L120.52,44.21a8.75,8.75,0,0,1,15,0l87.45,151.87A7.59,7.59,0,0,1,222.93,203.8ZM120,144V104a8,8,0,0,1,16,0v40a8,8,0,0,1-16,0Zm20,36a12,12,0,1,1-12-12A12,12,0,0,1,140,180Z">
                        </path>
                    </svg> {{ session('err') }}</span>
            </div>
        </div>
    @endif
    <div class="w-[100dvw] h-[100dvh] flex items-center justify-center flex-col">

        <h1 class="text-3xl text-primary font-bold">Login</h1>


        <form action="{{ url()->current() }}" method="post" class="flex flex-col gap-2">
            @csrf
            <div class="form-control w-full max-w-lg">
                <label class="label">
                    <span class="label-text">Email:</span>
                </label>
                <input type="email" name="email" value="{{ old('email', $adm->email ?? '') }}"
                    class="input input-bordered w-full max-w-lg" />
            </div>
            <div class="form-control w-full max-w-lg">
                <label class="label">
                    <span class="label-text">Password:</span>
                </label>
                <input type="password" name="password" value="{{ old('password', $adm->password ?? '') }}"
                    class="input input-bordered w-full max-w-lg" />
            </div>
            <input type="submit" value="Submit" class="btn w-full mt-2 bg-primary" />
            <span>Dont have an account? <a href="/register" class="btn btn-link font-bold">Register</a></span>
        </form>
    </div>
</body>

</html>
