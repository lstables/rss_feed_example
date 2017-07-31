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
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $source = env('FEED_URL');

        $headers = get_headers($source);
        $response = substr($headers[0], 9, 3);
        if ($response == '404')
        {
            return 'Invalid Source';
        }

        $data = simplexml_load_string(file_get_contents($source));

        if (count($data) == 0)
        {
            return 'No Posts';
        }
        $posts = '';
        foreach($data->channel->item as $item)
        {
            $posts = new Rss;
            $posts->title = $item->title;
            $posts->pubDate = Carbon::parse($item->pubDate)->format('Y-m-d H:i:s');
            $posts->description = $item->description;
            $posts->link = $item->link;
            $posts->save();
        }

        return $posts;


        $this->info('RSS polled and database updated.');
    }
}
