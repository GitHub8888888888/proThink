DROP TABLE IF EXISTS `ithink_blog_article`;
CREATE TABLE `ithink_blog_article` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `title` char(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '标题',
  `category` tinyint(3) unsigned NOT NULL DEFAULT '1' COMMENT '类型,1:文章;2:单页',
  `source_type` tinyint(3) unsigned NOT NULL DEFAULT '1' COMMENT '内容来源;1:模板页面;2:文本编辑器',
  `content` longtext COMMENT '文章内容',
  `type` int(11) NOT NULL COMMENT '博文分类',
  `uid` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '发表者用户id',
  `is_published` tinyint(3) unsigned NOT NULL DEFAULT '1' COMMENT '状态;1:已发布;0:未发布;',
  `is_allow_comments` tinyint(3) unsigned NOT NULL DEFAULT '1' COMMENT '评论状态;1:允许;0:不允许',
  `is_top` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '是否置顶;1:置顶;0:不置顶',
  `Viewing_times` int(20) unsigned NOT NULL DEFAULT '0' COMMENT '查看数',
  `favorites` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '收藏数',
  `comment_count` int(20) unsigned NOT NULL DEFAULT '0' COMMENT '评论数',
  `update_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '更新时间',
  `published_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '发布时间',
  `keywords` varchar(150) NOT NULL DEFAULT '' COMMENT 'seo keywords',
  `abstruct` varchar(500) NOT NULL DEFAULT '' COMMENT '摘要',
  `source` varchar(150) NOT NULL DEFAULT '' COMMENT '转载文章的来源',
  `thumbnail` varchar(100) NOT NULL DEFAULT '' COMMENT '缩略图',
  `more` text COMMENT '扩展属性,如缩略图;格式为json',
  `time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '添加时间',
  `del_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '删除时间',
  `status` tinyint(4) NOT NULL COMMENT '0:禁用, 1:正常, 2:已删除',
  PRIMARY KEY (`id`),
  KEY `type_status_date` (`category`,`is_published`,`time`,`id`),
  KEY `user_id` (`uid`),
  KEY `create_time` (`time`) USING BTREE
) ENGINE=InnoDB    DEFAULT CHARSET=utf8 COMMENT='文章表';
INSERT INTO `ithink_blog_article` (`id` , `title` , `category` , `source_type` , `content` , `type` , `uid` , `is_published` , `is_allow_comments` , `is_top` , `Viewing_times` , `favorites` , `comment_count` , `update_time` , `published_time` , `keywords` , `abstruct` , `source` , `thumbnail` , `more` , `time` , `del_time` , `status`) VALUES ( 14,'iThink博客系统',1,1,'&amp;lt;h2&amp;gt;&amp;lt;/h2&amp;gt;&amp;lt;h2&amp;gt;&amp;lt;/h2&amp;gt;&amp;lt;h2&amp;gt;&amp;lt;/h2&amp;gt;&amp;lt;h3&amp;gt;&amp;lt;blockquote&amp;gt;&amp;lt;ul&amp;gt;&amp;lt;li&amp;gt;iThink 博客系统是一款基于iThink的博客应用，以应用的形式安装在iThink中，类似安卓系统上安装的apk软件包&amp;lt;/li&amp;gt;&amp;lt;/ul&amp;gt;&amp;lt;ul&amp;gt;&amp;lt;li&amp;gt;iThink 博客系统存在的主要目的为位iThink应用者提供一个应用开发参考规范，方便广大开发者更方便高效的开发更多更优秀，功能更强大的iThink应用&amp;lt;/li&amp;gt;&amp;lt;/ul&amp;gt;&amp;lt;/blockquote&amp;gt;&amp;lt;blockquote&amp;gt;&amp;lt;table class=\\&amp;quot;table\\&amp;quot; style=\\&amp;quot;background-color: rgb(243, 243, 244); width: 777px; font-family: \\&amp;quot;open sans\\&amp;quot;, \\&amp;quot;Helvetica Neue\\&amp;quot;, Helvetica, Arial, sans-serif; font-size: 15px;\\&amp;quot;&amp;gt;&amp;lt;tbody id=\\&amp;quot;tb\\&amp;quot;&amp;gt;&amp;lt;tr&amp;gt;&amp;lt;td style=\\&amp;quot;padding: 4px; line-height: 1.1; vertical-align: middle; border-top-color: rgb(231, 234, 236);\\&amp;quot;&amp;gt;产品名称&amp;lt;/td&amp;gt;&amp;lt;td style=\\&amp;quot;padding: 4px; line-height: 1.1; vertical-align: middle; border-top-color: rgb(231, 234, 236);\\&amp;quot;&amp;gt;iThink&amp;lt;/td&amp;gt;&amp;lt;/tr&amp;gt;&amp;lt;tr&amp;gt;&amp;lt;td style=\\&amp;quot;padding: 4px; line-height: 1.1; vertical-align: middle; border-top-color: rgb(231, 234, 236);\\&amp;quot;&amp;gt;官方网站&amp;lt;/td&amp;gt;&amp;lt;td style=\\&amp;quot;padding: 4px; line-height: 1.1; vertical-align: middle; border-top-color: rgb(231, 234, 236);\\&amp;quot;&amp;gt;&amp;lt;a target=\\&amp;quot;_blank\\&amp;quot; href=\\&amp;quot;http://www.ithinkphp.org/\\&amp;quot; style=\\&amp;quot;color: rgb(51, 122, 183);\\&amp;quot;&amp;gt;www.ithinkphp.org&amp;lt;/a&amp;gt;&amp;lt;/td&amp;gt;&amp;lt;/tr&amp;gt;&amp;lt;tr&amp;gt;&amp;lt;td style=\\&amp;quot;padding: 4px; line-height: 1.1; vertical-align: middle; border-top-color: rgb(231, 234, 236);\\&amp;quot;&amp;gt;交流社区&amp;lt;/td&amp;gt;&amp;lt;td style=\\&amp;quot;padding: 4px; line-height: 1.1; vertical-align: middle; border-top-color: rgb(231, 234, 236);\\&amp;quot;&amp;gt;&amp;lt;a target=\\&amp;quot;_blank\\&amp;quot; href=\\&amp;quot;http://forum.ithinkphp.org/\\&amp;quot; style=\\&amp;quot;color: rgb(51, 122, 183);\\&amp;quot;&amp;gt;forum.ithinkphp.org&amp;lt;/a&amp;gt;&amp;lt;/td&amp;gt;&amp;lt;/tr&amp;gt;&amp;lt;tr&amp;gt;&amp;lt;td style=\\&amp;quot;padding: 4px; line-height: 1.1; vertical-align: middle; border-top-color: rgb(231, 234, 236);\\&amp;quot;&amp;gt;码云仓库&amp;lt;/td&amp;gt;&amp;lt;td style=\\&amp;quot;padding: 4px; line-height: 1.1; vertical-align: middle; border-top-color: rgb(231, 234, 236);\\&amp;quot;&amp;gt;&amp;lt;a target=\\&amp;quot;_blank\\&amp;quot; href=\\&amp;quot;https://gitee.com/wf5858585858/iThink\\&amp;quot; style=\\&amp;quot;color: rgb(51, 122, 183);\\&amp;quot;&amp;gt;https://gitee.com/wf5858585858/iThink&amp;lt;/a&amp;gt;&amp;lt;/td&amp;gt;&amp;lt;/tr&amp;gt;&amp;lt;tr&amp;gt;&amp;lt;td style=\\&amp;quot;padding: 4px; line-height: 1.1; vertical-align: middle; border-top-color: rgb(231, 234, 236);\\&amp;quot;&amp;gt;开发手册&amp;lt;/td&amp;gt;&amp;lt;td style=\\&amp;quot;padding: 4px; line-height: 1.1; vertical-align: middle; border-top-color: rgb(231, 234, 236);\\&amp;quot;&amp;gt;&amp;lt;/td&amp;gt;&amp;lt;/tr&amp;gt;&amp;lt;tr&amp;gt;&amp;lt;td style=\\&amp;quot;padding: 4px; line-height: 1.1; vertical-align: middle; border-top-color: rgb(231, 234, 236);\\&amp;quot;&amp;gt;交流QQ群&amp;lt;/td&amp;gt;&amp;lt;td style=\\&amp;quot;padding: 4px; line-height: 1.1; vertical-align: middle; border-top-color: rgb(231, 234, 236);\\&amp;quot;&amp;gt;419395011&amp;lt;/td&amp;gt;&amp;lt;/tr&amp;gt;&amp;lt;tr&amp;gt;&amp;lt;td style=\\&amp;quot;padding: 4px; line-height: 1.1; vertical-align: middle; border-top-color: rgb(231, 234, 236);\\&amp;quot;&amp;gt;联系邮箱&amp;lt;/td&amp;gt;&amp;lt;td style=\\&amp;quot;padding: 4px; line-height: 1.1; vertical-align: middle; border-top-color: rgb(231, 234, 236);\\&amp;quot;&amp;gt;wf585858@yeah.net&amp;lt;/td&amp;gt;&amp;lt;/tr&amp;gt;&amp;lt;/tbody&amp;gt;&amp;lt;/table&amp;gt;&amp;lt;/blockquote&amp;gt;&amp;lt;/h3&amp;gt;',13,1,1,1,0,0,0,0,0,0,'','iThink 博客系统存在的主要目的为位iThink应用者提供一个应用开发参考规范，方便广大开发者更方便高效的开发更多更优秀，功能更强大的iThink应用','','',NULL,1542157591,0,1 ) , ( 15,'开发规范',1,1,'&amp;lt;h2 style=\\&amp;quot;box-sizing: inherit; -webkit-font-smoothing: antialiased; -webkit-tap-highlight-color: transparent; text-size-adjust: none; font-family: dashicons, \\&amp;quot;Segoe UI\\&amp;quot;, \\&amp;quot;WenQuanYi Micro Hei\\&amp;quot;, \\&amp;quot;WenQuanYi Micro Hei Mono\\&amp;quot;, \\&amp;quot;Microsoft Yahei\\&amp;quot;, \\&amp;quot;Microsoft Yahei Mono\\&amp;quot;, 微软雅黑, sans-serif; padding: 0px 0px 0.3em; line-height: 1.225; margin: 0px 0px 14px; font-size: 24px; border-bottom: 1px solid rgb(238, 238, 238); color: rgb(82, 82, 82); background-color: rgb(255, 255, 255);\\&amp;quot;&amp;gt;命名规范&amp;lt;/h2&amp;gt;&amp;lt;p style=\\&amp;quot;box-sizing: inherit; -webkit-font-smoothing: antialiased; -webkit-tap-highlight-color: transparent; text-size-adjust: none; line-height: 2; margin-bottom: 0px; font-family: dashicons, \\&amp;quot;Segoe UI\\&amp;quot;, \\&amp;quot;WenQuanYi Micro Hei\\&amp;quot;, \\&amp;quot;WenQuanYi Micro Hei Mono\\&amp;quot;, \\&amp;quot;Microsoft Yahei\\&amp;quot;, \\&amp;quot;Microsoft Yahei Mono\\&amp;quot;, 微软雅黑, sans-serif; padding: 0px; color: rgb(82, 82, 82); background-color: rgb(255, 255, 255);\\&amp;quot;&amp;gt;&amp;lt;code style=\\&amp;quot;box-sizing: inherit; -webkit-font-smoothing: antialiased; -webkit-tap-highlight-color: transparent; text-size-adjust: none; font-family: Consolas, Monaco, \\&amp;quot;Andale Mono\\&amp;quot;, \\&amp;quot;Ubuntu Mono\\&amp;quot;, monospace; font-size: 1em; background: rgb(249, 250, 250); display: inline-block; line-height: 1.3; margin: 0px 5px; padding-right: 6px; padding-left: 6px; white-space: pre; word-break: break-all; border: 1px solid rgb(222, 217, 217);\\&amp;quot;&amp;gt;ThinkPHP5&amp;lt;/code&amp;gt;遵循&amp;lt;code style=\\&amp;quot;box-sizing: inherit; -webkit-font-smoothing: antialiased; -webkit-tap-highlight-color: transparent; text-size-adjust: none; font-family: Consolas, Monaco, \\&amp;quot;Andale Mono\\&amp;quot;, \\&amp;quot;Ubuntu Mono\\&amp;quot;, monospace; font-size: 1em; background: rgb(249, 250, 250); display: inline-block; line-height: 1.3; margin: 0px 5px; padding-right: 6px; padding-left: 6px; white-space: pre; word-break: break-all; border: 1px solid rgb(222, 217, 217);\\&amp;quot;&amp;gt;PSR-2&amp;lt;/code&amp;gt;命名规范和&amp;lt;code style=\\&amp;quot;box-sizing: inherit; -webkit-font-smoothing: antialiased; -webkit-tap-highlight-color: transparent; text-size-adjust: none; font-family: Consolas, Monaco, \\&amp;quot;Andale Mono\\&amp;quot;, \\&amp;quot;Ubuntu Mono\\&amp;quot;, monospace; font-size: 1em; background: rgb(249, 250, 250); display: inline-block; line-height: 1.3; margin: 0px 5px; padding-right: 6px; padding-left: 6px; white-space: pre; word-break: break-all; border: 1px solid rgb(222, 217, 217);\\&amp;quot;&amp;gt;PSR-4&amp;lt;/code&amp;gt;自动加载规范，并且注意如下规范：&amp;lt;/p&amp;gt;&amp;lt;h3 style=\\&amp;quot;box-sizing: inherit; -webkit-font-smoothing: antialiased; -webkit-tap-highlight-color: transparent; text-size-adjust: none; font-family: dashicons, \\&amp;quot;Segoe UI\\&amp;quot;, \\&amp;quot;WenQuanYi Micro Hei\\&amp;quot;, \\&amp;quot;WenQuanYi Micro Hei Mono\\&amp;quot;, \\&amp;quot;Microsoft Yahei\\&amp;quot;, \\&amp;quot;Microsoft Yahei Mono\\&amp;quot;, 微软雅黑, sans-serif; padding: 0px; line-height: 1.43; margin: 14px 0px; font-size: 1.2em; color: rgb(82, 82, 82); background-color: rgb(255, 255, 255);\\&amp;quot;&amp;gt;&amp;lt;a id=\\&amp;quot;_4\\&amp;quot; style=\\&amp;quot;box-sizing: inherit; -webkit-font-smoothing: antialiased; -webkit-tap-highlight-color: transparent; text-size-adjust: none; color: rgb(65, 131, 196); margin-top: -66px; position: absolute;\\&amp;quot;&amp;gt;&amp;lt;/a&amp;gt;目录和文件&amp;lt;/h3&amp;gt;&amp;lt;ul style=\\&amp;quot;box-sizing: inherit; -webkit-font-smoothing: antialiased; -webkit-tap-highlight-color: transparent; text-size-adjust: none; font-family: dashicons, \\&amp;quot;Segoe UI\\&amp;quot;, \\&amp;quot;WenQuanYi Micro Hei\\&amp;quot;, \\&amp;quot;WenQuanYi Micro Hei Mono\\&amp;quot;, \\&amp;quot;Microsoft Yahei\\&amp;quot;, \\&amp;quot;Microsoft Yahei Mono\\&amp;quot;, 微软雅黑, sans-serif; line-height: 1.2; margin: 14px 0px; padding: 0px 0px 0px 28px; color: rgb(82, 82, 82); background-color: rgb(255, 255, 255);\\&amp;quot;&amp;gt;&amp;lt;li style=\\&amp;quot;box-sizing: inherit; -webkit-font-smoothing: antialiased; -webkit-tap-highlight-color: transparent; text-size-adjust: none; line-height: 2;\\&amp;quot;&amp;gt;目录使用小写+下划线；&amp;lt;/li&amp;gt;&amp;lt;li style=\\&amp;quot;box-sizing: inherit; -webkit-font-smoothing: antialiased; -webkit-tap-highlight-color: transparent; text-size-adjust: none; line-height: 2;\\&amp;quot;&amp;gt;类库、函数文件统一以&amp;lt;code style=\\&amp;quot;box-sizing: inherit; -webkit-font-smoothing: antialiased; -webkit-tap-highlight-color: transparent; text-size-adjust: none; font-family: Consolas, Monaco, \\&amp;quot;Andale Mono\\&amp;quot;, \\&amp;quot;Ubuntu Mono\\&amp;quot;, monospace; font-size: 1em; background: rgb(249, 250, 250); display: inline-block; line-height: 1.3; margin: 0px 5px; padding-right: 6px; padding-left: 6px; white-space: pre; word-break: break-all; border: 1px solid rgb(222, 217, 217);\\&amp;quot;&amp;gt;.php&amp;lt;/code&amp;gt;为后缀；&amp;lt;/li&amp;gt;&amp;lt;li style=\\&amp;quot;box-sizing: inherit; -webkit-font-smoothing: antialiased; -webkit-tap-highlight-color: transparent; text-size-adjust: none; line-height: 2;\\&amp;quot;&amp;gt;类的文件名均以命名空间定义，并且命名空间的路径和类库文件所在路径一致；&amp;lt;/li&amp;gt;&amp;lt;li style=\\&amp;quot;box-sizing: inherit; -webkit-font-smoothing: antialiased; -webkit-tap-highlight-color: transparent; text-size-adjust: none; line-height: 2;\\&amp;quot;&amp;gt;类文件采用驼峰法命名（首字母大写），其它文件采用小写+下划线命名；&amp;lt;/li&amp;gt;&amp;lt;li style=\\&amp;quot;box-sizing: inherit; -webkit-font-smoothing: antialiased; -webkit-tap-highlight-color: transparent; text-size-adjust: none; line-height: 2;\\&amp;quot;&amp;gt;类名和类文件名保持一致，统一采用驼峰法命名（首字母大写）；&amp;lt;/li&amp;gt;&amp;lt;/ul&amp;gt;&amp;lt;h3 style=\\&amp;quot;box-sizing: inherit; -webkit-font-smoothing: antialiased; -webkit-tap-highlight-color: transparent; text-size-adjust: none; font-family: dashicons, \\&amp;quot;Segoe UI\\&amp;quot;, \\&amp;quot;WenQuanYi Micro Hei\\&amp;quot;, \\&amp;quot;WenQuanYi Micro Hei Mono\\&amp;quot;, \\&amp;quot;Microsoft Yahei\\&amp;quot;, \\&amp;quot;Microsoft Yahei Mono\\&amp;quot;, 微软雅黑, sans-serif; padding: 0px; line-height: 1.43; margin: 14px 0px; font-size: 1.2em; color: rgb(82, 82, 82); background-color: rgb(255, 255, 255);\\&amp;quot;&amp;gt;&amp;lt;a id=\\&amp;quot;_13\\&amp;quot; style=\\&amp;quot;box-sizing: inherit; -webkit-font-smoothing: antialiased; -webkit-tap-highlight-color: transparent; text-size-adjust: none; color: rgb(65, 131, 196); margin-top: -66px; position: absolute;\\&amp;quot;&amp;gt;&amp;lt;/a&amp;gt;函数和类、属性命名&amp;lt;/h3&amp;gt;&amp;lt;ul style=\\&amp;quot;box-sizing: inherit; -webkit-font-smoothing: antialiased; -webkit-tap-highlight-color: transparent; text-size-adjust: none; font-family: dashicons, \\&amp;quot;Segoe UI\\&amp;quot;, \\&amp;quot;WenQuanYi Micro Hei\\&amp;quot;, \\&amp;quot;WenQuanYi Micro Hei Mono\\&amp;quot;, \\&amp;quot;Microsoft Yahei\\&amp;quot;, \\&amp;quot;Microsoft Yahei Mono\\&amp;quot;, 微软雅黑, sans-serif; line-height: 1.2; margin: 14px 0px; padding: 0px 0px 0px 28px; color: rgb(82, 82, 82); background-color: rgb(255, 255, 255);\\&amp;quot;&amp;gt;&amp;lt;li style=\\&amp;quot;box-sizing: inherit; -webkit-font-smoothing: antialiased; -webkit-tap-highlight-color: transparent; text-size-adjust: none; line-height: 2;\\&amp;quot;&amp;gt;类的命名采用驼峰法（首字母大写），例如&amp;nbsp;&amp;lt;code style=\\&amp;quot;box-sizing: inherit; -webkit-font-smoothing: antialiased; -webkit-tap-highlight-color: transparent; text-size-adjust: none; font-family: Consolas, Monaco, \\&amp;quot;Andale Mono\\&amp;quot;, \\&amp;quot;Ubuntu Mono\\&amp;quot;, monospace; font-size: 1em; background: rgb(249, 250, 250); display: inline-block; line-height: 1.3; margin: 0px 5px; padding-right: 6px; padding-left: 6px; white-space: pre; word-break: break-all; border: 1px solid rgb(222, 217, 217);\\&amp;quot;&amp;gt;User&amp;lt;/code&amp;gt;、&amp;lt;code style=\\&amp;quot;box-sizing: inherit; -webkit-font-smoothing: antialiased; -webkit-tap-highlight-color: transparent; text-size-adjust: none; font-family: Consolas, Monaco, \\&amp;quot;Andale Mono\\&amp;quot;, \\&amp;quot;Ubuntu Mono\\&amp;quot;, monospace; font-size: 1em; background: rgb(249, 250, 250); display: inline-block; line-height: 1.3; margin: 0px 5px; padding-right: 6px; padding-left: 6px; white-space: pre; word-break: break-all; border: 1px solid rgb(222, 217, 217);\\&amp;quot;&amp;gt;UserType&amp;lt;/code&amp;gt;，默认不需要添加后缀，例如&amp;lt;code style=\\&amp;quot;box-sizing: inherit; -webkit-font-smoothing: antialiased; -webkit-tap-highlight-color: transparent; text-size-adjust: none; font-family: Consolas, Monaco, \\&amp;quot;Andale Mono\\&amp;quot;, \\&amp;quot;Ubuntu Mono\\&amp;quot;, monospace; font-size: 1em; background: rgb(249, 250, 250); display: inline-block; line-height: 1.3; margin: 0px 5px; padding-right: 6px; padding-left: 6px; white-space: pre; word-break: break-all; border: 1px solid rgb(222, 217, 217);\\&amp;quot;&amp;gt;UserController&amp;lt;/code&amp;gt;应该直接命名为&amp;lt;code style=\\&amp;quot;box-sizing: inherit; -webkit-font-smoothing: antialiased; -webkit-tap-highlight-color: transparent; text-size-adjust: none; font-family: Consolas, Monaco, \\&amp;quot;Andale Mono\\&amp;quot;, \\&amp;quot;Ubuntu Mono\\&amp;quot;, monospace; font-size: 1em; background: rgb(249, 250, 250); display: inline-block; line-height: 1.3; margin: 0px 5px; padding-right: 6px; padding-left: 6px; white-space: pre; word-break: break-all; border: 1px solid rgb(222, 217, 217);\\&amp;quot;&amp;gt;User&amp;lt;/code&amp;gt;；&amp;lt;/li&amp;gt;&amp;lt;li style=\\&amp;quot;box-sizing: inherit; -webkit-font-smoothing: antialiased; -webkit-tap-highlight-color: transparent; text-size-adjust: none; line-height: 2;\\&amp;quot;&amp;gt;函数的命名使用小写字母和下划线（小写字母开头）的方式，例如&amp;nbsp;&amp;lt;code style=\\&amp;quot;box-sizing: inherit; -webkit-font-smoothing: antialiased; -webkit-tap-highlight-color: transparent; text-size-adjust: none; font-family: Consolas, Monaco, \\&amp;quot;Andale Mono\\&amp;quot;, \\&amp;quot;Ubuntu Mono\\&amp;quot;, monospace; font-size: 1em; background: rgb(249, 250, 250); display: inline-block; line-height: 1.3; margin: 0px 5px; padding-right: 6px; padding-left: 6px; white-space: pre; word-break: break-all; border: 1px solid rgb(222, 217, 217);\\&amp;quot;&amp;gt;get_client_ip&amp;lt;/code&amp;gt;；&amp;lt;/li&amp;gt;&amp;lt;li style=\\&amp;quot;box-sizing: inherit; -webkit-font-smoothing: antialiased; -webkit-tap-highlight-color: transparent; text-size-adjust: none; line-height: 2;\\&amp;quot;&amp;gt;方法的命名使用驼峰法（首字母小写），例如&amp;nbsp;&amp;lt;code style=\\&amp;quot;box-sizing: inherit; -webkit-font-smoothing: antialiased; -webkit-tap-highlight-color: transparent; text-size-adjust: none; font-family: Consolas, Monaco, \\&amp;quot;Andale Mono\\&amp;quot;, \\&amp;quot;Ubuntu Mono\\&amp;quot;, monospace; font-size: 1em; background: rgb(249, 250, 250); display: inline-block; line-height: 1.3; margin: 0px 5px; padding-right: 6px; padding-left: 6px; white-space: pre; word-break: break-all; border: 1px solid rgb(222, 217, 217);\\&amp;quot;&amp;gt;getUserName&amp;lt;/code&amp;gt;；&amp;lt;/li&amp;gt;&amp;lt;li style=\\&amp;quot;box-sizing: inherit; -webkit-font-smoothing: antialiased; -webkit-tap-highlight-color: transparent; text-size-adjust: none; line-height: 2;\\&amp;quot;&amp;gt;属性的命名使用驼峰法（首字母小写），例如&amp;nbsp;&amp;lt;code style=\\&amp;quot;box-sizing: inherit; -webkit-font-smoothing: antialiased; -webkit-tap-highlight-color: transparent; text-size-adjust: none; font-family: Consolas, Monaco, \\&amp;quot;Andale Mono\\&amp;quot;, \\&amp;quot;Ubuntu Mono\\&amp;quot;, monospace; font-size: 1em; background: rgb(249, 250, 250); display: inline-block; line-height: 1.3; margin: 0px 5px; padding-right: 6px; padding-left: 6px; white-space: pre; word-break: break-all; border: 1px solid rgb(222, 217, 217);\\&amp;quot;&amp;gt;tableName&amp;lt;/code&amp;gt;、&amp;lt;code style=\\&amp;quot;box-sizing: inherit; -webkit-font-smoothing: antialiased; -webkit-tap-highlight-color: transparent; text-size-adjust: none; font-family: Consolas, Monaco, \\&amp;quot;Andale Mono\\&amp;quot;, \\&amp;quot;Ubuntu Mono\\&amp;quot;, monospace; font-size: 1em; background: rgb(249, 250, 250); display: inline-block; line-height: 1.3; margin: 0px 5px; padding-right: 6px; padding-left: 6px; white-space: pre; word-break: break-all; border: 1px solid rgb(222, 217, 217);\\&amp;quot;&amp;gt;instance&amp;lt;/code&amp;gt;；&amp;lt;/li&amp;gt;&amp;lt;li style=\\&amp;quot;box-sizing: inherit; -webkit-font-smoothing: antialiased; -webkit-tap-highlight-color: transparent; text-size-adjust: none; line-height: 2;\\&amp;quot;&amp;gt;以双下划线&amp;ldquo;__&amp;rdquo;打头的函数或方法作为魔术方法，例如&amp;nbsp;&amp;lt;code style=\\&amp;quot;box-sizing: inherit; -webkit-font-smoothing: antialiased; -webkit-tap-highlight-color: transparent; text-size-adjust: none; font-family: Consolas, Monaco, \\&amp;quot;Andale Mono\\&amp;quot;, \\&amp;quot;Ubuntu Mono\\&amp;quot;, monospace; font-size: 1em; background: rgb(249, 250, 250); display: inline-block; line-height: 1.3; margin: 0px 5px; padding-right: 6px; padding-left: 6px; white-space: pre; word-break: break-all; border: 1px solid rgb(222, 217, 217);\\&amp;quot;&amp;gt;__call&amp;lt;/code&amp;gt;&amp;nbsp;和&amp;nbsp;&amp;lt;code style=\\&amp;quot;box-sizing: inherit; -webkit-font-smoothing: antialiased; -webkit-tap-highlight-color: transparent; text-size-adjust: none; font-family: Consolas, Monaco, \\&amp;quot;Andale Mono\\&amp;quot;, \\&amp;quot;Ubuntu Mono\\&amp;quot;, monospace; font-size: 1em; background: rgb(249, 250, 250); display: inline-block; line-height: 1.3; margin: 0px 5px; padding-right: 6px; padding-left: 6px; white-space: pre; word-break: break-all; border: 1px solid rgb(222, 217, 217);\\&amp;quot;&amp;gt;__autoload&amp;lt;/code&amp;gt;；&amp;lt;/li&amp;gt;&amp;lt;/ul&amp;gt;&amp;lt;h3 style=\\&amp;quot;box-sizing: inherit; -webkit-font-smoothing: antialiased; -webkit-tap-highlight-color: transparent; text-size-adjust: none; font-family: dashicons, \\&amp;quot;Segoe UI\\&amp;quot;, \\&amp;quot;WenQuanYi Micro Hei\\&amp;quot;, \\&amp;quot;WenQuanYi Micro Hei Mono\\&amp;quot;, \\&amp;quot;Microsoft Yahei\\&amp;quot;, \\&amp;quot;Microsoft Yahei Mono\\&amp;quot;, 微软雅黑, sans-serif; padding: 0px; line-height: 1.43; margin: 14px 0px; font-size: 1.2em; color: rgb(82, 82, 82); background-color: rgb(255, 255, 255);\\&amp;quot;&amp;gt;&amp;lt;a id=\\&amp;quot;_20\\&amp;quot; style=\\&amp;quot;box-sizing: inherit; -webkit-font-smoothing: antialiased; -webkit-tap-highlight-color: transparent; text-size-adjust: none; color: rgb(65, 131, 196); margin-top: -66px; position: absolute;\\&amp;quot;&amp;gt;&amp;lt;/a&amp;gt;常量和配置&amp;lt;/h3&amp;gt;&amp;lt;ul style=\\&amp;quot;box-sizing: inherit; -webkit-font-smoothing: antialiased; -webkit-tap-highlight-color: transparent; text-size-adjust: none; font-family: dashicons, \\&amp;quot;Segoe UI\\&amp;quot;, \\&amp;quot;WenQuanYi Micro Hei\\&amp;quot;, \\&amp;quot;WenQuanYi Micro Hei Mono\\&amp;quot;, \\&amp;quot;Microsoft Yahei\\&amp;quot;, \\&amp;quot;Microsoft Yahei Mono\\&amp;quot;, 微软雅黑, sans-serif; line-height: 1.2; margin: 14px 0px; padding: 0px 0px 0px 28px; color: rgb(82, 82, 82); background-color: rgb(255, 255, 255);\\&amp;quot;&amp;gt;&amp;lt;li style=\\&amp;quot;box-sizing: inherit; -webkit-font-smoothing: antialiased; -webkit-tap-highlight-color: transparent; text-size-adjust: none; line-height: 2;\\&amp;quot;&amp;gt;常量以大写字母和下划线命名，例如&amp;nbsp;&amp;lt;code style=\\&amp;quot;box-sizing: inherit; -webkit-font-smoothing: antialiased; -webkit-tap-highlight-color: transparent; text-size-adjust: none; font-family: Consolas, Monaco, \\&amp;quot;Andale Mono\\&amp;quot;, \\&amp;quot;Ubuntu Mono\\&amp;quot;, monospace; font-size: 1em; background: rgb(249, 250, 250); display: inline-block; line-height: 1.3; margin: 0px 5px; padding-right: 6px; padding-left: 6px; white-space: pre; word-break: break-all; border: 1px solid rgb(222, 217, 217);\\&amp;quot;&amp;gt;APP_PATH&amp;lt;/code&amp;gt;和&amp;nbsp;&amp;lt;code style=\\&amp;quot;box-sizing: inherit; -webkit-font-smoothing: antialiased; -webkit-tap-highlight-color: transparent; text-size-adjust: none; font-family: Consolas, Monaco, \\&amp;quot;Andale Mono\\&amp;quot;, \\&amp;quot;Ubuntu Mono\\&amp;quot;, monospace; font-size: 1em; background: rgb(249, 250, 250); display: inline-block; line-height: 1.3; margin: 0px 5px; padding-right: 6px; padding-left: 6px; white-space: pre; word-break: break-all; border: 1px solid rgb(222, 217, 217);\\&amp;quot;&amp;gt;THINK_PATH&amp;lt;/code&amp;gt;；&amp;lt;/li&amp;gt;&amp;lt;li style=\\&amp;quot;box-sizing: inherit; -webkit-font-smoothing: antialiased; -webkit-tap-highlight-color: transparent; text-size-adjust: none; line-height: 2;\\&amp;quot;&amp;gt;配置参数以小写字母和下划线命名，例如&amp;nbsp;&amp;lt;code style=\\&amp;quot;box-sizing: inherit; -webkit-font-smoothing: antialiased; -webkit-tap-highlight-color: transparent; text-size-adjust: none; font-family: Consolas, Monaco, \\&amp;quot;Andale Mono\\&amp;quot;, \\&amp;quot;Ubuntu Mono\\&amp;quot;, monospace; font-size: 1em; background: rgb(249, 250, 250); display: inline-block; line-height: 1.3; margin: 0px 5px; padding-right: 6px; padding-left: 6px; white-space: pre; word-break: break-all; border: 1px solid rgb(222, 217, 217);\\&amp;quot;&amp;gt;url_route_on&amp;lt;/code&amp;gt;&amp;nbsp;和&amp;lt;code style=\\&amp;quot;box-sizing: inherit; -webkit-font-smoothing: antialiased; -webkit-tap-highlight-color: transparent; text-size-adjust: none; font-family: Consolas, Monaco, \\&amp;quot;Andale Mono\\&amp;quot;, \\&amp;quot;Ubuntu Mono\\&amp;quot;, monospace; font-size: 1em; background: rgb(249, 250, 250); display: inline-block; line-height: 1.3; margin: 0px 5px; padding-right: 6px; padding-left: 6px; white-space: pre; word-break: break-all; border: 1px solid rgb(222, 217, 217);\\&amp;quot;&amp;gt;url_convert&amp;lt;/code&amp;gt;；&amp;lt;/li&amp;gt;&amp;lt;/ul&amp;gt;&amp;lt;h3 style=\\&amp;quot;box-sizing: inherit; -webkit-font-smoothing: antialiased; -webkit-tap-highlight-color: transparent; text-size-adjust: none; font-family: dashicons, \\&amp;quot;Segoe UI\\&amp;quot;, \\&amp;quot;WenQuanYi Micro Hei\\&amp;quot;, \\&amp;quot;WenQuanYi Micro Hei Mono\\&amp;quot;, \\&amp;quot;Microsoft Yahei\\&amp;quot;, \\&amp;quot;Microsoft Yahei Mono\\&amp;quot;, 微软雅黑, sans-serif; padding: 0px; line-height: 1.43; margin: 14px 0px; font-size: 1.2em; color: rgb(82, 82, 82); background-color: rgb(255, 255, 255);\\&amp;quot;&amp;gt;&amp;lt;a id=\\&amp;quot;_24\\&amp;quot; style=\\&amp;quot;box-sizing: inherit; -webkit-font-smoothing: antialiased; -webkit-tap-highlight-color: transparent; text-size-adjust: none; color: rgb(65, 131, 196); margin-top: -66px; position: absolute;\\&amp;quot;&amp;gt;&amp;lt;/a&amp;gt;数据表和字段&amp;lt;/h3&amp;gt;&amp;lt;ul style=\\&amp;quot;box-sizing: inherit; -webkit-font-smoothing: antialiased; -webkit-tap-highlight-color: transparent; text-size-adjust: none; font-family: dashicons, \\&amp;quot;Segoe UI\\&amp;quot;, \\&amp;quot;WenQuanYi Micro Hei\\&amp;quot;, \\&amp;quot;WenQuanYi Micro Hei Mono\\&amp;quot;, \\&amp;quot;Microsoft Yahei\\&amp;quot;, \\&amp;quot;Microsoft Yahei Mono\\&amp;quot;, 微软雅黑, sans-serif; line-height: 1.2; margin: 14px 0px; padding: 0px 0px 0px 28px; color: rgb(82, 82, 82); background-color: rgb(255, 255, 255);\\&amp;quot;&amp;gt;&amp;lt;li style=\\&amp;quot;box-sizing: inherit; -webkit-font-smoothing: antialiased; -webkit-tap-highlight-color: transparent; text-size-adjust: none; line-height: 2;\\&amp;quot;&amp;gt;数据表和字段采用小写加下划线方式命名，并注意字段名不要以下划线开头，例如&amp;nbsp;&amp;lt;code style=\\&amp;quot;box-sizing: inherit; -webkit-font-smoothing: antialiased; -webkit-tap-highlight-color: transparent; text-size-adjust: none; font-family: Consolas, Monaco, \\&amp;quot;Andale Mono\\&amp;quot;, \\&amp;quot;Ubuntu Mono\\&amp;quot;, monospace; font-size: 1em; background: rgb(249, 250, 250); display: inline-block; line-height: 1.3; margin: 0px 5px; padding-right: 6px; padding-left: 6px; white-space: pre; word-break: break-all; border: 1px solid rgb(222, 217, 217);\\&amp;quot;&amp;gt;think_user&amp;lt;/code&amp;gt;&amp;nbsp;表和&amp;nbsp;&amp;lt;code style=\\&amp;quot;box-sizing: inherit; -webkit-font-smoothing: antialiased; -webkit-tap-highlight-color: transparent; text-size-adjust: none; font-family: Consolas, Monaco, \\&amp;quot;Andale Mono\\&amp;quot;, \\&amp;quot;Ubuntu Mono\\&amp;quot;, monospace; font-size: 1em; background: rgb(249, 250, 250); display: inline-block; line-height: 1.3; margin: 0px 5px; padding-right: 6px; padding-left: 6px; white-space: pre; word-break: break-all; border: 1px solid rgb(222, 217, 217);\\&amp;quot;&amp;gt;user_name&amp;lt;/code&amp;gt;字段，不建议使用驼峰和中文作为数据表字段命名。&amp;lt;/li&amp;gt;&amp;lt;/ul&amp;gt;&amp;lt;h3 style=\\&amp;quot;box-sizing: inherit; -webkit-font-smoothing: antialiased; -webkit-tap-highlight-color: transparent; text-size-adjust: none; font-family: dashicons, \\&amp;quot;Segoe UI\\&amp;quot;, \\&amp;quot;WenQuanYi Micro Hei\\&amp;quot;, \\&amp;quot;WenQuanYi Micro Hei Mono\\&amp;quot;, \\&amp;quot;Microsoft Yahei\\&amp;quot;, \\&amp;quot;Microsoft Yahei Mono\\&amp;quot;, 微软雅黑, sans-serif; padding: 0px; line-height: 1.43; margin: 14px 0px; font-size: 1.2em; color: rgb(82, 82, 82); background-color: rgb(255, 255, 255);\\&amp;quot;&amp;gt;&amp;lt;a id=\\&amp;quot;_27\\&amp;quot; style=\\&amp;quot;box-sizing: inherit; -webkit-font-smoothing: antialiased; -webkit-tap-highlight-color: transparent; text-size-adjust: none; color: rgb(65, 131, 196); margin-top: -66px; position: absolute;\\&amp;quot;&amp;gt;&amp;lt;/a&amp;gt;应用类库命名空间规范&amp;lt;/h3&amp;gt;&amp;lt;p style=\\&amp;quot;box-sizing: inherit; -webkit-font-smoothing: antialiased; -webkit-tap-highlight-color: transparent; text-size-adjust: none; line-height: 2; margin-bottom: 0px; font-family: dashicons, \\&amp;quot;Segoe UI\\&amp;quot;, \\&amp;quot;WenQuanYi Micro Hei\\&amp;quot;, \\&amp;quot;WenQuanYi Micro Hei Mono\\&amp;quot;, \\&amp;quot;Microsoft Yahei\\&amp;quot;, \\&amp;quot;Microsoft Yahei Mono\\&amp;quot;, 微软雅黑, sans-serif; padding: 0px; color: rgb(82, 82, 82); background-color: rgb(255, 255, 255);\\&amp;quot;&amp;gt;应用类库的根命名空间统一为app（不建议更改，可以设置&amp;lt;code style=\\&amp;quot;box-sizing: inherit; -webkit-font-smoothing: antialiased; -webkit-tap-highlight-color: transparent; text-size-adjust: none; font-family: Consolas, Monaco, \\&amp;quot;Andale Mono\\&amp;quot;, \\&amp;quot;Ubuntu Mono\\&amp;quot;, monospace; font-size: 1em; background: rgb(249, 250, 250); display: inline-block; line-height: 1.3; margin: 0px 5px; padding-right: 6px; padding-left: 6px; white-space: pre; word-break: break-all; border: 1px solid rgb(222, 217, 217);\\&amp;quot;&amp;gt;app_namespace&amp;lt;/code&amp;gt;配置参数更改，&amp;lt;code style=\\&amp;quot;box-sizing: inherit; -webkit-font-smoothing: antialiased; -webkit-tap-highlight-color: transparent; text-size-adjust: none; font-family: Consolas, Monaco, \\&amp;quot;Andale Mono\\&amp;quot;, \\&amp;quot;Ubuntu Mono\\&amp;quot;, monospace; font-size: 1em; background: rgb(249, 250, 250); display: inline-block; line-height: 1.3; margin: 0px 5px; padding-right: 6px; padding-left: 6px; white-space: pre; word-break: break-all; border: 1px solid rgb(222, 217, 217);\\&amp;quot;&amp;gt;V5.0.8&amp;lt;/code&amp;gt;版本开始使用&amp;lt;code style=\\&amp;quot;box-sizing: inherit; -webkit-font-smoothing: antialiased; -webkit-tap-highlight-color: transparent; text-size-adjust: none; font-family: Consolas, Monaco, \\&amp;quot;Andale Mono\\&amp;quot;, \\&amp;quot;Ubuntu Mono\\&amp;quot;, monospace; font-size: 1em; background: rgb(249, 250, 250); display: inline-block; line-height: 1.3; margin: 0px 5px; padding-right: 6px; padding-left: 6px; white-space: pre; word-break: break-all; border: 1px solid rgb(222, 217, 217);\\&amp;quot;&amp;gt;APP_NAMESPACE&amp;lt;/code&amp;gt;常量定义）；&amp;lt;br style=\\&amp;quot;box-sizing: inherit; -webkit-font-smoothing: antialiased; -webkit-tap-highlight-color: transparent; text-size-adjust: none;\\&amp;quot;&amp;gt;例如：&amp;lt;code style=\\&amp;quot;box-sizing: inherit; -webkit-font-smoothing: antialiased; -webkit-tap-highlight-color: transparent; text-size-adjust: none; font-family: Consolas, Monaco, \\&amp;quot;Andale Mono\\&amp;quot;, \\&amp;quot;Ubuntu Mono\\&amp;quot;, monospace; font-size: 1em; background: rgb(249, 250, 250); display: inline-block; line-height: 1.3; margin: 0px 5px; padding-right: 6px; padding-left: 6px; white-space: pre; word-break: break-all; border: 1px solid rgb(222, 217, 217);\\&amp;quot;&amp;gt;app\\\\index\\\\controller\\\\Index&amp;lt;/code&amp;gt;和&amp;lt;code style=\\&amp;quot;box-sizing: inherit; -webkit-font-smoothing: antialiased; -webkit-tap-highlight-color: transparent; text-size-adjust: none; font-family: Consolas, Monaco, \\&amp;quot;Andale Mono\\&amp;quot;, \\&amp;quot;Ubuntu Mono\\&amp;quot;, monospace; font-size: 1em; background: rgb(249, 250, 250); display: inline-block; line-height: 1.3; margin: 0px 5px; padding-right: 6px; padding-left: 6px; white-space: pre; word-break: break-all; border: 1px solid rgb(222, 217, 217);\\&amp;quot;&amp;gt;app\\\\index\\\\model\\\\User&amp;lt;/code&amp;gt;。&amp;lt;/p&amp;gt;',0,1,1,1,0,0,0,0,0,0,'','ThinkPHP5遵循PSR-2命名规范和PSR-4自动加载规范','','',NULL,1542254686,0,1 );



