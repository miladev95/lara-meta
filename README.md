# Laravel Meta

[![Latest Stable Version](https://poser.pugx.org/miladev/lara-meta/v)](//packagist.org/packages/miladev/lara-meta)
[![License](https://poser.pugx.org/miladev/lara-meta/license)](//packagist.org/packages/miladev/lara-meta)
[![Total Downloads](https://poser.pugx.org/miladev/lara-meta/downloads)](//packagist.org/packages/miladev/lara-meta)

<a href="https://github.com/miladev95/lara-meta/issues"><img src="https://img.shields.io/github/issues/miladev95/lara-meta.svg" alt=""></a>
<a href="https://github.com/miladev95/lara-meta/stargazers"><img src="https://img.shields.io/github/stars/miladev95/lara-meta.svg" alt=""></a>
<a href="https://github.com/miladev95/lara-meta/network"><img src="https://img.shields.io/github/forks/miladev95/lara-meta.svg" alt=""></a>

Save metadata (key, value) with any model.

---
Sometimes, we may need to store few extra information for some objects.
In some situation, it's not good solution to add new columns.
This package can solve those issues.

The package will create a table in database named `laravel_metas` with key, value and metable column.
However, table name can be changed by updating table_name in `config/meta.php`.
N.B: After changing table_name, you need to delete the previous table (if exists) from DB and delete the `create_meta_table` row from `migrations` table.
Then re-run the `php artisan migrate` command again.

## Installation

You can install the package via composer:

```bash
composer require miladev/lara-meta
```

If you are using Laravel Package Auto-Discovery, you don't need you to manually add the ServiceProvider.

#### Without auto-discovery:

If you don't use auto-discovery, add the below ServiceProvider to the `$providers` array in `config/app.php` file.

```php
Miladev\LaravelMeta\MetaServiceProvider::class,
```

If you want to change the meta table name, then first publish the config file.

```bash
php artisan vendor:publish --provider="Miladev\LaravelMeta\MetaServiceProvider"
```

Then, update the `table_name` value in `config/meta.php`.

Then you can run migration command to create database table.

```bash
php artisan migrate
```

## Usage

Add `Miladev\LaravelMeta\Metable` trait to models where you need.

```php
use \Illuminate\Database\Eloquent\Model;
use \Miladev\LaravelMeta\Metable;

class Post extends Model
{
    use Metable;
}
```

Then you can access like below:

```php
$post = Post::withMetas()->first();
```

```php
$post = Post::first();
$post->metas;
```

```php
$post = Post::first();
$post->saveMeta('meta_key_here', 'value_here');
$post->getMeta('meta_key_here', 'default_value');
$post->updateMeta('meta_key_here', 'value_here_new');
$post->deleteMeta('meta_key_here');
```

## Contribute

If you want to contribute, open a pull request by following Laravel contribution guide.

## License

The MIT License (MIT). Please see [License File](LICENSE) for more information.