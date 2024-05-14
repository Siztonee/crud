<?php

namespace App\Console\Commands;

use App\Components\ImportDataClient;
use App\Models\Post;
use Illuminate\Console\Command;

class ImportJsonPlaceholderCommand extends Command
{

    protected $signature = 'import:jsonplaceholder';

    protected $description = 'Get data from JsonPlaceholder';

    /**
     * Execute the console command.
     */

    public function handle()
    {
        $import = new ImportDataClient();
        $response = $import->client->request('GET', 'posts');
        $data = json_decode($response->getBody()->getContents());
        foreach ($data as $post) {
            Post::firstOrCreate([
                'title' => $post->title
            ], [
                'title' => $post->title,
                'content' => $post->body,
                'category_id' => 2,
            ]);

            dd('Success!');
        }
    }
}
