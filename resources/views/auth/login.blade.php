<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gradient-to-br from-blue-500 to-purple-600 min-h-screen">
    <div class="min-h-screen flex items-center justify-center p-4">
        <div class="bg-white/90 backdrop-blur-sm p-8 rounded-2xl shadow-2xl w-full max-w-md">
            <h1 class="text-3xl font-bold text-center mb-8 text-gray-800">{{ $greeting }}</h1>
            
            <form method="POST" action="{{ route('login') }}" class="space-y-6">
                @csrf
                
                <div>
                    <label for="username" class="block text-sm font-semibold text-gray-700 mb-2">Username</label>
                    <input type="text" name="username" id="username" required autocomplete="username" autofocus
                        class="mt-1 block w-full px-4 py-3 rounded-lg border-2 border-gray-200 focus:border-blue-500 focus:ring focus:ring-blue-200 transition duration-200 ease-in-out">
                </div>

                <div>
                    <label for="password" class="block text-sm font-semibold text-gray-700 mb-2">Password</label>
                    <input type="password" name="password" id="password" required autocomplete="current-password"
                        class="mt-1 block w-full px-4 py-3 rounded-lg border-2 border-gray-200 focus:border-blue-500 focus:ring focus:ring-blue-200 transition duration-200 ease-in-out">
                </div>

                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <input type="checkbox" name="remember" id="remember" 
                            class="h-5 w-5 rounded border-gray-300 text-blue-600 focus:ring-blue-500 transition duration-150 ease-in-out">
                        <label for="remember" class="ml-2 block text-sm font-medium text-gray-700">Remember me</label>
                    </div>
                    <a href="#" class="text-sm font-medium text-blue-600 hover:text-blue-500">Forgot password?</a>
                </div>

                <button type="submit" 
                    class="w-full flex justify-center py-3 px-4 border border-transparent rounded-lg text-sm font-semibold text-white bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition duration-200 ease-in-out transform hover:-translate-y-0.5">
                    Sign in
                </button>

                <p class="mt-4 text-center text-sm text-gray-600">
                    Don't have an account?
                    <a href="#" class="font-medium text-blue-600 hover:text-blue-500">Ask Admin</a>
                </p>
            </form>
        </div>
    </div>
</body>
</html>