DROP TABLE IF EXISTS `ithink_blog_article_tag`;
CREATE TABLE `ithink_blog_article_tag` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `tag_id` bigint(20) unsigned NOT NULL DEFAULT '0' COMMENT '标签 id',
  `article_id` bigint(20) unsigned NOT NULL DEFAULT '0' COMMENT '文章 id',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB    DEFAULT CHARSET=utf8 COMMENT='标签文章对应表';
INSERT INTO `ithink_blog_article_tag` (`id` , `tag_id` , `article_id`) VALUES ( 5,12,14 );



DROP TABLE IF EXISTS `ithink_blog_tag`;
CREATE TABLE `ithink_blog_tag` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT COMMENT '分类id',
  `name` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '标签名称',
  `articel_numbers` int(20) unsigned NOT NULL DEFAULT '0' COMMENT '标签文章数',
  `status` tinyint(3) unsigned NOT NULL DEFAULT '1' COMMENT '0:禁用, 1:正常, 2:已删除',
  `time` int(11) NOT NULL DEFAULT '0',
  `order` int(11) NOT NULL DEFAULT '0',
  `remark` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB    DEFAULT CHARSET=utf8 COMMENT='文章标签表';
INSERT INTO `ithink_blog_tag` (`id` , `name` , `articel_numbers` , `status` , `time` , `order` , `remark`) VALUES ( 12,'php手册',0,1,1542157621,1,'' );



DROP TABLE IF EXISTS `ithink_blog_type`;
CREATE TABLE `ithink_blog_type` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT COMMENT '分类id',
  `pid` bigint(20) unsigned NOT NULL DEFAULT '0' COMMENT '分类父id',
  `name` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '分类名称',
  `articel_numbers` bigint(20) unsigned NOT NULL DEFAULT '0' COMMENT '分类文章数',
  `order` int(11) NOT NULL DEFAULT '10000' COMMENT '排序',
  `del_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '删除时间',
  `time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '添加时间',
  `remark` text NOT NULL COMMENT '分类描述',
  `status` tinyint(3) unsigned NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB    DEFAULT CHARSET=utf8 COMMENT='文章分类表';
INSERT INTO `ithink_blog_type` (`id` , `pid` , `name` , `articel_numbers` , `order` , `del_time` , `time` , `remark` , `status`) VALUES ( 13,0,'php',0,1,0,1542157606,'',1 );


