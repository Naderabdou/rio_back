<?php

namespace App\Console\Commands;

use App\Models\Alert;
use App\Models\Active;
use App\Notifications\AppNotification;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Notification;

class AlertNotifictions extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:alert-notifictions {type}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
         $users = $this->argument('type');

            dd($users);

        $alerts = Alert::all();
        $alert_ids = $alerts->pluck('id');
        $actives = Active::whereIn('alert_id', $alert_ids)
            ->where('is_active', 1)
            ->whereHas('user' , function($q){
                $q->whereHas('firebase_tokens');
            })->get();

        foreach ($actives as $active){
            $users = $active->user;
            $data = [
                'name_ar' =>'تنبيه جديد',
                'name_en' => 'New Alert',
                'body_ar' => $active->alert->title,
                'body_en' => $active->alert->title,

            ];

            Notification::send($users, new AppNotification($data));




            // SendMobileNotification::dispatch($users, $data);
        }








    }
}
