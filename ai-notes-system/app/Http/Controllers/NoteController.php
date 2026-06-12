<?php

namespace App\Http\Controllers;

use App\Models\Note;
use App\Services\NoteService;
use App\Traits\ApiResponse;
use App\Http\Requests\StoreNoteRequest;
use App\Http\Requests\UpdateNoteRequest;

class NoteController extends Controller
{
    use ApiResponse;

    private $noteService;

    public function __construct(NoteService $noteService)
    {
        $this->noteService = $noteService;
    }

    /**
     * Get All Notes
     */
    public function index()
    {
        $limit = request()->get('limit', 10);

        $notes = $this->noteService->getAll($limit);
        dd($notes);
        return $this->success($notes, 'Notes fetched successfully');
    }

    /**
     * Create Note
     */
    public function store(StoreNoteRequest $request)
    {
        $note = $this->noteService->create(
            $request->validated()
        );

        return $this->success(
            $note,
            'Note created successfully',
            201
        );
    }

    /**
     * Get Single Note
     */
    public function show($id)
    {
        $note = Note::find($id);

        if (!$note) {
            return $this->error(
                'Note not found',
                404
            );
        }

        return $this->success(
            $note,
            'Note fetched successfully'
        );
    }

    /**
     * Update Note
     */
    public function update(
        UpdateNoteRequest $request,
        $id
    ) {

        $note = Note::find($id);

        if (!$note) {
            return $this->error(
                'Note not found',
                404
            );
        }

        $updatedNote = $this->noteService->update(
            $note,
            $request->validated()
        );

        return $this->success(
            $updatedNote,
            'Note updated successfully'
        );
    }

    /**
     * Delete Note
     */
    public function destroy($id)
    {
        $note = Note::find($id);

        if (!$note) {
            return $this->error(
                'Note not found',
                404
            );
        }

        $this->noteService->delete($note);

        return $this->success(
            null,
            'Note deleted successfully'
        );
    }
}