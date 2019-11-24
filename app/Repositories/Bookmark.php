<?php
declare (strict_types = 1);

namespace App\Repositories;

use App\Models\MainBookmark as BookmarkModel;


class Bookmark
{
    private $bookmark_model;

    public function __construct(BookmarkModel $bookmark_model)
    {
        $this->bookmark_model = $bookmark_model;
    }

    public function getAllBookmarks()
    {
        return $this->bookmark_model->all();
    }

    public function getIdBookmark(int $id)
    {
        return $this->bookmark_model->findOrFail($id);   
    }
}