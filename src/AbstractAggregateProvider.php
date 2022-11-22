<?php
declare(strict_types=1);

namespace GetSDK\Shared\System;

/**
 * AbstractAggregateProvider
 *
 * @author bu0nq <hello@bu0nq.ru>
 */
abstract class AbstractAggregateProvider extends AbstractBootstrapProvider
{
    /**
     * @var array
     */
    protected array $providers = [];

    /**
     * @var array
     */
    protected array $instances = [];

    /**
     * @return void
     */
    public function register() : void
    {
        $this->instances = [];

        foreach ($this->providers as $provider) {
            $this->instances[] = $this->app->register(
                $provider
            );
        }
    }

    /**
     * @return array
     */
    public function provides() : array
    {
        $provides = [];

        foreach ($this->providers as $provider) {
            $instance = $this->app->resolveProvider(
                $provider
            );

            $provides = array_merge(
                $provides, $instance->provides()
            );
        }

        return $provides;
    }
}
