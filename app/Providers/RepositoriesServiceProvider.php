<?php

namespace App\Providers;

        use App\Repositories\Sql\CounterZekrRepository;
        use App\Repositories\Contract\CounterZekrRepositoryInterface;

        use App\Repositories\Sql\MultimediaCategoryRepository;
        use App\Repositories\Contract\MultimediaCategoryRepositoryInterface;

        use App\Repositories\Sql\Repository;
        use App\Repositories\Contract\RepositoryInterface;

        use App\Repositories\Sql\ConnectivityToolRepository;
        use App\Repositories\Contract\ConnectivityToolRepositoryInterface;

        use App\Repositories\Sql\OrderRepository;
        use App\Repositories\Contract\OrderRepositoryInterface;

        use App\Repositories\Sql\FeedBackRepository;
        use App\Repositories\Contract\FeedBackRepositoryInterface;

        use App\Repositories\Sql\AdRepository;
        use App\Repositories\Contract\AdRepositoryInterface;

        use App\Repositories\Sql\ProductRepository;
        use App\Repositories\Contract\ProductRepositoryInterface;

        use App\Repositories\Sql\PartnerRepository;
        use App\Repositories\Contract\PartnerRepositoryInterface;

        use App\Repositories\Sql\FeatureRepository;
        use App\Repositories\Contract\FeatureRepositoryInterface;

        use App\Repositories\Sql\NewsSubscriptionRepository;
        use App\Repositories\Contract\NewsSubscriptionRepositoryInterface;

        use App\Repositories\Sql\SectorRepository;
        use App\Repositories\Contract\SectorRepositoryInterface;

        use App\Repositories\Sql\BannerRepository;
        use App\Repositories\Contract\BannerRepositoryInterface;

        use App\Repositories\Sql\NewsRepository;
        use App\Repositories\Contract\NewsRepositoryInterface;

        use App\Repositories\Sql\CategoryRepository;
        use App\Repositories\Contract\CategoryRepositoryInterface;

        use App\Repositories\Sql\SettingRepository;
        use App\Repositories\Contract\SettingRepositoryInterface;

        use App\Repositories\Sql\UserRepository;
        use App\Repositories\Contract\UserRepositoryInterface;

        use App\Repositories\Sql\ContactRepository;
        use App\Repositories\Contract\ContactRepositoryInterface;
// interface


use App\Repositories\Contract\BaseRepositoryInterface;
// repository

use App\Repositories\Sql\BaseRepository;
use Illuminate\Support\ServiceProvider;

class RepositoriesServiceProvider extends ServiceProvider
{

    public function register(){

        $this->app->bind(CounterZekrRepositoryInterface::class, CounterZekrRepository::class);

        $this->app->bind(MultimediaCategoryRepositoryInterface::class, MultimediaCategoryRepository::class);

        $this->app->bind(RepositoryInterface::class, Repository::class);

        $this->app->bind(ConnectivityToolRepositoryInterface::class, ConnectivityToolRepository::class);

        $this->app->bind(OrderRepositoryInterface::class, OrderRepository::class);

        $this->app->bind(FeedBackRepositoryInterface::class, FeedBackRepository::class);

        $this->app->bind(AdRepositoryInterface::class, AdRepository::class);

        $this->app->bind(ProductRepositoryInterface::class, ProductRepository::class);

        $this->app->bind(PartnerRepositoryInterface::class, PartnerRepository::class);

        $this->app->bind(FeatureRepositoryInterface::class, FeatureRepository::class);

        $this->app->bind(NewsSubscriptionRepositoryInterface::class, NewsSubscriptionRepository::class);

        $this->app->bind(SectorRepositoryInterface::class, SectorRepository::class);

        $this->app->bind(BannerRepositoryInterface::class, BannerRepository::class);

        $this->app->bind(NewsRepositoryInterface::class, NewsRepository::class);

        $this->app->bind(CategoryRepositoryInterface::class, CategoryRepository::class);

        $this->app->bind(ContactRepositoryInterface::class, ContactRepository::class);

        $this->app->bind(SettingRepositoryInterface::class, SettingRepository::class);

        $this->app->bind(UserRepositoryInterface::class, UserRepository::class);

        $this->app->bind(BaseRepositoryInterface::class, BaseRepository::class);
    }

    public function boot()
    {
        //
    }

}
