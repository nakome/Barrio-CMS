/*! Split.js - v1.5.11 */
!function(e,t){"object"==typeof exports&&"undefined"!=typeof module?module.exports=t():"function"==typeof define&&define.amd?define(t):e.Split=t()}(this,function(){"use strict";var L=window,T=L.document,N="addEventListener",R="removeEventListener",q="getBoundingClientRect",H="horizontal",I=function(){return!1},W=L.attachEvent&&!L[N],i=["","-webkit-","-moz-","-o-"].filter(function(e){var t=T.createElement("div");return t.style.cssText="width:"+e+"calc(9px)",!!t.style.length}).shift()+"calc",s=function(e){return"string"==typeof e||e instanceof String},X=function(e){if(s(e)){var t=T.querySelector(e);if(!t)throw new Error("Selector "+e+" did not match a DOM element");return t}return e},Y=function(e,t,n){var r=e[t];return void 0!==r?r:n},G=function(e,t,n,r){if(t){if("end"===r)return 0;if("center"===r)return e/2}else if(n){if("start"===r)return 0;if("center"===r)return e/2}return e},J=function(e,t){var n=T.createElement("div");return n.className="gutter gutter-"+t,n},K=function(e,t,n){var r={};return s(t)?r[e]=t:r[e]=W?t+"%":i+"("+t+"% - "+n+"px)",r},P=function(e,t){var n;return(n={})[e]=t+"px",n};return function(e,i){void 0===i&&(i={});var u,t,s,o,r,a,l=e;Array.from&&(l=Array.from(l));var c=X(l[0]).parentNode,n=getComputedStyle?getComputedStyle(c):null,f=n?n.flexDirection:null,m=Y(i,"sizes")||l.map(function(){return 100/l.length}),h=Y(i,"minSize",100),d=Array.isArray(h)?h:l.map(function(){return h}),g=Y(i,"expandToMin",!1),v=Y(i,"gutterSize",10),p=Y(i,"gutterAlign","center"),y=Y(i,"snapOffset",30),z=Y(i,"dragInterval",1),S=Y(i,"direction",H),b=Y(i,"cursor",S===H?"col-resize":"row-resize"),_=Y(i,"gutter",J),E=Y(i,"elementStyle",K),w=Y(i,"gutterStyle",P);function k(t,e,n,r){var i=E(u,e,n,r);Object.keys(i).forEach(function(e){t.style[e]=i[e]})}function x(){return a.map(function(e){return e.size})}function M(e){return"touches"in e?e.touches[0][t]:e[t]}function U(e){var t=a[this.a],n=a[this.b],r=t.size+n.size;t.size=e/this.size*r,n.size=r-e/this.size*r,k(t.element,t.size,this._b,t.i),k(n.element,n.size,this._c,n.i)}function O(){var e=a[this.a].element,t=a[this.b].element,n=e[q](),r=t[q]();this.size=n[u]+r[u]+this._b+this._c,this.start=n[s],this.end=n[o]}function C(s){var o=function(e){if(!getComputedStyle)return null;var t=getComputedStyle(e);if(!t)return null;var n=e[r];return 0===n?null:n-=S===H?parseFloat(t.paddingLeft)+parseFloat(t.paddingRight):parseFloat(t.paddingTop)+parseFloat(t.paddingBottom)}(c);if(null===o)return s;if(d.reduce(function(e,t){return e+t},0)>o)return s;var a=0,u=[],e=s.map(function(e,t){var n=o*e/100,r=G(v,0===t,t===s.length-1,p),i=d[t]+r;return n<i?(a+=i-n,u.push(0),i):(u.push(n-i),n)});return 0===a?s:e.map(function(e,t){var n=e;if(0<a&&0<u[t]-a){var r=Math.min(a,u[t]-a);a-=r,n=e-r}return n/o*100})}function D(e){if(!("button"in e&&0!==e.button)){var t=this,n=a[t.a].element,r=a[t.b].element;t.dragging||Y(i,"onDragStart",I)(x()),e.preventDefault(),t.dragging=!0,t.move=function(e){var t,n=a[this.a],r=a[this.b];this.dragging&&(t=M(e)-this.start+(this._b-this.dragOffset),1<z&&(t=Math.round(t/z)*z),t<=n.minSize+y+this._b?t=n.minSize+this._b:t>=this.size-(r.minSize+y+this._c)&&(t=this.size-(r.minSize+this._c)),U.call(this,t),Y(i,"onDrag",I)())}.bind(t),t.stop=function(){var e=this,t=a[e.a].element,n=a[e.b].element;e.dragging&&Y(i,"onDragEnd",I)(x()),e.dragging=!1,L[R]("mouseup",e.stop),L[R]("touchend",e.stop),L[R]("touchcancel",e.stop),L[R]("mousemove",e.move),L[R]("touchmove",e.move),e.stop=null,e.move=null,t[R]("selectstart",I),t[R]("dragstart",I),n[R]("selectstart",I),n[R]("dragstart",I),t.style.userSelect="",t.style.webkitUserSelect="",t.style.MozUserSelect="",t.style.pointerEvents="",n.style.userSelect="",n.style.webkitUserSelect="",n.style.MozUserSelect="",n.style.pointerEvents="",e.gutter.style.cursor="",e.parent.style.cursor="",T.body.style.cursor=""}.bind(t),L[N]("mouseup",t.stop),L[N]("touchend",t.stop),L[N]("touchcancel",t.stop),L[N]("mousemove",t.move),L[N]("touchmove",t.move),n[N]("selectstart",I),n[N]("dragstart",I),r[N]("selectstart",I),r[N]("dragstart",I),n.style.userSelect="none",n.style.webkitUserSelect="none",n.style.MozUserSelect="none",n.style.pointerEvents="none",r.style.userSelect="none",r.style.webkitUserSelect="none",r.style.MozUserSelect="none",r.style.pointerEvents="none",t.gutter.style.cursor=b,t.parent.style.cursor=b,T.body.style.cursor=b,O.call(t),t.dragOffset=M(e)-t.end}}S===H?(u="width",t="clientX",s="left",o="right",r="clientWidth"):"vertical"===S&&(u="height",t="clientY",s="top",o="bottom",r="clientHeight"),m=C(m);var A=[];function j(e){var t=e.i===A.length,n=t?A[e.i-1]:A[e.i];O.call(n);var r=t?n.size-e.minSize-n._c:e.minSize+n._b;U.call(n,r)}function F(e){var s=C(e);s.forEach(function(e,t){if(0<t){var n=A[t-1],r=a[n.a],i=a[n.b];r.size=s[t-1],i.size=e,k(r.element,r.size,n._b,r.i),k(i.element,i.size,n._c,i.i)}})}function B(n,r){A.forEach(function(t){if(!0!==r?t.parent.removeChild(t.gutter):(t.gutter[R]("mousedown",t._a),t.gutter[R]("touchstart",t._a)),!0!==n){var e=E(u,t.a.size,t._b);Object.keys(e).forEach(function(e){a[t.a].element.style[e]="",a[t.b].element.style[e]=""})}})}return(a=l.map(function(e,t){var n,r,i,s={element:X(e),size:m[t],minSize:d[t],i:t};if(0<t&&((n={a:t-1,b:t,dragging:!1,direction:S,parent:c})._b=G(v,t-1==0,!1,p),n._c=G(v,!1,t===l.length-1,p),"row-reverse"===f||"column-reverse"===f)){var o=n.a;n.a=n.b,n.b=o}if(!W&&0<t){var a=_(t,S,s.element);r=a,i=w(u,v,t),Object.keys(i).forEach(function(e){r.style[e]=i[e]}),n._a=D.bind(n),a[N]("mousedown",n._a),a[N]("touchstart",n._a),c.insertBefore(a,s.element),n.gutter=a}return k(s.element,s.size,G(v,0===t,t===l.length-1,p),t),0<t&&A.push(n),s})).forEach(function(e){var t=e.element[q]()[u];t<e.minSize&&(g?j(e):e.minSize=t)}),W?{setSizes:F,destroy:B}:{setSizes:F,getSizes:x,collapse:function(e){j(a[e])},destroy:B,parent:c,pairs:A}}});
//# sourceMappingURL=split.min.js.map
/*!
 * --------------------------------------------------------------------
 *  SIMPLE TEXT SELECTION LIBRARY FOR ONLINE TEXT EDITING (2015-02-21)
 * --------------------------------------------------------------------
 * Source code available at https://github.com/tovic/simple-text-editor-library
 *
 */
