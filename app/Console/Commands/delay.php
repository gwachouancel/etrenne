<?php

namespace App\Console\Commands;

use App\Models\User;
use App\Models\Setting;
use App\Models\Filiale;
use Illuminate\Console\Command;
use Carbon\Carbon;

class delay extends Command
{
    private $serviceRepo;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'order:delay';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Notifiy Users and admin to order something';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $limit = (new Setting())->where('slug', 'date')->first()->data;
        $filiales = (new Filiale)->wheredoesntHave('order')->get()->pluck('id')->toArray();
        
        if($limit >= ($today = date('y-m-d'))){
            $diff = Carbon::parse($limit)->diffInDays(Carbon::parse($today));

            if($diff <= 9 && ($diff % 3 == 0) ){
                $users = (new User())->whereHas('company', function($q) use($filiales){
                    return $q->whereIn('filiale_id', $filiales);
                })
                ->whereIn('role', ['admin','user'])->get();

                foreach($users as $user){
                    $msg = "Aucune commande n'a été passée sur la plateforme Demo pour votre Filiale. Il vous reste $diff Jours pour le faire";
                    \Mail::raw($msg, function($message) use($uer){
                        $message->to($user->email);
                    });
                }
            }
        }
    }
}
