@extends('layout.SchoolSideLayout')
<title>@yield('title', 'DCP Batch')</title>

@section('content')
    <style>
        .folder-stack {
            margin: 1rem;
        }

        .folder {
            background-color: #fef3c7;
            border: 1px solid #fcd34d;
            border-left: 5px solid #facc15;
            border-radius: 6px;
            margin-bottom: 10px;
            overflow: hidden;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
        }

        .folder-label {
            cursor: pointer;
            font-weight: 600;
            padding: 12px 20px;
            color: #92400e;
            background-color: #fde68a;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .folder-items {
            display: none;
            padding: 10px 20px;
            background-color: #fffbea;
        }

        .folder.open .folder-items {
            display: block;
        }

        .folder-label:hover {
            background-color: #fcd34d;
        }

        .item {
            padding: 5px 0;

            color: #374151;
        }

        .item:last-child {
            border-bottom: none;
        }
    </style>

    <div class="mx-5 my-5 ">


        <h2 class="text-2xl font-bold text-gray-800 mb-4"> DCP Batch Folders</h2>

        <div class="folder-stack">
            @foreach ($batches as $batchLabel => $items)
                <div class="folder" id="folder-{{ $loop->index }}">
                    <div class="folder-label" onclick="toggleFolder({{ $loop->index }})">
                        {{ $batchLabel }}
                        <span id="icon-{{ $loop->index }}">➕</span>
                    </div>
                    <div class="folder-items">
                        @forelse ($items as $item)
                            <div class="item"> {{ $item->item_name ?? $item->item_type_id }}</div>
                        @empty
                            <div class="item text-gray-500 italic">No items in this batch.</div>
                        @endforelse
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    <script>
        function toggleFolder(index) {
            const folder = document.getElementById(`folder-${index}`);
            const icon = document.getElementById(`icon-${index}`);

            folder.classList.toggle('open');
            icon.textContent = folder.classList.contains('open') ? '➖' : '➕';
        }
    </script>
@endsection
