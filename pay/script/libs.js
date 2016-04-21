
/*flexible*/
!function(a) {
	function b() {
		var b = g.getBoundingClientRect().width;
		b / c > 540 && (b = 540 * c), a.rem = b / 16;
		ss = a.rem > 28 ? 28 : a.rem;
		g.style.fontSize = ss + "px";
	}
	var c, d, e, f = a.document,
		g = f.documentElement,
		h = f.querySelector('meta[name="viewport"]'),
		i = f.querySelector('meta[name="flexible"]');
	if (h) {
		console.log("将根据已有的meta标签来设置缩放比例");
		var j = h.getAttribute("content").match(/initial\-scale=(["']?)([\d\.]+)\1?/);
		j && (d = parseFloat(j[2]), c = parseInt(1 / d))
	} else if (i) {
		var j = i.getAttribute("content").match(/initial\-dpr=(["']?)([\d\.]+)\1?/);
		j && (c = parseFloat(j[2]), d = parseFloat((1 / c).toFixed(2)))
	}
	if (!c && !d) {
		var k = (a.navigator.appVersion.match(/android/gi), a.navigator.appVersion.match(/iphone/gi)),
			c = a.devicePixelRatio;
		c = k ? c >= 3 ? 3 : c >= 2 ? 2 : 1 : 1, d = 1 / c
	}
	if (g.setAttribute("data-dpr", c), !h) if (h = f.createElement("meta"), h.setAttribute("name", "viewport"), h.setAttribute("content", "initial-scale=" + d + ", maximum-scale=" + d + ", minimum-scale=" + d + ", user-scalable=no"), g.firstElementChild) g.firstElementChild.appendChild(h);
	else {
		var l = f.createElement("div");
		l.appendChild(h), f.write(l.innerHTML)
	}
	a.dpr = c, a.addEventListener("resize", function() {
		clearTimeout(e), e = setTimeout(b, 300)
	}, !1), a.addEventListener("pageshow", function(a) {
		a.persisted && (clearTimeout(e), e = setTimeout(b, 300))
	}, !1), "complete" === f.readyState ? f.body.style.fontSize = (12 * c) > 28 ? (28 + "px") : (12 * c + "px") : f.addEventListener("DOMContentLoaded", function() {
		f.body.style.fontSize = (12 * c) > 28 ? (28 + "px") : (12 * c + "px")
	}, !1), b()
}(window);

/*RequireJs*/
var requirejs,require,define;(function(global){var req,s,head,baseElement,dataMain,src,interactiveScript,currentlyAddingScript,mainScript,subPath,version="2.1.20",commentRegExp=/(\/\*([\s\S]*?)\*\/|([^:]|^)\/\/(.*)$)/mg,cjsRequireRegExp=/[^.]\s*require\s*\(\s*["']([^'"\s]+)["']\s*\)/g,jsSuffixRegExp=/\.js$/,currDirRegExp=/^\.\//,op=Object.prototype,ostring=op.toString,hasOwn=op.hasOwnProperty,ap=Array.prototype,isBrowser=!!(typeof window!=="undefined"&&typeof navigator!=="undefined"&&window.document),isWebWorker=!isBrowser&&typeof importScripts!=="undefined",readyRegExp=isBrowser&&navigator.platform==="PLAYSTATION 3"?/^complete$/:/^(complete|loaded)$/,defContextName="_",isOpera=typeof opera!=="undefined"&&opera.toString()==="[object Opera]",contexts={},cfg={},globalDefQueue=[],useInteractive=false;function isFunction(it){return ostring.call(it)==="[object Function]"}function isArray(it){return ostring.call(it)==="[object Array]"}function each(ary,func){if(ary){var i;for(i=0;i<ary.length;i+=1){if(ary[i]&&func(ary[i],i,ary)){break}}}}function eachReverse(ary,func){if(ary){var i;for(i=ary.length-1;i>-1;i-=1){if(ary[i]&&func(ary[i],i,ary)){break}}}}function hasProp(obj,prop){return hasOwn.call(obj,prop)}function getOwn(obj,prop){return hasProp(obj,prop)&&obj[prop]}function eachProp(obj,func){var prop;for(prop in obj){if(hasProp(obj,prop)){if(func(obj[prop],prop)){break}}}}function mixin(target,source,force,deepStringMixin){if(source){eachProp(source,function(value,prop){if(force||!hasProp(target,prop)){if(deepStringMixin&&typeof value==="object"&&value&&!isArray(value)&&!isFunction(value)&&!(value instanceof RegExp)){if(!target[prop]){target[prop]={}}mixin(target[prop],value,force,deepStringMixin)}else{target[prop]=value}}})}return target}function bind(obj,fn){return function(){return fn.apply(obj,arguments)}}function scripts(){return document.getElementsByTagName("script")}function defaultOnError(err){throw err}function getGlobal(value){if(!value){return value}var g=global;each(value.split("."),function(part){g=g[part]});return g}function makeError(id,msg,err,requireModules){var e=new Error(msg+"\nhttp://requirejs.org/docs/errors.html#"+id);e.requireType=id;e.requireModules=requireModules;if(err){e.originalError=err}return e}if(typeof define!=="undefined"){return}if(typeof requirejs!=="undefined"){if(isFunction(requirejs)){return}cfg=requirejs;requirejs=undefined}if(typeof require!=="undefined"&&!isFunction(require)){cfg=require;require=undefined}function newContext(contextName){var inCheckLoaded,Module,context,handlers,checkLoadedTimeoutId,config={waitSeconds:7,baseUrl:"./",paths:{},bundles:{},pkgs:{},shim:{},config:{}},registry={},enabledRegistry={},undefEvents={},defQueue=[],defined={},urlFetched={},bundlesMap={},requireCounter=1,unnormalizedCounter=1;function trimDots(ary){var i,part;for(i=0;i<ary.length;i++){part=ary[i];if(part==="."){ary.splice(i,1);i-=1}else{if(part===".."){if(i===0||(i===1&&ary[2]==="..")||ary[i-1]===".."){continue}else{if(i>0){ary.splice(i-1,2);i-=2}}}}}}function normalize(name,baseName,applyMap){var pkgMain,mapValue,nameParts,i,j,nameSegment,lastIndex,foundMap,foundI,foundStarMap,starI,normalizedBaseParts,baseParts=(baseName&&baseName.split("/")),map=config.map,starMap=map&&map["*"];if(name){name=name.split("/");lastIndex=name.length-1;if(config.nodeIdCompat&&jsSuffixRegExp.test(name[lastIndex])){name[lastIndex]=name[lastIndex].replace(jsSuffixRegExp,"")}if(name[0].charAt(0)==="."&&baseParts){normalizedBaseParts=baseParts.slice(0,baseParts.length-1);name=normalizedBaseParts.concat(name)}trimDots(name);name=name.join("/")}if(applyMap&&map&&(baseParts||starMap)){nameParts=name.split("/");outerLoop:for(i=nameParts.length;i>0;i-=1){nameSegment=nameParts.slice(0,i).join("/");if(baseParts){for(j=baseParts.length;j>0;j-=1){mapValue=getOwn(map,baseParts.slice(0,j).join("/"));if(mapValue){mapValue=getOwn(mapValue,nameSegment);if(mapValue){foundMap=mapValue;foundI=i;break outerLoop}}}}if(!foundStarMap&&starMap&&getOwn(starMap,nameSegment)){foundStarMap=getOwn(starMap,nameSegment);starI=i}}if(!foundMap&&foundStarMap){foundMap=foundStarMap;foundI=starI}if(foundMap){nameParts.splice(0,foundI,foundMap);name=nameParts.join("/")}}pkgMain=getOwn(config.pkgs,name);return pkgMain?pkgMain:name}function removeScript(name){if(isBrowser){each(scripts(),function(scriptNode){if(scriptNode.getAttribute("data-requiremodule")===name&&scriptNode.getAttribute("data-requirecontext")===context.contextName){scriptNode.parentNode.removeChild(scriptNode);return true}})}}function hasPathFallback(id){var pathConfig=getOwn(config.paths,id);if(pathConfig&&isArray(pathConfig)&&pathConfig.length>1){pathConfig.shift();context.require.undef(id);context.makeRequire(null,{skipMap:true})([id]);return true}}function splitPrefix(name){var prefix,index=name?name.indexOf("!"):-1;if(index>-1){prefix=name.substring(0,index);name=name.substring(index+1,name.length)}return[prefix,name]}function makeModuleMap(name,parentModuleMap,isNormalized,applyMap){var url,pluginModule,suffix,nameParts,prefix=null,parentName=parentModuleMap?parentModuleMap.name:null,originalName=name,isDefine=true,normalizedName="";if(!name){isDefine=false;name="_@r"+(requireCounter+=1)}nameParts=splitPrefix(name);prefix=nameParts[0];name=nameParts[1];if(prefix){prefix=normalize(prefix,parentName,applyMap);pluginModule=getOwn(defined,prefix)}if(name){if(prefix){if(pluginModule&&pluginModule.normalize){normalizedName=pluginModule.normalize(name,function(name){return normalize(name,parentName,applyMap)})}else{normalizedName=name.indexOf("!")===-1?normalize(name,parentName,applyMap):name}}else{normalizedName=normalize(name,parentName,applyMap);nameParts=splitPrefix(normalizedName);prefix=nameParts[0];normalizedName=nameParts[1];isNormalized=true;url=context.nameToUrl(normalizedName)}}suffix=prefix&&!pluginModule&&!isNormalized?"_unnormalized"+(unnormalizedCounter+=1):"";return{prefix:prefix,name:normalizedName,parentMap:parentModuleMap,unnormalized:!!suffix,url:url,originalName:originalName,isDefine:isDefine,id:(prefix?prefix+"!"+normalizedName:normalizedName)+suffix}}function getModule(depMap){var id=depMap.id,mod=getOwn(registry,id);if(!mod){mod=registry[id]=new context.Module(depMap)}return mod}function on(depMap,name,fn){var id=depMap.id,mod=getOwn(registry,id);if(hasProp(defined,id)&&(!mod||mod.defineEmitComplete)){if(name==="defined"){fn(defined[id])}}else{mod=getModule(depMap);if(mod.error&&name==="error"){fn(mod.error)}else{mod.on(name,fn)}}}function onError(err,errback){var ids=err.requireModules,notified=false;if(errback){errback(err)}else{each(ids,function(id){var mod=getOwn(registry,id);if(mod){mod.error=err;if(mod.events.error){notified=true;mod.emit("error",err)}}});if(!notified){req.onError(err)}}}function takeGlobalQueue(){if(globalDefQueue.length){each(globalDefQueue,function(queueItem){var id=queueItem[0];if(typeof id==="string"){context.defQueueMap[id]=true}defQueue.push(queueItem)});globalDefQueue=[]}}handlers={require:function(mod){if(mod.require){return mod.require}else{return(mod.require=context.makeRequire(mod.map))}},exports:function(mod){mod.usingExports=true;if(mod.map.isDefine){if(mod.exports){return(defined[mod.map.id]=mod.exports)}else{return(mod.exports=defined[mod.map.id]={})}}},module:function(mod){if(mod.module){return mod.module}else{return(mod.module={id:mod.map.id,uri:mod.map.url,config:function(){return getOwn(config.config,mod.map.id)||{}},exports:mod.exports||(mod.exports={})})}}};function cleanRegistry(id){delete registry[id];delete enabledRegistry[id]}function breakCycle(mod,traced,processed){var id=mod.map.id;if(mod.error){mod.emit("error",mod.error)}else{traced[id]=true;each(mod.depMaps,function(depMap,i){var depId=depMap.id,dep=getOwn(registry,depId);if(dep&&!mod.depMatched[i]&&!processed[depId]){if(getOwn(traced,depId)){mod.defineDep(i,defined[depId]);mod.check()}else{breakCycle(dep,traced,processed)}}});processed[id]=true}}function checkLoaded(){var err,usingPathFallback,waitInterval=config.waitSeconds*1000,expired=waitInterval&&(context.startTime+waitInterval)<new Date().getTime(),noLoads=[],reqCalls=[],stillLoading=false,needCycleCheck=true;if(inCheckLoaded){return}inCheckLoaded=true;eachProp(enabledRegistry,function(mod){var map=mod.map,modId=map.id;if(!mod.enabled){return}if(!map.isDefine){reqCalls.push(mod)}if(!mod.error){if(!mod.inited&&expired){if(hasPathFallback(modId)){usingPathFallback=true;stillLoading=true}else{noLoads.push(modId);removeScript(modId)}}else{if(!mod.inited&&mod.fetched&&map.isDefine){stillLoading=true;if(!map.prefix){return(needCycleCheck=false)}}}}});if(expired&&noLoads.length){err=makeError("timeout","Load timeout for modules: "+noLoads,null,noLoads);err.contextName=context.contextName;return onError(err)}if(needCycleCheck){each(reqCalls,function(mod){breakCycle(mod,{},{})})}if((!expired||usingPathFallback)&&stillLoading){if((isBrowser||isWebWorker)&&!checkLoadedTimeoutId){checkLoadedTimeoutId=setTimeout(function(){checkLoadedTimeoutId=0;checkLoaded()},50)}}inCheckLoaded=false}Module=function(map){this.events=getOwn(undefEvents,map.id)||{};this.map=map;this.shim=getOwn(config.shim,map.id);this.depExports=[];this.depMaps=[];this.depMatched=[];this.pluginMaps={};this.depCount=0};Module.prototype={init:function(depMaps,factory,errback,options){options=options||{};if(this.inited){return}this.factory=factory;if(errback){this.on("error",errback)}else{if(this.events.error){errback=bind(this,function(err){this.emit("error",err)})}}this.depMaps=depMaps&&depMaps.slice(0);this.errback=errback;this.inited=true;this.ignore=options.ignore;if(options.enabled||this.enabled){this.enable()}else{this.check()}},defineDep:function(i,depExports){if(!this.depMatched[i]){this.depMatched[i]=true;this.depCount-=1;this.depExports[i]=depExports}},fetch:function(){if(this.fetched){return}this.fetched=true;context.startTime=(new Date()).getTime();var map=this.map;if(this.shim){context.makeRequire(this.map,{enableBuildCallback:true})(this.shim.deps||[],bind(this,function(){return map.prefix?this.callPlugin():this.load()}))}else{return map.prefix?this.callPlugin():this.load()}},load:function(){var url=this.map.url;if(!urlFetched[url]){urlFetched[url]=true;context.load(this.map.id,url)}},check:function(){if(!this.enabled||this.enabling){return}var err,cjsModule,id=this.map.id,depExports=this.depExports,exports=this.exports,factory=this.factory;if(!this.inited){if(!hasProp(context.defQueueMap,id)){this.fetch()}}else{if(this.error){this.emit("error",this.error)}else{if(!this.defining){this.defining=true;if(this.depCount<1&&!this.defined){if(isFunction(factory)){if((this.events.error&&this.map.isDefine)||req.onError!==defaultOnError){try{exports=context.execCb(id,factory,depExports,exports)}catch(e){err=e}}else{exports=context.execCb(id,factory,depExports,exports)}if(this.map.isDefine&&exports===undefined){cjsModule=this.module;if(cjsModule){exports=cjsModule.exports}else{if(this.usingExports){exports=this.exports}}}if(err){err.requireMap=this.map;err.requireModules=this.map.isDefine?[this.map.id]:null;err.requireType=this.map.isDefine?"define":"require";return onError((this.error=err))}}else{exports=factory}this.exports=exports;if(this.map.isDefine&&!this.ignore){defined[id]=exports;if(req.onResourceLoad){req.onResourceLoad(context,this.map,this.depMaps)}}cleanRegistry(id);this.defined=true}this.defining=false;if(this.defined&&!this.defineEmitted){this.defineEmitted=true;this.emit("defined",this.exports);this.defineEmitComplete=true}}}}},callPlugin:function(){var map=this.map,id=map.id,pluginMap=makeModuleMap(map.prefix);this.depMaps.push(pluginMap);on(pluginMap,"defined",bind(this,function(plugin){var load,normalizedMap,normalizedMod,bundleId=getOwn(bundlesMap,this.map.id),name=this.map.name,parentName=this.map.parentMap?this.map.parentMap.name:null,localRequire=context.makeRequire(map.parentMap,{enableBuildCallback:true});if(this.map.unnormalized){if(plugin.normalize){name=plugin.normalize(name,function(name){return normalize(name,parentName,true)})||""}normalizedMap=makeModuleMap(map.prefix+"!"+name,this.map.parentMap);on(normalizedMap,"defined",bind(this,function(value){this.init([],function(){return value},null,{enabled:true,ignore:true})}));normalizedMod=getOwn(registry,normalizedMap.id);if(normalizedMod){this.depMaps.push(normalizedMap);if(this.events.error){normalizedMod.on("error",bind(this,function(err){this.emit("error",err)}))}normalizedMod.enable()}return}if(bundleId){this.map.url=context.nameToUrl(bundleId);this.load();return}load=bind(this,function(value){this.init([],function(){return value},null,{enabled:true})});load.error=bind(this,function(err){this.inited=true;this.error=err;err.requireModules=[id];eachProp(registry,function(mod){if(mod.map.id.indexOf(id+"_unnormalized")===0){cleanRegistry(mod.map.id)}});onError(err)});load.fromText=bind(this,function(text,textAlt){var moduleName=map.name,moduleMap=makeModuleMap(moduleName),hasInteractive=useInteractive;if(textAlt){text=textAlt}if(hasInteractive){useInteractive=false}getModule(moduleMap);if(hasProp(config.config,id)){config.config[moduleName]=config.config[id]}try{req.exec(text)}catch(e){return onError(makeError("fromtexteval","fromText eval for "+id+" failed: "+e,e,[id]))}if(hasInteractive){useInteractive=true}this.depMaps.push(moduleMap);context.completeLoad(moduleName);localRequire([moduleName],load)});plugin.load(map.name,localRequire,load,config)}));context.enable(pluginMap,this);this.pluginMaps[pluginMap.id]=pluginMap},enable:function(){enabledRegistry[this.map.id]=this;this.enabled=true;this.enabling=true;each(this.depMaps,bind(this,function(depMap,i){var id,mod,handler;if(typeof depMap==="string"){depMap=makeModuleMap(depMap,(this.map.isDefine?this.map:this.map.parentMap),false,!this.skipMap);this.depMaps[i]=depMap;handler=getOwn(handlers,depMap.id);if(handler){this.depExports[i]=handler(this);return}this.depCount+=1;on(depMap,"defined",bind(this,function(depExports){if(this.undefed){return}this.defineDep(i,depExports);this.check()}));if(this.errback){on(depMap,"error",bind(this,this.errback))}else{if(this.events.error){on(depMap,"error",bind(this,function(err){this.emit("error",err)}))}}}id=depMap.id;mod=registry[id];if(!hasProp(handlers,id)&&mod&&!mod.enabled){context.enable(depMap,this)}}));eachProp(this.pluginMaps,bind(this,function(pluginMap){var mod=getOwn(registry,pluginMap.id);if(mod&&!mod.enabled){context.enable(pluginMap,this)}}));this.enabling=false;this.check()},on:function(name,cb){var cbs=this.events[name];if(!cbs){cbs=this.events[name]=[]}cbs.push(cb)},emit:function(name,evt){each(this.events[name],function(cb){cb(evt)});if(name==="error"){delete this.events[name]}}};function callGetModule(args){if(!hasProp(defined,args[0])){getModule(makeModuleMap(args[0],null,true)).init(args[1],args[2])}}function removeListener(node,func,name,ieName){if(node.detachEvent&&!isOpera){if(ieName){node.detachEvent(ieName,func)}}else{node.removeEventListener(name,func,false)}}function getScriptData(evt){var node=evt.currentTarget||evt.srcElement;removeListener(node,context.onScriptLoad,"load","onreadystatechange");removeListener(node,context.onScriptError,"error");return{node:node,id:node&&node.getAttribute("data-requiremodule")}}function intakeDefines(){var args;takeGlobalQueue();while(defQueue.length){args=defQueue.shift();if(args[0]===null){return onError(makeError("mismatch","Mismatched anonymous define() module: "+args[args.length-1]))}else{callGetModule(args)}}context.defQueueMap={}}context={config:config,contextName:contextName,registry:registry,defined:defined,urlFetched:urlFetched,defQueue:defQueue,defQueueMap:{},Module:Module,makeModuleMap:makeModuleMap,nextTick:req.nextTick,onError:onError,configure:function(cfg){if(cfg.baseUrl){if(cfg.baseUrl.charAt(cfg.baseUrl.length-1)!=="/"){cfg.baseUrl+="/"}}var shim=config.shim,objs={paths:true,bundles:true,config:true,map:true};eachProp(cfg,function(value,prop){if(objs[prop]){if(!config[prop]){config[prop]={}}mixin(config[prop],value,true,true)}else{config[prop]=value}});if(cfg.bundles){eachProp(cfg.bundles,function(value,prop){each(value,function(v){if(v!==prop){bundlesMap[v]=prop}})})}if(cfg.shim){eachProp(cfg.shim,function(value,id){if(isArray(value)){value={deps:value}}if((value.exports||value.init)&&!value.exportsFn){value.exportsFn=context.makeShimExports(value)}shim[id]=value});config.shim=shim}if(cfg.packages){each(cfg.packages,function(pkgObj){var location,name;pkgObj=typeof pkgObj==="string"?{name:pkgObj}:pkgObj;name=pkgObj.name;location=pkgObj.location;if(location){config.paths[name]=pkgObj.location}config.pkgs[name]=pkgObj.name+"/"+(pkgObj.main||"main").replace(currDirRegExp,"").replace(jsSuffixRegExp,"")})}eachProp(registry,function(mod,id){if(!mod.inited&&!mod.map.unnormalized){mod.map=makeModuleMap(id,null,true)}});if(cfg.deps||cfg.callback){context.require(cfg.deps||[],cfg.callback)}},makeShimExports:function(value){function fn(){var ret;if(value.init){ret=value.init.apply(global,arguments)}return ret||(value.exports&&getGlobal(value.exports))}return fn},makeRequire:function(relMap,options){options=options||{};function localRequire(deps,callback,errback){var id,map,requireMod;if(options.enableBuildCallback&&callback&&isFunction(callback)){callback.__requireJsBuild=true}if(typeof deps==="string"){if(isFunction(callback)){return onError(makeError("requireargs","Invalid require call"),errback)}if(relMap&&hasProp(handlers,deps)){return handlers[deps](registry[relMap.id])}if(req.get){return req.get(context,deps,relMap,localRequire)}map=makeModuleMap(deps,relMap,false,true);id=map.id;if(!hasProp(defined,id)){return onError(makeError("notloaded",'Module name "'+id+'" has not been loaded yet for context: '+contextName+(relMap?"":". Use require([])")))}return defined[id]}intakeDefines();context.nextTick(function(){intakeDefines();requireMod=getModule(makeModuleMap(null,relMap));requireMod.skipMap=options.skipMap;requireMod.init(deps,callback,errback,{enabled:true});checkLoaded()});return localRequire}mixin(localRequire,{isBrowser:isBrowser,toUrl:function(moduleNamePlusExt){var ext,index=moduleNamePlusExt.lastIndexOf("."),segment=moduleNamePlusExt.split("/")[0],isRelative=segment==="."||segment==="..";if(index!==-1&&(!isRelative||index>1)){ext=moduleNamePlusExt.substring(index,moduleNamePlusExt.length);moduleNamePlusExt=moduleNamePlusExt.substring(0,index)}return context.nameToUrl(normalize(moduleNamePlusExt,relMap&&relMap.id,true),ext,true)},defined:function(id){return hasProp(defined,makeModuleMap(id,relMap,false,true).id)},specified:function(id){id=makeModuleMap(id,relMap,false,true).id;return hasProp(defined,id)||hasProp(registry,id)}});if(!relMap){localRequire.undef=function(id){takeGlobalQueue();var map=makeModuleMap(id,relMap,true),mod=getOwn(registry,id);mod.undefed=true;removeScript(id);delete defined[id];delete urlFetched[map.url];delete undefEvents[id];eachReverse(defQueue,function(args,i){if(args[0]===id){defQueue.splice(i,1)}});delete context.defQueueMap[id];if(mod){if(mod.events.defined){undefEvents[id]=mod.events}cleanRegistry(id)}}}return localRequire},enable:function(depMap){var mod=getOwn(registry,depMap.id);if(mod){getModule(depMap).enable()}},completeLoad:function(moduleName){var found,args,mod,shim=getOwn(config.shim,moduleName)||{},shExports=shim.exports;takeGlobalQueue();while(defQueue.length){args=defQueue.shift();if(args[0]===null){args[0]=moduleName;if(found){break}found=true}else{if(args[0]===moduleName){found=true}}callGetModule(args)}context.defQueueMap={};mod=getOwn(registry,moduleName);if(!found&&!hasProp(defined,moduleName)&&mod&&!mod.inited){if(config.enforceDefine&&(!shExports||!getGlobal(shExports))){if(hasPathFallback(moduleName)){return}else{return onError(makeError("nodefine","No define call for "+moduleName,null,[moduleName]))}}else{callGetModule([moduleName,(shim.deps||[]),shim.exportsFn])}}checkLoaded()},nameToUrl:function(moduleName,ext,skipExt){var paths,syms,i,parentModule,url,parentPath,bundleId,pkgMain=getOwn(config.pkgs,moduleName);if(pkgMain){moduleName=pkgMain}bundleId=getOwn(bundlesMap,moduleName);if(bundleId){return context.nameToUrl(bundleId,ext,skipExt)}if(req.jsExtRegExp.test(moduleName)){url=moduleName+(ext||"")}else{paths=config.paths;syms=moduleName.split("/");for(i=syms.length;i>0;i-=1){parentModule=syms.slice(0,i).join("/");parentPath=getOwn(paths,parentModule);if(parentPath){if(isArray(parentPath)){parentPath=parentPath[0]}syms.splice(0,i,parentPath);break}}url=syms.join("/");url+=(ext||(/^data\:|\?/.test(url)||skipExt?"":".js"));url=(url.charAt(0)==="/"||url.match(/^[\w\+\.\-]+:/)?"":config.baseUrl)+url}return config.urlArgs?url+((url.indexOf("?")===-1?"?":"&")+config.urlArgs):url},load:function(id,url){req.load(context,id,url)},execCb:function(name,callback,args,exports){return callback.apply(exports,args)},onScriptLoad:function(evt){if(evt.type==="load"||(readyRegExp.test((evt.currentTarget||evt.srcElement).readyState))){interactiveScript=null;var data=getScriptData(evt);context.completeLoad(data.id)}},onScriptError:function(evt){var data=getScriptData(evt);if(!hasPathFallback(data.id)){return onError(makeError("scripterror","Script error for: "+data.id,evt,[data.id]))}}};context.require=context.makeRequire();return context}req=requirejs=function(deps,callback,errback,optional){var context,config,contextName=defContextName;if(!isArray(deps)&&typeof deps!=="string"){config=deps;if(isArray(callback)){deps=callback;callback=errback;errback=optional}else{deps=[]}}if(config&&config.context){contextName=config.context}context=getOwn(contexts,contextName);if(!context){context=contexts[contextName]=req.s.newContext(contextName)}if(config){context.configure(config)}return context.require(deps,callback,errback)};req.config=function(config){return req(config)};req.nextTick=typeof setTimeout!=="undefined"?function(fn){setTimeout(fn,4)}:function(fn){fn()};if(!require){require=req}req.version=version;req.jsExtRegExp=/^\/|:|\?|\.js$/;req.isBrowser=isBrowser;s=req.s={contexts:contexts,newContext:newContext};req({});each(["toUrl","undef","defined","specified"],function(prop){req[prop]=function(){var ctx=contexts[defContextName];return ctx.require[prop].apply(ctx,arguments)}});if(isBrowser){head=s.head=document.getElementsByTagName("head")[0];baseElement=document.getElementsByTagName("base")[0];if(baseElement){head=s.head=baseElement.parentNode}}req.onError=defaultOnError;req.createNode=function(config,moduleName,url){var node=config.xhtml?document.createElementNS("http://www.w3.org/1999/xhtml","html:script"):document.createElement("script");node.type=config.scriptType||"text/javascript";node.charset="utf-8";node.async=true;return node};req.load=function(context,moduleName,url){var config=(context&&context.config)||{},node;if(isBrowser){node=req.createNode(config,moduleName,url);if(config.onNodeCreated){config.onNodeCreated(node,config,moduleName,url)}node.setAttribute("data-requirecontext",context.contextName);node.setAttribute("data-requiremodule",moduleName);if(node.attachEvent&&!(node.attachEvent.toString&&node.attachEvent.toString().indexOf("[native code")<0)&&!isOpera){useInteractive=true;node.attachEvent("onreadystatechange",context.onScriptLoad)}else{node.addEventListener("load",context.onScriptLoad,false);node.addEventListener("error",context.onScriptError,false)}node.src=url;currentlyAddingScript=node;if(baseElement){head.insertBefore(node,baseElement)}else{head.appendChild(node)}currentlyAddingScript=null;return node}else{if(isWebWorker){try{importScripts(url);context.completeLoad(moduleName)}catch(e){context.onError(makeError("importscripts","importScripts failed for "+moduleName+" at "+url,e,[moduleName]))}}}};function getInteractiveScript(){if(interactiveScript&&interactiveScript.readyState==="interactive"){return interactiveScript}eachReverse(scripts(),function(script){if(script.readyState==="interactive"){return(interactiveScript=script)}});return interactiveScript}if(isBrowser&&!cfg.skipDataMain){eachReverse(scripts(),function(script){if(!head){head=script.parentNode}dataMain=script.getAttribute("data-main");if(dataMain){mainScript=dataMain;if(!cfg.baseUrl){src=mainScript.split("/");mainScript=src.pop();subPath=src.length?src.join("/")+"/":"./";cfg.baseUrl=subPath}mainScript=mainScript.replace(jsSuffixRegExp,"");if(req.jsExtRegExp.test(mainScript)){mainScript=dataMain}cfg.deps=cfg.deps?cfg.deps.concat(mainScript):[mainScript];return true}})}define=function(name,deps,callback){var node,context;if(typeof name!=="string"){callback=deps;deps=name;name=null}if(!isArray(deps)){callback=deps;deps=null}if(!deps&&isFunction(callback)){deps=[];if(callback.length){callback.toString().replace(commentRegExp,"").replace(cjsRequireRegExp,function(match,dep){deps.push(dep)});deps=(callback.length===1?["require"]:["require","exports","module"]).concat(deps)}}if(useInteractive){node=currentlyAddingScript||getInteractiveScript();if(node){if(!name){name=node.getAttribute("data-requiremodule")}context=contexts[node.getAttribute("data-requirecontext")]}}if(context){context.defQueue.push([name,deps,callback]);context.defQueueMap[name]=true}else{globalDefQueue.push([name,deps,callback])}};define.amd={jQuery:true};req.exec=function(text){return eval(text)};req(cfg)}(this));

/* Zepto v1.0rc1 - polyfill zepto event detect fx ajax form touch - zeptojs.com/license */
(function(a){String.prototype.trim===a&&(String.prototype.trim=function(){return this.replace(/^\s+/,"").replace(/\s+$/,"")}),Array.prototype.reduce===a&&(Array.prototype.reduce=function(b){if(this===void 0||this===null)throw new TypeError;var c=Object(this),d=c.length>>>0,e=0,f;if(typeof b!="function")throw new TypeError;if(d==0&&arguments.length==1)throw new TypeError;if(arguments.length>=2)f=arguments[1];else do{if(e in c){f=c[e++];break}if(++e>=d)throw new TypeError}while(!0);while(e<d)e in c&&(f=b.call(a,f,c[e],e,c)),e++;return f})})();var Zepto=function(){function A(a){return v.call(a)=="[object Function]"}function B(a){return a instanceof Object}function C(b){var c,d;if(v.call(b)!=="[object Object]")return!1;d=A(b.constructor)&&b.constructor.prototype;if(!d||!hasOwnProperty.call(d,"isPrototypeOf"))return!1;for(c in b);return c===a||hasOwnProperty.call(b,c)}function D(a){return a instanceof Array}function E(a){return typeof a.length=="number"}function F(b){return b.filter(function(b){return b!==a&&b!==null})}function G(a){return a.length>0?[].concat.apply([],a):a}function H(a){return a.replace(/::/g,"/").replace(/([A-Z]+)([A-Z][a-z])/g,"$1_$2").replace(/([a-z\d])([A-Z])/g,"$1_$2").replace(/_/g,"-").toLowerCase()}function I(a){return a in i?i[a]:i[a]=new RegExp("(^|\\s)"+a+"(\\s|$)")}function J(a,b){return typeof b=="number"&&!k[H(a)]?b+"px":b}function K(a){var b,c;return h[a]||(b=g.createElement(a),g.body.appendChild(b),c=j(b,"").getPropertyValue("display"),b.parentNode.removeChild(b),c=="none"&&(c="block"),h[a]=c),h[a]}function L(b,d){return d===a?c(b):c(b).filter(d)}function M(a,b,c,d){return A(b)?b.call(a,c,d):b}function N(a,b,d){var e=a%2?b:b.parentNode;e?e.insertBefore(d,a?a==1?e.firstChild:a==2?b:null:b.nextSibling):c(d).remove()}function O(a,b){b(a);for(var c in a.childNodes)O(a.childNodes[c],b)}var a,b,c,d,e=[],f=e.slice,g=window.document,h={},i={},j=g.defaultView.getComputedStyle,k={"column-count":1,columns:1,"font-weight":1,"line-height":1,opacity:1,"z-index":1,zoom:1},l=/^\s*<(\w+|!)[^>]*>/,m=[1,3,8,9,11],n=["after","prepend","before","append"],o=g.createElement("table"),p=g.createElement("tr"),q={tr:g.createElement("tbody"),tbody:o,thead:o,tfoot:o,td:p,th:p,"*":g.createElement("div")},r=/complete|loaded|interactive/,s=/^\.([\w-]+)$/,t=/^#([\w-]+)$/,u=/^[\w-]+$/,v={}.toString,w={},x,y,z=g.createElement("div");return w.matches=function(a,b){if(!a||a.nodeType!==1)return!1;var c=a.webkitMatchesSelector||a.mozMatchesSelector||a.oMatchesSelector||a.matchesSelector;if(c)return c.call(a,b);var d,e=a.parentNode,f=!e;return f&&(e=z).appendChild(a),d=~w.qsa(e,b).indexOf(a),f&&z.removeChild(a),d},x=function(a){return a.replace(/-+(.)?/g,function(a,b){return b?b.toUpperCase():""})},y=function(a){return a.filter(function(b,c){return a.indexOf(b)==c})},w.fragment=function(b,d){d===a&&(d=l.test(b)&&RegExp.$1),d in q||(d="*");var e=q[d];return e.innerHTML=""+b,c.each(f.call(e.childNodes),function(){e.removeChild(this)})},w.Z=function(a,b){return a=a||[],a.__proto__=arguments.callee.prototype,a.selector=b||"",a},w.isZ=function(a){return a instanceof w.Z},w.init=function(b,d){if(!b)return w.Z();if(A(b))return c(g).ready(b);if(w.isZ(b))return b;var e;if(D(b))e=F(b);else if(C(b))e=[c.extend({},b)],b=null;else if(m.indexOf(b.nodeType)>=0||b===window)e=[b],b=null;else if(l.test(b))e=w.fragment(b.trim(),RegExp.$1),b=null;else{if(d!==a)return c(d).find(b);e=w.qsa(g,b)}return w.Z(e,b)},c=function(a,b){return w.init(a,b)},c.extend=function(c){return f.call(arguments,1).forEach(function(d){for(b in d)d[b]!==a&&(c[b]=d[b])}),c},w.qsa=function(a,b){var c;return a===g&&t.test(b)?(c=a.getElementById(RegExp.$1))?[c]:e:a.nodeType!==1&&a.nodeType!==9?e:f.call(s.test(b)?a.getElementsByClassName(RegExp.$1):u.test(b)?a.getElementsByTagName(b):a.querySelectorAll(b))},c.isFunction=A,c.isObject=B,c.isArray=D,c.isPlainObject=C,c.inArray=function(a,b,c){return e.indexOf.call(b,a,c)},c.trim=function(a){return a.trim()},c.uuid=0,c.map=function(a,b){var c,d=[],e,f;if(E(a))for(e=0;e<a.length;e++)c=b(a[e],e),c!=null&&d.push(c);else for(f in a)c=b(a[f],f),c!=null&&d.push(c);return G(d)},c.each=function(a,b){var c,d;if(E(a)){for(c=0;c<a.length;c++)if(b.call(a[c],c,a[c])===!1)return a}else for(d in a)if(b.call(a[d],d,a[d])===!1)return a;return a},c.fn={forEach:e.forEach,reduce:e.reduce,push:e.push,indexOf:e.indexOf,concat:e.concat,map:function(a){return c.map(this,function(b,c){return a.call(b,c,b)})},slice:function(){return c(f.apply(this,arguments))},ready:function(a){return r.test(g.readyState)?a(c):g.addEventListener("DOMContentLoaded",function(){a(c)},!1),this},get:function(b){return b===a?f.call(this):this[b]},toArray:function(){return this.get()},size:function(){return this.length},remove:function(){return this.each(function(){this.parentNode!=null&&this.parentNode.removeChild(this)})},each:function(a){return this.forEach(function(b,c){a.call(b,c,b)}),this},filter:function(a){return c([].filter.call(this,function(b){return w.matches(b,a)}))},add:function(a,b){return c(y(this.concat(c(a,b))))},is:function(a){return this.length>0&&w.matches(this[0],a)},not:function(b){var d=[];if(A(b)&&b.call!==a)this.each(function(a){b.call(this,a)||d.push(this)});else{var e=typeof b=="string"?this.filter(b):E(b)&&A(b.item)?f.call(b):c(b);this.forEach(function(a){e.indexOf(a)<0&&d.push(a)})}return c(d)},eq:function(a){return a===-1?this.slice(a):this.slice(a,+a+1)},first:function(){var a=this[0];return a&&!B(a)?a:c(a)},last:function(){var a=this[this.length-1];return a&&!B(a)?a:c(a)},find:function(a){var b;return this.length==1?b=w.qsa(this[0],a):b=this.map(function(){return w.qsa(this,a)}),c(b)},closest:function(a,b){var d=this[0];while(d&&!w.matches(d,a))d=d!==b&&d!==g&&d.parentNode;return c(d)},parents:function(a){var b=[],d=this;while(d.length>0)d=c.map(d,function(a){if((a=a.parentNode)&&a!==g&&b.indexOf(a)<0)return b.push(a),a});return L(b,a)},parent:function(a){return L(y(this.pluck("parentNode")),a)},children:function(a){return L(this.map(function(){return f.call(this.children)}),a)},siblings:function(a){return L(this.map(function(a,b){return f.call(b.parentNode.children).filter(function(a){return a!==b})}),a)},empty:function(){return this.each(function(){this.innerHTML=""})},pluck:function(a){return this.map(function(){return this[a]})},show:function(){return this.each(function(){this.style.display=="none"&&(this.style.display=null),j(this,"").getPropertyValue("display")=="none"&&(this.style.display=K(this.nodeName))})},replaceWith:function(a){return this.before(a).remove()},wrap:function(a){return this.each(function(){c(this).wrapAll(c(a)[0].cloneNode(!1))})},wrapAll:function(a){return this[0]&&(c(this[0]).before(a=c(a)),a.append(this)),this},unwrap:function(){return this.parent().each(function(){c(this).replaceWith(c(this).children())}),this},clone:function(){return c(this.map(function(){return this.cloneNode(!0)}))},hide:function(){return this.css("display","none")},toggle:function(b){return(b===a?this.css("display")=="none":b)?this.show():this.hide()},prev:function(){return c(this.pluck("previousElementSibling"))},next:function(){return c(this.pluck("nextElementSibling"))},html:function(b){return b===a?this.length>0?this[0].innerHTML:null:this.each(function(a){var d=this.innerHTML;c(this).empty().append(M(this,b,a,d))})},text:function(b){return b===a?this.length>0?this[0].textContent:null:this.each(function(){this.textContent=b})},attr:function(c,d){var e;return typeof c=="string"&&d===a?this.length==0||this[0].nodeType!==1?a:c=="value"&&this[0].nodeName=="INPUT"?this.val():!(e=this[0].getAttribute(c))&&c in this[0]?this[0][c]:e:this.each(function(a){if(this.nodeType!==1)return;if(B(c))for(b in c)this.setAttribute(b,c[b]);else this.setAttribute(c,M(this,d,a,this.getAttribute(c)))})},removeAttr:function(a){return this.each(function(){this.nodeType===1&&this.removeAttribute(a)})},prop:function(b,c){return c===a?this[0]?this[0][b]:a:this.each(function(a){this[b]=M(this,c,a,this[b])})},data:function(b,c){var d=this.attr("data-"+H(b),c);return d!==null?d:a},val:function(b){return b===a?this.length>0?this[0].value:a:this.each(function(a){this.value=M(this,b,a,this.value)})},offset:function(){if(this.length==0)return null;var a=this[0].getBoundingClientRect();return{left:a.left+window.pageXOffset,top:a.top+window.pageYOffset,width:a.width,height:a.height}},css:function(c,d){if(d===a&&typeof c=="string")return this.length==0?a:this[0].style[x(c)]||j(this[0],"").getPropertyValue(c);var e="";for(b in c)typeof c[b]=="string"&&c[b]==""?this.each(function(){this.style.removeProperty(H(b))}):e+=H(b)+":"+J(b,c[b])+";";return typeof c=="string"&&(d==""?this.each(function(){this.style.removeProperty(H(c))}):e=H(c)+":"+J(c,d)),this.each(function(){this.style.cssText+=";"+e})},index:function(a){return a?this.indexOf(c(a)[0]):this.parent().children().indexOf(this[0])},hasClass:function(a){return this.length<1?!1:I(a).test(this[0].className)},addClass:function(a){return this.each(function(b){d=[];var e=this.className,f=M(this,a,b,e);f.split(/\s+/g).forEach(function(a){c(this).hasClass(a)||d.push(a)},this),d.length&&(this.className+=(e?" ":"")+d.join(" "))})},removeClass:function(b){return this.each(function(c){if(b===a)return this.className="";d=this.className,M(this,b,c,d).split(/\s+/g).forEach(function(a){d=d.replace(I(a)," ")}),this.className=d.trim()})},toggleClass:function(b,d){return this.each(function(e){var f=M(this,b,e,this.className);(d===a?!c(this).hasClass(f):d)?c(this).addClass(f):c(this).removeClass(f)})}},["width","height"].forEach(function(b){c.fn[b]=function(d){var e,f=b.replace(/./,function(a){return a[0].toUpperCase()});return d===a?this[0]==window?window["inner"+f]:this[0]==g?g.documentElement["offset"+f]:(e=this.offset())&&e[b]:this.each(function(a){var e=c(this);e.css(b,M(this,d,a,e[b]()))})}}),n.forEach(function(a,b){c.fn[a]=function(){var a=c.map(arguments,function(a){return B(a)?a:w.fragment(a)});if(a.length<1)return this;var d=this.length,e=d>1,f=b<2;return this.each(function(c,g){for(var h=0;h<a.length;h++){var i=a[f?a.length-h-1:h];O(i,function(a){a.nodeName!=null&&a.nodeName.toUpperCase()==="SCRIPT"&&(!a.type||a.type==="text/javascript")&&window.eval.call(window,a.innerHTML)}),e&&c<d-1&&(i=i.cloneNode(!0)),N(b,g,i)}})},c.fn[b%2?a+"To":"insert"+(b?"Before":"After")]=function(b){return c(b)[a](this),this}}),w.Z.prototype=c.fn,w.camelize=x,w.uniq=y,c.zepto=w,c}();window.Zepto=Zepto,"$"in window||(window.$=Zepto),function(a){function f(a){return a._zid||(a._zid=d++)}function g(a,b,d,e){b=h(b);if(b.ns)var g=i(b.ns);return(c[f(a)]||[]).filter(function(a){return a&&(!b.e||a.e==b.e)&&(!b.ns||g.test(a.ns))&&(!d||f(a.fn)===f(d))&&(!e||a.sel==e)})}function h(a){var b=(""+a).split(".");return{e:b[0],ns:b.slice(1).sort().join(" ")}}function i(a){return new RegExp("(?:^| )"+a.replace(" "," .* ?")+"(?: |$)")}function j(b,c,d){a.isObject(b)?a.each(b,d):b.split(/\s/).forEach(function(a){d(a,c)})}function k(b,d,e,g,i,k){k=!!k;var l=f(b),m=c[l]||(c[l]=[]);j(d,e,function(c,d){var e=i&&i(d,c),f=e||d,j=function(a){var c=f.apply(b,[a].concat(a.data));return c===!1&&a.preventDefault(),c},l=a.extend(h(c),{fn:d,proxy:j,sel:g,del:e,i:m.length});m.push(l),b.addEventListener(l.e,j,k)})}function l(a,b,d,e){var h=f(a);j(b||"",d,function(b,d){g(a,b,d,e).forEach(function(b){delete c[h][b.i],a.removeEventListener(b.e,b.proxy,!1)})})}function p(b){var c=a.extend({originalEvent:b},b);return a.each(o,function(a,d){c[a]=function(){return this[d]=m,b[a].apply(b,arguments)},c[d]=n}),c}function q(a){if(!("defaultPrevented"in a)){a.defaultPrevented=!1;var b=a.preventDefault;a.preventDefault=function(){this.defaultPrevented=!0,b.call(this)}}}var b=a.zepto.qsa,c={},d=1,e={};e.click=e.mousedown=e.mouseup=e.mousemove="MouseEvents",a.event={add:k,remove:l},a.proxy=function(b,c){if(a.isFunction(b)){var d=function(){return b.apply(c,arguments)};return d._zid=f(b),d}if(typeof c=="string")return a.proxy(b[c],b);throw new TypeError("expected function")},a.fn.bind=function(a,b){return this.each(function(){k(this,a,b)})},a.fn.unbind=function(a,b){return this.each(function(){l(this,a,b)})},a.fn.one=function(a,b){return this.each(function(c,d){k(this,a,b,null,function(a,b){return function(){var c=a.apply(d,arguments);return l(d,b,a),c}})})};var m=function(){return!0},n=function(){return!1},o={preventDefault:"isDefaultPrevented",stopImmediatePropagation:"isImmediatePropagationStopped",stopPropagation:"isPropagationStopped"};a.fn.delegate=function(b,c,d){var e=!1;if(c=="blur"||c=="focus")a.iswebkit?c=c=="blur"?"focusout":c=="focus"?"focusin":c:e=!0;return this.each(function(f,g){k(g,c,d,b,function(c){return function(d){var e,f=a(d.target).closest(b,g).get(0);if(f)return e=a.extend(p(d),{currentTarget:f,liveFired:g}),c.apply(f,[e].concat([].slice.call(arguments,1)))}},e)})},a.fn.undelegate=function(a,b,c){return this.each(function(){l(this,b,c,a)})},a.fn.live=function(b,c){return a(document.body).delegate(this.selector,b,c),this},a.fn.die=function(b,c){return a(document.body).undelegate(this.selector,b,c),this},a.fn.on=function(b,c,d){return c==undefined||a.isFunction(c)?this.bind(b,c):this.delegate(c,b,d)},a.fn.off=function(b,c,d){return c==undefined||a.isFunction(c)?this.unbind(b,c):this.undelegate(c,b,d)},a.fn.trigger=function(b,c){return typeof b=="string"&&(b=a.Event(b)),q(b),b.data=c,this.each(function(){"dispatchEvent"in this&&this.dispatchEvent(b)})},a.fn.triggerHandler=function(b,c){var d,e;return this.each(function(f,h){d=p(typeof b=="string"?a.Event(b):b),d.data=c,d.target=h,a.each(g(h,b.type||b),function(a,b){e=b.proxy(d);if(d.isImmediatePropagationStopped())return!1})}),e},"focusin focusout load resize scroll unload click dblclick mousedown mouseup mousemove mouseover mouseout change select keydown keypress keyup error".split(" ").forEach(function(b){a.fn[b]=function(a){return this.bind(b,a)}}),["focus","blur"].forEach(function(b){a.fn[b]=function(a){if(a)this.bind(b,a);else if(this.length)try{this.get(0)[b]()}catch(c){}return this}}),a.Event=function(a,b){var c=document.createEvent(e[a]||"Events"),d=!0;if(b)for(var f in b)f=="bubbles"?d=!!b[f]:c[f]=b[f];return c.initEvent(a,d,!0,null,null,null,null,null,null,null,null,null,null,null,null),c}}(Zepto),function(a){function b(a){var b=this.os={},c=this.browser={},d=a.match(/WebKit\/([\d.]+)/),e=a.match(/(Android)\s+([\d.]+)/),f=a.match(/(iPad).*OS\s([\d_]+)/),g=!f&&a.match(/(iPhone\sOS)\s([\d_]+)/),h=a.match(/(webOS|hpwOS)[\s\/]([\d.]+)/),i=h&&a.match(/TouchPad/),j=a.match(/Kindle\/([\d.]+)/),k=a.match(/Silk\/([\d._]+)/),l=a.match(/(BlackBerry).*Version\/([\d.]+)/);if(c.webkit=!!d)c.version=d[1];e&&(b.android=!0,b.version=e[2]),g&&(b.ios=b.iphone=!0,b.version=g[2].replace(/_/g,".")),f&&(b.ios=b.ipad=!0,b.version=f[2].replace(/_/g,".")),h&&(b.webos=!0,b.version=h[2]),i&&(b.touchpad=!0),l&&(b.blackberry=!0,b.version=l[2]),j&&(b.kindle=!0,b.version=j[1]),k&&(c.silk=!0,c.version=k[1]),!k&&b.android&&a.match(/Kindle Fire/)&&(c.silk=!0)}b.call(a,navigator.userAgent),a.__detect=b}(Zepto),function(a,b){function l(a){return a.toLowerCase()}function m(a){return d?d+a:l(a)}var c="",d,e,f,g={Webkit:"webkit",Moz:"",O:"o",ms:"MS"},h=window.document,i=h.createElement("div"),j=/^((translate|rotate|scale)(X|Y|Z|3d)?|matrix(3d)?|perspective|skew(X|Y)?)$/i,k={};a.each(g,function(a,e){if(i.style[a+"TransitionProperty"]!==b)return c="-"+l(a)+"-",d=e,!1}),k[c+"transition-property"]=k[c+"transition-duration"]=k[c+"transition-timing-function"]=k[c+"animation-name"]=k[c+"animation-duration"]="",a.fx={off:d===b&&i.style.transitionProperty===b,cssPrefix:c,transitionEnd:m("TransitionEnd"),animationEnd:m("AnimationEnd")},a.fn.animate=function(b,c,d,e){return a.isObject(c)&&(d=c.easing,e=c.complete,c=c.duration),c&&(c/=1e3),this.anim(b,c,d,e)},a.fn.anim=function(d,e,f,g){var h,i={},l,m=this,n,o=a.fx.transitionEnd;e===b&&(e=.4),a.fx.off&&(e=0);if(typeof d=="string")i[c+"animation-name"]=d,i[c+"animation-duration"]=e+"s",o=a.fx.animationEnd;else{for(l in d)j.test(l)?(h||(h=[]),h.push(l+"("+d[l]+")")):i[l]=d[l];h&&(i[c+"transform"]=h.join(" ")),!a.fx.off&&typeof d=="object"&&(i[c+"transition-property"]=Object.keys(d).join(", "),i[c+"transition-duration"]=e+"s",i[c+"transition-timing-function"]=f||"linear")}return n=function(b){if(typeof b!="undefined"){if(b.target!==b.currentTarget)return;a(b.target).unbind(o,arguments.callee)}a(this).css(k),g&&g.call(this)},e>0&&this.bind(o,n),setTimeout(function(){m.css(i),e<=0&&setTimeout(function(){m.each(function(){n.call(this)})},0)},0),this},i=null}(Zepto),function($){function triggerAndReturn(a,b,c){var d=$.Event(b);return $(a).trigger(d,c),!d.defaultPrevented}function triggerGlobal(a,b,c,d){if(a.global)return triggerAndReturn(b||document,c,d)}function ajaxStart(a){a.global&&$.active++===0&&triggerGlobal(a,null,"ajaxStart")}function ajaxStop(a){a.global&&!--$.active&&triggerGlobal(a,null,"ajaxStop")}function ajaxBeforeSend(a,b){var c=b.context;if(b.beforeSend.call(c,a,b)===!1||triggerGlobal(b,c,"ajaxBeforeSend",[a,b])===!1)return!1;triggerGlobal(b,c,"ajaxSend",[a,b])}function ajaxSuccess(a,b,c){var d=c.context,e="success";c.success.call(d,a,e,b),triggerGlobal(c,d,"ajaxSuccess",[b,c,a]),ajaxComplete(e,b,c)}function ajaxError(a,b,c,d){var e=d.context;d.error.call(e,c,b,a),triggerGlobal(d,e,"ajaxError",[c,d,a]),ajaxComplete(b,c,d)}function ajaxComplete(a,b,c){var d=c.context;c.complete.call(d,b,a),triggerGlobal(c,d,"ajaxComplete",[b,c]),ajaxStop(c)}function empty(){}function mimeToDataType(a){return a&&(a==htmlType?"html":a==jsonType?"json":scriptTypeRE.test(a)?"script":xmlTypeRE.test(a)&&"xml")||"text"}function appendQuery(a,b){return(a+"&"+b).replace(/[&?]{1,2}/,"?")}function serializeData(a){isObject(a.data)&&(a.data=$.param(a.data)),a.data&&(!a.type||a.type.toUpperCase()=="GET")&&(a.url=appendQuery(a.url,a.data))}function serialize(a,b,c,d){var e=$.isArray(b);$.each(b,function(b,f){d&&(b=c?d:d+"["+(e?"":b)+"]"),!d&&e?a.add(f.name,f.value):(c?$.isArray(f):isObject(f))?serialize(a,f,c,b):a.add(b,f)})}var jsonpID=0,isObject=$.isObject,document=window.document,key,name,rscript=/<script\b[^<]*(?:(?!<\/script>)<[^<]*)*<\/script>/gi,scriptTypeRE=/^(?:text|application)\/javascript/i,xmlTypeRE=/^(?:text|application)\/xml/i,jsonType="application/json",htmlType="text/html",blankRE=/^\s*$/;$.active=0,$.ajaxJSONP=function(a){var b="jsonp"+ ++jsonpID,c=document.createElement("script"),d=function(){$(c).remove(),b in window&&(window[b]=empty),ajaxComplete("abort",e,a)},e={abort:d},f;return a.error&&(c.onerror=function(){e.abort(),a.error()}),window[b]=function(d){clearTimeout(f),$(c).remove(),delete window[b],ajaxSuccess(d,e,a)},serializeData(a),c.src=a.url.replace(/=\?/,"="+b),$("head").append(c),a.timeout>0&&(f=setTimeout(function(){e.abort(),ajaxComplete("timeout",e,a)},a.timeout)),e},$.ajaxSettings={type:"GET",beforeSend:empty,success:empty,error:empty,complete:empty,context:null,global:!0,xhr:function(){return new window.XMLHttpRequest},accepts:{script:"text/javascript, application/javascript",json:jsonType,xml:"application/xml, text/xml",html:htmlType,text:"text/plain"},crossDomain:!1,timeout:0},$.ajax=function(options){var settings=$.extend({},options||{});for(key in $.ajaxSettings)settings[key]===undefined&&(settings[key]=$.ajaxSettings[key]);ajaxStart(settings),settings.crossDomain||(settings.crossDomain=/^([\w-]+:)?\/\/([^\/]+)/.test(settings.url)&&RegExp.$2!=window.location.host);var dataType=settings.dataType,hasPlaceholder=/=\?/.test(settings.url);if(dataType=="jsonp"||hasPlaceholder)return hasPlaceholder||(settings.url=appendQuery(settings.url,"callback=?")),$.ajaxJSONP(settings);settings.url||(settings.url=window.location.toString()),serializeData(settings);var mime=settings.accepts[dataType],baseHeaders={},protocol=/^([\w-]+:)\/\//.test(settings.url)?RegExp.$1:window.location.protocol,xhr=$.ajaxSettings.xhr(),abortTimeout;settings.crossDomain||(baseHeaders["X-Requested-With"]="XMLHttpRequest"),mime&&(baseHeaders.Accept=mime,mime.indexOf(",")>-1&&(mime=mime.split(",",2)[0]),xhr.overrideMimeType&&xhr.overrideMimeType(mime));if(settings.contentType||settings.data&&settings.type.toUpperCase()!="GET")baseHeaders["Content-Type"]=settings.contentType||"application/x-www-form-urlencoded";settings.headers=$.extend(baseHeaders,settings.headers||{}),xhr.onreadystatechange=function(){if(xhr.readyState==4){clearTimeout(abortTimeout);var result,error=!1;if(xhr.status>=200&&xhr.status<300||xhr.status==304||xhr.status==0&&protocol=="file:"){dataType=dataType||mimeToDataType(xhr.getResponseHeader("content-type")),result=xhr.responseText;try{dataType=="script"?(1,eval)(result):dataType=="xml"?result=xhr.responseXML:dataType=="json"&&(result=blankRE.test(result)?null:JSON.parse(result))}catch(e){error=e}error?ajaxError(error,"parsererror",xhr,settings):ajaxSuccess(result,xhr,settings)}else ajaxError(null,"error",xhr,settings)}};var async="async"in settings?settings.async:!0;xhr.open(settings.type,settings.url,async);for(name in settings.headers)xhr.setRequestHeader(name,settings.headers[name]);return ajaxBeforeSend(xhr,settings)===!1?(xhr.abort(),!1):(settings.timeout>0&&(abortTimeout=setTimeout(function(){xhr.onreadystatechange=empty,xhr.abort(),ajaxError(null,"timeout",xhr,settings)},settings.timeout)),xhr.send(settings.data?settings.data:null),xhr)},$.get=function(a,b){return $.ajax({url:a,success:b})},$.post=function(a,b,c,d){return $.isFunction(b)&&(d=d||c,c=b,b=null),$.ajax({type:"POST",url:a,data:b,success:c,dataType:d})},$.getJSON=function(a,b){return $.ajax({url:a,success:b,dataType:"json"})},$.fn.load=function(a,b){if(!this.length)return this;var c=this,d=a.split(/\s/),e;return d.length>1&&(a=d[0],e=d[1]),$.get(a,function(a){c.html(e?$(document.createElement("div")).html(a.replace(rscript,"")).find(e).html():a),b&&b.call(c)}),this};var escape=encodeURIComponent;$.param=function(a,b){var c=[];return c.add=function(a,b){this.push(escape(a)+"="+escape(b))},serialize(c,a,b),c.join("&").replace("%20","+")}}(Zepto),function(a){a.fn.serializeArray=function(){var b=[],c;return a(Array.prototype.slice.call(this.get(0).elements)).each(function(){c=a(this);var d=c.attr("type");this.nodeName.toLowerCase()!="fieldset"&&!this.disabled&&d!="submit"&&d!="reset"&&d!="button"&&(d!="radio"&&d!="checkbox"||this.checked)&&b.push({name:c.attr("name"),value:c.val()})}),b},a.fn.serialize=function(){var a=[];return this.serializeArray().forEach(function(b){a.push(encodeURIComponent(b.name)+"="+encodeURIComponent(b.value))}),a.join("&")},a.fn.submit=function(b){if(b)this.bind("submit",b);else if(this.length){var c=a.Event("submit");this.eq(0).trigger(c),c.defaultPrevented||this.get(0).submit()}return this}}(Zepto),function(a){function d(a){return"tagName"in a?a:a.parentNode}function e(a,b,c,d){var e=Math.abs(a-b),f=Math.abs(c-d);return e>=f?a-b>0?"Left":"Right":c-d>0?"Up":"Down"}function h(){g=null,b.last&&(b.el.trigger("longTap"),b={})}function i(){g&&clearTimeout(g),g=null}var b={},c,f=750,g;a(document).ready(function(){var j,k;a(document.body).bind("touchstart",function(e){j=Date.now(),k=j-(b.last||j),b.el=a(d(e.touches[0].target)),c&&clearTimeout(c),b.x1=e.touches[0].pageX,b.y1=e.touches[0].pageY,k>0&&k<=250&&(b.isDoubleTap=!0),b.last=j,g=setTimeout(h,f)}).bind("touchmove",function(a){i(),b.x2=a.touches[0].pageX,b.y2=a.touches[0].pageY}).bind("touchend",function(a){i(),b.isDoubleTap?(b.el.trigger("doubleTap"),b={}):b.x2&&Math.abs(b.x1-b.x2)>30||b.y2&&Math.abs(b.y1-b.y2)>30?(b.el.trigger("swipe")&&b.el.trigger("swipe"+e(b.x1,b.x2,b.y1,b.y2)),b={}):"last"in b&&(b.el.trigger("tap"),c=setTimeout(function(){c=null,b.el.trigger("singleTap"),b={}},250))}).bind("touchcancel",function(){c&&clearTimeout(c),g&&clearTimeout(g),g=c=null,b={}})}),["swipe","swipeLeft","swipeRight","swipeUp","swipeDown","doubleTap","tap","singleTap","longTap"].forEach(function(b){a.fn[b]=function(a){return this.bind(b,a)}})}(Zepto);

/*! iScroll v5.1.1 ~ (c) 2008-2014 Matteo Spinelli ~ http://cubiq.org/license */
(function (window, document, Math) {
var rAF = window.requestAnimationFrame	||
	window.webkitRequestAnimationFrame	||
	window.mozRequestAnimationFrame		||
	window.oRequestAnimationFrame		||
	window.msRequestAnimationFrame		||
	function (callback) { window.setTimeout(callback, 1000 / 60); };

var utils = (function () {
	var me = {};

	var _elementStyle = document.createElement('div').style;
	var _vendor = (function () {
		var vendors = ['t', 'webkitT', 'MozT', 'msT', 'OT'],
			transform,
			i = 0,
			l = vendors.length;

		for ( ; i < l; i++ ) {
			transform = vendors[i] + 'ransform';
			if ( transform in _elementStyle ) return vendors[i].substr(0, vendors[i].length-1);
		}

		return false;
	})();

	function _prefixStyle (style) {
		if ( _vendor === false ) return false;
		if ( _vendor === '' ) return style;
		return _vendor + style.charAt(0).toUpperCase() + style.substr(1);
	}

	me.getTime = Date.now || function getTime () { return new Date().getTime(); };

	me.extend = function (target, obj) {
		for ( var i in obj ) {
			target[i] = obj[i];
		}
	};

	me.addEvent = function (el, type, fn, capture) {
		el.addEventListener(type, fn, !!capture);
	};

	me.removeEvent = function (el, type, fn, capture) {
		el.removeEventListener(type, fn, !!capture);
	};

	me.momentum = function (current, start, time, lowerMargin, wrapperSize, deceleration) {
		var distance = current - start,
			speed = Math.abs(distance) / time,
			destination,
			duration;

		deceleration = deceleration === undefined ? 0.0006 : deceleration;

		destination = current + ( speed * speed ) / ( 2 * deceleration ) * ( distance < 0 ? -1 : 1 );
		duration = speed / deceleration;

		if ( destination < lowerMargin ) {
			destination = wrapperSize ? lowerMargin - ( wrapperSize / 2.5 * ( speed / 8 ) ) : lowerMargin;
			distance = Math.abs(destination - current);
			duration = distance / speed;
		} else if ( destination > 0 ) {
			destination = wrapperSize ? wrapperSize / 2.5 * ( speed / 8 ) : 0;
			distance = Math.abs(current) + destination;
			duration = distance / speed;
		}

		return {
			destination: Math.round(destination),
			duration: duration
		};
	};

	var _transform = _prefixStyle('transform');

	me.extend(me, {
		hasTransform: _transform !== false,
		hasPerspective: _prefixStyle('perspective') in _elementStyle,
		hasTouch: 'ontouchstart' in window,
		hasPointer: navigator.msPointerEnabled,
		hasTransition: _prefixStyle('transition') in _elementStyle
	});

	// This should find all Android browsers lower than build 535.19 (both stock browser and webview)
	me.isBadAndroid = /Android /.test(window.navigator.appVersion) && !(/Chrome\/\d/.test(window.navigator.appVersion));

	me.extend(me.style = {}, {
		transform: _transform,
		transitionTimingFunction: _prefixStyle('transitionTimingFunction'),
		transitionDuration: _prefixStyle('transitionDuration'),
		transitionDelay: _prefixStyle('transitionDelay'),
		transformOrigin: _prefixStyle('transformOrigin')
	});

	me.hasClass = function (e, c) {
		var re = new RegExp("(^|\\s)" + c + "(\\s|$)");
		return re.test(e.className);
	};

	me.addClass = function (e, c) {
		if ( me.hasClass(e, c) ) {
			return;
		}

		var newclass = e.className.split(' ');
		newclass.push(c);
		e.className = newclass.join(' ');
	};

	me.removeClass = function (e, c) {
		if ( !me.hasClass(e, c) ) {
			return;
		}

		var re = new RegExp("(^|\\s)" + c + "(\\s|$)", 'g');
		e.className = e.className.replace(re, ' ');
	};

	me.offset = function (el) {
		var left = -el.offsetLeft,
			top = -el.offsetTop;

		// jshint -W084
		while (el = el.offsetParent) {
			left -= el.offsetLeft;
			top -= el.offsetTop;
		}
		// jshint +W084

		return {
			left: left,
			top: top
		};
	};

	me.preventDefaultException = function (el, exceptions) {
		for ( var i in exceptions ) {
			if ( exceptions[i].test(el[i]) ) {
				return true;
			}
		}

		return false;
	};

	me.extend(me.eventType = {}, {
		touchstart: 1,
		touchmove: 1,
		touchend: 1,

		mousedown: 2,
		mousemove: 2,
		mouseup: 2,

		MSPointerDown: 3,
		MSPointerMove: 3,
		MSPointerUp: 3
	});

	me.extend(me.ease = {}, {
		quadratic: {
			style: 'cubic-bezier(0.25, 0.46, 0.45, 0.94)',
			fn: function (k) {
				return k * ( 2 - k );
			}
		},
		circular: {
			style: 'cubic-bezier(0.1, 0.57, 0.1, 1)',	// Not properly "circular" but this looks better, it should be (0.075, 0.82, 0.165, 1)
			fn: function (k) {
				return Math.sqrt( 1 - ( --k * k ) );
			}
		},
		back: {
			style: 'cubic-bezier(0.175, 0.885, 0.32, 1.275)',
			fn: function (k) {
				var b = 4;
				return ( k = k - 1 ) * k * ( ( b + 1 ) * k + b ) + 1;
			}
		},
		bounce: {
			style: '',
			fn: function (k) {
				if ( ( k /= 1 ) < ( 1 / 2.75 ) ) {
					return 7.5625 * k * k;
				} else if ( k < ( 2 / 2.75 ) ) {
					return 7.5625 * ( k -= ( 1.5 / 2.75 ) ) * k + 0.75;
				} else if ( k < ( 2.5 / 2.75 ) ) {
					return 7.5625 * ( k -= ( 2.25 / 2.75 ) ) * k + 0.9375;
				} else {
					return 7.5625 * ( k -= ( 2.625 / 2.75 ) ) * k + 0.984375;
				}
			}
		},
		elastic: {
			style: '',
			fn: function (k) {
				var f = 0.22,
					e = 0.4;

				if ( k === 0 ) { return 0; }
				if ( k == 1 ) { return 1; }

				return ( e * Math.pow( 2, - 10 * k ) * Math.sin( ( k - f / 4 ) * ( 2 * Math.PI ) / f ) + 1 );
			}
		}
	});

	me.tap = function (e, eventName) {
		var ev = document.createEvent('Event');
		ev.initEvent(eventName, true, true);
		ev.pageX = e.pageX;
		ev.pageY = e.pageY;
		e.target.dispatchEvent(ev);
	};

	me.click = function (e) {
		var target = e.target,
			ev;

		if ( !(/(SELECT|INPUT|TEXTAREA)/i).test(target.tagName) ) {
			ev = document.createEvent('MouseEvents');
			ev.initMouseEvent('click', true, true, e.view, 1,
				target.screenX, target.screenY, target.clientX, target.clientY,
				e.ctrlKey, e.altKey, e.shiftKey, e.metaKey,
				0, null);

			ev._constructed = true;
			target.dispatchEvent(ev);
		}
	};

	return me;
})();

function IScroll (el, options) {
	this.wrapper = typeof el == 'string' ? document.querySelector(el) : el;
	this.scroller = this.wrapper.children[0];
	this.scrollerStyle = this.scroller.style;		// cache style for better performance

	this.options = {

		resizeScrollbars: true,

		mouseWheelSpeed: 20,

		snapThreshold: 0.334,

// INSERT POINT: OPTIONS 

		startX: 0,
		startY: 0,
		scrollY: true,
		directionLockThreshold: 5,
		momentum: true,

		bounce: true,
		bounceTime: 600,
		bounceEasing: '',

		preventDefault: true,
		preventDefaultException: { tagName: /^(INPUT|TEXTAREA|BUTTON|SELECT)$/ },

		HWCompositing: true,
		useTransition: true,
		useTransform: true
	};

	for ( var i in options ) {
		this.options[i] = options[i];
	}

	// Normalize options
	this.translateZ = this.options.HWCompositing && utils.hasPerspective ? ' translateZ(0)' : '';

	this.options.useTransition = utils.hasTransition && this.options.useTransition;
	this.options.useTransform = utils.hasTransform && this.options.useTransform;

	this.options.eventPassthrough = this.options.eventPassthrough === true ? 'vertical' : this.options.eventPassthrough;
	this.options.preventDefault = !this.options.eventPassthrough && this.options.preventDefault;

	// If you want eventPassthrough I have to lock one of the axes
	this.options.scrollY = this.options.eventPassthrough == 'vertical' ? false : this.options.scrollY;
	this.options.scrollX = this.options.eventPassthrough == 'horizontal' ? false : this.options.scrollX;

	// With eventPassthrough we also need lockDirection mechanism
	this.options.freeScroll = this.options.freeScroll && !this.options.eventPassthrough;
	this.options.directionLockThreshold = this.options.eventPassthrough ? 0 : this.options.directionLockThreshold;

	this.options.bounceEasing = typeof this.options.bounceEasing == 'string' ? utils.ease[this.options.bounceEasing] || utils.ease.circular : this.options.bounceEasing;

	this.options.resizePolling = this.options.resizePolling === undefined ? 60 : this.options.resizePolling;

	if ( this.options.tap === true ) {
		this.options.tap = 'tap';
	}

	if ( this.options.shrinkScrollbars == 'scale' ) {
		this.options.useTransition = false;
	}

	this.options.invertWheelDirection = this.options.invertWheelDirection ? -1 : 1;

	if ( this.options.probeType == 3 ) {
		this.options.useTransition = false;	}

// INSERT POINT: NORMALIZATION

	// Some defaults	
	this.x = 0;
	this.y = 0;
	this.directionX = 0;
	this.directionY = 0;
	this._events = {};

// INSERT POINT: DEFAULTS

	this._init();
	this.refresh();

	this.scrollTo(this.options.startX, this.options.startY);
	this.enable();
}

IScroll.prototype = {
	version: '5.1.1',

	_init: function () {
		this._initEvents();

		if ( this.options.scrollbars || this.options.indicators ) {
			this._initIndicators();
		}

		if ( this.options.mouseWheel ) {
			this._initWheel();
		}

		if ( this.options.snap ) {
			this._initSnap();
		}

		if ( this.options.keyBindings ) {
			this._initKeys();
		}

// INSERT POINT: _init

	},

	destroy: function () {
		this._initEvents(true);

		this._execEvent('destroy');
	},

	_transitionEnd: function (e) {
		if ( e.target != this.scroller || !this.isInTransition ) {
			return;
		}

		this._transitionTime();
		console.log('_transitionEnd scrollEnd');
		if ( !this.resetPosition(this.options.bounceTime) ) {
			this.isInTransition = false;
			this._execEvent('scrollEnd');
		}
	},

	_start: function (e) {
		// React to left mouse button only
		if ( utils.eventType[e.type] != 1 ) {
			if ( e.button !== 0 ) {
				return;
			}
		}

		if ( !this.enabled || (this.initiated && utils.eventType[e.type] !== this.initiated) ) {
			return;
		}

		if ( this.options.preventDefault && !utils.isBadAndroid && !utils.preventDefaultException(e.target, this.options.preventDefaultException) ) {
			e.preventDefault();
		}

		var point = e.touches ? e.touches[0] : e,
			pos;

		this.initiated	= utils.eventType[e.type];
		this.moved		= false;
		this.distX		= 0;
		this.distY		= 0;
		this.directionX = 0;
		this.directionY = 0;
		this.directionLocked = 0;

		this._transitionTime();

		this.startTime = utils.getTime();

		if ( this.options.useTransition && this.isInTransition ) {
			this.isInTransition = false;
			pos = this.getComputedPosition();
			this._translate(Math.round(pos.x), Math.round(pos.y));
			this._execEvent('scrollEnd');
		} else if ( !this.options.useTransition && this.isAnimating ) {
			this.isAnimating = false;
			this._execEvent('scrollEnd');
		}

		this.startX    = this.x;
		this.startY    = this.y;
		this.absStartX = this.x;
		this.absStartY = this.y;
		this.pointX    = point.pageX;
		this.pointY    = point.pageY;

		this._execEvent('beforeScrollStart');
	},

	_move: function (e) {
		if ( !this.enabled || utils.eventType[e.type] !== this.initiated ) {
			return;
		}

		if ( this.options.preventDefault ) {	// increases performance on Android? TODO: check!
			e.preventDefault();
		}

		var point		= e.touches ? e.touches[0] : e,
			deltaX		= point.pageX - this.pointX,
			deltaY		= point.pageY - this.pointY,
			timestamp	= utils.getTime(),
			newX, newY,
			absDistX, absDistY;

		this.pointX		= point.pageX;
		this.pointY		= point.pageY;

		this.distX		+= deltaX;
		this.distY		+= deltaY;
		absDistX		= Math.abs(this.distX);
		absDistY		= Math.abs(this.distY);

		// We need to move at least 10 pixels for the scrolling to initiate
		if ( timestamp - this.endTime > 300 && (absDistX < 10 && absDistY < 10) ) {
			return;
		}

		// If you are scrolling in one direction lock the other
		if ( !this.directionLocked && !this.options.freeScroll ) {
			if ( absDistX > absDistY + this.options.directionLockThreshold ) {
				this.directionLocked = 'h';		// lock horizontally
			} else if ( absDistY >= absDistX + this.options.directionLockThreshold ) {
				this.directionLocked = 'v';		// lock vertically
			} else {
				this.directionLocked = 'n';		// no lock
			}
		}

		if ( this.directionLocked == 'h' ) {
			if ( this.options.eventPassthrough == 'vertical' ) {
				e.preventDefault();
			} else if ( this.options.eventPassthrough == 'horizontal' ) {
				this.initiated = false;
				return;
			}

			deltaY = 0;
		} else if ( this.directionLocked == 'v' ) {
			if ( this.options.eventPassthrough == 'horizontal' ) {
				e.preventDefault();
			} else if ( this.options.eventPassthrough == 'vertical' ) {
				this.initiated = false;
				return;
			}

			deltaX = 0;
		}

		deltaX = this.hasHorizontalScroll ? deltaX : 0;
		deltaY = this.hasVerticalScroll ? deltaY : 0;

		newX = this.x + deltaX;
		newY = this.y + deltaY;

		// Slow down if outside of the boundaries
		if ( newX > 0 || newX < this.maxScrollX ) {
			newX = this.options.bounce ? this.x + deltaX / 3 : newX > 0 ? 0 : this.maxScrollX;
		}
		if ( newY > 0 || newY < this.maxScrollY ) {
			newY = this.options.bounce ? this.y + deltaY / 3 : newY > 0 ? 0 : this.maxScrollY;
		}

		this.directionX = deltaX > 0 ? -1 : deltaX < 0 ? 1 : 0;
		this.directionY = deltaY > 0 ? -1 : deltaY < 0 ? 1 : 0;

		if ( !this.moved ) {
			this._execEvent('scrollStart');
		}

		this.moved = true;

		this._translate(newX, newY);

/* REPLACE START: _move */
		if ( timestamp - this.startTime > 300 ) {
			this.startTime = timestamp;
			this.startX = this.x;
			this.startY = this.y;

			if ( this.options.probeType == 1 ) {
				this._execEvent('scroll');
			}
		}

		if ( this.options.probeType > 1 ) {
			this._execEvent('scroll');
		}
/* REPLACE END: _move */

	},

	_end: function (e) {
		if ( !this.enabled || utils.eventType[e.type] !== this.initiated ) {
			return;
		}

		if ( this.options.preventDefault && !utils.preventDefaultException(e.target, this.options.preventDefaultException) ) {
			e.preventDefault();
		}

		var point = e.changedTouches ? e.changedTouches[0] : e,
			momentumX,
			momentumY,
			duration = utils.getTime() - this.startTime,
			newX = Math.round(this.x),
			newY = Math.round(this.y),
			distanceX = Math.abs(newX - this.startX),
			distanceY = Math.abs(newY - this.startY),
			time = 0,
			easing = '';

		this.isInTransition = 0;
		this.initiated = 0;
		this.endTime = utils.getTime();

		// reset if we are outside of the boundaries
		if ( this.resetPosition(this.options.bounceTime) ) {
			return;
		}

		this.scrollTo(newX, newY);	// ensures that the last position is rounded

		// we scrolled less than 10 pixels
		if ( !this.moved ) {
			if ( this.options.tap ) {
				utils.tap(e, this.options.tap);
			}

			if ( this.options.click ) {
				utils.click(e);
			}

			this._execEvent('scrollCancel');
			return;
		}

		if ( this._events.flick && duration < 200 && distanceX < 100 && distanceY < 100 ) {
			this._execEvent('flick');
			return;
		}

		// start momentum animation if needed
		if ( this.options.momentum && duration < 300 ) {
			momentumX = this.hasHorizontalScroll ? utils.momentum(this.x, this.startX, duration, this.maxScrollX, this.options.bounce ? this.wrapperWidth : 0, this.options.deceleration) : { destination: newX, duration: 0 };
			momentumY = this.hasVerticalScroll ? utils.momentum(this.y, this.startY, duration, this.maxScrollY, this.options.bounce ? this.wrapperHeight : 0, this.options.deceleration) : { destination: newY, duration: 0 };
			newX = momentumX.destination;
			newY = momentumY.destination;
			time = Math.max(momentumX.duration, momentumY.duration);
			this.isInTransition = 1;
		}


		if ( this.options.snap ) {
			var snap = this._nearestSnap(newX, newY);
			this.currentPage = snap;
			time = this.options.snapSpeed || Math.max(
					Math.max(
						Math.min(Math.abs(newX - snap.x), 1000),
						Math.min(Math.abs(newY - snap.y), 1000)
					), 300);
			newX = snap.x;
			newY = snap.y;

			this.directionX = 0;
			this.directionY = 0;
			easing = this.options.bounceEasing;
		}

// INSERT POINT: _end

		if ( newX != this.x || newY != this.y ) {
			// change easing function when scroller goes out of the boundaries
			if ( newX > 0 || newX < this.maxScrollX || newY > 0 || newY < this.maxScrollY ) {
				easing = utils.ease.quadratic;
			}
			// console.log('2. newY=',newY,',this.y=',this.y);
			this.scrollTo(newX, newY, time, easing);
			return;
		}

		this._execEvent('scrollEnd');
	},

	_resize: function () {
		var that = this;

		clearTimeout(this.resizeTimeout);

		this.resizeTimeout = setTimeout(function () {
			that.refresh();
		}, this.options.resizePolling);
	},

	resetPosition: function (time) {
		var x = this.x,
			y = this.y;
		// console.log('1.resetPosition: y=',y);
		time = time || 0;

		if ( !this.hasHorizontalScroll || this.x > 0 ) {
			x = 0;
		} else if ( this.x < this.maxScrollX ) {
			x = this.maxScrollX;
		}

		if ( !this.hasVerticalScroll || this.y > 0 ) {
			if(this.waitLoadTop && y>=this.waitLoadTop){
				// console.log('2.resetPosition: this.waitLoadTop =',this.waitLoadTop)
				y=this.waitLoadTop;
			}else{
				y = 0;
			}
		} else if ( this.y < this.maxScrollY ) {
			y = this.maxScrollY;
		}
		// console.log('2.resetPosition: y=',y);
		if ( x == this.x && y == this.y ) {
			return false;
		}

		this.scrollTo(x, y, time, this.options.bounceEasing);
		// console.log('3. resetPosition end');
		return true;
	},

	disable: function () {
		this.enabled = false;
	},

	enable: function () {
		this.enabled = true;
	},

	refresh: function () {
		var rf = this.wrapper.offsetHeight;		// Force reflow

		this.wrapperWidth	= this.wrapper.clientWidth;
		this.wrapperHeight	= this.wrapper.clientHeight;

/* REPLACE START: refresh */

		this.scrollerWidth	= this.scroller.offsetWidth;
		this.scrollerHeight	= this.scroller.offsetHeight;

		this.maxScrollX		= this.wrapperWidth - this.scrollerWidth;
		this.maxScrollY		= this.wrapperHeight - this.scrollerHeight;

/* REPLACE END: refresh */

		this.hasHorizontalScroll	= this.options.scrollX && this.maxScrollX < 0;
		this.hasVerticalScroll		= this.options.scrollY && this.maxScrollY < 0;

		if ( !this.hasHorizontalScroll ) {
			this.maxScrollX = 0;
			this.scrollerWidth = this.wrapperWidth;
		}

		if ( !this.hasVerticalScroll ) {
			this.maxScrollY = 0;
			this.scrollerHeight = this.wrapperHeight;
		}

		this.endTime = 0;
		this.directionX = 0;
		this.directionY = 0;

		this.wrapperOffset = utils.offset(this.wrapper);

		this._execEvent('refresh');

		this.resetPosition();

// INSERT POINT: _refresh

	},

	on: function (type, fn) {
		if ( !this._events[type] ) {
			this._events[type] = [];
		}

		this._events[type].push(fn);
		return this;
	},

	off: function (type, fn) {
		if ( !this._events[type] ) {
			return;
		}

		var index = this._events[type].indexOf(fn);

		if ( index > -1 ) {
			this._events[type].splice(index, 1);
		}
	},

	_execEvent: function (type) {
		if ( !this._events[type] ) {
			return;
		}

		var i = 0,
			l = this._events[type].length;

		if ( !l ) {
			return;
		}

		for ( ; i < l; i++ ) {
			this._events[type][i].apply(this, [].slice.call(arguments, 1));
		}
	},

	scrollBy: function (x, y, time, easing) {
		x = this.x + x;
		y = this.y + y;
		time = time || 0;

		this.scrollTo(x, y, time, easing);
	},

	scrollTo: function (x, y, time, easing) {
		easing = easing || utils.ease.circular;

		this.isInTransition = this.options.useTransition && time > 0;

		if ( !time || (this.options.useTransition && easing.style) ) {
			this._transitionTimingFunction(easing.style);
			this._transitionTime(time);
			this._translate(x, y);
		} else {
			this._animate(x, y, time, easing.fn);
		}
	},

	scrollToElement: function (el,sh, time, offsetX, offsetY, easing) {
		el = el.nodeType ? el : this.scroller.querySelector(el);
		sh = sh || 0;
		if ( !el ) {
			return;
		}

		var pos = utils.offset(el);

		pos.left -= this.wrapperOffset.left;
		pos.top  -= this.wrapperOffset.top;

		// if offsetX/Y are true we center the element to the screen
		if ( offsetX === true ) {
			offsetX = Math.round(el.offsetWidth / 2 - this.wrapper.offsetWidth / 2);
		}
		if ( offsetY === true ) {
			offsetY = Math.round(el.offsetHeight / 2 - this.wrapper.offsetHeight / 2);
		}

		pos.left -= offsetX || 0;
		pos.top  -= offsetY || 0;

		pos.left = pos.left > 0 ? 0 : pos.left < this.maxScrollX ? this.maxScrollX : pos.left;
		pos.top  = pos.top  > 0 ? 0 : pos.top  < this.maxScrollY ? this.maxScrollY : pos.top;

		time = time === undefined || time === null || time === 'auto' ? Math.max(Math.abs(this.x-pos.left), Math.abs(this.y-pos.top)) : time;

		this.scrollTo(pos.left, pos.top + sh, time, easing);
	},

	_transitionTime: function (time) {
		time = time || 0;

		this.scrollerStyle[utils.style.transitionDuration] = time + 'ms';

		if ( !time && utils.isBadAndroid ) {
			this.scrollerStyle[utils.style.transitionDuration] = '0.001s';
		}


		if ( this.indicators ) {
			for ( var i = this.indicators.length; i--; ) {
				this.indicators[i].transitionTime(time);
			}
		}


// INSERT POINT: _transitionTime

	},

	_transitionTimingFunction: function (easing) {
		this.scrollerStyle[utils.style.transitionTimingFunction] = easing;


		if ( this.indicators ) {
			for ( var i = this.indicators.length; i--; ) {
				this.indicators[i].transitionTimingFunction(easing);
			}
		}


// INSERT POINT: _transitionTimingFunction

	},

	_translate: function (x, y) {
		if ( this.options.useTransform ) {

/* REPLACE START: _translate */

			this.scrollerStyle[utils.style.transform] = 'translate(' + x + 'px,' + y + 'px)' + this.translateZ;

/* REPLACE END: _translate */

		} else {
			x = Math.round(x);
			y = Math.round(y);
			this.scrollerStyle.left = x + 'px';
			this.scrollerStyle.top = y + 'px';
		}

		this.x = x;
		this.y = y;


	if ( this.indicators ) {
		for ( var i = this.indicators.length; i--; ) {
			this.indicators[i].updatePosition();
		}
	}


// INSERT POINT: _translate

	},

	_initEvents: function (remove) {
		var eventType = remove ? utils.removeEvent : utils.addEvent,
			target = this.options.bindToWrapper ? this.wrapper : window;

		eventType(window, 'orientationchange', this);
		eventType(window, 'resize', this);

		if ( this.options.click ) {
			eventType(this.wrapper, 'click', this, true);
		}

		if ( !this.options.disableMouse ) {
			eventType(this.wrapper, 'mousedown', this);
			eventType(target, 'mousemove', this);
			eventType(target, 'mousecancel', this);
			eventType(target, 'mouseup', this);
		}

		if ( utils.hasPointer && !this.options.disablePointer ) {
			eventType(this.wrapper, 'MSPointerDown', this);
			eventType(target, 'MSPointerMove', this);
			eventType(target, 'MSPointerCancel', this);
			eventType(target, 'MSPointerUp', this);
		}

		if ( utils.hasTouch && !this.options.disableTouch ) {
			eventType(this.wrapper, 'touchstart', this);
			eventType(target, 'touchmove', this);
			eventType(target, 'touchcancel', this);
			eventType(target, 'touchend', this);
		}

		eventType(this.scroller, 'transitionend', this);
		eventType(this.scroller, 'webkitTransitionEnd', this);
		eventType(this.scroller, 'oTransitionEnd', this);
		eventType(this.scroller, 'MSTransitionEnd', this);
	},

	getComputedPosition: function () {
		var matrix = window.getComputedStyle(this.scroller, null),
			x, y;

		if ( this.options.useTransform ) {
			matrix = matrix[utils.style.transform].split(')')[0].split(', ');
			x = +(matrix[12] || matrix[4]);
			y = +(matrix[13] || matrix[5]);
		} else {
			x = +matrix.left.replace(/[^-\d.]/g, '');
			y = +matrix.top.replace(/[^-\d.]/g, '');
		}

		return { x: x, y: y };
	},

	_initIndicators: function () {
		var interactive = this.options.interactiveScrollbars,
			customStyle = typeof this.options.scrollbars != 'string',
			indicators = [],
			indicator;

		var that = this;

		this.indicators = [];

		if ( this.options.scrollbars ) {
			// Vertical scrollbar
			if ( this.options.scrollY ) {
				indicator = {
					el: createDefaultScrollbar('v', interactive, this.options.scrollbars),
					interactive: interactive,
					defaultScrollbars: true,
					customStyle: customStyle,
					resize: this.options.resizeScrollbars,
					shrink: this.options.shrinkScrollbars,
					fade: this.options.fadeScrollbars,
					listenX: false
				};

				this.wrapper.appendChild(indicator.el);
				indicators.push(indicator);
			}

			// Horizontal scrollbar
			if ( this.options.scrollX ) {
				indicator = {
					el: createDefaultScrollbar('h', interactive, this.options.scrollbars),
					interactive: interactive,
					defaultScrollbars: true,
					customStyle: customStyle,
					resize: this.options.resizeScrollbars,
					shrink: this.options.shrinkScrollbars,
					fade: this.options.fadeScrollbars,
					listenY: false
				};

				this.wrapper.appendChild(indicator.el);
				indicators.push(indicator);
			}
		}

		if ( this.options.indicators ) {
			// TODO: check concat compatibility
			indicators = indicators.concat(this.options.indicators);
		}

		for ( var i = indicators.length; i--; ) {
			this.indicators.push( new Indicator(this, indicators[i]) );
		}

		// TODO: check if we can use array.map (wide compatibility and performance issues)
		function _indicatorsMap (fn) {
			for ( var i = that.indicators.length; i--; ) {
				fn.call(that.indicators[i]);
			}
		}

		if ( this.options.fadeScrollbars ) {
			this.on('scrollEnd', function () {
				_indicatorsMap(function () {
					this.fade();
				});
			});

			this.on('scrollCancel', function () {
				_indicatorsMap(function () {
					this.fade();
				});
			});

			this.on('scrollStart', function () {
				_indicatorsMap(function () {
					this.fade(1);
				});
			});

			this.on('beforeScrollStart', function () {
				_indicatorsMap(function () {
					this.fade(1, true);
				});
			});
		}


		this.on('refresh', function () {
			_indicatorsMap(function () {
				this.refresh();
			});
		});

		this.on('destroy', function () {
			_indicatorsMap(function () {
				this.destroy();
			});

			delete this.indicators;
		});
	},

	_initWheel: function () {
		utils.addEvent(this.wrapper, 'wheel', this);
		utils.addEvent(this.wrapper, 'mousewheel', this);
		utils.addEvent(this.wrapper, 'DOMMouseScroll', this);

		this.on('destroy', function () {
			utils.removeEvent(this.wrapper, 'wheel', this);
			utils.removeEvent(this.wrapper, 'mousewheel', this);
			utils.removeEvent(this.wrapper, 'DOMMouseScroll', this);
		});
	},

	_wheel: function (e) {
		if ( !this.enabled ) {
			return;
		}

		e.preventDefault();
		e.stopPropagation();

		var wheelDeltaX, wheelDeltaY,
			newX, newY,
			that = this;

		if ( this.wheelTimeout === undefined ) {
			that._execEvent('scrollStart');
		}

		// Execute the scrollEnd event after 400ms the wheel stopped scrolling
		clearTimeout(this.wheelTimeout);
		this.wheelTimeout = setTimeout(function () {
			that._execEvent('scrollEnd');
			that.wheelTimeout = undefined;
		}, 400);

		if ( 'deltaX' in e ) {
			wheelDeltaX = -e.deltaX;
			wheelDeltaY = -e.deltaY;
		} else if ( 'wheelDeltaX' in e ) {
			wheelDeltaX = e.wheelDeltaX / 120 * this.options.mouseWheelSpeed;
			wheelDeltaY = e.wheelDeltaY / 120 * this.options.mouseWheelSpeed;
		} else if ( 'wheelDelta' in e ) {
			wheelDeltaX = wheelDeltaY = e.wheelDelta / 120 * this.options.mouseWheelSpeed;
		} else if ( 'detail' in e ) {
			wheelDeltaX = wheelDeltaY = -e.detail / 3 * this.options.mouseWheelSpeed;
		} else {
			return;
		}

		wheelDeltaX *= this.options.invertWheelDirection;
		wheelDeltaY *= this.options.invertWheelDirection;

		if ( !this.hasVerticalScroll ) {
			wheelDeltaX = wheelDeltaY;
			wheelDeltaY = 0;
		}

		if ( this.options.snap ) {
			newX = this.currentPage.pageX;
			newY = this.currentPage.pageY;

			if ( wheelDeltaX > 0 ) {
				newX--;
			} else if ( wheelDeltaX < 0 ) {
				newX++;
			}

			if ( wheelDeltaY > 0 ) {
				newY--;
			} else if ( wheelDeltaY < 0 ) {
				newY++;
			}

			this.goToPage(newX, newY);

			return;
		}

		newX = this.x + Math.round(this.hasHorizontalScroll ? wheelDeltaX : 0);
		newY = this.y + Math.round(this.hasVerticalScroll ? wheelDeltaY : 0);

		if ( newX > 0 ) {
			newX = 0;
		} else if ( newX < this.maxScrollX ) {
			newX = this.maxScrollX;
		}

		if ( newY > 0 ) {
			newY = 0;
		} else if ( newY < this.maxScrollY ) {
			newY = this.maxScrollY;
		}

		this.scrollTo(newX, newY, 0);

		if ( this.options.probeType > 1 ) {
			this._execEvent('scroll');
		}

// INSERT POINT: _wheel
	},

	_initSnap: function () {
		this.currentPage = {};

		if ( typeof this.options.snap == 'string' ) {
			this.options.snap = this.scroller.querySelectorAll(this.options.snap);
		}

		this.on('refresh', function () {
			var i = 0, l,
				m = 0, n,
				cx, cy,
				x = 0, y,
				stepX = this.options.snapStepX || this.wrapperWidth,
				stepY = this.options.snapStepY || this.wrapperHeight,
				el;

			this.pages = [];

			if ( !this.wrapperWidth || !this.wrapperHeight || !this.scrollerWidth || !this.scrollerHeight ) {
				return;
			}

			if ( this.options.snap === true ) {
				cx = Math.round( stepX / 2 );
				cy = Math.round( stepY / 2 );

				while ( x > -this.scrollerWidth ) {
					this.pages[i] = [];
					l = 0;
					y = 0;

					while ( y > -this.scrollerHeight ) {
						this.pages[i][l] = {
							x: Math.max(x, this.maxScrollX),
							y: Math.max(y, this.maxScrollY),
							width: stepX,
							height: stepY,
							cx: x - cx,
							cy: y - cy
						};

						y -= stepY;
						l++;
					}

					x -= stepX;
					i++;
				}
			} else {
				el = this.options.snap;
				l = el.length;
				n = -1;

				for ( ; i < l; i++ ) {
					if ( i === 0 || el[i].offsetLeft <= el[i-1].offsetLeft ) {
						m = 0;
						n++;
					}

					if ( !this.pages[m] ) {
						this.pages[m] = [];
					}

					x = Math.max(-el[i].offsetLeft, this.maxScrollX);
					y = Math.max(-el[i].offsetTop, this.maxScrollY);
					cx = x - Math.round(el[i].offsetWidth / 2);
					cy = y - Math.round(el[i].offsetHeight / 2);

					this.pages[m][n] = {
						x: x,
						y: y,
						width: el[i].offsetWidth,
						height: el[i].offsetHeight,
						cx: cx,
						cy: cy
					};

					if ( x > this.maxScrollX ) {
						m++;
					}
				}
			}

			this.goToPage(this.currentPage.pageX || 0, this.currentPage.pageY || 0, 0);

			// Update snap threshold if needed
			if ( this.options.snapThreshold % 1 === 0 ) {
				this.snapThresholdX = this.options.snapThreshold;
				this.snapThresholdY = this.options.snapThreshold;
			} else {
				this.snapThresholdX = Math.round(this.pages[this.currentPage.pageX][this.currentPage.pageY].width * this.options.snapThreshold);
				this.snapThresholdY = Math.round(this.pages[this.currentPage.pageX][this.currentPage.pageY].height * this.options.snapThreshold);
			}
		});

		this.on('flick', function () {
			var time = this.options.snapSpeed || Math.max(
					Math.max(
						Math.min(Math.abs(this.x - this.startX), 1000),
						Math.min(Math.abs(this.y - this.startY), 1000)
					), 300);

			this.goToPage(
				this.currentPage.pageX + this.directionX,
				this.currentPage.pageY + this.directionY,
				time
			);
		});
	},

	_nearestSnap: function (x, y) {
		if ( !this.pages.length ) {
			return { x: 0, y: 0, pageX: 0, pageY: 0 };
		}

		var i = 0,
			l = this.pages.length,
			m = 0;

		// Check if we exceeded the snap threshold
		if ( Math.abs(x - this.absStartX) < this.snapThresholdX &&
			Math.abs(y - this.absStartY) < this.snapThresholdY ) {
			return this.currentPage;
		}

		if ( x > 0 ) {
			x = 0;
		} else if ( x < this.maxScrollX ) {
			x = this.maxScrollX;
		}

		if ( y > 0 ) {
			y = 0;
		} else if ( y < this.maxScrollY ) {
			y = this.maxScrollY;
		}

		for ( ; i < l; i++ ) {
			if ( x >= this.pages[i][0].cx ) {
				x = this.pages[i][0].x;
				break;
			}
		}

		l = this.pages[i].length;

		for ( ; m < l; m++ ) {
			if ( y >= this.pages[0][m].cy ) {
				y = this.pages[0][m].y;
				break;
			}
		}

		if ( i == this.currentPage.pageX ) {
			i += this.directionX;

			if ( i < 0 ) {
				i = 0;
			} else if ( i >= this.pages.length ) {
				i = this.pages.length - 1;
			}

			x = this.pages[i][0].x;
		}

		if ( m == this.currentPage.pageY ) {
			m += this.directionY;

			if ( m < 0 ) {
				m = 0;
			} else if ( m >= this.pages[0].length ) {
				m = this.pages[0].length - 1;
			}

			y = this.pages[0][m].y;
		}

		return {
			x: x,
			y: y,
			pageX: i,
			pageY: m
		};
	},

	goToPage: function (x, y, time, easing) {
		easing = easing || this.options.bounceEasing;

		if ( x >= this.pages.length ) {
			x = this.pages.length - 1;
		} else if ( x < 0 ) {
			x = 0;
		}

		if ( y >= this.pages[x].length ) {
			y = this.pages[x].length - 1;
		} else if ( y < 0 ) {
			y = 0;
		}

		var posX = this.pages[x][y].x,
			posY = this.pages[x][y].y;

		time = time === undefined ? this.options.snapSpeed || Math.max(
			Math.max(
				Math.min(Math.abs(posX - this.x), 1000),
				Math.min(Math.abs(posY - this.y), 1000)
			), 300) : time;

		this.currentPage = {
			x: posX,
			y: posY,
			pageX: x,
			pageY: y
		};

		this.scrollTo(posX, posY, time, easing);
	},

	next: function (time, easing) {
		var x = this.currentPage.pageX,
			y = this.currentPage.pageY;

		x++;

		if ( x >= this.pages.length && this.hasVerticalScroll ) {
			x = 0;
			y++;
		}

		this.goToPage(x, y, time, easing);
	},

	prev: function (time, easing) {
		var x = this.currentPage.pageX,
			y = this.currentPage.pageY;

		x--;

		if ( x < 0 && this.hasVerticalScroll ) {
			x = 0;
			y--;
		}

		this.goToPage(x, y, time, easing);
	},

	_initKeys: function (e) {
		// default key bindings
		var keys = {
			pageUp: 33,
			pageDown: 34,
			end: 35,
			home: 36,
			left: 37,
			up: 38,
			right: 39,
			down: 40
		};
		var i;

		// if you give me characters I give you keycode
		if ( typeof this.options.keyBindings == 'object' ) {
			for ( i in this.options.keyBindings ) {
				if ( typeof this.options.keyBindings[i] == 'string' ) {
					this.options.keyBindings[i] = this.options.keyBindings[i].toUpperCase().charCodeAt(0);
				}
			}
		} else {
			this.options.keyBindings = {};
		}

		for ( i in keys ) {
			this.options.keyBindings[i] = this.options.keyBindings[i] || keys[i];
		}

		utils.addEvent(window, 'keydown', this);

		this.on('destroy', function () {
			utils.removeEvent(window, 'keydown', this);
		});
	},

	_key: function (e) {
		if ( !this.enabled ) {
			return;
		}

		var snap = this.options.snap,	// we are using this alot, better to cache it
			newX = snap ? this.currentPage.pageX : this.x,
			newY = snap ? this.currentPage.pageY : this.y,
			now = utils.getTime(),
			prevTime = this.keyTime || 0,
			acceleration = 0.250,
			pos;

		if ( this.options.useTransition && this.isInTransition ) {
			pos = this.getComputedPosition();

			this._translate(Math.round(pos.x), Math.round(pos.y));
			this.isInTransition = false;
		}

		this.keyAcceleration = now - prevTime < 200 ? Math.min(this.keyAcceleration + acceleration, 50) : 0;

		switch ( e.keyCode ) {
			case this.options.keyBindings.pageUp:
				if ( this.hasHorizontalScroll && !this.hasVerticalScroll ) {
					newX += snap ? 1 : this.wrapperWidth;
				} else {
					newY += snap ? 1 : this.wrapperHeight;
				}
				break;
			case this.options.keyBindings.pageDown:
				if ( this.hasHorizontalScroll && !this.hasVerticalScroll ) {
					newX -= snap ? 1 : this.wrapperWidth;
				} else {
					newY -= snap ? 1 : this.wrapperHeight;
				}
				break;
			case this.options.keyBindings.end:
				newX = snap ? this.pages.length-1 : this.maxScrollX;
				newY = snap ? this.pages[0].length-1 : this.maxScrollY;
				break;
			case this.options.keyBindings.home:
				newX = 0;
				newY = 0;
				break;
			case this.options.keyBindings.left:
				newX += snap ? -1 : 5 + this.keyAcceleration>>0;
				break;
			case this.options.keyBindings.up:
				newY += snap ? 1 : 5 + this.keyAcceleration>>0;
				break;
			case this.options.keyBindings.right:
				newX -= snap ? -1 : 5 + this.keyAcceleration>>0;
				break;
			case this.options.keyBindings.down:
				newY -= snap ? 1 : 5 + this.keyAcceleration>>0;
				break;
			default:
				return;
		}

		if ( snap ) {
			this.goToPage(newX, newY);
			return;
		}

		if ( newX > 0 ) {
			newX = 0;
			this.keyAcceleration = 0;
		} else if ( newX < this.maxScrollX ) {
			newX = this.maxScrollX;
			this.keyAcceleration = 0;
		}

		if ( newY > 0 ) {
			newY = 0;
			this.keyAcceleration = 0;
		} else if ( newY < this.maxScrollY ) {
			newY = this.maxScrollY;
			this.keyAcceleration = 0;
		}

		this.scrollTo(newX, newY, 0);

		this.keyTime = now;
	},

	_animate: function (destX, destY, duration, easingFn) {
		var that = this,
			startX = this.x,
			startY = this.y,
			startTime = utils.getTime(),
			destTime = startTime + duration;

		function step () {
			var now = utils.getTime(),
				newX, newY,
				easing;

			if ( now >= destTime ) {
				that.isAnimating = false;
				that._translate(destX, destY);
				
				if ( !that.resetPosition(that.options.bounceTime) ) {
					that._execEvent('scrollEnd');
				}

				return;
			}

			now = ( now - startTime ) / duration;
			easing = easingFn(now);
			newX = ( destX - startX ) * easing + startX;
			newY = ( destY - startY ) * easing + startY;
			that._translate(newX, newY);

			if ( that.isAnimating ) {
				rAF(step);
			}

			if ( that.options.probeType == 3 ) {
				that._execEvent('scroll');
			}
		}

		this.isAnimating = true;
		step();
	},

	handleEvent: function (e) {
		switch ( e.type ) {
			case 'touchstart':
			case 'MSPointerDown':
			case 'mousedown':
				this._start(e);
				break;
			case 'touchmove':
			case 'MSPointerMove':
			case 'mousemove':
				this._move(e);
				break;
			case 'touchend':
			case 'MSPointerUp':
			case 'mouseup':
			case 'touchcancel':
			case 'MSPointerCancel':
			case 'mousecancel':
				this._end(e);
				break;
			case 'orientationchange':
			case 'resize':
				this._resize();
				break;
			case 'transitionend':
			case 'webkitTransitionEnd':
			case 'oTransitionEnd':
			case 'MSTransitionEnd':
				this._transitionEnd(e);
				break;
			case 'wheel':
			case 'DOMMouseScroll':
			case 'mousewheel':
				this._wheel(e);
				break;
			case 'keydown':
				this._key(e);
				break;
			case 'click':
				if ( !e._constructed ) {
					e.preventDefault();
					e.stopPropagation();
				}
				break;
		}
	}
};
function createDefaultScrollbar (direction, interactive, type) {
	var scrollbar = document.createElement('div'),
		indicator = document.createElement('div');

	if ( type === true ) {
		scrollbar.style.cssText = 'position:absolute;z-index:9999';
		indicator.style.cssText = '-webkit-box-sizing:border-box;-moz-box-sizing:border-box;box-sizing:border-box;position:absolute;background:rgba(0,0,0,0.5);border:1px solid rgba(255,255,255,0.9);border-radius:3px';
	}

	indicator.className = 'iScrollIndicator';

	if ( direction == 'h' ) {
		if ( type === true ) {
			scrollbar.style.cssText += ';height:7px;left:2px;right:2px;bottom:0';
			indicator.style.height = '100%';
		}
		scrollbar.className = 'iScrollHorizontalScrollbar';
	} else {
		if ( type === true ) {
			scrollbar.style.cssText += ';width:7px;bottom:2px;top:2px;right:1px';
			indicator.style.width = '100%';
		}
		scrollbar.className = 'iScrollVerticalScrollbar';
	}

	scrollbar.style.cssText += ';overflow:hidden';

	if ( !interactive ) {
		scrollbar.style.pointerEvents = 'none';
	}

	scrollbar.appendChild(indicator);

	return scrollbar;
}

function Indicator (scroller, options) {
	this.wrapper = typeof options.el == 'string' ? document.querySelector(options.el) : options.el;
	this.wrapperStyle = this.wrapper.style;
	this.indicator = this.wrapper.children[0];
	this.indicatorStyle = this.indicator.style;
	this.scroller = scroller;

	this.options = {
		listenX: true,
		listenY: true,
		interactive: false,
		resize: true,
		defaultScrollbars: false,
		shrink: false,
		fade: false,
		speedRatioX: 0,
		speedRatioY: 0
	};

	for ( var i in options ) {
		this.options[i] = options[i];
	}

	this.sizeRatioX = 1;
	this.sizeRatioY = 1;
	this.maxPosX = 0;
	this.maxPosY = 0;

	if ( this.options.interactive ) {
		if ( !this.options.disableTouch ) {
			utils.addEvent(this.indicator, 'touchstart', this);
			utils.addEvent(window, 'touchend', this);
		}
		if ( !this.options.disablePointer ) {
			utils.addEvent(this.indicator, 'MSPointerDown', this);
			utils.addEvent(window, 'MSPointerUp', this);
		}
		if ( !this.options.disableMouse ) {
			utils.addEvent(this.indicator, 'mousedown', this);
			utils.addEvent(window, 'mouseup', this);
		}
	}

	if ( this.options.fade ) {
		this.wrapperStyle[utils.style.transform] = this.scroller.translateZ;
		this.wrapperStyle[utils.style.transitionDuration] = utils.isBadAndroid ? '0.001s' : '0ms';
		this.wrapperStyle.opacity = '0';
	}
}

Indicator.prototype = {
	handleEvent: function (e) {
		switch ( e.type ) {
			case 'touchstart':
			case 'MSPointerDown':
			case 'mousedown':
				this._start(e);
				break;
			case 'touchmove':
			case 'MSPointerMove':
			case 'mousemove':
				this._move(e);
				break;
			case 'touchend':
			case 'MSPointerUp':
			case 'mouseup':
			case 'touchcancel':
			case 'MSPointerCancel':
			case 'mousecancel':
				this._end(e);
				break;
		}
	},

	destroy: function () {
		if ( this.options.interactive ) {
			utils.removeEvent(this.indicator, 'touchstart', this);
			utils.removeEvent(this.indicator, 'MSPointerDown', this);
			utils.removeEvent(this.indicator, 'mousedown', this);

			utils.removeEvent(window, 'touchmove', this);
			utils.removeEvent(window, 'MSPointerMove', this);
			utils.removeEvent(window, 'mousemove', this);

			utils.removeEvent(window, 'touchend', this);
			utils.removeEvent(window, 'MSPointerUp', this);
			utils.removeEvent(window, 'mouseup', this);
		}

		if ( this.options.defaultScrollbars ) {
			this.wrapper.parentNode.removeChild(this.wrapper);
		}
	},

	_start: function (e) {
		var point = e.touches ? e.touches[0] : e;

		e.preventDefault();
		e.stopPropagation();

		this.transitionTime();

		this.initiated = true;
		this.moved = false;
		this.lastPointX	= point.pageX;
		this.lastPointY	= point.pageY;

		this.startTime	= utils.getTime();

		if ( !this.options.disableTouch ) {
			utils.addEvent(window, 'touchmove', this);
		}
		if ( !this.options.disablePointer ) {
			utils.addEvent(window, 'MSPointerMove', this);
		}
		if ( !this.options.disableMouse ) {
			utils.addEvent(window, 'mousemove', this);
		}

		this.scroller._execEvent('beforeScrollStart');
	},

	_move: function (e) {
		var point = e.touches ? e.touches[0] : e,
			deltaX, deltaY,
			newX, newY,
			timestamp = utils.getTime();

		if ( !this.moved ) {
			this.scroller._execEvent('scrollStart');
		}

		this.moved = true;

		deltaX = point.pageX - this.lastPointX;
		this.lastPointX = point.pageX;

		deltaY = point.pageY - this.lastPointY;
		this.lastPointY = point.pageY;

		newX = this.x + deltaX;
		newY = this.y + deltaY;

		this._pos(newX, newY);


		if ( this.scroller.options.probeType == 1 && timestamp - this.startTime > 300 ) {
			this.startTime = timestamp;
			this.scroller._execEvent('scroll');
		} else if ( this.scroller.options.probeType > 1 ) {
			this.scroller._execEvent('scroll');
		}


// INSERT POINT: indicator._move

		e.preventDefault();
		e.stopPropagation();
	},

	_end: function (e) {
		if ( !this.initiated ) {
			return;
		}

		this.initiated = false;

		e.preventDefault();
		e.stopPropagation();

		utils.removeEvent(window, 'touchmove', this);
		utils.removeEvent(window, 'MSPointerMove', this);
		utils.removeEvent(window, 'mousemove', this);

		if ( this.scroller.options.snap ) {
			var snap = this.scroller._nearestSnap(this.scroller.x, this.scroller.y);

			var time = this.options.snapSpeed || Math.max(
					Math.max(
						Math.min(Math.abs(this.scroller.x - snap.x), 1000),
						Math.min(Math.abs(this.scroller.y - snap.y), 1000)
					), 300);

			if ( this.scroller.x != snap.x || this.scroller.y != snap.y ) {
				this.scroller.directionX = 0;
				this.scroller.directionY = 0;
				this.scroller.currentPage = snap;
				this.scroller.scrollTo(snap.x, snap.y, time, this.scroller.options.bounceEasing);
			}
		}

		if ( this.moved ) {
			this.scroller._execEvent('scrollEnd');
		}
	},

	transitionTime: function (time) {
		time = time || 0;
		this.indicatorStyle[utils.style.transitionDuration] = time + 'ms';

		if ( !time && utils.isBadAndroid ) {
			this.indicatorStyle[utils.style.transitionDuration] = '0.001s';
		}
	},

	transitionTimingFunction: function (easing) {
		this.indicatorStyle[utils.style.transitionTimingFunction] = easing;
	},

	refresh: function () {
		this.transitionTime();

		if ( this.options.listenX && !this.options.listenY ) {
			this.indicatorStyle.display = this.scroller.hasHorizontalScroll ? 'block' : 'none';
		} else if ( this.options.listenY && !this.options.listenX ) {
			this.indicatorStyle.display = this.scroller.hasVerticalScroll ? 'block' : 'none';
		} else {
			this.indicatorStyle.display = this.scroller.hasHorizontalScroll || this.scroller.hasVerticalScroll ? 'block' : 'none';
		}

		if ( this.scroller.hasHorizontalScroll && this.scroller.hasVerticalScroll ) {
			utils.addClass(this.wrapper, 'iScrollBothScrollbars');
			utils.removeClass(this.wrapper, 'iScrollLoneScrollbar');

			if ( this.options.defaultScrollbars && this.options.customStyle ) {
				if ( this.options.listenX ) {
					this.wrapper.style.right = '8px';
				} else {
					this.wrapper.style.bottom = '8px';
				}
			}
		} else {
			utils.removeClass(this.wrapper, 'iScrollBothScrollbars');
			utils.addClass(this.wrapper, 'iScrollLoneScrollbar');

			if ( this.options.defaultScrollbars && this.options.customStyle ) {
				if ( this.options.listenX ) {
					this.wrapper.style.right = '2px';
				} else {
					this.wrapper.style.bottom = '2px';
				}
			}
		}

		var r = this.wrapper.offsetHeight;	// force refresh

		if ( this.options.listenX ) {
			this.wrapperWidth = this.wrapper.clientWidth;
			if ( this.options.resize ) {
				this.indicatorWidth = Math.max(Math.round(this.wrapperWidth * this.wrapperWidth / (this.scroller.scrollerWidth || this.wrapperWidth || 1)), 8);
				this.indicatorStyle.width = this.indicatorWidth + 'px';
			} else {
				this.indicatorWidth = this.indicator.clientWidth;
			}

			this.maxPosX = this.wrapperWidth - this.indicatorWidth;

			if ( this.options.shrink == 'clip' ) {
				this.minBoundaryX = -this.indicatorWidth + 8;
				this.maxBoundaryX = this.wrapperWidth - 8;
			} else {
				this.minBoundaryX = 0;
				this.maxBoundaryX = this.maxPosX;
			}

			this.sizeRatioX = this.options.speedRatioX || (this.scroller.maxScrollX && (this.maxPosX / this.scroller.maxScrollX));	
		}

		if ( this.options.listenY ) {
			this.wrapperHeight = this.wrapper.clientHeight;
			if ( this.options.resize ) {
				this.indicatorHeight = Math.max(Math.round(this.wrapperHeight * this.wrapperHeight / (this.scroller.scrollerHeight || this.wrapperHeight || 1)), 8);
				this.indicatorStyle.height = this.indicatorHeight + 'px';
			} else {
				this.indicatorHeight = this.indicator.clientHeight;
			}

			this.maxPosY = this.wrapperHeight - this.indicatorHeight;

			if ( this.options.shrink == 'clip' ) {
				this.minBoundaryY = -this.indicatorHeight + 8;
				this.maxBoundaryY = this.wrapperHeight - 8;
			} else {
				this.minBoundaryY = 0;
				this.maxBoundaryY = this.maxPosY;
			}

			this.maxPosY = this.wrapperHeight - this.indicatorHeight;
			this.sizeRatioY = this.options.speedRatioY || (this.scroller.maxScrollY && (this.maxPosY / this.scroller.maxScrollY));
		}

		this.updatePosition();
	},

	updatePosition: function () {
		var x = this.options.listenX && Math.round(this.sizeRatioX * this.scroller.x) || 0,
			y = this.options.listenY && Math.round(this.sizeRatioY * this.scroller.y) || 0;

		if ( !this.options.ignoreBoundaries ) {
			if ( x < this.minBoundaryX ) {
				if ( this.options.shrink == 'scale' ) {
					this.width = Math.max(this.indicatorWidth + x, 8);
					this.indicatorStyle.width = this.width + 'px';
				}
				x = this.minBoundaryX;
			} else if ( x > this.maxBoundaryX ) {
				if ( this.options.shrink == 'scale' ) {
					this.width = Math.max(this.indicatorWidth - (x - this.maxPosX), 8);
					this.indicatorStyle.width = this.width + 'px';
					x = this.maxPosX + this.indicatorWidth - this.width;
				} else {
					x = this.maxBoundaryX;
				}
			} else if ( this.options.shrink == 'scale' && this.width != this.indicatorWidth ) {
				this.width = this.indicatorWidth;
				this.indicatorStyle.width = this.width + 'px';
			}

			if ( y < this.minBoundaryY ) {
				if ( this.options.shrink == 'scale' ) {
					this.height = Math.max(this.indicatorHeight + y * 3, 8);
					this.indicatorStyle.height = this.height + 'px';
				}
				y = this.minBoundaryY;
			} else if ( y > this.maxBoundaryY ) {
				if ( this.options.shrink == 'scale' ) {
					this.height = Math.max(this.indicatorHeight - (y - this.maxPosY) * 3, 8);
					this.indicatorStyle.height = this.height + 'px';
					y = this.maxPosY + this.indicatorHeight - this.height;
				} else {
					y = this.maxBoundaryY;
				}
			} else if ( this.options.shrink == 'scale' && this.height != this.indicatorHeight ) {
				this.height = this.indicatorHeight;
				this.indicatorStyle.height = this.height + 'px';
			}
		}

		this.x = x;
		this.y = y;

		if ( this.scroller.options.useTransform ) {
			this.indicatorStyle[utils.style.transform] = 'translate(' + x + 'px,' + y + 'px)' + this.scroller.translateZ;
		} else {
			this.indicatorStyle.left = x + 'px';
			this.indicatorStyle.top = y + 'px';
		}
	},

	_pos: function (x, y) {
		if ( x < 0 ) {
			x = 0;
		} else if ( x > this.maxPosX ) {
			x = this.maxPosX;
		}

		if ( y < 0 ) {
			y = 0;
		} else if ( y > this.maxPosY ) {
			y = this.maxPosY;
		}

		x = this.options.listenX ? Math.round(x / this.sizeRatioX) : this.scroller.x;
		y = this.options.listenY ? Math.round(y / this.sizeRatioY) : this.scroller.y;

		this.scroller.scrollTo(x, y);
	},

	fade: function (val, hold) {
		if ( hold && !this.visible ) {
			return;
		}

		clearTimeout(this.fadeTimeout);
		this.fadeTimeout = null;

		var time = val ? 250 : 500,
			delay = val ? 0 : 300;

		val = val ? '1' : '0';

		this.wrapperStyle[utils.style.transitionDuration] = time + 'ms';

		this.fadeTimeout = setTimeout((function (val) {
			this.wrapperStyle.opacity = val;
			this.visible = +val;
		}).bind(this, val), delay);
	}
};

IScroll.utils = utils;

if ( "function" == typeof define &&  define.amd ) {
    define("IScroll", [], function() {
        return IScroll;
    });   
} else {
    window.IScroll = IScroll;
}

})(window, document, Math);


/**
 * swipeSlide
 * http://ons.me/500.html
 * 西门
 * 3.4.2(150930)
 */
;(function(win,$){
    'use strict';
    
    // 判断IE
    var browser = {
        ie10 : win.navigator.msPointerEnabled,
        ie11 : win.navigator.pointerEnabled
    };
    // 触摸事件
    var events = ['touchstart','touchmove','touchend'];
    // 检测
    var support = {
        // 触摸
        touch : (win.Modernizr && Modernizr.touch === true) || (function () {
            return !!(('ontouchstart' in win) || win.DocumentTouch && document instanceof DocumentTouch);
        })()
    };

    // 判断浏览器
    if (browser.ie10) events = ['MSPointerDown', 'MSPointerMove', 'MSPointerUp'];
    if (browser.ie11) events = ['pointerdown', 'pointermove', 'pointerup'];

    // 触摸赋值
    var touchEvents = {
        touchStart : events[0],
        touchMove : events[1],
        touchEnd : events[2]
    };

    // 绑定swipeSlide
    $.fn.swipeSlide = function(options){
        var list = [];
        this.each(function(i, me){
            list.push(new sS(me, options));
        });
        return list;
    };
    var sS = function(element, options){
        var me = this;
        me.$el = $(element);
        me._distance = 50;
        me.allowSlideClick = true;
        me.init(options);
    };

    // 初始化
    sS.prototype.init = function(options){
        var me = this;
        me.opts = $.extend({}, {
            ul : me.$el.children('ul'),             // 父dom
            li : me.$el.children().children('li'),  // 子dom
            index : 0,                              // 轮播初始值
            continuousScroll : false,               // 连续滚动
            autoSwipe : true,                       // 自动切换
            speed : 4000,                           // 切换速度
            axisX : true,                           // X轴
            transitionType : 'ease',                // 过渡类型
            lazyLoad : false,                       // 图片懒加载
            firstCallback : function(){},           // 页面加载回调
            callback : function(){}                 // 每次滚动回调
        }, options);
        me._index = me.opts.index;
        // 轮播数量
        me._liLength = me.opts.li.length;
        me.isScrolling;

        // 回调
        me.opts.firstCallback(me._index,me._liLength,me.$el);

        // 如果轮播小于等于1个，跳出
        if(me._liLength <= 1){
            if(me.opts.lazyLoad) fnLazyLoad(me, 0);
            return false;
        }

        // 连续滚动，复制dom
        if(me.opts.continuousScroll) me.opts.ul.prepend(me.opts.li.last().clone()).append(me.opts.li.first().clone());

        // 懒加载图片
        if(me.opts.lazyLoad){
            fnLazyLoad(me, me._index);
            if(me.opts.continuousScroll){
                fnLazyLoad(me, me._index+1);
                fnLazyLoad(me, me._index+2);
                // 如果是第一屏
                if(me._index == 0){
                    fnLazyLoad(me, me._liLength);
                // 如果是最后一屏
                }else if(me._index+1 == me._liLength){
                    fnLazyLoad(me, 1);
                }
            }else{
                // 如果不连续滚动
                if(me._index == 0){
                    fnLazyLoad(me, me._index+1);
                }else if(me._index+1 == me._liLength){
                    fnLazyLoad(me, me._index-1);
                }else{
                    fnLazyLoad(me, me._index+1);
                    fnLazyLoad(me, me._index-1);
                }
            }
        }

        // 轮播的宽度
        fnGetSlideDistance();

        if(browser.ie10 || browser.ie11){
            // IE触控
            var action = '';
            if(me.opts.axisX){
                action = 'pan-y';
            }else{
                action = 'none';
            }
            me.$el.css({'-ms-touch-action':action,'touch-action':action});

            // 解决IE滑动触发click
            me.$el.on('click',function(){
                return me.allowSlideClick;
            });
        }

        // 调用轮播
        fnAutoSlide(me);

        // 绑定触摸
        me.$el.on(touchEvents.touchStart,function(e){
            fnTouches(e);
            fnTouchstart(e, me);
        });
        me.$el.on(touchEvents.touchMove,function(e){
            fnTouches(e);
            fnTouchmove(e, me);
        });
        me.$el.on(touchEvents.touchEnd,function(){
            fnTouchend(me);
        });
        me.opts.ul.on('webkitTransitionEnd MSTransitionEnd transitionend',function(){
            fnAutoSlide(me);
        });

        // 横竖屏、窗口调整
        $(win).on('onorientationchange' in win ? 'orientationchange' : 'resize',function(){
            clearTimeout(me.timer);
            me.timer = setTimeout(fnGetSlideDistance,150);
        });
        
        // 获取轮播宽度
        function fnGetSlideDistance(){
            var $li = me.opts.ul.children();
            me._slideDistance = me.opts.axisX ? me.opts.ul.width() : me.opts.ul.height();
            // 定位
            fnTransition(me, me.opts.ul, 0);
            fnTranslate(me, me.opts.ul, -me._slideDistance*me._index);
            fnTransition(me, $li, 0);
            var num = me.opts.continuousScroll ? -1 : 0;
            $li.each(function(i){
                fnTranslate(me, $(this), me._slideDistance*(i+num));
            });
        }
    };

    // css过渡
    function fnTransition(me, dom, num){
        dom.css({
            '-webkit-transition':'all '+num+'s '+me.opts.transitionType,
            'transition':'all '+num+'s '+me.opts.transitionType
        });
    }

    // css位移
    function fnTranslate(me, dom, distance){
        var result = me.opts.axisX ? distance+'px,0,0' : '0,'+distance+'px,0';
        dom.css({
            '-webkit-transform':'translate3d('+result+')',
            'transform':'translate3d('+result+')'
        });
    }

    // 懒加载图片
    function fnLazyLoad(me, index){
        var $li = me.opts.ul.children();
        var $thisImg = $li.eq(index).find('[data-src]');
        if($thisImg){
            $thisImg.each(function(i){
                var $this = $(this);
                if($this.is('img')){
                    $this.attr('src',$this.data('src'));
                    $this.removeAttr('data-src');
                }else{
                    $this.css({'background-image':'url('+$this.data('src')+')'});
                    $this.removeAttr('data-src');
                }
            });
        }
    }

    // touches
    function fnTouches(e){
        if(support.touch && !e.touches){
            e.touches = e.originalEvent.touches;
        }
    }

    // touchstart
    function fnTouchstart(e, me){
        me.isScrolling = undefined;
        me._moveDistance = me._moveDistanceIE = 0;
        // 按下时的坐标
        me._startX = support.touch ? e.touches[0].pageX : (e.pageX || e.clientX);
        me._startY = support.touch ? e.touches[0].pageY : (e.pageY || e.clientY);
    }

    // touchmove
    function fnTouchmove(e, me){
        // 如果自动切换，move的时候清除autoSlide自动轮播方法
        if(me.opts.autoSwipe) fnStopSlide(me);
        me.allowSlideClick = false;
        // 触摸时的坐标
        me._curX = support.touch ? e.touches[0].pageX : (e.pageX || e.clientX);
        me._curY = support.touch ? e.touches[0].pageY : (e.pageY || e.clientY);
        // 触摸时的距离
        me._moveX = me._curX - me._startX;
        me._moveY = me._curY - me._startY;
        // 优化触摸禁止事件
        if(typeof me.isScrolling == 'undefined'){
            if(me.opts.axisX){
                me.isScrolling = !!(Math.abs(me._moveX) >= Math.abs(me._moveY));
            }else{
                me.isScrolling = !!(Math.abs(me._moveY) >= Math.abs(me._moveX));
            }
        }
        
        // 距离
        if(me.isScrolling){
            if (e.preventDefault) e.preventDefault();
            else e.returnValue = false;
            // 触摸时跟手
            fnTransition(me, me.opts.ul, 0);
            me._moveDistance = me._moveDistanceIE = me.opts.axisX ? me._moveX : me._moveY;
        }
        if(!me.opts.continuousScroll){
            // 如果是第一屏，并且往下滚动，就不让滚动 || 如果是最后一屏，并且往上滚动，就不让滚动
            if(me._index == 0 && me._moveDistance > 0 || (me._index + 1) >= me._liLength && me._moveDistance < 0){
                me._moveDistance = 0;
            }
        }
        // 触摸时跟手滚动
        fnTranslate(me, me.opts.ul, -(me._slideDistance * me._index - me._moveDistance));
    }

    // touchend
    function fnTouchend(me){
        // 优化触摸禁止事件
        if(!me.isScrolling){
            fnAutoSlide(me);
        }

        // 解决IE滑动触发click
        if(browser.ie10 || browser.ie11){
            if(Math.abs(me._moveDistanceIE) < 5){
                me.allowSlideClick = true;
            }
            setTimeout(function(){
                me.allowSlideClick = true;
            },100);
        }

        // 距离小
        if(Math.abs(me._moveDistance) <= me._distance){
            fnSlide(me, '', '.3');
        // 距离大
        }else{
            // 手指触摸上一屏滚动
            if(me._moveDistance > me._distance){
                fnSlide(me, 'prev', '.3');
            // 手指触摸下一屏滚动
            }else if(Math.abs(me._moveDistance) > me._distance){
                fnSlide(me, 'next', '.3');
            }
        }
        me._moveDistance = me._moveDistanceIE = 0;
    }

    // 自动轮播
    function fnAutoSlide(me){
        if(me.opts.autoSwipe){
            fnStopSlide(me);
            me.autoSlide = setInterval(function(){
                fnSlide(me, 'next', '.3');
            },me.opts.speed);
        }
    }

    // 停止轮播
    function fnStopSlide(me){
        clearInterval(me.autoSlide);
    }

    // 指定轮播
    sS.prototype.goTo = function(i){
        var me = this;
        fnSlide(me, i, '.3');
    };

    // 轮播方法
    function fnSlide(me, go, num){
        // 判断方向
        if(typeof go === 'number'){
            me._index = go;
            // 加载当前屏、前一屏、后一屏
            if(me.opts.lazyLoad){
                // 因为连续滚动，复制dom，所以要多加1
                if(me.opts.continuousScroll){
                    fnLazyLoad(me, me._index);
                    fnLazyLoad(me, me._index+1);
                    fnLazyLoad(me, me._index+2);
                }else{
                    fnLazyLoad(me, me._index-1);
                    fnLazyLoad(me, me._index);
                    fnLazyLoad(me, me._index+1);
                }
            }
        }else if(go == 'next'){
            me._index++;
            if(me.opts.lazyLoad){
                if(me.opts.continuousScroll){
                    fnLazyLoad(me, me._index+2);
                    // 滑到最后一屏
                    if(me._index+1 == me._liLength){
                        fnLazyLoad(me, 1);
                    // 最后一屏，继续往后滑动
                    }else if(me._index == me._liLength){
                        fnLazyLoad(me, 0);
                    }
                }else{
                    fnLazyLoad(me, me._index+1);
                }
            }
        }else if(go == 'prev'){
            me._index--;
            if(me.opts.lazyLoad){
                if(me.opts.continuousScroll){
                    fnLazyLoad(me, me._index);
                    // 滑到第一屏
                    if(me._index == 0){
                        fnLazyLoad(me, me._liLength);
                    
                    // 第一屏，继续往前滑动
                    }else if(me._index < 0){
                        fnLazyLoad(me, me._liLength-1);
                    }
                }else{
                    fnLazyLoad(me, me._index-1);
                }
            }
        }
        // 如果是连续滚动
        if(me.opts.continuousScroll){
            if(me._index >= me._liLength){
                fnScroll(me, num);
                me._index = 0;
                setTimeout(function(){
                    fnScroll(me, 0);
                    return;
                },300);
            }else if(me._index < 0){
                fnScroll(me, num);
                me._index = me._liLength-1;
                setTimeout(function(){
                    fnScroll(me, 0);
                    return;
                },300);
            }else{
                fnScroll(me, num);
            }
        }else{
            if(me._index >= me._liLength){
                me._index = 0;
            }else if(me._index < 0){
                me._index = me._liLength-1;
            }
            fnScroll(me, num);
        }
        // 如果第二个参数为空，就不回调
        if(arguments[1] !== ''){
            me.opts.callback(me._index,me._liLength,me.$el);
        }
    }

    // 轮播动作
    function fnScroll(me, num){
        fnTransition(me, me.opts.ul, num);
        fnTranslate(me, me.opts.ul, -me._index*me._slideDistance);
    }

})(window, window.Zepto || window.jQuery);
