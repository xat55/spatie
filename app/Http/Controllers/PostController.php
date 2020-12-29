<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Repositories\CategoryRepository;
use App\Repositories\PostRepository;
use App\Repositories\UserRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

class PostController extends AppBaseController
{
    /** @var  PostRepository */
    private $categoryRepository;
    private $postRepository;
    private $userRepository;

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
            $posts = $this->postRepository->model()::orderBy('id', 'desc');
        } else {
            $posts = $user->posts()->orderBy('id', 'desc');
        }
        
        $posts = $posts->paginate(13);
        // dd($posts);
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
        $post->users()->save($user);
        
        $categoryIds = $request->get('categories');
        
        foreach ($categoryIds as $categoryId) {
            $category = $this->categoryRepository->find($categoryId);
            $category->posts()->save($post);
        }

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
        $user = $post->users->first();
        
        // Get all users
        $users = $this->userRepository->all()->pluck('name')->toArray();
        $users = array_combine(range(1, count($users)), $users);
        
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
        
        // Отсоединяем все категории и пользователя от поста
        $post->categories()->detach();
        $post->users()->detach();
        
        // привязываем новый пост к категории
        $categoryIds = $request->get('categories');
        
        foreach ($categoryIds as $categoryId) {
            $category = $this->categoryRepository->find($categoryId);
            $category->posts()->save($post);
        } 
        
        // Обновляем редактируемый пост
        $post = $this->postRepository->update($request->except('author'), $id);
        
        // привязываем новый пост к пользователю
        $authorName = $request->get('author');
        $user = $this->userRepository->all(['name' => $authorName])->first();
        $post->users()->save($user);

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
        // Отвяжем пользователя от поста
        $post->users()->detach();

        if (empty($post)) {
            Flash::error('Post not found');

            return redirect(route('posts.index'));
        }

        $this->postRepository->delete($id);

        Flash::success('Post deleted successfully.');

        return redirect(route('posts.index'));
    }
}
