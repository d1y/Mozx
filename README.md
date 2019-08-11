<p align="center">
  <img src="resources/logo.svg">
</p>

<p align="center">
  简洁 · 优雅 · 易用 · Music ON xposed
</p>

```bash

./run.sh # 安装依赖

```

❤️ 新手推荐使用宝塔面板来搭建 (**PHP>=7.1**)

🌻 只需要修改配置文件`config.json`即可快速开始:

```json
{
	"MOX_VERSION": "0.0.1",
	"MOX_AUTHOR": "@d1y",
	"MOX_AUTHOR_LINK": "http://d1y.live",
	"MOX_DB_HOST": "localhost", // 数据库地址
	"MOX_DB_USER": "root",  // 数据库用户名
	"MOX_DB_PWD": "root",  // 数据库密码
	"MOX_DB_NAME": "music", // 数据库
	"MOX_DB_PORT": 8889 // 端口,若是默认端口也要写
}
```

⬇️ 下面是截图

#### 登录页面

![](https://i.loli.net/2019/08/11/DHTGlRgBML8Xy6F.png)

#### 登录成功

![](https://i.loli.net/2019/08/11/A9SwpyU3vTX1Rom.png)

#### 首页推荐内容

![](https://i.loli.net/2019/08/11/yfQtMCWlS2JmdAD.png)

#### 视频页

![](https://i.loli.net/2019/08/11/LrKfXnFVRlgv2z4.png)

可设置`黑夜模式` (`Dark Mode`)

![](https://i.loli.net/2019/08/11/yrLiuF96Ol3Id7f.png)

#### 后台页面

可管理 `稿件` | `用户` | `数据量`, 并且可以`DIY`主题
![](https://i.loli.net/2019/08/11/Mf8SDQcV5FvXhar.png)

#### 个人中心

![](https://i.loli.net/2019/08/11/9w3tQMAZnU6ayY1.png)
![](https://i.loli.net/2019/08/11/d5VmIwWLN89l2ZY.png)
![](https://i.loli.net/2019/08/11/BF8ZlcuK6fDaW4V.png)
![](https://i.loli.net/2019/08/11/pClJDtIuNanhGdZ.png)

#### 投稿

![](https://i.loli.net/2019/08/11/TfoQwgRNcKL4rWh.png)
![](https://i.loli.net/2019/08/11/Dltw7FMd3UkpQXy.png)
![](https://i.loli.net/2019/08/11/ydWar6QoCY79HUO.png)


**全部支持`Markdown`语法,我实在太爱这家伙了!**


## 用到的开源项目

如果没有下面的开源项目,我可能坚持不下去❤️!
(不分排名)

### 前端

- `Bootstrap.css` - `tw`出品的`ui`库
- `markdown.js` - `markdown`语法支持
- `sweetalert.js` - 炒鸡好看的弹窗
- `pace.js` - 监听页面加载,提升用户体验
- `caomei-icons` - 草莓图标🍓,非常漂亮,国人出品
- `jQuery` - 一把梭啊
- `darkmode.js` - 自动`Dardmode`, 无需配置

### 后端

- `catfan/medoo` - 快速操作`sql`,舒服