var Editor=function(e){var t=this,a=document,n=[],l=0,r=null;t.area=void 0!==e?e:a.getElementsByTagName("textarea")[0],n[l]={value:t.area.value,selectionStart:0,selectionEnd:0},l++,t.selection=function(){var e=t.area.selectionStart,a=t.area.selectionEnd,n=t.area.value.substring(e,a),l=t.area.value.substring(0,e),r=t.area.value.substring(a),o={start:e,end:a,value:n,before:l,after:r};return o},t.select=function(e,n,l){var r=[a.documentElement.scrollTop,a.body.scrollTop,t.area.scrollTop];t.area.focus(),t.area.setSelectionRange(e,n),a.documentElement.scrollTop=r[0],a.body.scrollTop=r[1],t.area.scrollTop=r[2],"function"==typeof l&&l()},t.replace=function(e,a,n){var l=t.selection(),r=l.start,o=(l.end,l.value.replace(e,a));t.area.value=l.before+o+l.after,t.select(r,r+o.length),"function"==typeof n?n():t.updateHistory({value:t.area.value,selectionStart:r,selectionEnd:r+o.length})},t.insert=function(e,a){var n=t.selection(),l=n.start;n.end,t.area.value=n.before+e+n.after,t.select(l+e.length,l+e.length),"function"==typeof a?a():t.updateHistory({value:t.area.value,selectionStart:l+e.length,selectionEnd:l+e.length})},t.wrap=function(e,a,n){var l=t.selection(),r=l.value,o=l.before,c=l.after;t.area.value=o+e+r+a+c,t.select(o.length+e.length,o.length+e.length+r.length),"function"==typeof n?n():t.updateHistory({value:t.area.value,selectionStart:o.length+e.length,selectionEnd:o.length+e.length+r.length})},t.indent=function(e,a){var n=t.selection();n.value.length>0?t.replace(/(^|\n)([^\n])/gm,"$1"+e+"$2",a):(t.area.value=n.before+e+n.value+n.after,t.select(n.start+e.length,n.start+e.length),"function"==typeof a?a():t.updateHistory({value:t.area.value,selectionStart:n.start+e.length,selectionEnd:n.start+e.length}))},t.outdent=function(e,a){var n=t.selection();if(n.value.length>0)t.replace(RegExp("(^|\n)"+e,"gm"),"$1",a);else{var l=n.before.replace(RegExp(e+"$"),"");t.area.value=l+n.value+n.after,t.select(l.length,l.length),"function"==typeof a?a():t.updateHistory({value:t.area.value,selectionStart:l.length,selectionEnd:l.length})}},t.callHistory=function(e){return"number"==typeof e?n[e]:n},t.updateHistory=function(e,a){var r=void 0!==e?e:{value:t.area.value,selectionStart:t.selection().start,selectionEnd:t.selection().end};n["number"==typeof a?a:l]=r,l++},t.undo=function(e){if(n.length>1){l>1?l--:l=1;var a=t.callHistory(l-1);r=l>0?l:l-1,t.area.value=a.value,t.select(a.selectionStart,a.selectionEnd),"function"==typeof e&&e()}},t.redo=function(e){if(null!==r){var a=t.callHistory(r);r<n.length-1?r++:r=n.length-1,l=r<n.length-1?r:r+1,t.area.value=a.value,t.select(a.selectionStart,a.selectionEnd),"function"==typeof e&&e()}}};
'use strict';

