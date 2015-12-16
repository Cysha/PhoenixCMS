<?php

namespace Cms\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
    ];

    /**
     * Define the application's command schedule.
     *
     * @param \Illuminate\Console\Scheduling\Schedule $schedule
     *
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        if (!count(app('modules')->enabled())) {
            return;
        }

        foreach (app('modules')->getOrdered() as $module) {
            if (!$module->enabled()) {
                return;
            }

            $class = sprintf('\Cms\Modules\%s\Console\Kernel', ucwords($module));
            if (!class_exists($class)) {
                continue;
            }

            with(new $class($this->app, $this->app['events']))->schedule($schedule);
        }
    }
}
