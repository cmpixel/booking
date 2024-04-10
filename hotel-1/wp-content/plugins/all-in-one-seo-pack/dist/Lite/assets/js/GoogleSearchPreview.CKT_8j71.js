import{u as h,m as C,t as F}from"./links.C7Z9vJvv.js";import{s as L}from"./strings.DHEzgTA5.js";import{C as R}from"./constants.DpuIWwJ9.js";import{a as T}from"./Caret.iRBf3wcH.js";import{E as x,x as k,o,c as n,a as s,t as a,D as $,d as l,F as v,K as m,C as q,H as V,L as H,M}from"./vue.esm-bundler.CWQFYt9y.js";import{_ as j}from"./_plugin-vue_export-helper.BN1snXvA.js";const g={components:{SvgCaret:T},computed:{faq(){var t;const e=((t=this.richResults)==null?void 0:t.faq)||[];return Array.isArray(e)&&e.length?e:[]},reviewSnippet(){var i;const t={...{bestRating:null,ratingValue:null,reviewCount:null,ratingCount:null,priceCurrency:null,price:null,priceFrom:null,priceTo:null},...((i=this.richResults)==null?void 0:i.reviewSnippet)||{}};if(Object.values(t).every(c=>c===null)||!t.reviewCount&&!t.ratingCount)return{};for(const[c,p]of Object.entries(t))if(["bestRating","ratingValue"].includes(c)&&(5<p||p===null))return{};return t.price=parseFloat(t.price)?parseFloat(t.price).toFixed(2):null,t.priceFrom=parseFloat(t.priceFrom)?parseFloat(t.priceFrom).toFixed(2):null,t.priceTo=parseFloat(t.priceTo)?parseFloat(t.priceTo).toFixed(2):null,t},yellowStarsWidth(){return`${this.reviewSnippet.ratingValue*100/5}%`},urlBreadcrumbs(){try{const e=new URL(this.url);return`${e.protocol}//${e.hostname}`+e.pathname.replace(/\/$/,"").replaceAll("/"," &rsaquo; ")}catch{return""}},parseFavicon(){var i;const e=h();let t=`https://www.google.com/s2/favicons?sz=64&domain=${e.aioseo.urls.domain}`;try{t=new URL(this.favicon||"").href}catch{(i=e.aioseo.data)!=null&&i.isDev&&(t=`${e.aioseo.urls.home}/favicon.ico`)}return t},parseDescription(){const e=C(this.description.substring(0,160).trim()+(160<this.description.length?" ...":""));if(!this.focusKeyphrase)return e;const t=this.focusKeyphrase.split(" "),i=new RegExp("\\b"+t.join("\\b|\\b")+"\\b","gi");return e.replace(i,"<strong>$&</strong>")}},methods:{stripTags:L,getReviewSnippetPriceLabel(){if(parseFloat(this.reviewSnippet.price)===0&&!this.reviewSnippet.priceTo)return this.strings.free;if(this.reviewSnippet.priceCurrency){const e=R.find(t=>t.value===this.reviewSnippet.priceCurrency)||{};return this.reviewSnippet.priceFrom&&this.reviewSnippet.priceTo?`${e==null?void 0:e.symbol}${this.reviewSnippet.priceFrom} - ${e==null?void 0:e.symbol}${this.reviewSnippet.priceTo}`:`${e==null?void 0:e.symbol}${this.reviewSnippet.price}`}return`$${this.reviewSnippet.price}`},getReviewSnippetCountLabel(){if(this.device==="desktop"){const e=this.reviewSnippet.ratingCount||this.reviewSnippet.reviewCount,t=this.reviewSnippet.ratingCount?this.$t._n("vote","votes",e,this.$td):this.$t._n("review","reviews",e,this.$td);return this.$t.sprintf(this.$t.__("%1$s %2$s",this.$td),e,t)}return`(${this.reviewSnippet.ratingCount||this.reviewSnippet.reviewCount})`},truncate:F},props:{focusKeyphrase:String,device:{type:String,default:"desktop"},favicon:String,hostname:{type:String,default(){return h().aioseo.urls.domain}},url:{type:String,default(){return h().aioseo.urls.mainSiteUrl}},title:String,description:String,richResults:Object},data(){return{strings:{free:this.$t.__("Free",this.$td),rating:this.$t.__("Rating",this.$td)}}}},S=()=>{x(e=>({dbfb0334:e.yellowStarsWidth}))},y=g.setup;g.setup=y?(e,t)=>(S(),y(e,t)):S;const A=e=>(H("data-v-546c0ec9"),e=e(),M(),e),B={class:"aioseo-google-search-preview__main"},U={class:"aioseo-google-search-preview__favicon"},D={class:"favicon-wrapper"},I=["src"],N={class:"aioseo-google-search-preview__location"},O={class:"hostname text-truncate"},E=["innerHTML"],K={class:"aioseo-google-search-preview__title"},P=["innerHTML"],z={key:0,class:"aioseo-google-search-preview__review-snippet"},W=A(()=>s("div",{class:"aioseo-google-search-preview__review-snippet__stars"},[s("div")],-1)),G={class:"aioseo-google-search-preview__review-snippet__rating"},Y={class:"aioseo-google-search-preview__review-snippet__count bullet"},J={key:0,class:"aioseo-google-search-preview__review-snippet__price bullet"},Q={key:1,class:"aioseo-google-search-preview__anchor"},X={class:"aioseo-google-search-preview__anchor__link"},Z={key:0,class:"aioseo-google-search-preview__anchor__bullet"},ee={key:2,class:"aioseo-google-search-preview__faq"},te={class:"aioseo-google-search-preview__faq__question",role:"button"},se=["innerHTML"],re=["innerHTML"];function ie(e,t,i,c,p,r){var d,w,f;const b=k("svg-caret");return o(),n("div",{class:V(["aioseo-google-search-preview",`aioseo-google-search-preview--${i.device}`])},[s("div",B,[s("div",U,[s("div",D,[s("img",{src:r.parseFavicon,alt:"Favicon",loading:"lazy",decoding:"async",height:"18",width:"18"},null,8,I)])]),s("div",N,[s("div",O,a(i.hostname.replace(/^(m|www)\./,"")),1),s("div",{class:"url text-truncate",innerHTML:r.urlBreadcrumbs.substring(0,35).trim()+(r.urlBreadcrumbs.length>35?"...":"")},null,8,E)]),s("div",K,a(i.title.substring(0,70).trim()+(i.title.length>70?" ...":"")),1),s("div",{class:"aioseo-google-search-preview__description",innerHTML:r.parseDescription},null,8,P)]),Object.values(r.reviewSnippet).length?(o(),n("div",z,[W,s("div",G,[s("span",null,a(p.strings.rating)+":",1),$(" "+a(parseFloat(r.reviewSnippet.ratingValue).toFixed(2)),1)]),s("div",Y,a(r.getReviewSnippetCountLabel()),1),((d=r.reviewSnippet)==null?void 0:d.price)!==null?(o(),n("div",J,a(r.getReviewSnippetPriceLabel()),1)):l("",!0)])):l("",!0),(f=(w=this.richResults)==null?void 0:w.anchorLinks)!=null&&f.length?(o(),n("div",Q,[(o(!0),n(v,null,m(this.richResults.anchorLinks,(u,_)=>(o(),n(v,{key:`anchor-${_}`},[s("span",X,a(r.truncate(u,30)),1),_!==this.richResults.anchorLinks.length-1?(o(),n("span",Z," • ")):l("",!0)],64))),128))])):l("",!0),Object.values(r.faq).length?(o(),n("div",ee,[(o(!0),n(v,null,m(r.faq.slice(0,3),(u,_)=>(o(),n("details",{key:`faq-${_}`,class:"aioseo-google-search-preview__faq__container"},[s("summary",te,[s("span",{class:"text-truncate",innerHTML:r.truncate(r.stripTags(u.question),60)},null,8,se),q(b,{width:"20"})]),s("span",{class:"aioseo-google-search-preview__faq__answer",innerHTML:r.stripTags(u.answer)},null,8,re)]))),128))])):l("",!0)],2)}const ue=j(g,[["render",ie],["__scopeId","data-v-546c0ec9"]]);export{ue as C};
