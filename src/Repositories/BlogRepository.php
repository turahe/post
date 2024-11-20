<?php

declare(strict_types=1);

namespace Turahe\Post\Repositories;

use App\Contracts\BlogRepositoryInterface;
use App\Models\Blog;
use Exception;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Turahe\Core\Repositories\BaseRepository;

class BlogRepository extends BaseRepository implements BlogRepositoryInterface
{
    public function __construct(Blog $post)
    {
        parent::__construct($post);
        $this->model = $post;
    }

    public function createBlog(array $data): Blog
    {
        $data['type'] = 'blog';
        $data['layout'] = 'blog';
        if (empty($data['subtitle'])) {
            $data['subtitle'] = $data['title'];
        }
        if (empty($data['is_sticky'])) {
            $data['is_sticky'] = false;
        }
        if (empty($data['description'])) {
            $data['description'] = Str::limit($data['content'], 150);
        }
        if (empty($data['language'])) {
            $data['language'] = config('app.locale');
        }

        return DB::transaction(function () use ($data) {
            $blog = $this->model->create($data);
            $blog->setContents($data['content']);
            if (isset($data['tags'])) {
                $blog->attachTags($data['tags']);
            }

            return $blog;
        });

    }

    /**
     * @throws \Exception
     */
    public function updateBlog(array $data): bool
    {
        return DB::transaction(function () use ($data) {
            $blog = $this->model->update($data);
            if (isset($data['content'])) {
                $this->model->setContents($data['content']);
            }

            if (isset($data['tags'])) {
                $this->model->attachTags($data['tags']);
            }

            return $blog;
        });
    }

    /**
     * @throws Exception
     */
    public function deleteBlog(): bool
    {
        try {
            return $this->model->forceDelete();
        } catch (QueryException $exception) {
            throw new Exception($exception->getMessage());
        }
    }

    public function getBlogsBuilder(string $order = 'created_at', string $sort = 'desc'): Builder
    {
        return $this->model->query()
            ->with(['media', 'contents'])
            ->where('type', 'blog')
            ->orderBy($order, $sort);

    }

    public function getBlogs(string $order = 'created_at', string $sort = 'desc', $except = []): Collection
    {
        return $this->getBlogsBuilder($order, $sort)->get()->except($except);

    }

    /**
     * @throws Exception
     */
    public function getBlog(string $slug): Blog
    {
        try {
            return $this->model->query()
                ->where('type', 'blog')
                ->where('slug', $slug)->firstOrFail();
        } catch (ModelNotFoundException $exception) {
            throw new ModelNotFoundException($exception->getMessage());
        }
    }

    public function restoreBlog(): bool
    {
        try {
            return $this->model->restore();
        } catch (QueryException $exception) {
            throw new Exception($exception->getMessage());
        }
    }

    public function trashBlog(): bool
    {
        try {
            return $this->model->delete();
        } catch (QueryException $exception) {
            throw new Exception($exception->getMessage());
        }
    }

    public function emptyTrash(): bool
    {
        try {
            return (bool) $this->model->onlyTrashed()->forceDelete();
        } catch (QueryException $exception) {
            throw new Exception($exception->getMessage());
        }
    }
}
