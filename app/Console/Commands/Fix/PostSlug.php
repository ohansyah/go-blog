<?php

namespace App\Console\Commands\Fix;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class PostSlug extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'fix:post-slug';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fix empty post slug';

    protected $chunkSize = 100;

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Fixing empty post slug...');

        $count = DB::table('posts')->whereNull('slug')->count();
        if ($count === 0) {
            $this->info('No posts with empty slug found');
            return;
        }
        $this->info('Found ' . $count . ' posts with empty slug');

        DB::table('posts')
            ->whereNull('slug')
            ->chunkById($this->chunkSize, function ($posts) {
                foreach ($posts as $post) {
                    $slug = Str::slug($post->title);
                    DB::table('posts')
                        ->where('id', $post->id)
                        ->update(['slug' => $slug]);
                    $this->info('Updated post ' . $post->id . ' with slug ' . $slug);
                }
            });

        $this->info('Success ' . $this->description);
    }
}
