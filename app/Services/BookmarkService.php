<?php
namespace App\Services;

use App\Http\Resources\BookmarkResource as BookmarkResource;
use App\Repositories\Bookmark as BookmarkRepository;
use Illuminate\Http\Request;

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
        return BookmarkResource::collection($this->bookmark_repository->getAll());
    }

    /** ID取得　Json整形 */
    public function getIdBookmarks(int $id)
    {
        return new BookmarkResource($this->bookmark_repository->getIdBookmark($id));
    }

   /** しおり作成 DB登録処理 */
   public function ComposeGuide(Request $request)
   {
       return $this->bookmark_repository->compose($request);
   }
    
}