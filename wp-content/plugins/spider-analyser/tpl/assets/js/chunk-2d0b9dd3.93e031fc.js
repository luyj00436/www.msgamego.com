(window["webpackJsonp"]=window["webpackJsonp"]||[]).push([["chunk-2d0b9dd3"],{3583:function(t,e,a){"use strict";a.r(e);var i=function(){var t=this,e=t.$createElement,a=t._self._c||e;return a("div",{staticClass:"wbs-main"},[a("div",{staticClass:"log-box with-mask"},[t.$cnf.is_mobile?a("div",{staticClass:"cell-items"},[t.spider_log.length?t._e():a("div",{staticClass:"empty-data align-center"},[t._v("--暂无数据--")]),t._l(t.spider_log,(function(e,i){return a("div",{key:"item"+i,staticClass:"cell-item with-expand"},[a("div",{staticClass:"cell-hd"},[a("input",{directives:[{name:"model",rawName:"v-model",value:t.multipleSelection,expression:"multipleSelection"}],attrs:{type:"checkbox"},domProps:{value:e,checked:Array.isArray(t.multipleSelection)?t._i(t.multipleSelection,e)>-1:t.multipleSelection},on:{change:function(a){var i=t.multipleSelection,n=a.target,s=!!n.checked;if(Array.isArray(i)){var l=e,o=t._i(i,l);n.checked?o<0&&(t.multipleSelection=i.concat([l])):o>-1&&(t.multipleSelection=i.slice(0,o).concat(i.slice(o+1)))}else t.multipleSelection=s}}})]),a("div",{staticClass:"cell-bd primary"},[a("div",{attrs:{"data-label":"拦截名称"}},[a("span",[t._v(t._s(e.name?e.name:"-"))])]),a("div",{attrs:{"data-label":"拦截IP/IP段"}},[a("span",[t._v(t._s(e.ip?e.ip:"-"))])]),a("div",{staticClass:"def-hide"},[a("div",{attrs:{"data-label":"拦截方式"}},[a("span",[t._v(t._s(t._f("stop_type")(e)))])]),a("div",{attrs:{"data-label":"路径"}},[a("span",[t._v(t._s({4:"-",11:"蜘蛛日志",12:"蜘蛛清单",13:"蜘蛛IP段",14:"疑似伪蜘蛛",15:"自定义"}[e.status]))])]),a("div",{staticClass:"btns align-right"},[a("el-button",{attrs:{size:"mini",type:"success",plain:""},on:{click:function(a){return t.remove(i,e)}}},[t._v("移出拦截")])],1)])]),a("div",{staticClass:"cell-ft",on:{click:t.$WB.toggleActive}})])}))],2):a("el-table",{staticClass:"wbs-table table-fixed",staticStyle:{width:"100%"},attrs:{data:t.spider_log},on:{"selection-change":t.handleSelectionChange}},[a("el-table-column",{attrs:{type:"selection",width:"55"}}),a("el-table-column",{staticClass:"w20",attrs:{label:"拦截方式"},scopedSlots:t._u([{key:"default",fn:function(e){return[a("div",{attrs:{"data-label":"拦截方式"}},[a("span",[t._v(t._s(t._f("stop_type")(e.row)))])])]}}])}),a("el-table-column",{attrs:{label:"拦截名称"},scopedSlots:t._u([{key:"default",fn:function(e){return[a("div",{attrs:{"data-label":"拦截名称"}},[a("span",[t._v(t._s(e.row.name?e.row.name:"-"))])])]}}])}),a("el-table-column",{attrs:{label:"拦截IP/IP段"},scopedSlots:t._u([{key:"default",fn:function(e){return[a("div",{attrs:{"data-label":"拦截IP/IP段"}},[a("span",[t._v(t._s(e.row.ip?e.row.ip:"-"))])])]}}])}),a("el-table-column",{attrs:{label:"路径"},scopedSlots:t._u([{key:"default",fn:function(e){return[a("div",{attrs:{"data-label":"路径"}},[a("span",[t._v(t._s({4:"-",11:"蜘蛛日志",12:"蜘蛛清单",13:"蜘蛛IP段",14:"疑似伪蜘蛛",15:"自定义"}[e.row.status]))])])]}}])}),a("el-table-column",{attrs:{label:"操作",align:"right"},scopedSlots:t._u([{key:"default",fn:function(e){return[a("el-button",{attrs:{size:"mini",type:"success",plain:""},on:{click:function(a){return t.remove(e.$index,e.row)}}},[t._v("移出拦截")])]}}])})],1),a("table",{staticClass:"wbs-table table-fixed el-table"},[t.custom_active?a("tr",{class:t.custom_active?"cur-editing":""},[a("td",[a("input",{directives:[{name:"model",rawName:"v-model",value:t.one.name,expression:"one.name"}],staticClass:"wbs-input",attrs:{type:"text",placeholder:"填写拦截蜘蛛名称"},domProps:{value:t.one.name},on:{input:function(e){e.target.composing||t.$set(t.one,"name",e.target.value)}}})]),a("td",[a("input",{directives:[{name:"model",rawName:"v-model",value:t.one.ip,expression:"one.ip"}],staticClass:"wbs-input",attrs:{type:"text",placeholder:"填写拦截蜘蛛IP"},domProps:{value:t.one.ip},on:{input:function(e){e.target.composing||t.$set(t.one,"ip",e.target.value)}}})]),a("td",{attrs:{align:"right"}},[a("div",{staticClass:"cell align-right"},[a("el-button",{attrs:{type:"primary",size:"mini"},on:{click:t.add_one}},[t._v("保存")]),a("a",{staticClass:"button-link-delete ml",attrs:{href:"javascript:;"},on:{click:function(e){t.custom_active=0}}},[t._v("取消")])],1)])]):t._e(),t.custom_active?t._e():a("tr",[a("td",{attrs:{align:"right",colspan:"3"}},[a("div",{staticClass:"cell align-right"},[a("el-button",{attrs:{type:"primary",size:"mini",icon:"el-icon-circle-plus"},on:{click:function(e){t.custom_active=1}}},[t._v("添加")])],1)])])]),a("div",{directives:[{name:"show",rawName:"v-show",value:t.spider_log.length>0,expression:"spider_log.length>0"}],staticClass:"btns-bar with-ctrl-area"},[a("div",{staticClass:"wb-ctrl-area"},[a("el-select",{attrs:{size:"small",placeholder:"批量操作"},model:{value:t.batch_op,callback:function(e){t.batch_op=e},expression:"batch_op"}},[a("el-option",{attrs:{label:"移除",value:"remove"}})],1),a("el-button",{staticClass:"ml-s",attrs:{type:"info",plain:"",size:"small"},on:{click:t.batch_apply}},[t._v(" 应用 ")])],1),a("el-pagination",{attrs:{background:"",layout:t.$cnf.is_mobile?"pager, total, prev, next":"total, prev, pager, next, jumper","page-size":20,total:1*t.total,"pager-count":5},on:{"current-change":t.nav_page}})],1),t.is_pro?t._e():a("div",{staticClass:"getpro-mask"},[a("div",{staticClass:"mask-inner"},[a("a",{staticClass:"wbs-btn-primary",on:{click:t.about_pro}},[t._v("获取PRO版本")]),a("p",{staticClass:"tips"},[t._v("* 激活PRO版本即可使用")])])])],1),t._m(0)])},n=[function(){var t=this,e=t.$createElement,a=t._self._c||e;return a("dl",{staticClass:"description mt"},[a("dt",[t._v("温馨提示:")]),a("dd",[t._v("部分伪蜘蛛可能会伪装成真实蜘蛛名称，对于伪蜘蛛拦截请使用IP拦截方式。")]),a("dd",[t._v("按蜘蛛名称拦截，需准确填写蜘蛛名称，区分大小写，否则可能会拦截失败。")]),a("dd",[t._v("蜘蛛拦截仅对前端页面爬取蜘蛛有效，对后端数据爬取蜘蛛无效。")])])}],s=(a("4160"),a("159b"),a("b0c0"),a("a434"),a("c975"),{name:"ListStop",data:function(){var t=this;return{isLoaded:0,is_pro:t.$cnf.is_pro,cnf:{spider:[],code:[]},config:{},spider_log:[],log_loading:1,total:0,page:1,num:20,search:{},one:{name:"",ip:""},multipleSelection:[],batch_op:"",custom_active:0}},mounted:function(){var t=this;t.$verify(t.verify_run)},methods:{handleSelectionChange:function(t){this.multipleSelection=t},batch_apply:function(){var t=this;if(!t.batch_op)return!1;if(t.multipleSelection.length<1)return wbui.toast("未选择项目"),!1;if("remove"==t.batch_op){if(!t.is_pro)return wbui.open({content:"该功能仅Pro版本提供",btn:["激活Pro版"],yes:function(){t.$router.push({path:"/pro"})}}),!1;var e=[];if(t.multipleSelection.forEach((function(t){e.push([t.name,t.ip])})),e.length<1)return;wbui.confirm("确认将所选移出拦截清单？",(function(){var a=wbui.toast("执行中...",{time:180});t.$api.saveData({action:t.$cnf.action.act,op:"stop",removes:e}).then((function(e){wbui.close(a),wbui.toast("已将所选项移出拦截清单"),t.page=1,t.load_data()}))}))}return!1},nav_page:function(t){this.page=t,this.load_data()},remove:function(t,e){var a=this;wbui.confirm("确认移出？",(function(){var i={remove:[e.name,e.ip]};Object.assign(i,a.config.param),i.op="stop",a.$api.saveData(i).then((function(e){a.spider_log.splice(t,1),wbui.toast("已移出")}))}))},add_one:function(){var t=this;if(t.one.name||t.one.ip){var e={new:[t.one.name,t.one.ip],cid:15};Object.assign(e,this.config.param),e.op="stop",t.$api.saveData(e).then((function(e){t.one.name="",t.one.ip="",t.page=1,t.spider_log=[],t.custom_active=0,t.load_data()}))}else wbui.toast("填写拦截蜘蛛名称或IP")},loadMore2:function(){var t=this;t.page=t.page+1,t.load_data()},load_data:function(){var t=this;t.log_loading=wbui.loading();var e={status:4,page:t.page,num:t.num};Object.assign(e,t.config.param),e.op="stop",t.$api.getData(e).then((function(e){t.spider_log=e.data,t.total=e.total,t.num=e.num,wbui.close(t.log_loading)}))},about_pro:function(){this.$router.push({path:"/pro"})},verify_run:function(t,e){t&&this.set_cnf(e)},set_cnf:function(t){this.config=t,this.is_pro=1,this.load_data()}},filters:{stop_type:function(t){var e="";return 15==t.status?"自定义":(t.name&&(e="名称"),t.ip&&(e=e?e+"及":"",e+=t.ip.indexOf("*")>-1?"IP段":"IP"),e)}}}),l=s,o=a("2877"),c=Object(o["a"])(l,i,n,!1,null,null,null);e["default"]=c.exports}}]);