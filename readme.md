# Project実行前
```php
//tool for dependency management in PHP
composer install

//make .env file
//sneakerspj/.env.example file copy

//create app key
php artisan key:generate

//create database
//name is 'sneakerspj'

//check the database setting
//.env

//database migration
php artisan migrate

//insert test data
php artisan db:seed

//start project
php artisan serve
```

---
# Project開発
## Project開始

```php
// git作業
// Project開発
laravel new sneakerspj
```

## CSS Framework設定

```php
// cssはtailwindcssを使用
composer require laravel-frontend-presets/tailwindcss --dev
php artisan ui tailwindcss
// 設定にNodeJSが必要
npm install
// mixエラー対応
npm install laravel-mix@latest
npm clean-install
npm run dev
```

## ModelとMigration

```php
// modelとMigrationを作成
php artisan make:model Product -m

// database必要（基本プロジェクト名）
// migration適用
php artisan migrate
```

- model
    - fillable
    - name, description, price
- migration
    - products table
    - id, name, description, price, timestamp

## Seeder

- テストデータ入力
- name, description, price
- （例）airforce, description about airforce, 20000

## Route

- sneakerspj/routes/web.php

```php
// indexページ
Route::get('/', [ProductsController::class, 'index']);
// 商品詳細ページ
Route::get('product/{id}', [ProductsController::class, 'show'])->name('show');
// カートページ
Route::get('cart', [ProductsController::class, 'cart'])->name('cart');
// カートに入れるボタン
Route::get('add-cart/{id}', [ProductsController::class, 'addCart'])->name('add.cart');
// ajax
Route::patch('update-cart', [ProductsController::class, 'update'])->name('update.cart');
Route::delete('remove-from-cart', [ProductsController::class, 'remove'])->name('remove.from.cart');
```

## Controller

```php
// CRUD用のcontrollerを作成
php artisan make:controller ProductsController --resource
```

- index
    - display a list of the resources
- show
    - display the resource
- cart
    - view of cart
- addCart
    - added to cart
- update
    - update to cart session
- destroy
    - destroy product from cart

## Ajax

- cart.blade.php
    
    ```php
    @section('scripts')
    <script type="text/javascript">
        
        // change event
        $(".update-cart").change(function (e) {
            e.preventDefault();
      
            var ele = $(this);
      
            $.ajax({
                url: '{{ route('update.cart') }}',
                method: "patch",
                data: {
                    _token: '{{ csrf_token() }}', 
                    id: ele.parents("tr").attr("data-id"), 
                    quantity: ele.parents("tr").find(".quantity").val()
                },
                success: function (response) {
                   window.location.reload();
                },
                error: function(data) {
                    //
                }
            });
        });
        
        // click event
        $(".remove-from-cart").click(function (e) {
            e.preventDefault();
      
            var ele = $(this);
      
            if(confirm("Are you sure want to remove?")) {
                $.ajax({
                    url: '{{ route('remove.from.cart') }}',
                    method: "DELETE",
                    data: {
                        _token: '{{ csrf_token() }}', 
                        id: ele.parents("tr").attr("data-id")
                    },
                    success: function (response) {
                        window.location.reload();
                    },
                    error: function(data) {
                        //
                    }
                });
            }
        });
      
    </script>
    @endsection
    ```
    

## Blade View

- layout/layout.blade.php
- layout/navigation.blade.php
- sneakers/cart.blade.php
- sneakers/index.blade.php
- sneakers/product.blade.php