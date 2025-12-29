<?php

namespace Paparee\BaleDindik;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;
use Livewire\Component as LivewireComponent;
use Livewire\Livewire;
use Symfony\Component\Finder\Finder;

class BaleDindikServiceProvider extends ServiceProvider
{
    /**
     * Method register()
     * 
     * Digunakan untuk mendaftarkan service, binding, atau command
     * ke dalam service container Laravel.
     */
    public function register(): void
    {
        $this->registerCommands();
    }

    protected function registerCommands(): void
    {
        $commands = [
        ];

        foreach ($commands as $key => $class) {
            $this->app->bind($key, $class);
        }

        $this->commands(array_keys($commands));
    }

    /**
     * Method boot()
     * 
     * Dipanggil setelah semua service diregistrasi.
     * Digunakan untuk load resource seperti:
     * - view
     * - migration
     * - konfigurasi
     * - Livewire component
     */
    public function boot(): void
    {
        $this->app->booted(function () {
            $this->loadRoutesFrom(__DIR__ . '/../routes/web.php');
        });

        $this->registerViews();
        $this->registerLivewireComponents();
    }

    protected function registerViews(): void
    {
        $this->loadViewsFrom(
            __DIR__ . '/../resources/views',
            'bale-dindik'
        );
    }

    protected function registerLivewireComponents(): void
    {
        $namespace = "Paparee\\BaleDindik\\Livewire";
        $basePath = __DIR__ . "/Livewire";

        // Jika folder Livewire tidak ada, hentikan proses
        if (!is_dir($basePath)) {
            return;
        }

        $finder = new Finder();
        $finder->files()->in($basePath)->name('*.php');

        foreach ($finder as $file) {
            $relativePathname = $file->getRelativePathname();

            // Normalisasi path (Windows/Linux)
            $nsPath = str_replace(['/', '\\'], '\\', $relativePathname);

            // Konversi ke FQCN (Fully Qualified Class Name)
            $class = $namespace . '\\' . Str::beforeLast($nsPath, '.php');

            // Skip jika class tidak ditemukan
            if (!class_exists($class)) {
                continue;
            }

            // Skip jika bukan turunan Livewire\Component
            if (!is_subclass_of($class, LivewireComponent::class)) {
                continue;
            }

            // Buat alias berdasarkan struktur folder (kebab-case)
            $withoutExt = Str::replaceLast('.php', '', $relativePathname);
            $segments = preg_split('#[\\/\\\\]#', $withoutExt);
            $kebab = array_map(fn($s) => Str::kebab($s), $segments);

            $alias = 'bale-dindik.' . implode('.', $kebab);

            // Registrasi komponen ke Livewire
            Livewire::component($alias, $class);
        }
    }
}
