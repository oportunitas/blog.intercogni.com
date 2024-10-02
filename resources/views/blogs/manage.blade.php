<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Blogs</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 p-10">
    <div class="container mx-auto">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-3xl font-bold">Manage Your Blogs</h1>
            <a href="{{ url('/blogs/view') }}" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-700">View Community</a>
            <a href="{{ url('/') }}" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-700">Back to Main Page</a>
        </div>
        <div class="flex items-center mb-6">
            <img src="{{ Auth::user()->avatar }}" alt="User Avatar" class="w-12 h-12 rounded-full mr-4">
            <div>
                <p class="text-gray-700 font-bold">{{ Auth::user()->name }}</p>
                <p class="text-gray-500">{{ Auth::user()->email }}</p>
            </div>
        </div>
        
        <form action="{{ url('/blogs/add') }}" method="POST" class="bg-white p-6 rounded shadow-md mb-6">
            @csrf
            <div class="mb-4">
            <label for="title" class="block text-gray-700 font-bold mb-2">Title:</label>
            <input type="text" id="title" name="title" required class="w-full p-2 border border-gray-300 rounded">
            </div>
            <div class="mb-4">
            <label for="body" class="block text-gray-700 font-bold mb-2">Body:</label>
            <textarea id="body" name="body" required class="w-full p-2 border border-gray-300 rounded"></textarea>
            </div>
            <input type="hidden" name="user_email" value="{{ Auth::user()->email }}">
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-700">Create Blog</button>
        </form>

        <h2 class="text-2xl font-bold mb-4">Existing Blogs</h2>
        <ul>
            @foreach($blogs as $blog)
                <li class="bg-white p-6 rounded shadow-md mb-4">
                    <h3 class="text-xl font-bold">{{ $blog->title }}</h3>
                    <p class="text-gray-700 whitespace-pre-line">{{ $blog->body }}</p>
                    <div class="mt-4">
                        <form action="{{ url('/blogs/' . $blog->id . '/delete') }}" method="POST" class="inline-block">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-700">Delete</button>
                        </form>
                        <a href="{{ url('/blogs/' . $blog->id . '/edit') }}" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-700 ml-2">Edit</a>
                    </div>
                </li>
            @endforeach
        </ul>
    </div>
</body>
</html>