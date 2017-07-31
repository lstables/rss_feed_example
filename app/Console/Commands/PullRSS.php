<?php

namespace App\Console\Commands;

use App\Rss;
use Carbon\Carbon;
use Illuminate\Console\Command;

class PullRSS extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'pull:rss';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Poll RSS feed into database';


    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        // get source url from ENV
        $source = env('FEED_URL');

        $headers = get_headers($source);
        $response = substr($headers[0], 9, 3);
        if ($response == '404')
        {
            return 'Invalid Source';
        }
        // get the content from the source
        $data = simplexml_load_string(file_get_contents($source));

        if (count($data) == 0)
        {
            return 'No Posts';
        }
        // Assign to posts array, and loop through, while adding to db
        $posts = '';
        foreach($data->channel->item as $item)
        {
            $posts = new Rss;
            $posts->title = $item->title;
            $posts->pubDate = $item->pubDate;
            $posts->description = $item->description;
            $posts->link = $item->link;
            $posts->save();
        }

        $this->info('RSS polled and database updated.');

        return $posts;

    }
}
