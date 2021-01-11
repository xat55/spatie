<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Repositories\CategoryRepository;
use App\Repositories\PostRepository;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;
use Flash;
use Response;

class PostController extends AppBaseController
{
    /** @var  PostRepository */
    private $categoryRepository;
    private $postRepository;
    private $userRepository;

    /**
     * PostController constructor.
     * @param CategoryRepository $categoryRepo
     * @param PostRepository $postRepo
     * @param UserRepository $userRepo
     */
    public function __construct(CategoryRepository $categoryRepo, PostRepository $postRepo, UserRepository $userRepo)
    {
        $this->categoryRepository = $categoryRepo;
        $this->postRepository = $postRepo;
        $this->userRepository = $userRepo;
    }

    /**
     * Display a listing of the Post.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $user = auth()->user();

        if ($user->hasRole('admin')) {
            $posts = $this->postRepository->allQuery([], 'id', 'desc');
        } else {
            $posts = $this->postRepository->allQuery(['user_id' => $user->id]);
        }
        $posts = $posts->with('user', 'categories')->paginate(3);

        return view('posts.index')->with('posts', $posts);
    }

    /**
     * Show the form for creating a new Post.
     *
     * @return Response
     */
    public function create()
    {
        $categories = $this->categoryRepository->all()->pluck('name')->toArray();
        $categories = array_combine(range(1, count($categories)), $categories);
        $user = auth()->user();

        return view('posts.create', compact('categories', 'user'));
    }

    /**
     * Store a newly created Post in storage.
     *
     * @param CreatePostRequest $request
     *
     * @return Response
     */
    public function store(CreatePostRequest $request)
    {
        $input = $request->except('author');
        $post = $this->postRepository->create($input);

        // Get the user and associate it with the post
        $userId = $request->get('userId');
        $user = $this->userRepository->find($userId);
        $post->user()->associate($user);

        // привязываем категорию к посту
        $categoryIds = $request->get('categories');
        $this->associateCategoriesToPost($categoryIds, $post);

        Flash::success('Post saved successfully.');

        return redirect(route('posts.index'));
    }

    /**
     * Display the specified Post.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $post = $this->postRepository->find($id);

        if (empty($post)) {
            Flash::error('Post not found');

            return redirect(route('posts.index'));
        }

        return view('posts.show')->with('post', $post);
    }

    /**
     * Show the form for editing the specified Post.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $post = $this->postRepository->find($id);
        $userId = $post->user_id;
        $user = $this->userRepository->find($userId);

        // Get all users
        $users = $this->userRepository->all()->pluck('name')->toArray();
        $users = array_combine(range(1, count($users)), $users);

        // Get all categories
        $categories = $this->categoryRepository->all()->pluck('name')->toArray();
        $categories = array_combine(range(1, count($categories)), $categories);

        if (empty($post)) {
            Flash::error('Post not found');

            return redirect(route('posts.index'));
        }

        return view('posts.edit', compact('categories', 'post', 'user', 'users'));
    }

    /**
     * Update the specified Post in storage.
     *
     * @param int $id
     * @param UpdatePostRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatePostRequest $request)
    {
        $post = $this->postRepository->find($id);

        if (empty($post)) {
            Flash::error('Post not found');

            return redirect(route('posts.index'));
        }

        // Отсоединяем пост от пользователя и категорий
        $post->categories()->detach();
        $post->user()->dissociate();

        // привязываем категорию к посту
        $categoryIds = $request->get('categories');
        $this->associateCategoriesToPost($categoryIds, $post);

        // Обновляем редактируемый пост
        $post = $this->postRepository->update($request->except('author'), $id);

        // привязываем новый пост к пользователю
        $authorName = $request->get('author');
        $user = $this->userRepository->all(['name' => $authorName])->first();
        $post->user()->associate($user);
        $post->save();

        Flash::success('Post updated successfully.');

        return redirect(route('posts.index'));
    }

    /**
     * Remove the specified Post from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $post = $this->postRepository->find($id);
        // Отвяжем категории от поста
        $post->categories()->detach();

        if (empty($post)) {
            Flash::error('Post not found');

            return redirect(route('posts.index'));
        }

        $this->postRepository->delete($id);

        Flash::success('Post deleted successfully.');

        return redirect(route('posts.index'));
    }

    private function associateCategoriesToPost($categoryIds, $post)
    {
        for ($i = 0; $i < count($categoryIds); $i++) {
            $category = $this->categoryRepository->all([], 'id', 'asc', --$categoryIds[$i], 1)->first();
            $category->posts()->save($post);
        }
    }
}
