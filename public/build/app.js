(self["webpackChunk"] = self["webpackChunk"] || []).push([["app"],{

/***/ "./assets/controllers sync recursive ./node_modules/@symfony/stimulus-bridge/lazy-controller-loader.js! \\.[jt]sx?$":
/*!****************************************************************************************************************!*\
  !*** ./assets/controllers/ sync ./node_modules/@symfony/stimulus-bridge/lazy-controller-loader.js! \.[jt]sx?$ ***!
  \****************************************************************************************************************/
/***/ ((module) => {

function webpackEmptyContext(req) {
	var e = new Error("Cannot find module '" + req + "'");
	e.code = 'MODULE_NOT_FOUND';
	throw e;
}
webpackEmptyContext.keys = () => ([]);
webpackEmptyContext.resolve = webpackEmptyContext;
webpackEmptyContext.id = "./assets/controllers sync recursive ./node_modules/@symfony/stimulus-bridge/lazy-controller-loader.js! \\.[jt]sx?$";
module.exports = webpackEmptyContext;

/***/ }),

/***/ "./node_modules/@symfony/stimulus-bridge/dist/webpack/loader.js!./assets/controllers.json":
/*!************************************************************************************************!*\
  !*** ./node_modules/@symfony/stimulus-bridge/dist/webpack/loader.js!./assets/controllers.json ***!
  \************************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = ({
});

/***/ }),

/***/ "./assets/app.js":
/*!***********************!*\
  !*** ./assets/app.js ***!
  \***********************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _styles_app_scss__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./styles/app.scss */ "./assets/styles/app.scss");
/* harmony import */ var _bootstrap__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./bootstrap */ "./assets/bootstrap.js");
/* harmony import */ var bootstrap__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! bootstrap */ "./node_modules/bootstrap/dist/js/bootstrap.esm.js");
/* harmony import */ var _javascript_post_opinion_js__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! ./javascript/post_opinion.js */ "./assets/javascript/post_opinion.js");
/* harmony import */ var _javascript_post_opinion_js__WEBPACK_IMPORTED_MODULE_3___default = /*#__PURE__*/__webpack_require__.n(_javascript_post_opinion_js__WEBPACK_IMPORTED_MODULE_3__);
/* harmony import */ var _javascript_post_answer_js__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! ./javascript/post_answer.js */ "./assets/javascript/post_answer.js");
/* harmony import */ var _javascript_post_answer_js__WEBPACK_IMPORTED_MODULE_4___default = /*#__PURE__*/__webpack_require__.n(_javascript_post_answer_js__WEBPACK_IMPORTED_MODULE_4__);
/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */
// any CSS you import will output into a single css file (app.css in this case)
 // start the Stimulus application


 //JavaScript




/***/ }),

/***/ "./assets/bootstrap.js":
/*!*****************************!*\
  !*** ./assets/bootstrap.js ***!
  \*****************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "app": () => (/* binding */ app)
/* harmony export */ });
/* harmony import */ var _symfony_stimulus_bridge__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @symfony/stimulus-bridge */ "./node_modules/@symfony/stimulus-bridge/dist/index.js");
 // Registers Stimulus controllers from controllers.json and in the controllers/ directory

var app = (0,_symfony_stimulus_bridge__WEBPACK_IMPORTED_MODULE_0__.startStimulusApp)(__webpack_require__("./assets/controllers sync recursive ./node_modules/@symfony/stimulus-bridge/lazy-controller-loader.js! \\.[jt]sx?$")); // register any custom, 3rd party controllers here
// app.register('some_controller_name', SomeImportedController);

/***/ }),

/***/ "./assets/javascript/post_answer.js":
/*!******************************************!*\
  !*** ./assets/javascript/post_answer.js ***!
  \******************************************/
/***/ ((__unused_webpack_module, __unused_webpack_exports, __webpack_require__) => {

/* provided dependency */ var $ = __webpack_require__(/*! jquery */ "./node_modules/jquery/dist/jquery.js");
__webpack_require__(/*! core-js/modules/es.array.find.js */ "./node_modules/core-js/modules/es.array.find.js");

__webpack_require__(/*! core-js/modules/es.object.to-string.js */ "./node_modules/core-js/modules/es.object.to-string.js");

//Display form for add comment after click and set id of parent post
$(function () {
  $('.give-answer').on('click', function () {
    var id = $(this).attr('id');
    $('.answer-post-id-' + id).show();
    res = $('.input-id-' + id).find('#create_post_parentID').val(id);
  });
});

/***/ }),

