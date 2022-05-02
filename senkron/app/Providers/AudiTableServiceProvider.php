<?php

namespace App\Providers;

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;

/**
 * @method foreignId(string $string)
 * @method timestamps()
 * @method timestamp(string $string)
 */
class AudiTableServiceProvider extends ServiceProvider
{
    public function register()
    {
        Blueprint::macro('audiTable', function () {

            $model = "App\Models\\" . Str::studly(Str::singular(($this->table)));
            if (class_exists($model)) {
                $model = app($model);
                if (method_exists($model, 'getMultiLanguageColumns')) {
                    if ($model->getMultiLanguageColumns()) {
                        foreach ($model->getMultiLanguageColumns() as $multi_language_column) {
                            $this->text("{$multi_language_column}_translations")->nullable();
                        }
                    }
                }
            }
            $this->foreignId('created_by')->nullable()->constrained('users');
            $this->foreignId('updated_by')->nullable()->constrained('users');
            $this->foreignId('deleted_by')->nullable()->constrained('users');
            $this->timestamps();
            $this->timestamp('deleted_at')->nullable();
        });


    }
}
