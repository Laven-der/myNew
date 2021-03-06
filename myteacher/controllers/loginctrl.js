var formidable = require("formidable");
var User = require("../models/User.js");
var crypto = require("crypto");

exports.showLogin = function(req,res){
	//如果用户已经登录过，此时不能让他看见这个页面
	if(req.session.login){
		res.send("<h1>你已经登录了！还来干什么！</h1>");
		return;
	}
	//呈递模板引擎
	res.render("login" , {
		//当前所在的栏目：
		"column" : "login" ,
		"login" : req.session.login ,
		"email" : req.session.email
	});
}

//执行登录
exports.doLogin = function(req,res){
	
	var form = new formidable.IncomingForm();
	form.parse(req , function(err , fields , files){
		var email = fields.email;
		var password = fields.password;
		//加密
		password = crypto.createHash('SHA256').update(password + "我是考拉").digest("hex");
		
		//和数据库比对
		User.find({"email" : email , "password" : password} , function(err , results){
			if(results.length > 0){
				//登录成功，下发session
				req.session.login = true;
				req.session.email = email;

				res.json({"result" : 1});
			}else{
				res.json({"result" : -1});
			}
		});
	});
}

