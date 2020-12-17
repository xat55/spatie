<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Repositories\CategoryRepository;
use App\Repositories\PostRepository;
use App\Repositories\UserRepository;
// use App\Models\User;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

class PostController extends AppBaseController
{
    /** @var  PostRepository */
    private $postRepository;

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
        // $posts = $this->postRepository->all();
        $author = auth()->user()->name;
        $posts = $this->postRepository->all(['author' => $author]);
        
        return view('posts.index')
            ->with('posts', $posts);
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
        $input = $request->all();
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
        // $user = auth()->user();
        // dd($user);
        $post = $this->postRepository->find($id);
        // $authorName = $post->author;
        $user = $this->userRepository->all(['name' => $post->author])->first();
        // $user = $post()->user;    
        // dd($user);
        // dd($user->name);
        
        $categories = $this->categoryRepository->all()->pluck('name')->toArray();
        $categories = array_combine(range(1, count($categories)), $categories);
        // dump($categories);
        
        if (empty($post)) {
            Flash::error('Post not found');

            return redirect(route('posts.index'));
        }

        return view('posts.edit', compact('categories', 'post', 'user'));
        // ->with('post', $post);
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
        
        // Отсоединяем все категории и пользователей от поста
        $post->categories()->detach();
        $post->users()->detach();
        
        $categoryIds = $request->get('categories');
        
        foreach ($categoryIds as $categoryId) {
            $category = $this->categoryRepository->find($categoryId);
            // привязываем новый пост к категории
            $category->posts()->save($post);
        }    
        $post = $this->postRepository->update($request->all(), $id);
        
        $authorName = $request->get('author');
        $user = $this->userRepository->all(['name' => $authorName])->first();
        // привязываем новый пост к пользователю
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
