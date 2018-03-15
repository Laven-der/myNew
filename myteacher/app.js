//引用模块
var express = require("express");
var mongoose = require("mongoose");
var session = require("express-session");

var mainctrl = require("./controllers/mainctrl.js");
var registctrl = require("./controllers/registctrl.js");
var loginctrl = require("./controllers/loginctrl.js");
var infoctrl = require("./controllers/infoctrl.js");

//创建app对象
var app = express();

//设置模板引擎
app.set("view engine" , "ejs");


//数据库
mongoose.connect("mongodb://localhost/qasystem");

//使用session，
app.set('trust proxy', 1);
app.use(session({
	resave : false,
	secret: 'qasystem',
	saveUninitialized: true,
	cookie: { maxAge: 826400 }	//session能够存储的时间
}));

//静态化www文件夹
app.use(express.static("www"));
//静态化uploads文件夹
app.use("/uploads" , express.static("uploads"));

//路由清单
app.get("/" 				, mainctrl.showIndex);
app.get("/regist" 			, registctrl.showRegist);
app.post("/regist"  		, registctrl.doRegist);
app.checkout("/regist"  	, registctrl.checkUserExist);//验证邮箱是否存在的接口
app.get("/login"			, loginctrl.showLogin);
app.post("/login"			, loginctrl.doLogin);
app.get("/info"				, infoctrl.showInfo);
app.checkout("/info"		, infoctrl.checkoutInfo);
app.post("/info"			, infoctrl.updateInfo);
app.post("/uploadavatar" 	, infoctrl.uploadavatar);
app.get("/form"				, infoctrl.showform);
app.get("/cut"				, infoctrl.showcut);
app.post("/cut"				, infoctrl.docut);
app.post("/fatupian" 		, mainctrl.doFatietupian);
app.get("/form2"    		, mainctrl.form2);
app.post("/q"				, mainctrl.doSaveQ);
app.get("/q"				, mainctrl.getQ);
app.get("/user"				, mainctrl.getUser);

//监听
app.listen(3000);
console.log("程序已经运行在端口！");