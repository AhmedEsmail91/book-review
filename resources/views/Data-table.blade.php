<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Welcome</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body{
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }
    </style>
</head>
<body>
    <h1>Welcome to the Book Review App!</h1>

    @if ($data->isEmpty())
        <p>No data available.</p>
    @else
        <h2>Books</h2>
        <table class="table-auto border-collapse border border-slate-500">
            <thead>
                <tr>
                    @foreach($data->first()->getAttributes() as $key => $value)
                        <th class="border border-slate-600">{{ ucfirst($key) }}</th>
                    @endforeach
                </tr>
            </thead>
            <tbody>
                @foreach($data as $item)
                    <tr>
                        @foreach($item->getAttributes() as $value)
                            <td class="border border-slate-600" style="text-align: center">{{ $value }}</td>
                        @endforeach
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
        {{-- Pagination --}}
    @if ($data->count ())
    <nav>
        {{$data->links ()}}
    </nav>
	@endif
</body>
</html>
