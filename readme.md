### Installation

- git clone git@github.com:lstables/rss_feed_example.git

- composer install

- setup env in the normal way, but add in a new variable of `FEED_URL=http://metro.co.uk/feed/` to assign to the RRS feed.

------------------------------

- `php artisan migrate` this will migrate the usual users & password table (which are not in use in this example) but also migrate the RSS table which is required.
- once migrate as run, run `php artisan pull:rss` to get the RSS feed and save it to the database, navigate to the home page to see the list of articles appear which has links
to the rss article, as well as
action and delete functionality.