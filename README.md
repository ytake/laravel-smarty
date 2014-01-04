laravel4.1 for Smarty
========
laravel4.1でsmartyを使用できます。  
通常のテンプレートへの出力の他、  
`View::assign('word', 'hello');`  
とsmartyライクにも使用できます。  
またcacheClear等が使用できます。  

install 導入方法
==================



usage 使い方
==================

app/config配下のapp.phpのproviders配列に以下のnamespaceを追加してください。  
`'Comnect\Smarty\SmartyServiceProvider'`  
view配下にsmartyファイルがあればそれをテンプレートと使用し、  
なければ通常通りbladeテンプレートかphpファイルを使用します。  

smartyテンプレート内にも*{{app_path()}}*等のヘルパーやblade構文がそのまま使用できます。  
その場合、delimiterをbladeと同じものを指定しない様にしてください。  

configファイルでこれらの指定が可能です。  
