<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Wishlist;
use App\Mail\Wishlistadmin;
use Illuminate\Support\Facades\Mail;
use DB;


class UsersWishlist extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'users:wishlist';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send wishlist to admin';

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
        $wishlists = Wishlist::with('products')->whereDate('created_at',DB::raw('CURDATE()'))->get();
        Mail::to('admin@demo.com')->send(new Wishlistadmin($wishlists));

    }
}
