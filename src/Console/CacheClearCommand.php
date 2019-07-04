<?php

namespace Bertshang\Dictionary\Console;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Cache;

class CacheClearCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'dict:clear';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '清除缓存的字典数据';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {

        Cache::forget('dict');
        Cache::forget('type');
        $this->info('dict Cache cleared successful.');
    }
}
