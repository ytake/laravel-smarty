smarty template engine for laravel4
========
[![Build Status](https://travis-ci.org/ytake/laravel-smarty.svg?branch=master)](https://travis-ci.org/ytake/laravel-smarty)
[![Latest Stable Version](https://poser.pugx.org/comnect/smarty/v/stable.png)](https://packagist.org/packages/comnect/smarty) [![Total Downloads](https://poser.pugx.org/comnect/smarty/downloads.png)](https://packagist.org/packages/comnect/smarty) [![Latest Unstable Version](https://poser.pugx.org/comnect/smarty/v/unstable.png)](https://packagist.org/packages/comnect/smarty) [![License](https://poser.pugx.org/comnect/smarty/license.png)](https://packagist.org/packages/comnect/smarty)
##install 導入方法
###for Laravel4.2
```json
    "require": {
        "comnect/smarty": "2.*"
    },
```
###for Laravel4.1
```json
    "require": {
        "comnect/smarty": "1.*"
    },
```
##Basic
smarty template for laravel4  

laravel4でsmartyを使用できます。  
bladeの構文をそのまま使用することができ、  
それに加え、View Facadeを通じてsmartyのmethodはすべて利用可能です。  
easily use all the methods of smarty  
###required array short syntax!
```php
// laravel4 blade template render
View::make('template', ['hello']);
// use smarty method
View::assign('word', 'hello');  
View::clearAllAssign(); // smarty method
```
##Artisan
キャッシュクリア、コンパイルファイルの削除がコマンドラインから行えます。  
smarty's cacheclear, remove compile class from Artisan(cli)
###cache clear
```bash
$ php artisan comnect:smarty-cacheclear
```
Options:  
 --file (-f)           specify file  
 --time (-t)           clear all of the files that are specified duration time  
###remove compile class
```bash
$ php artisan comnect:smarty-clear-compiled
```
Options:  
 --file (-f)           specify file  

usage 使い方
==================

install後、
app/config配下のapp.phpのproviders配列に以下のnamespaceを追加してください。  
add providers
```php
'Comnect\Smarty\SmartyServiceProvider'
```

configファイルをpublishします。  
publish configure
```bash
$ php artisan config:publish comnect/smarty
```
app/config/packages配下に追加されます。  
publish to app/config/packages


views配下にsmartyファイルがあればそれをテンプレートと使用し、  
なければ通常通りbladeテンプレートかphpファイルを使用します。  

smartyテンプレート内にも*{{app_path()}}*等のヘルパーそのまま使用できます。  
その場合、delimiterをbladeと同じものを指定しない様にしてください。  

configファイルでこれらの指定が可能です。  

sample
======================
[layout.sample](https://gist.github.com/ytake/11345539)  
[layout.extends.sample](https://gist.github.com/ytake/11345614)
