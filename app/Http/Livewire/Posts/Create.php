<?php

namespace App\Http\Livewire\Posts;

use App\Models\Post;
use Livewire\Component;
use Livewire\WithFileUploads;

class Create extends Component
{
    use WithFileUploads;

    public $title;
    public $post_text;
    public $photo;

    public function render()
    {
        return view('livewire.posts.create');
    }

    public function submit()
    {
        $this->validate([
            'title' => 'required',
            'post_text' => 'required',
        ]);

        $post = Post::create([
            'title' => $this->title,
            'post_text' => $this->post_text,
        ]);

        $this->photo->storeAs('photos', $post->id . '.' . $this->photo->extension());
        $post->update(['photo' => $post->id]);

        $this->reset();
    }

    public function updatedPhoto()
    {
        $this->validate([
            'photo' => 'required|image'
        ]);
    }
}
