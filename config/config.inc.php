<?php
		$config['dbhost'] = '172.16.3.218';      //数据库所在IP地址
		/*$config['dbhost'] = '127.0.0.1';      //数据库所在IP地址
		$config['dbpass'] = '';   	 //数据库密码*/
		$config['dbport'] = '';  //数据库用户
		$config['dbuser'] = 'root';  //数据库用户
		$config['dbpass'] = 'root';   	 //数据库密码
		$config['dbname'] = 'mallbuilder';     //数据库名
		//$config['dbname'] = 'mallbuilder_bwj';     //数据库名
		$config['table_pre']='mallbuilder_';  //数据库表前缀
		$config['authkey']='2c7832406405c2479e3da150925a73e0';  //数据库表前缀

		/*
		 *用户中心配置
		 */
		$config['UC_state'] = true;
		if($config['UC_state']){
			$config['_UC']['uc_appid'] = "20160100136";
			$config['_UC']['uc_secret'] = "92nkdbdagls3bnfs0nsdn9ndkngiansk8nlzn8isdn";
			$config['_UC']['uc_server']="http://staging.mayionline.cn/apis/uc";
		}
		
		
		?>