(function() {

    //  convert href to toUpperCase
    String.prototype.capitalize = function(lower) {
        return (lower ? this.toLowerCase() : this).replace(/(?:^|\s)\S/g, function(a) {
            return a.toUpperCase();
        });
    };

    // vars
    var y = document.querySelector('#editorArea'),
        o = document.querySelector('.result'),
        w = document.querySelector('.close_window'),
        d = document.querySelector('.drag'),
        btn = document.querySelector('#editor-control').getElementsByTagName('a'),
        editor = new Editor(y),
        controls = {
            'text': function() {
                editor.wrap("[Text bg='blue' color='white']", '\n[/Text]');
            },
            'iframe': function() {
                editor.wrap("[Iframe src='link sin https://", "']");
            },
            'youtube': function() {
                editor.wrap("[Youtube id='id_de_youtube", "']");
            },
            'vimeo': function() {
                editor.wrap("[Vimeo id='id_de_youtube", "']");
            },
            'video': function() {
                editor.wrap("[Video src='link_del_video", "']");
            },
            'img': function() {
                editor.wrap("[Img src='link_de_la_imagen", "']");
            },
            'link': function() {
                editor.wrap("[Link title='Ir a' href='enlace_aqui", "']");
            },
            'row': function() {
                editor.wrap('[Row]', '\n[/Row]');
            },
            'col': function() {
                editor.wrap("[Col num='4']", '\n[/Col]');
            },
            'btn': function() {
                editor.wrap("[Btn text='boton' href='", "']");
            },
            'html': function() {
                editor.wrap("[Html src='/public/", "']");
            },
            'lorem': function() {
                editor.wrap('Lorem ipsum dolor sit amet, consectetur adipisicing elit. Earum nihil eligendi libero laboriosam iure tenetur sunt dolores explicabo velit nesciunt rem at vitae, aspernatur culpa eum consectetur, vero enim modi.\n\n', '');
            },
            'table': function() {
                editor.wrap('| clave | valor |\n| ----- | ----- |\n|   pi  | 3,14  |\n', '');
            },
            'bold': function bold() {
                editor.wrap('**', '**');
            },
            'italic': function italic() {
                editor.wrap('_', '_');
            },
            'code': function code() {
                editor.wrap('`', '`');
            },
            'quote': function quote() {
                editor.indent('> ');
            },
            'ul-list': function ulList() {
                var sel = editor.selection();
                var added = "";
                if (sel.value.length > 0) {
                    editor.indent('', function() {
                        editor.replace(/^[^\n\r]/gm, function(str) {
                            added += '- ';
                            return str.replace(/^/, '- ');
                        });
                        editor.select(sel.start, sel.end + added.length);
                    });
                } else {
                    (function() {
                        var placeholder = '- List Item';
                        editor.indent(placeholder, function() {
                            editor.select(sel.start + 2, sel.start + placeholder.length);
                        });
                    })();
                }
            },
            'ol-list': function olList() {
                var sel = editor.selection();
                var ol = 0;
                var added = "";
                if (sel.value.length > 0) {
                    editor.indent('', function() {
                        editor.replace(/^[^\n\r]/gm, function(str) {
                            ol++;
                            added += ol + '. ';
                            return str.replace(/^/, ol + '. ');
                        });
                        editor.select(sel.start, sel.end + added.length);
                    });
                } else {
                    (function() {
                        var placeholder = '1. List Item';
                        editor.indent(placeholder, function() {
                            editor.select(sel.start + 3, sel.start + placeholder.length);
                        });
                    })();
                }
            },
            'h1': function h1() {
                heading('#');
            },
            'h2': function h2() {
                heading('##');
            },
            'h3': function h3() {
                heading('###');
            },
            'hr': function hr() {
                editor.insert('\n[Divider]\n');
            }
        };

    var shortcodes = document.querySelector('#shortcodes');
    shortcodes.addEventListener('change', function() {
        var hash = this.value;
        if (controls[hash]) {
            controls[hash]();
            shortcodes.selectedIndex = 0;
        }
    });

    // find and add function all btn
    for (var i = 0, len = btn.length; i < len; ++i) {
        click(btn[i]);
        btn[i].href = '#';
    }

    // key events
    var pressed = 0;
    editor.area.addEventListener('keydown', function(event) {
        if (pressed < 5) {
            pressed++;
        } else {
            editor.updateHistory();
            pressed = 0;
        }
        // shift + tab
        if (event.shiftKey && event.keyCode == 9) {
            event.preventDefault();
            editor.outdent('  ');
            // tab
        } else if (event.keyCode == 9) {
            event.preventDefault();
            editor.indent('    ');
        }
    });

    // heading wrap
    function heading(key) {
        if (editor.selection().value.length > 0) {
            editor.wrap(key + ' ', "");
        } else {
            (function() {
                var placeholder = key + ' Heading ' + key.length + '\n\n';
                editor.insert(placeholder, function() {
                    var s = editor.selection().start;
                    editor.select(s - placeholder.length + key.length + 1, s - 2);
                });
            })();
        }
    }

    // click events with hash
    function click(elem) {
        var hash = elem.hash.replace('#', "");
        if (controls[hash]) {
            elem.addEventListener('click', function(e) {
                e.preventDefault();
                controls[hash]();
            }, false);
        }
    }

})();


var maxWidth = 768;
Split(["#code", "#preview"], {
    minSize: [500, 400],
    elementStyle: (dimension, size, gutterSize) => ({
        "flex-basis": `calc(${size}% - ${gutterSize}px)`,
    }),
    gutterStyle: (dimension, gutterSize) => ({
        "flex-basis": `${gutterSize}px`,
    }),
});

let store = localStorage;
if (store.getItem('demoEditor')) window.editorArea.value = store.getItem('demoEditor');
window.render.onclick = function() {
    store.setItem('demoEditor', window.editorArea.value);
}