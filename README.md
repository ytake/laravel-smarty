smarty template engine for laravel4
========

##Basic
laravel4でsmartyを使用できます。  
bladeの構文をそのまま使用することができ(デリミタは重複しないように)、  
それに加え、smartyのmethodはすべて利用可能です。
```php
// laravel4 blade template render
View::make('template', ['hello']);
// use smarty method
View::assign('word', 'hello');  
View::clearAllAssign();  
```
##Artisan
キャッシュクリア、コンパイルファイルの削除がコマンドラインから行えます。
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

##install 導入方法
composer.jsonのrequireに追記してください。
```json
	"require": {
		"comnect/smarty": "dev-master"
	},
```


usage 使い方
==================

install後、
app/config配下のapp.phpのproviders配列に以下のnamespaceを追加してください。  
```php
'Comnect\Smarty\SmartyServiceProvider'
```

configファイルをpublishします。
```bash
$ php artisan config:publish comnect/smarty
```
app/config/packages配下に追加されます。  


view配下にsmartyファイルがあればそれをテンプレートと使用し、  
なければ通常通りbladeテンプレートかphpファイルを使用します。  

smartyテンプレート内にも*{{app_path()}}*等のヘルパーそのまま使用できます。  
その場合、delimiterをbladeと同じものを指定しない様にしてください。  

configファイルでこれらの指定が可能です。  
