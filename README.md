laravel4.1 for Smarty
========
laravel4.1でsmartyを使用できます。  
通常のテンプレートへの出力の他、  
```php
// laravel4 template render
View::make('template', ['hello']);
// like smarty
View::assign('word', 'hello');  
```
とsmartyライクにも使用できます。  
またcacheClear等が使用できます。  

install 導入方法
==================
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

smartyテンプレート内にも*{{app_path()}}*等のヘルパーやblade構文がそのまま使用できます。  
その場合、delimiterをbladeと同じものを指定しない様にしてください。  

configファイルでこれらの指定が可能です。  
