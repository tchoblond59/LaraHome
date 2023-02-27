<?php

namespace App\Console\Commands;

use App\User;
use Illuminate\Console\Command;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class LarahomeCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'larahome:install';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command to install the basics of Larahome';

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
        if(User::all()->count()==0)
        {
            $user = new User();
            $user->name = "admin";
            $user->email = "admin@admin.com";
            $user->password = \Hash::make("admin");
            $user->save();

            $role = Role::create(['name' => 'admin']);

            $perms = ['list sensor', 'create sensor', 'update sensor', 'create user'];
            foreach ($perms as $perm)
            {
                Permission::create(['name' => $perm]);
                $role->givePermissionTo($perm);
            }
            $user->assignRole('admin');
            $this->info('User admin@admin.com with admin password created');
        }
        else
        {
            $this->info('Nothing to do, there is already a user in database');
        }
        return 0;
    }
}
