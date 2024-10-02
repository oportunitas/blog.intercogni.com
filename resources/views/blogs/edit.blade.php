<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Blog</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">
    <div class="container mx-auto mt-8 p-6 bg-white shadow-md rounded-lg">
        <h1 class="text-3xl font-bold mb-6 text-center text-gray-800">Edit Blog</h1>
        <form action="{{ url('/blogs/' . $blog->id . '/edit/apply') }}" method="POST" class="space-y-6">
            @csrf
            @method('POST')
            <div>
                <label for="title" class="block text-lg font-medium text-gray-700">Title:</label>
                <input type="text" id="title" name="title" value="{{ $blog->title }}" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
            </div>
            <div>
                <label for="body" class="block text-lg font-medium text-gray-700">Body:</label>
                <textarea id="body" name="body" rows="10" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">{{ $blog->body }}</textarea>
            </div>
            <div class="text-center">
                <button type="submit" class="bg-blue-500 text-white px-6 py-2 rounded-md shadow-sm hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">Update</button>
            </div>
        </form>
    </div>
</body>
</html>