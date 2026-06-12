<?php

namespace App\Services;

use App\Repositories\NoteRepository;

class NoteService
{
    public function __construct(
        private NoteRepository $repository
    ) {
    }

    public function getAll($limit = 10)
    {
        return $this->repository->getAll($limit);
    }

    public function create(array $data)
    {
        return $this->repository->create($data);
    }

    public function update($note, array $data)
    {
        return $this->repository->update($note, $data);
    }

    public function delete($note)
    {
        return $this->repository->delete($note);
    }
}