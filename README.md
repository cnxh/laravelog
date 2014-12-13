#laravelog

enhance of the default laravel logger, which provide seperating different level's log into different files. and you can store the log files just you want (such as different day different directory)

替换原有的laravel日志记录组件，提供按日志等级（debug/notice/warning/errr..etc)分文件记录日志，并且可以将这些文件动态的记录到不同目录中（比如按天记录日志）

##how to use 使用
1.edit composer.json (编辑composer.json文件，在require中新增)

		"cnxh/laravelog": "dev-master"

2."composer update"

		composer update

3.replace the default "LogServiceProvider" in "app/config/app.php" (替换掉原有的LogServicePorvider)

		......
		//'Illuminate\Log\LogServiceProvider',
		'Cnxh\Laravelog\LogServiceProvider',
		......


4.comment the default log-handler-register in "app/start/global.php", laravelog will registe the log handler automatic (注释掉"app/start/global.php"文件中的下列行)

		......
		//Log::useFiles(storage_path().'/logs/laravel.log');
		......
