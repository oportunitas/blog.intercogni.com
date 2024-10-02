<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog List</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Restore scroll position
            if (localStorage.getItem('scrollPosition')) {
                window.scrollTo(0, localStorage.getItem('scrollPosition'));
                localStorage.removeItem('scrollPosition');
            }

            // Store scroll position before form submission
            document.querySelectorAll('form').forEach(function(form) {
                form.addEventListener('submit', function() {
                    localStorage.setItem('scrollPosition', window.scrollY);
                });
            });
        });
    </script>
</head>
<body class="bg-gray-100">
    <div class="container mx-auto p-10">
        <div class="flex justify-between mb-4">
            <h1 class="text-3xl font-bold">Community Blogs</h1>
            <a href="{{ route('blogs.manage') }}" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-700">Manage Blogs</a>
            <a href="{{ url('/') }}" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-700">Return to Main Menu</a>
        </div>
        <ul>
            @foreach($blogs as $blog)
                <li class="bg-white p-6 rounded shadow-md mb-4 flex flex-row justify-between">
                    <div class="flex flex-col items-end align-between w-full ">
                        <div class="flex flex-row justify-between items-begin w-full ">
                            <div class=" h-full w-2/3">
                                <h3 class="text-xl font-bold">{{ $blog->title }}</h3>
                            </div>
                            <div class="flex flex-col items-center mb-1 h-full w-1/3">
                                <div class="flex flex-row items-center justify-center">
                                    <img src="{{ $blog->user->avatar }}" alt="User Avatar" class="w-6 h-6 rounded-full mr-4">
                                    <p class="text-gray-700 font-bold">{{ $blog->user->name }}</p>
                                </div>
                                <div>
                                    <p class="text-gray-500">{{ $blog->user->email }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="flex flex-row justify-between items-center w-full">
                            <div class=" w-full h-full">
                                <p class="text-gray-700 whitespace-pre-line">{{ $blog->body }}</p>
                            </div>
                            <div class="flex flex-col items-center justify-center">
                                <form action="{{ route('blogs.upvote', $blog->id) }}" method="POST" class="flex items-center">
                                    @csrf
                                    <input type="hidden" name="blog_id" value="{{ $blog->id }}">
                                    <button type="submit" class="flex items-center text-gray-500 hover:text-orange-500">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 15l7-7 7 7" />
                                        </svg>
                                    </button>
                                </form>
                                <p class="text-gray-700 font-bold">{{ $blog->vote_count }}</p>
                                <form action="{{ route('blogs.downvote', $blog->id) }}" method="POST" class="flex items-center">
                                    @csrf
                                    <input type="hidden" name="blog_id" value="{{ $blog->id }}">
                                    <button type="submit" class="flex items-center text-gray-500 hover:text-blue-500">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                        </svg>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </li>
            @endforeach
        </ul>
    </div>
</body>
</html>