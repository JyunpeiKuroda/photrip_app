<?php
namespace App\Services;

use App\Http\Resources\BookmarkResource as BookmarkResource;
use App\Repositories\Bookmark as BookmarkRepository;


class BookmarkService 
{
    private $bookmark_repository;

    public function __construct(BookmarkRepository $bookmark_repository)
    {
        $this->bookmark_repository = $bookmark_repository;
    }

    /** 全取得　Json整形 */
    public function getAllBookmarks()
    {
        return BookmarkResource::collection($this->bookmark_repository->getAllBookmarks());
    }

    /** ID取得　Json整形 */
    public function getIdBookmarks(int $id)
    {
        return new BookmarkService($this->bookmark_repository->getIdBookmark($id));
    }
    
}