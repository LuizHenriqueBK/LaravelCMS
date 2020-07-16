<?php

namespace LuizHenriqueBK\LaravelCMS\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\{Composer, Facades\File};

class LaravelCmsCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'cms:install';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Install Laravel CMS';

    /**
     * The Composer instance.
     *
     * @var \Illuminate\Support\Composer
     */
    protected $composer;

    /**
     * Create a new command instance.
     *
     * @param Composer $composer
     * @return void
     */
    public function __construct(Composer $composer)
    {
        parent::__construct();

        $this->composer = $composer;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $source_path = join('/', [dirname(dirname(__DIR__)), 'stubs']);

        // copy Controllers, Middlewares and Requests files
        $this->line('copying Controllers, Middlewares and Requests files ...');
        $from = glob($source_path.'/app/*', GLOB_ONLYDIR);
        $to   = app_path();
        $this->copyCmsFiles($from, $to);

        // copy database files
        $this->line('copying Database files ...');
        $from = glob($source_path.'/database/*', GLOB_ONLYDIR);
        $to   = database_path();
        $this->copyCmsFiles($from, $to);

        // copy Resources and assets files
        $this->line('copying Resources files ...');
        $from = glob($source_path.'/resources/admin/*', GLOB_ONLYDIR);
        $to   = resource_path('admin');
        $this->copyCmsFiles($from, $to);

        // copy lang files
        $this->line('copying Lang files ...');
        $from = glob($source_path.'/resources/lang/*', GLOB_ONLYDIR);
        $to   = resource_path('lang');
        $this->copyCmsFiles($from, $to);

        // copy routes files
        $this->line('copying Routes files ...');
        $from = glob($source_path.'/routes/*', GLOB_ONLYDIR);
        $to   = base_path('routes');
        $this->copyCmsFiles($from, $to);

        // Add Assets to package.json
        $this->line('Add Assets to package.json ...');
        $this->updatePackages();
        $this->pasteWebPackMix($source_path);

        //composer dump-autolod
        $this->line('Running composer dump-autoload --optimize ...');
        $this->composer->dumpOptimized();

        $this->line('Running migrations and seeds ...');
        $this->call('migrate');
        $this->call('db:seed', ['--class'=>'PermissionsTableSeeder']);
        $this->call('db:seed', ['--class'=>'RolesTableSeeder']);
        $this->call('db:seed', ['--class'=>'AdminUserTableSeeder']);
    }

    public function copyCmsFiles($from, $to, $ignore_files = [])
    {
        if (! File::exists($to)) {
            mkdir($to, 0755, true);
        }

        foreach ($from as $path) {
            $dest = join('/', [$to, basename($path)]);

            File::isDirectory($path) ?
                File::copyDirectory($path, $dest):
                File::copy($path, $dest);
        }

        return true;
    }

    /**
     * Update the given package array.
     *
     * @param  array  $packages
     * @return array
     */
    private function updatePackageArray(array $packages)
    {
        return [
            "@fortawesome/fontawesome-free" => "^5.13.0",
            "animate.css" => "^4.1.0",
            "axios" => "^0.19.2",
            "bootstrap" => "^4.5.0",
            "bootstrap-select" => "^1.13.17",
            "bootstrap4-toggle" => "^3.6.1",
            "dropify" => "^0.2.2",
            "jquery" => "^3.5.1",
            "popper.js" => "^1.12",
            "startbootstrap-sb-admin-2" => "^4.1.1",
            "sweetalert" => "^2.1.2",
            "vue" => "^2.6.11"
       ] + $packages;
    }

    /**
     * Update the "package.json" file.
     *
     * @param  bool  $dev
     * @return void
     */
    private function updatePackages()
    {
        if (! File::exists(base_path('package.json'))) {
            return;
        }

        $packages = json_decode(File::get(base_path('package.json')), true);

        $dependencies = array_key_exists('dependencies', $packages) ? $packages['dependencies'] : [];

        $packages['dependencies'] = $this->updatePackageArray($dependencies);

        ksort($packages['dependencies']);

        File::put(
            base_path('package.json'),
            json_encode($packages, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT).PHP_EOL
        );
    }

    /**
     * Update the "webpack.mix.js" file.
     *
     * @param  String  $webPack
     * @return void
     */
    private function pasteWebPackMix($source_path)
    {
        preg_match('/\/\/Admin/', File::get($webPack = base_path('webpack.mix.js')), $has);

        if (!count($has)) {
            File::append($webPack, File::get($source_path.'/webpack.mix.js'));
        }
    }
}
