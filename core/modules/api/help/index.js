"use strict";

function _asyncToGenerator(fn) {
  return function () {
    var gen = fn.apply(this, arguments);
    return new Promise(function (resolve, reject) {
      function step(key, arg) {
        try {
          var info = gen[key](arg);
          var value = info.value;
        } catch (error) {
          reject(error);
          return;
        }
        if (info.done) {
          resolve(value);
        } else {
          return Promise.resolve(value).then(
            function (value) {
              step("next", value);
            },
            function (err) {
              step("throw", err);
            }
          );
        }
      }
      return step("next");
    });
  };
}

var url = "./index.php?";

var waitForTime = function waitForTime(ms) {
  return new Promise(function (r) {
    return setTimeout(r, ms);
  });
};

var Home = {
  data: function data() {
    return {
      link: "example.php",
      output: "example",
    };
  },

  template:
    '<div>\n\n<button class="btn btn-block btn-primary" @click="getBlog(\'api=file&data=pages&name=blog\')">Get Blog</button>\n<button class="btn btn-block btn-primary" @click="getBlog(\'api=file&data=pages&name=blog&limit=2\')">Get Blog limit 2</button>\n<button class="btn btn-block btn-primary" @click="getBlog(\'api=file&data=pages&name=blog&filter=title\')">Get Blog titles</button>\n<button class="btn btn-block btn-primary" @click="getBlog(\'api=file&data=pages&name=blog&filter=image\')">Get Blog images</button>\n<button class="btn btn-block btn-primary" @click="getBlog(\'api=file&data=pages&name=blog&filter=video\')">Get Blog Videos</button>\n<button class="btn btn-block btn-primary" @click="getBlog(\'api=file&data=page&name=contacto\')">Get Single</button>\n\n<div class="form-group mt-3">\n<input type="text" class="form-control" disabled v-model="link"/>\n<textarea class="form-control" rows="10">{{output}}</textarea>\n</div>\n\n</div>',
  methods: {
    getBlog: function getBlog(data) {
      var _this = this;
      return _asyncToGenerator(
        regeneratorRuntime.mark(function _callee() {
          return regeneratorRuntime.wrap(
            function _callee$(_context) {
              while (1) {
                switch ((_context.prev = _context.next)) {
                  case 0:
                    _context.next = 2;
                    return loadProgressBar();

                  case 2:
                    _this.link = "loading..";
                    _context.next = 5;
                    return waitForTime(300);

                  case 5:
                    _this.output = "loading..";
                    _context.next = 8;
                    return waitForTime(500);

                  case 8:
                    _context.next = 10;
                    return axios.get(url + data).then(function (r) {
                      _this.link = data;
                      _this.output = r.data;
                    });

                  case 10:
                  case "end":
                    return _context.stop();
                }
              }
            },
            _callee,
            _this
          );
        })
      )();
    },
  },
};

var Images = {
  data: function data() {
    return {
      link: "example.php",
      output: "https://via.placeholder.com/150",
    };
  },

  template:
    '<div>\n\n<button class="btn btn-block btn-primary" @click="getBlog(\'api=image&url=public/notfound.jpg\')">Get Image</button>\n<button class="btn btn-block btn-primary" @click="getBlog(\'api=image&url=public/notfound.jpg&w=600\')">Get Image width</button>\n<button class="btn btn-block btn-primary" @click="getBlog(\'api=image&url=public/notfound.jpg&w=600&h=300\')">Get Image width height</button>\n\n<div class="form-group mt-3">\n<input type="text" class="form-control" disabled v-model="link"/>\n</div>\n<a target="_blank" :href="output">{{output}}</a>\n\n</div>',
  methods: {
    getBlog: function getBlog(data) {
      this.link = data;
      this.output = url + data;
    },
  },
};

var Manifest = {
  data: function data() {
    return {
      link: "api=",
      output: "{}",
    };
  },

  template:
    '<div>\n\n<button class="btn btn-block btn-primary" @click="getBlog(\'api=manifest\')">Get Manifest</button>\n\n<div class="form-group mt-3">\n<input type="text" class="form-control" disabled v-model="link"/>\n<textarea class="form-control" rows="10">{{output}}</textarea>\n</div>\n\n</div>',
  methods: {
    getBlog: function getBlog(data) {
      var _this2 = this;

      return _asyncToGenerator(
        regeneratorRuntime.mark(function _callee2() {
          return regeneratorRuntime.wrap(
            function _callee2$(_context2) {
              while (1) {
                switch ((_context2.prev = _context2.next)) {
                  case 0:
                    _context2.next = 2;
                    return loadProgressBar();

                  case 2:
                    _this2.link = "loading..";
                    _context2.next = 5;
                    return waitForTime(300);

                  case 5:
                    _this2.output = "loading..";
                    _context2.next = 8;
                    return waitForTime(500);

                  case 8:
                    _context2.next = 10;
                    return axios.get(url + data).then(function (r) {
                      _this2.link = data;
                      _this2.output = r.data;
                    });

                  case 10:
                  case "end":
                    return _context2.stop();
                }
              }
            },
            _callee2,
            _this2
          );
        })
      )();
    },
  },
};

var Sitemap = {
  data: function data() {
    return {
      link: "api=",
      output: '<?xml version="1.0" encoding="UTF-8"?>',
    };
  },

  template:
    '<div>\n\n<button class="btn btn-block btn-primary" @click="getBlog(\'api=sitemap\')">Get Sitemap</button>\n\n<div class="form-group mt-3">\n<input type="text" class="form-control" disabled v-model="link"/>\n<textarea class="form-control" rows="10">{{output}}</textarea>\n</div>\n\n</div>',
  methods: {
    getBlog: function getBlog(data) {
      var _this3 = this;

      return _asyncToGenerator(
        regeneratorRuntime.mark(function _callee3() {
          return regeneratorRuntime.wrap(
            function _callee3$(_context3) {
              while (1) {
                switch ((_context3.prev = _context3.next)) {
                  case 0:
                    _context3.next = 2;
                    return loadProgressBar();

                  case 2:
                    _this3.link = "loading..";
                    _context3.next = 5;
                    return waitForTime(300);

                  case 5:
                    _this3.output = "loading..";
                    _context3.next = 8;
                    return waitForTime(500);

                  case 8:
                    _context3.next = 10;
                    return axios.get(url + data).then(function (r) {
                      _this3.link = data;
                      _this3.output = r.data;
                    });

                  case 10:
                  case "end":
                    return _context3.stop();
                }
              }
            },
            _callee3,
            _this3
          );
        })
      )();
    },
  },
};

var routes = [
  { path: "/", component: Home },
  { path: "/images", component: Images },
  { path: "/manifest", component: Manifest },
  { path: "/sitemap", component: Sitemap },
];

var router = new VueRouter({
  routes: routes, // short for `routes: routes`
});

var app = new Vue({
  data: function data() {
    return { navOpen: false };
  },

  methods: {
    toogleMenu: function toogleMenu() {
      this.navOpen = !this.navOpen;
    },
  },
  router: router,
}).$mount("#app");
//# sourceURL=userscript.js
