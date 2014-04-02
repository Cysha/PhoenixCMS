<?php

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class InstallCommand extends Command {

    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'cms:install';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Installs the CMS';

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
    public function fire()
    {
        $this->comment('');
        $this->comment('=====================================');
        $this->comment('');
        parent::info(' CMS:Install ');
        $this->comment('');
        $this->comment('-------------------------------------');
        $this->comment('');
        if ($this->confirm(' This command will rebuild your database! Continue? [yes|no]', true)) {

            $this->info('Clearing out the System Cache...');
            $this->call('cache:clear');

            if( Schema::hasTable('migrations') ){
                $this->info('Clearing out the database...');
                $this->call('migrate:reset');
            }else{
                $this->info('Setting up the database...');
                $this->call('migrate:install');
            }

            $this->info('Installing the Packages...');
            $this->call('migrate', array('--package' => 'toddish/verify'));

            $this->info('Installing the CMS Package...');
            $this->call('modules:migrate');

            $this->comment('');
            $this->comment('-------------------------------------');
            $this->comment('');
            if ($this->confirm(' Do you want to install test data into the database? [yes|no]', true)) {
                $this->call('modules:seed');
            }

        }
        $this->info('Done');
        $this->comment('=====================================');
        $this->comment('');
    }

    public function info($message){
        $this->comment('');
        $this->comment('-------------------------------------');
        parent::info(' CMS:Install - '.$message);
        $this->comment('');
    }

    /**
     * Get the console command arguments.
     *
     * @return array
     */
    protected function getArguments()
    {
        return array(
        );
    }

    /**
     * Get the console command options.
     *
     * @return array
     */
    protected function getOptions()
    {
        return array(
        );
    }

}
