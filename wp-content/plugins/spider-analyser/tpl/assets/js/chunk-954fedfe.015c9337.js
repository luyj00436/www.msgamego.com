(window["webpackJsonp"]=window["webpackJsonp"]||[]).push([["chunk-954fedfe"],{"063f":function(t,e,a){"use strict";a.r(e);var s=function(){var t=this,e=t.$createElement,a=t._self._c||e;return a("div",{staticClass:"wbs-main"},[a("div",{staticClass:"wbs-ctrl-bar"},[a("el-select",{staticClass:"ctrl-item",attrs:{clearable:"",filterable:"",placeholder:"所有蜘蛛"},model:{value:t.q.spider,callback:function(e){t.$set(t.q,"spider",e)},expression:"q.spider"}},t._l(t.cnf.spider,(function(t,e){return a("el-option",{key:e,attrs:{filterable:"",label:t,value:t}})})),1),a("el-select",{staticClass:"ctrl-item",attrs:{clearable:"",placeholder:"所有状态码"},model:{value:t.q.code,callback:function(e){t.$set(t.q,"code",e)},expression:"q.code"}},t._l(t.cnf.code,(function(t,e){return a("el-option",{key:e,attrs:{label:t,value:t}})})),1),a("el-select",{staticClass:"ctrl-item",attrs:{clearable:"",placeholder:"今天"},model:{value:t.q.day,callback:function(e){t.$set(t.q,"day",e)},expression:"q.day"}},t._l(t.cnf.day,(function(t,e){return a("el-option",{key:e,attrs:{label:t.label,value:t.value}})})),1),a("el-input",{staticClass:"m-hide ctrl-item wbs-input-short",attrs:{placeholder:"输入蜘蛛名称",clearable:""},model:{value:t.q.name,callback:function(e){t.$set(t.q,"name",e)},expression:"q.name"}}),a("el-button",{staticClass:"ctrl-item",attrs:{type:"primary",plain:"",name:"search"},on:{click:t.search_log}},[t._v("筛选")]),a("div",{staticClass:"switch-btn align-right",on:{click:t.toggle_panel}},[t.is_expanded?a("div",[a("i",{staticClass:"el-icon-arrow-up"}),t._v(" "),a("span",[t._v("收起面板")])]):a("div",[a("i",{staticClass:"el-icon-search"}),t._v(" "),a("span",[t._v("筛选")])])])],1),a("div",{staticClass:"mt log-box"},[t.$cnf.is_mobile?a("div",{staticClass:"cell-items"},[t.spider_log.length?t._e():a("div",{staticClass:"empty-data align-center"},[t._v("--暂无数据--")]),t._l(t.spider_log,(function(e,s){return a("div",{key:"item"+s,staticClass:"cell-item with-expand"},[a("div",{staticClass:"cell-hd"},[a("input",{directives:[{name:"model",rawName:"v-model",value:t.multipleSelection,expression:"multipleSelection"}],attrs:{type:"checkbox"},domProps:{value:e,checked:Array.isArray(t.multipleSelection)?t._i(t.multipleSelection,e)>-1:t.multipleSelection},on:{change:function(a){var s=t.multipleSelection,i=a.target,n=!!i.checked;if(Array.isArray(s)){var l=e,o=t._i(s,l);i.checked?o<0&&(t.multipleSelection=s.concat([l])):o>-1&&(t.multipleSelection=s.slice(0,o).concat(s.slice(o+1)))}else t.multipleSelection=n}}})]),a("div",{staticClass:"cell-bd primary"},[a("div",[t._v(" "+t._s(e.spider)+" "),2==e.udg?a("a",{attrs:{href:"https://www.wbolt.com/tools-spider-detail?id="+encodeURI(e.spider)+"&utm_source=spider-analyser",target:"_blank",title:"详情"}},[a("i",{staticClass:"el-icon-link el-icon--right"})]):t._e()]),a("div",{staticClass:"wk fz-s"},[a("span",{staticClass:"ib w25"},[t._v(t._s(e.bot_type?e.bot_type:"未知类型"))]),a("span",{staticClass:"ib ml w25"},[t._v("爬取: "+t._s(e.num))]),a("span",{staticClass:"ml"},[t._v("占比: "+t._s(e.rate)+"%")])]),a("div",{staticClass:"def-hide"},[a("div",{attrs:{"data-label":"蜘蛛地址"}},[a("span",[t._v(t._s(e.bot_url))])]),a("div",{attrs:{"data-label":"最近来访"}},[a("span",[t._v(t._s(e.last_visit))])]),a("div",{staticClass:"mt btns align-right"},[a("el-button",{attrs:{plain:"",size:"mini",type:"danger"},on:{click:function(a){return t.skip_spider(e)}}},[t._v("忽略")]),a("el-button",{attrs:{size:"mini",type:"success",plain:""},on:{click:function(a){return t.stop_spider(e)}}},[t._v("拦截")])],1)])]),a("div",{staticClass:"cell-ft",on:{click:t.toggleActive}})])}))],2):a("el-table",{staticClass:"wbs-table",staticStyle:{width:"100%"},attrs:{data:t.spider_log,"default-sort":{prop:"num",order:"descending"}},on:{"sort-change":t.sortChange,"selection-change":t.handleSelectionChange}},[a("el-table-column",{attrs:{type:"selection",width:"55"}}),a("el-table-column",{attrs:{label:"蜘蛛名称","sort-by":"spider",sortable:"custom"},scopedSlots:t._u([{key:"default",fn:function(e){return[a("div",{attrs:{"data-label":"蜘蛛名称"}},[a("span",[t._v(t._s(e.row.spider)+" "),2==e.row.udg?a("a",{attrs:{href:"https://www.wbolt.com/tools-spider-detail?id="+encodeURI(e.row.spider)+"&utm_source=spider-analyser",target:"_blank",title:"详情"}},[a("i",{staticClass:"el-icon-link el-icon--right"})]):t._e()])])]}}])}),a("el-table-column",{attrs:{"sort-by":"spider",label:"类型"},scopedSlots:t._u([{key:"default",fn:function(e){return[a("div",{attrs:{"data-label":"类型"}},[a("span",[t._v(t._s(e.row.bot_type?e.row.bot_type:"未知"))])])]}}])}),a("el-table-column",{attrs:{label:"蜘蛛地址","class-name":"w25"},scopedSlots:t._u([{key:"default",fn:function(e){return[a("div",{attrs:{"data-label":"蜘蛛地址"}},[a("span",[t._v(t._s(e.row.bot_url))])])]}}])}),a("el-table-column",{attrs:{"sort-by":"last_visit",label:"最近来访","class-name":"w15",sortable:"custom"},scopedSlots:t._u([{key:"default",fn:function(e){return[a("div",{attrs:{"data-label":"最近来访"},domProps:{innerHTML:t._s(t.date_format(e.row.last_visit))}})]}}])}),a("el-table-column",{attrs:{label:"爬取URLs","class-name":"w10"},scopedSlots:t._u([{key:"default",fn:function(e){return[a("div",{attrs:{"data-label":"爬取URLs"}},[a("span",[t._v(t._s(e.row.num))])])]}}])}),a("el-table-column",{attrs:{label:"占比",sortable:"custom","sort-by":"num","class-name":"w10"},scopedSlots:t._u([{key:"default",fn:function(e){return[a("div",{attrs:{"data-label":"占比"}},[a("span",[t._v(t._s(e.row.rate)+"%")])])]}}])}),a("el-table-column",{attrs:{align:"right","class-name":"w15",label:"操作"},scopedSlots:t._u([{key:"default",fn:function(e){return[a("el-button",{attrs:{plain:"",size:"mini",type:"danger"},on:{click:function(a){return t.skip_spider(e.row)}}},[t._v("忽略")]),a("el-button",{attrs:{size:"mini",type:"success",plain:""},on:{click:function(a){return t.stop_spider(e.row)}}},[t._v("拦截")])]}}])})],1),a("div",{directives:[{name:"show",rawName:"v-show",value:t.spider_log.length>0,expression:"spider_log.length>0"}],staticClass:"btns-bar with-ctrl-area"},[a("div",{staticClass:"wb-ctrl-area"},[a("el-select",{attrs:{size:"small",placeholder:"批量操作"},model:{value:t.batch_op,callback:function(e){t.batch_op=e},expression:"batch_op"}},[a("el-option",{attrs:{label:"忽略",value:"skip"}}),a("el-option",{attrs:{label:"拦截",value:"stop"}})],1),a("el-button",{staticClass:"ml-s",attrs:{type:"info",plain:"",size:"small"},on:{click:t.batch_apply}},[t._v("应用")])],1),a("el-pagination",{attrs:{background:"",layout:t.$cnf.is_mobile?"pager, total, prev, next":"total, prev, pager, next, jumper","page-size":100,total:1*t.total,"pager-count":5},on:{"current-change":t.nav_page}})],1)],1),t._m(0)])},i=[function(){var t=this,e=t.$createElement,a=t._self._c||e;return a("div",{staticClass:"description mt"},[a("dl",[a("dd",[t._v("* 部分不常见蜘蛛尤其是伪蜘蛛，可能类型显示为空。但站长切勿以此为标准判别该蜘蛛是否为伪蜘蛛。")]),a("dd",[t._v("* 蜘蛛清单数据引自"),a("a",{attrs:{href:"https://www.wbolt.com/tools-spider?utm_source=spider-analyser",target:"_blank"}},[t._v("蜘蛛爬虫查询工具")]),t._v("。")])])])}],n=(a("ac1f"),a("841c"),a("4160"),a("159b"),a("c975"),a("4e82"),a("1276"),{name:"ListSpider",components:{},data:function(){var t=this;return{isLoaded:0,is_pro:t.$cnf.is_pro,cnf:{spider:[],code:[]},spider_log:[],log_loading:1,total:0,page:1,num:100,sort:"num",order:"desc",q:{code:"",type:"",day:"",spider:"",name:""},search:{},is_expanded:0,multipleSelection:[],batch_op:""}},created:function(){Object.assign(this.search,this.q),this.loadData(),this.load_cnf()},methods:{handleSelectionChange:function(t){this.multipleSelection=t},batch_apply:function(){var t=this;if(!t.batch_op)return!1;if(t.multipleSelection.length<1)return wbui.toast("未选择项目"),!1;if("skip"==t.batch_op){var e=[];if(t.multipleSelection.forEach((function(t){-1==e.indexOf(t.spider)&&e.push(t.spider)})),e.length<1)return;return wbui.confirm("批量忽略所选蜘蛛，将不再记录此蜘蛛日志。可通过插件设置恢复统计。",(function(){var a=wbui.toast("执行中...",{time:180});t.$api.saveData({action:t.$cnf.action.act,op:"list",skip:e}).then((function(e){wbui.close(a),wbui.toast("已忽略所选记录"),t.page=1,t.loadData()}))})),!1}if("stop"==t.batch_op){if(!t.is_pro)return wbui.open({content:"该功能仅Pro版本提供",btn:["激活Pro版"],yes:function(){t.$router.push({path:"/pro"})}}),!1;var a=[];if(t.multipleSelection.forEach((function(t){-1==a.indexOf(t.spider)&&a.push(t.spider)})),a.length<1)return;wbui.confirm("批量拦截所选蜘蛛？可通过蜘蛛拦截列表移除。",(function(){var e=wbui.toast("执行中...",{time:180});t.$api.saveData({action:t.$cnf.action.act,op:"stop",cid:12,new:[a,""]}).then((function(a){wbui.close(e),wbui.toast("已添加所选至蜘蛛拦截清单"),t.page=1,t.loadData()}))}))}return!1},sortChange:function(t){if("custom"==t.column.sortable&&t.order){var e=this;e.page=1,e.sort=t.column.sortBy,e.order="ascending"==t.order?"asc":"desc",e.total>0&&e.loadData()}},nav_page:function(t){this.page=t,this.loadData()},search_log:function(){this.page=1,Object.assign(this.search,this.q),this.loadData()},skip_spider:function(t){var e=this;return wbui.confirm("将"+t.spider+"蜘蛛列为忽略列表，将不再记录此蜘蛛日志。可通过插件设置恢复统计。",(function(){e.$api.saveData({action:e.$cnf.action.act,op:"list",skip:t.spider}).then((function(t){wbui.toast("操作成功"),e.page=1,e.loadData()}))})),!1},stop_spider:function(t){var e=this;if(e.is_pro)return wbui.confirm("拦截名称为"+t.spider+"的蜘蛛？可通过蜘蛛拦截列表移除。",(function(){e.$api.saveData({action:e.$cnf.action.act,op:"stop",cid:12,new:[t.spider,""]}).then((function(t){wbui.toast("操作成功"),e.page=1,e.loadData()}))})),!1;wbui.open({content:"该功能仅Pro版本提供",btn:["激活Pro版"],yes:function(){e.$router.push({path:"/pro"})}})},loadData:function(){var t=this;t.log_loading=wbui.loading(),t.$api.getData({action:t.$cnf.action.act,op:"list",q:t.search,page:t.page,num:t.num,sort:t.sort,order:t.order}).then((function(e){t.spider_log=e.data,t.total=e.total,t.num=e.num,wbui.close(t.log_loading)}))},load_cnf:function(){var t=this;t.$api.getData({action:t.$cnf.action.act,op:"log_cnf"}).then((function(e){t.cnf=e["data"],t.isLoaded=1}))},toggle_panel:function(){var t=this;t.$el.querySelector(".wbs-ctrl-bar").classList.toggle("expand"),t.is_expanded=!t.is_expanded},date_format:function(t){var e=t.split(" ");return e.length>1?'<span class="ib">'+e[0]+'</span> <span class="ib">'+e[1]+"</span>":t},toggleActive:function(t){t.target.parentNode.classList.toggle("active")}}}),l=n,o=a("2877"),r=Object(o["a"])(l,s,i,!1,null,null,null);e["default"]=r.exports},"129f":function(t,e){t.exports=Object.is||function(t,e){return t===e?0!==t||1/t===1/e:t!=t&&e!=e}},"4e82":function(t,e,a){"use strict";var s=a("23e7"),i=a("1c0b"),n=a("7b0b"),l=a("d039"),o=a("a640"),r=[],c=r.sort,u=l((function(){r.sort(void 0)})),d=l((function(){r.sort(null)})),p=o("sort"),f=u||!d||!p;s({target:"Array",proto:!0,forced:f},{sort:function(t){return void 0===t?c.call(n(this)):c.call(n(this),i(t))}})},"841c":function(t,e,a){"use strict";var s=a("d784"),i=a("825a"),n=a("1d80"),l=a("129f"),o=a("14c3");s("search",1,(function(t,e,a){return[function(e){var a=n(this),s=void 0==e?void 0:e[t];return void 0!==s?s.call(e,a):new RegExp(e)[t](String(a))},function(t){var s=a(e,t,this);if(s.done)return s.value;var n=i(t),r=String(this),c=n.lastIndex;l(c,0)||(n.lastIndex=0);var u=o(n,r);return l(n.lastIndex,c)||(n.lastIndex=c),null===u?-1:u.index}]}))}}]);