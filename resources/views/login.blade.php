<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Login</title>
        @vite('resources/css/app.css')
    </head>

    <body class="bg-gray-100 flex items-center justify-center h-screen">

        <div class="sm:mx-auto sm:w-full sm:max-w-sm">
            <form action="{{ route('login') }}" method="POST" class="bg-white shadow-md rounded-sm px-8 pt-5 pb-8 mb-4">
                @csrf
                <h2 class="my-6 text-center text-2xl/9 font-bold tracking-tight text-gray-900">Sign in to your account
                </h2>

                <!-- Email Field -->
                <div>
                    <label for="email" class="block text-sm/6 font-medium text-gray-900">NIDN</label>
                    <div class="mt-2">
                        <input id="email" name="email" type="text" autocomplete="email" required
                            class="block w-full rounded-md border-0 px-2 py-1.5 text-gray-900 shadow-xs ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm/6">
                    </div>
                </div>

                <!-- Password Field -->
                <div>
                    <div class="flex items-center justify-between">
                        <label for="password" class="block mt-2 text-sm/6 font-medium text-gray-900">Password</label>
                    </div>
                    <div class="mt-2">
                        <input id="password" name="password" type="password" autocomplete="current-password" required
                            class="block w-full rounded-md border-0 px-2 py-1.5 text-gray-900 shadow-xs ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm/6">
                    </div>
                </div>

                <!-- Submit Button -->
                <div class="flex items-center justify-between">
                    <button type="submit"
                        class="flex w-full justify-center rounded-md bg-indigo-600 mt-6 py-1.5 text-sm/6 font-semibold text-white shadow-xs hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                        Sign in</button>
                </div>
            </form>

            <!-- Display error message if login fails -->
            @if (session('error'))
                <div class="mt-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-sm relative"
                    role="alert">
                    <span class="block sm:inline">{{ session('error') }}</span>
                </div>
            @endif
        </div>
    </body>

</html>
