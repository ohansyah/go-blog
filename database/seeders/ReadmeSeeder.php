<?php

namespace Database\Seeders;

use App\Models\Post;
use Illuminate\Database\Seeder;

class ReadmeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $content = "
        <p>Welcome to GO-Blog, your go-to platform for sharing knowledge and tips about Laravel, PHP, and a variety of other related topics. We're delighted to have you here as a part of our growing community of developers, enthusiasts, and learners.</p>
        <h2>About GO-Blog</h2>
        <p>GO-Blog is built on a strong foundation of cutting-edge technologies to provide you with the best possible experience:</p>
        <ul>
        <li>PHP (^8.1) - The backbone of our platform, ensuring powerful and efficient backend operations.</li>
        <li>Laravel Framework (^10.10) - Our chosen PHP framework, is known for its elegance and developer-friendly features.</li>
        <li>Laravel Jetstream (^3.2) - A beautifully designed application scaffolding that simplifies the development process.</li>
        <li>Livewire (^2.12) - Our go-to choice for creating dynamic user interfaces within Laravel.</li>
        <li>Tailwind CSS (^2.2) - A utility-first CSS framework that enables us to craft custom and responsive user interfaces rapidly.</li>
        <li>DaisyUI (^2.5) - Enhancing Tailwind CSS with a component library, adding style and functionality effortlessly.</li>
        <li>TinyMCE - Empowering content creation with a user-friendly rich text editor, making sharing your knowledge a breeze.</li>
        </ul>
        <h2>Join Our Community</h2>
        <p>At GO-Blog, we believe in the power of knowledge sharing and collaboration. Whether you're here to learn, share your expertise, or simply stay updated with the latest trends in Laravel and PHP, you're in the right place.</p>
        <p>Feel free to explore the wealth of information our community has to offer, and don't hesitate to join the conversation. Engage with fellow members, ask questions, share your thoughts, and let's grow together as developers.</p>
        <h2>Get Started</h2>
        <p>Ready to dive in? Here's how you can get started with GO-Blog:</p>
        <ol>
        <li><strong>Sign Up</strong>: Create your account and become a part of our community.</li>
        <li><strong>Explore</strong>: Discover a wide range of articles, tutorials, and discussions.</li>
        <li><strong>Share</strong>: Contribute your own knowledge and tips to help others.</li>
        <li><strong>Connect</strong>: Connect with like-minded individuals who share your interests.</li>
        <li><strong>Stay Updated</strong>: Stay informed about the latest happenings in the Laravel and PHP world.</li>
        </ol>
        <p>We're thrilled to have you with us on this exciting journey of learning and collaboration. Thank you for choosing GO-Blog, and we look forward to your contributions and interactions within our community.</p>
        <p>Happy coding and happy sharing!</p>
        <p>Sincerely,</p>
        <p>Ohansyah - The GO-Blog Team</p>";

        $post = Post::Create([
            'category_id' => 3,
            'slug' => 'readme',
            'title' => 'Readme',
            'content' => $content,
        ]);

        $post->postTags()->create([
            'tag_id' => 1,
        ]);

        $post->userPost()->create([
            'user_id' => 0,
        ]);


    }
}
