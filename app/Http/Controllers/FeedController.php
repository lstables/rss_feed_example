<?php

namespace App\Http\Controllers;

use App\Rss;
use Illuminate\Http\Request;

class FeedController extends Controller
{
    /**
     * Show list of RSS items
     * polled from the RSS artisan command
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $rss = Rss::where('actioned', '=', '0')->paginate(10);
        return view('welcome',compact('rss'));
    }

    /**
     * Action an item via given ID
     *
     * @param $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function action($id)
    {
        $feed = Rss::where('id', $id)->first()->delete();
        alert()->success('Success', 'Item deleted');

        return redirect('/');

    }

    /**
     * Show Actioned List
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function actioned()
    {
        $rss = Rss::onlyTrashed()->get();
        return view('trashed', compact('rss'));
    }

    /**
     * Force Delete the item
     *
     * @param $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function delete($id)
    {
        Rss::where('id', $id)->forceDelete();

        alert()->success('Success', 'Item permanently deleted');

        return redirect('/');
    }
}
