<?php

namespace App\Repositories;

use App\Models\Note;

class NoteRepository
{
    public function getAll($limit = 10)
    {
        return Note::latest()->paginate($limit);
    }

    public function findById($id)
    {
        return Note::findOrFail($id);
    }

    public function create(array $data)
    {
        return Note::create($data);
    }

    public function update(Note $note, array $data)
    {
        $note->update($data);

        return $note;
    }

    public function delete(Note $note)
    {
        return $note->delete();
    }
}