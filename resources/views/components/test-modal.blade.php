@props([
    'id' => 'status-modal',
])

<div id="{{ $id }}" class="fixed inset-0 bg-black/40 hidden items-center justify-center z-50">

    <div
        class="modal-content relative p-6 space-y-2 text-lg small-modal flex flex-col items-center justify-center bg-white rounded-lg">

        <!-- Close Button -->
        <button type="button" class="absolute top-2 right-2 btn-cancel p-1 rounded-full"
            onclick="closeModal('{{ $id }}')">
            ✕
        </button>

        <!-- Icon -->
        <div id="{{ $id }}-icon"></div>

        <!-- Title -->
        <h2 id="{{ $id }}-title" class="text-lg font-bold"></h2>

        <!-- Message -->
        <div id="{{ $id }}-message" class="text-gray-600 px-4 md:text-base text-sm text-center"></div>

        <!-- Footer -->
        <div>
            <button onclick="closeModal('{{ $id }}')" class="btn-green rounded-full py-1 px-4">
                Continue
            </button>
        </div>
    </div>
</div>