/***/ "./assets/javascript/post_opinion.js":
/*!*******************************************!*\
  !*** ./assets/javascript/post_opinion.js ***!
  \*******************************************/
/***/ ((__unused_webpack_module, __unused_webpack_exports, __webpack_require__) => {

/* provided dependency */ var $ = __webpack_require__(/*! jquery */ "./node_modules/jquery/dist/jquery.js");
__webpack_require__(/*! core-js/modules/es.parse-int.js */ "./node_modules/core-js/modules/es.parse-int.js");

$(function () {
  $('.userPositivePost').show();
  $('.userNegativePost').show();
  $('.noAction').show();
  $('.toogle-opinion').on('click', function (event) {
    event.preventDefault();
    var $link = $(event.currentTarget);
    $.ajax({
      method: 'POST',
      url: $link.attr('href')
    }).done(function (data) {
      switch (data.action) {
        case 'positive':
          var num_of_positive_str = $('.num-positive-' + data.id);
          var num_of_positive = parseInt(num_of_positive_str.html()) + 1;
          num_of_positive_str.html(num_of_positive);
          $('.positive-id-' + data.id).show();
          $('.negative-id-' + data.id).hide();
          $('.post-id-' + data.id).hide();
          break;

        case 'negative':
          var num_of_negative_str = $('.num-negative-' + data.id);
          var num_of_negative = parseInt(num_of_negative_str.html()) + 1;
          num_of_negative_str.html(num_of_negative);
          $('.negative-id-' + data.id).show();
          $('.positive-id-' + data.id).hide();
          $('.post-id-' + data.id).hide();
          break;

        case 'click-to-back-positive':
          var num_of_positive_str = $('.num-positive-' + data.id);
          var num_of_positive = parseInt(num_of_positive_str.html()) - 1;
          num_of_positive_str.html(num_of_positive);
          $('.post-id-' + data.id).show();
          $('.negative-id-' + data.id).hide();
          $('.positive-id-' + data.id).hide();
          break;

        case 'click-to-back-negative':
          var num_of_negative_str = $('.num-negative-' + data.id);
          var num_of_negative = parseInt(num_of_negative_str.html()) - 1;
          num_of_negative_str.html(num_of_negative);
          $('.post-id-' + data.id).show();
          $('.negative-id-' + data.id).hide();
          $('.positive-id-' + data.id).hide();
          break;
      }
    });
  });
});

/***/ }),

