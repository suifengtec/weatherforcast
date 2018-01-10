# weather

## 作用

用心知天气免费的API接口,获取天气预报,然后使用百度语音合成语音放入本地文件,然后把天气预报播放出来,播放后删除生成的语音文件。

## 需求

支持的操作系统: Linux(在Ubuntu 和 LinuxMint 上进行了测试) 或 Windows 10;
执行 PHP : PHP 5.3+;
编译命令行可用的 mp3 播放器: Windows 10 操作系统需要确保安装了 go 语言或者 gcc 可用;

## 获取项目代码

```

git clone http://g.com/PHP/weather

```

## 准备

登录[百度AI应用控制台](https://console.bce.baidu.com/ai/),创建个应用,记得点选" 百度语音",然后把应用相关的信息,放进 `config.php`;

到[心知天气](https://www.seniverse.com/)注册个免费账号,使用其免费接口,然后把应用相关信息,放进 `config.php`;

## 命令行播放语音文件

## Linux
以 Ubuntu 和 LinuxMint 为例:
```
sudo apt update
sudo apt upgrade
sudo apt  install sox libsox-fmt-all
```

### Windows 10

需要有支持命令行播放的播放器,虽然可以用 start 命令,但是为了让这篇文章更加丰满,我就加点儿料吧,以下两种播放器方案,任选其一即可:

### Go 语言的播放器
命令行执行
```
go get github.com/hajimehoshi/go-mp3
go get github.com/hajimehoshi/oto
```
在项目根目录执行:
```

go build playmp3go.go
playmp3go classic.mp3

```
能听到音乐就说明命令行播放器编译成功.

### C语言播放器
确保 gcc 可用, 在项目根目录执行:
```
gcc playmp3c.c -lwinmm -o playmp3c.exe
playmp3c classic.mp3
```
能听到音乐就说明命令行播放器编译成功.

## 使用
确保安装了 PHP, 在命令行执行:
```
php -S 127.0.0.1:8080
```
浏览器打开 http://127.0.0.1:8100/  , 就能听到了。

