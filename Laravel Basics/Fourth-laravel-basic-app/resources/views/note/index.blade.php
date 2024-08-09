<x-layout>
    <div class="note-container">
        <a href="{{ route('note.create') }}" class="new-note-btn">
            New Note
        </a>
        <div class="notes">
            @foreach ( $note as $fetchNotes )
            <div class="note">
                <div class="note-body">
                    {{ Str::words($fetchNotes->note, 30) }}
                </div>

                <div class="note-buttons">
                    <a href="{{ route('note.show', $fetchNotes) }}" class="note-edit-button">View</a>
                    <a href="{{ route('note.edit', $fetchNotes) }}" class="note-edit-button">Edit</a>
                    <button class="note-delete-button">Delete</button>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</x-layout>