/***/ "./assets/styles/app.scss":
/*!********************************!*\
  !*** ./assets/styles/app.scss ***!
  \********************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
// extracted by mini-css-extract-plugin


/***/ })

},
/******/ __webpack_require__ => { // webpackRuntimeModules
/******/ var __webpack_exec__ = (moduleId) => (__webpack_require__(__webpack_require__.s = moduleId))
/******/ __webpack_require__.O(0, ["vendors-node_modules_symfony_stimulus-bridge_dist_index_js-node_modules_bootstrap_dist_js_boo-08e11b"], () => (__webpack_exec__("./assets/app.js")));
/******/ var __webpack_exports__ = __webpack_require__.O();
/******/ }
]);
//# sourceMappingURL=data:application/json;charset=utf-8;base64,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ZWJwYWNrOi8vLyBcXC5banRdc3giLCJ3ZWJwYWNrOi8vLy4vYXNzZXRzL2NvbnRyb2xsZXJzLmpzb24iLCJ3ZWJwYWNrOi8vLy4vYXNzZXRzL2FwcC5qcyIsIndlYnBhY2s6Ly8vLi9hc3NldHMvYm9vdHN0cmFwLmpzIiwid2VicGFjazovLy8uL2Fzc2V0cy9qYXZhc2NyaXB0L3Bvc3RfYW5zd2VyLmpzIiwid2VicGFjazovLy8uL2Fzc2V0cy9qYXZhc2NyaXB0L3Bvc3Rfb3Bpbmlvbi5qcyIsIndlYnBhY2s6Ly8vLi9hc3NldHMvc3R5bGVzL2FwcC5zY3NzPzhmNTkiXSwic291cmNlc0NvbnRlbnQiOlsiZnVuY3Rpb24gd2VicGFja0VtcHR5Q29udGV4dChyZXEpIHtcblx0dmFyIGUgPSBuZXcgRXJyb3IoXCJDYW5ub3QgZmluZCBtb2R1bGUgJ1wiICsgcmVxICsgXCInXCIpO1xuXHRlLmNvZGUgPSAnTU9EVUxFX05PVF9GT1VORCc7XG5cdHRocm93IGU7XG59XG53ZWJwYWNrRW1wdHlDb250ZXh0LmtleXMgPSAoKSA9PiAoW10pO1xud2VicGFja0VtcHR5Q29udGV4dC5yZXNvbHZlID0gd2VicGFja0VtcHR5Q29udGV4dDtcbndlYnBhY2tFbXB0eUNvbnRleHQuaWQgPSBcIi4vYXNzZXRzL2NvbnRyb2xsZXJzIHN5bmMgcmVjdXJzaXZlIC4vbm9kZV9tb2R1bGVzL0BzeW1mb255L3N0aW11bHVzLWJyaWRnZS9sYXp5LWNvbnRyb2xsZXItbG9hZGVyLmpzISBcXFxcLltqdF1zeD8kXCI7XG5tb2R1bGUuZXhwb3J0cyA9IHdlYnBhY2tFbXB0eUNvbnRleHQ7IiwiZXhwb3J0IGRlZmF1bHQge1xufTsiLCIvKlxuICogV2VsY29tZSB0byB5b3VyIGFwcCdzIG1haW4gSmF2YVNjcmlwdCBmaWxlIVxuICpcbiAqIFdlIHJlY29tbWVuZCBpbmNsdWRpbmcgdGhlIGJ1aWx0IHZlcnNpb24gb2YgdGhpcyBKYXZhU2NyaXB0IGZpbGVcbiAqIChhbmQgaXRzIENTUyBmaWxlKSBpbiB5b3VyIGJhc2UgbGF5b3V0IChiYXNlLmh0bWwudHdpZykuXG4gKi9cblxuLy8gYW55IENTUyB5b3UgaW1wb3J0IHdpbGwgb3V0cHV0IGludG8gYSBzaW5nbGUgY3NzIGZpbGUgKGFwcC5jc3MgaW4gdGhpcyBjYXNlKVxuaW1wb3J0ICcuL3N0eWxlcy9hcHAuc2Nzcyc7XG5cbi8vIHN0YXJ0IHRoZSBTdGltdWx1cyBhcHBsaWNhdGlvblxuaW1wb3J0ICcuL2Jvb3RzdHJhcCc7XG5cbmltcG9ydCAnYm9vdHN0cmFwJztcblxuLy9KYXZhU2NyaXB0XG5pbXBvcnQgJy4vamF2YXNjcmlwdC9wb3N0X29waW5pb24uanMnO1xuaW1wb3J0ICcuL2phdmFzY3JpcHQvcG9zdF9hbnN3ZXIuanMnO1xuXG5cbiIsImltcG9ydCB7IHN0YXJ0U3RpbXVsdXNBcHAgfSBmcm9tICdAc3ltZm9ueS9zdGltdWx1cy1icmlkZ2UnO1xuXG4vLyBSZWdpc3RlcnMgU3RpbXVsdXMgY29udHJvbGxlcnMgZnJvbSBjb250cm9sbGVycy5qc29uIGFuZCBpbiB0aGUgY29udHJvbGxlcnMvIGRpcmVjdG9yeVxuZXhwb3J0IGNvbnN0IGFwcCA9IHN0YXJ0U3RpbXVsdXNBcHAocmVxdWlyZS5jb250ZXh0KFxuICAgICdAc3ltZm9ueS9zdGltdWx1cy1icmlkZ2UvbGF6eS1jb250cm9sbGVyLWxvYWRlciEuL2NvbnRyb2xsZXJzJyxcbiAgICB0cnVlLFxuICAgIC9cXC5banRdc3g/JC9cbikpO1xuXG4vLyByZWdpc3RlciBhbnkgY3VzdG9tLCAzcmQgcGFydHkgY29udHJvbGxlcnMgaGVyZVxuLy8gYXBwLnJlZ2lzdGVyKCdzb21lX2NvbnRyb2xsZXJfbmFtZScsIFNvbWVJbXBvcnRlZENvbnRyb2xsZXIpO1xuIiwiLy9EaXNwbGF5IGZvcm0gZm9yIGFkZCBjb21tZW50IGFmdGVyIGNsaWNrIGFuZCBzZXQgaWQgb2YgcGFyZW50IHBvc3RcblxuJChmdW5jdGlvbigpe1xuICAgICQoJy5naXZlLWFuc3dlcicpLm9uKCdjbGljaycsIGZ1bmN0aW9uKCkge1xuICAgICAgICB2YXIgaWQ9JCh0aGlzKS5hdHRyKCdpZCcpO1xuXG4gICAgICAgICQoJy5hbnN3ZXItcG9zdC1pZC0nICsgaWQpLnNob3coKTtcblxuICAgICAgICByZXM9JCgnLmlucHV0LWlkLScgK2lkKS5maW5kKCcjY3JlYXRlX3Bvc3RfcGFyZW50SUQnKS52YWwoaWQpO1xuICAgICAgXG4gICAgfSk7XG5cbn0pO1xuIiwiJChmdW5jdGlvbigpe1xuXG4gICAgJCgnLnVzZXJQb3NpdGl2ZVBvc3QnKS5zaG93KCk7XG4gICAgJCgnLnVzZXJOZWdhdGl2ZVBvc3QnKS5zaG93KCk7XG4gICAgJCgnLm5vQWN0aW9uJykuc2hvdygpO1xuXG4gICAgJCgnLnRvb2dsZS1vcGluaW9uJykub24oJ2NsaWNrJywgZnVuY3Rpb24oZXZlbnQpIHtcbiAgICAgICAgZXZlbnQucHJldmVudERlZmF1bHQoKTtcbiAgICAgICAgdmFyICRsaW5rPSQoZXZlbnQuY3VycmVudFRhcmdldCk7XG4gICAgICAgICQuYWpheCh7XG4gICAgICAgICAgICBtZXRob2Q6ICdQT1NUJyxcbiAgICAgICAgICAgIHVybDogJGxpbmsuYXR0cignaHJlZicpXG4gICAgICAgIH0pLmRvbmUoZnVuY3Rpb24oZGF0YSl7XG4gICAgICAgICAgICBzd2l0Y2goZGF0YS5hY3Rpb24pXG4gICAgICAgICAgICB7XG4gICAgICAgICAgICAgICAgY2FzZSAncG9zaXRpdmUnOlxuICAgICAgICAgICAgICAgIHZhciBudW1fb2ZfcG9zaXRpdmVfc3RyID0gJCgnLm51bS1wb3NpdGl2ZS0nICsgZGF0YS5pZCk7XG4gICAgICAgICAgICAgICAgdmFyIG51bV9vZl9wb3NpdGl2ZSA9IHBhcnNlSW50KCBudW1fb2ZfcG9zaXRpdmVfc3RyLmh0bWwoKSkrMTtcbiAgICAgICAgICAgICAgICBudW1fb2ZfcG9zaXRpdmVfc3RyLmh0bWwobnVtX29mX3Bvc2l0aXZlKTtcbiAgICAgICAgICAgICAgICAkKCcucG9zaXRpdmUtaWQtJytkYXRhLmlkKS5zaG93KCk7XG4gICAgICAgICAgICAgICAgJCgnLm5lZ2F0aXZlLWlkLScrZGF0YS5pZCkuaGlkZSgpO1xuICAgICAgICAgICAgICAgICQoJy5wb3N0LWlkLScrZGF0YS5pZCkuaGlkZSgpO1xuICAgICAgICAgICAgICAgIGJyZWFrO1xuXG4gICAgICAgICAgICAgICAgY2FzZSAnbmVnYXRpdmUnOlxuICAgICAgICAgICAgICAgIHZhciBudW1fb2ZfbmVnYXRpdmVfc3RyID0gJCgnLm51bS1uZWdhdGl2ZS0nICsgZGF0YS5pZCk7XG4gICAgICAgICAgICAgICAgdmFyIG51bV9vZl9uZWdhdGl2ZSA9IHBhcnNlSW50KCBudW1fb2ZfbmVnYXRpdmVfc3RyLmh0bWwoKSkrMTtcbiAgICAgICAgICAgICAgICBudW1fb2ZfbmVnYXRpdmVfc3RyLmh0bWwobnVtX29mX25lZ2F0aXZlKTtcbiAgICAgICAgICAgICAgICAkKCcubmVnYXRpdmUtaWQtJytkYXRhLmlkKS5zaG93KCk7XG4gICAgICAgICAgICAgICAgJCgnLnBvc2l0aXZlLWlkLScrZGF0YS5pZCkuaGlkZSgpO1xuICAgICAgICAgICAgICAgICQoJy5wb3N0LWlkLScrZGF0YS5pZCkuaGlkZSgpO1xuICAgICAgICAgICAgICAgIGJyZWFrO1xuXG4gICAgICAgICAgICAgICAgY2FzZSAnY2xpY2stdG8tYmFjay1wb3NpdGl2ZSc6XG4gICAgICAgICAgICAgICAgdmFyIG51bV9vZl9wb3NpdGl2ZV9zdHIgPSAkKCcubnVtLXBvc2l0aXZlLScgKyBkYXRhLmlkKTtcbiAgICAgICAgICAgICAgICB2YXIgbnVtX29mX3Bvc2l0aXZlID0gcGFyc2VJbnQoIG51bV9vZl9wb3NpdGl2ZV9zdHIuaHRtbCgpKS0xO1xuICAgICAgICAgICAgICAgIG51bV9vZl9wb3NpdGl2ZV9zdHIuaHRtbChudW1fb2ZfcG9zaXRpdmUpO1xuICAgICAgICAgICAgICAgICQoJy5wb3N0LWlkLScrZGF0YS5pZCkuc2hvdygpO1xuICAgICAgICAgICAgICAgICQoJy5uZWdhdGl2ZS1pZC0nK2RhdGEuaWQpLmhpZGUoKTtcbiAgICAgICAgICAgICAgICAkKCcucG9zaXRpdmUtaWQtJytkYXRhLmlkKS5oaWRlKCk7XG4gICAgICAgICAgICAgICAgYnJlYWs7XG5cbiAgICAgICAgICAgICAgICBjYXNlICdjbGljay10by1iYWNrLW5lZ2F0aXZlJzpcbiAgICAgICAgICAgICAgICB2YXIgbnVtX29mX25lZ2F0aXZlX3N0ciA9ICQoJy5udW0tbmVnYXRpdmUtJyArIGRhdGEuaWQpO1xuICAgICAgICAgICAgICAgIHZhciBudW1fb2ZfbmVnYXRpdmUgPSBwYXJzZUludCggbnVtX29mX25lZ2F0aXZlX3N0ci5odG1sKCkpLTE7XG4gICAgICAgICAgICAgICAgbnVtX29mX25lZ2F0aXZlX3N0ci5odG1sKG51bV9vZl9uZWdhdGl2ZSk7XG4gICAgICAgICAgICAgICAgJCgnLnBvc3QtaWQtJytkYXRhLmlkKS5zaG93KCk7XG4gICAgICAgICAgICAgICAgJCgnLm5lZ2F0aXZlLWlkLScrZGF0YS5pZCkuaGlkZSgpO1xuICAgICAgICAgICAgICAgICQoJy5wb3NpdGl2ZS1pZC0nK2RhdGEuaWQpLmhpZGUoKTtcbiAgICAgICAgICAgICAgICBicmVhaztcblxuICAgICAgICAgICAgfVxuICAgICAgICB9KVxuICAgIH0pO1xufSk7IiwiLy8gZXh0cmFjdGVkIGJ5IG1pbmktY3NzLWV4dHJhY3QtcGx1Z2luXG5leHBvcnQge307Il0sIm5hbWVzIjpbInN0YXJ0U3RpbXVsdXNBcHAiLCJhcHAiLCJyZXF1aXJlIiwiY29udGV4dCIsIiQiLCJvbiIsImlkIiwiYXR0ciIsInNob3ciLCJyZXMiLCJmaW5kIiwidmFsIiwiZXZlbnQiLCJwcmV2ZW50RGVmYXVsdCIsIiRsaW5rIiwiY3VycmVudFRhcmdldCIsImFqYXgiLCJtZXRob2QiLCJ1cmwiLCJkb25lIiwiZGF0YSIsImFjdGlvbiIsIm51bV9vZl9wb3NpdGl2ZV9zdHIiLCJudW1fb2ZfcG9zaXRpdmUiLCJwYXJzZUludCIsImh0bWwiLCJoaWRlIiwibnVtX29mX25lZ2F0aXZlX3N0ciIsIm51bV9vZl9uZWdhdGl2ZSJdLCJzb3VyY2VSb290IjoiIn0=