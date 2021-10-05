/*
 * ATTENTION: The "eval" devtool has been used (maybe by default in mode: "development").
 * This devtool is not neither made for production nor for readable output files.
 * It uses "eval()" calls to create a separate source file in the browser devtools.
 * If you are trying to read the output file, select a different devtool (https://webpack.js.org/configuration/devtool/)
 * or disable the default devtool with "devtool: false".
 * If you are looking for production-ready output files, see mode: "production" (https://webpack.js.org/configuration/mode/).
 */
/******/ (function() { // webpackBootstrap
/******/ 	var __webpack_modules__ = ({

/***/ "./node_modules/@babel/runtime/helpers/arrayLikeToArray.js":
/*!*****************************************************************!*\
  !*** ./node_modules/@babel/runtime/helpers/arrayLikeToArray.js ***!
  \*****************************************************************/
/***/ (function(module) {

eval("function _arrayLikeToArray(arr, len) {\n  if (len == null || len > arr.length) len = arr.length;\n\n  for (var i = 0, arr2 = new Array(len); i < len; i++) {\n    arr2[i] = arr[i];\n  }\n\n  return arr2;\n}\n\nmodule.exports = _arrayLikeToArray;\n\n//# sourceURL=webpack://hopes/./node_modules/@babel/runtime/helpers/arrayLikeToArray.js?");

/***/ }),

/***/ "./node_modules/@babel/runtime/helpers/arrayWithoutHoles.js":
/*!******************************************************************!*\
  !*** ./node_modules/@babel/runtime/helpers/arrayWithoutHoles.js ***!
  \******************************************************************/
/***/ (function(module, __unused_webpack_exports, __webpack_require__) {

eval("var arrayLikeToArray = __webpack_require__(/*! ./arrayLikeToArray */ \"./node_modules/@babel/runtime/helpers/arrayLikeToArray.js\");\n\nfunction _arrayWithoutHoles(arr) {\n  if (Array.isArray(arr)) return arrayLikeToArray(arr);\n}\n\nmodule.exports = _arrayWithoutHoles;\n\n//# sourceURL=webpack://hopes/./node_modules/@babel/runtime/helpers/arrayWithoutHoles.js?");

/***/ }),

/***/ "./node_modules/@babel/runtime/helpers/classCallCheck.js":
/*!***************************************************************!*\
  !*** ./node_modules/@babel/runtime/helpers/classCallCheck.js ***!
  \***************************************************************/
/***/ (function(module) {

eval("function _classCallCheck(instance, Constructor) {\n  if (!(instance instanceof Constructor)) {\n    throw new TypeError(\"Cannot call a class as a function\");\n  }\n}\n\nmodule.exports = _classCallCheck;\n\n//# sourceURL=webpack://hopes/./node_modules/@babel/runtime/helpers/classCallCheck.js?");

/***/ }),

/***/ "./node_modules/@babel/runtime/helpers/createClass.js":
/*!************************************************************!*\
  !*** ./node_modules/@babel/runtime/helpers/createClass.js ***!
  \************************************************************/
/***/ (function(module) {

eval("function _defineProperties(target, props) {\n  for (var i = 0; i < props.length; i++) {\n    var descriptor = props[i];\n    descriptor.enumerable = descriptor.enumerable || false;\n    descriptor.configurable = true;\n    if (\"value\" in descriptor) descriptor.writable = true;\n    Object.defineProperty(target, descriptor.key, descriptor);\n  }\n}\n\nfunction _createClass(Constructor, protoProps, staticProps) {\n  if (protoProps) _defineProperties(Constructor.prototype, protoProps);\n  if (staticProps) _defineProperties(Constructor, staticProps);\n  return Constructor;\n}\n\nmodule.exports = _createClass;\n\n//# sourceURL=webpack://hopes/./node_modules/@babel/runtime/helpers/createClass.js?");

/***/ }),

/***/ "./node_modules/@babel/runtime/helpers/defineProperty.js":
/*!***************************************************************!*\
  !*** ./node_modules/@babel/runtime/helpers/defineProperty.js ***!
  \***************************************************************/
/***/ (function(module) {

eval("function _defineProperty(obj, key, value) {\n  if (key in obj) {\n    Object.defineProperty(obj, key, {\n      value: value,\n      enumerable: true,\n      configurable: true,\n      writable: true\n    });\n  } else {\n    obj[key] = value;\n  }\n\n  return obj;\n}\n\nmodule.exports = _defineProperty;\n\n//# sourceURL=webpack://hopes/./node_modules/@babel/runtime/helpers/defineProperty.js?");

/***/ }),

/***/ "./node_modules/@babel/runtime/helpers/interopRequireDefault.js":
/*!**********************************************************************!*\
  !*** ./node_modules/@babel/runtime/helpers/interopRequireDefault.js ***!
  \**********************************************************************/
/***/ (function(module) {

eval("function _interopRequireDefault(obj) {\n  return obj && obj.__esModule ? obj : {\n    \"default\": obj\n  };\n}\n\nmodule.exports = _interopRequireDefault;\n\n//# sourceURL=webpack://hopes/./node_modules/@babel/runtime/helpers/interopRequireDefault.js?");

/***/ }),

/***/ "./node_modules/@babel/runtime/helpers/iterableToArray.js":
/*!****************************************************************!*\
  !*** ./node_modules/@babel/runtime/helpers/iterableToArray.js ***!
  \****************************************************************/
/***/ (function(module) {

eval("function _iterableToArray(iter) {\n  if (typeof Symbol !== \"undefined\" && Symbol.iterator in Object(iter)) return Array.from(iter);\n}\n\nmodule.exports = _iterableToArray;\n\n//# sourceURL=webpack://hopes/./node_modules/@babel/runtime/helpers/iterableToArray.js?");

/***/ }),

/***/ "./node_modules/@babel/runtime/helpers/nonIterableSpread.js":
/*!******************************************************************!*\
  !*** ./node_modules/@babel/runtime/helpers/nonIterableSpread.js ***!
  \******************************************************************/
/***/ (function(module) {

eval("function _nonIterableSpread() {\n  throw new TypeError(\"Invalid attempt to spread non-iterable instance.\\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method.\");\n}\n\nmodule.exports = _nonIterableSpread;\n\n//# sourceURL=webpack://hopes/./node_modules/@babel/runtime/helpers/nonIterableSpread.js?");

/***/ }),

/***/ "./node_modules/@babel/runtime/helpers/toConsumableArray.js":
/*!******************************************************************!*\
  !*** ./node_modules/@babel/runtime/helpers/toConsumableArray.js ***!
  \******************************************************************/
/***/ (function(module, __unused_webpack_exports, __webpack_require__) {

eval("var arrayWithoutHoles = __webpack_require__(/*! ./arrayWithoutHoles */ \"./node_modules/@babel/runtime/helpers/arrayWithoutHoles.js\");\n\nvar iterableToArray = __webpack_require__(/*! ./iterableToArray */ \"./node_modules/@babel/runtime/helpers/iterableToArray.js\");\n\nvar unsupportedIterableToArray = __webpack_require__(/*! ./unsupportedIterableToArray */ \"./node_modules/@babel/runtime/helpers/unsupportedIterableToArray.js\");\n\nvar nonIterableSpread = __webpack_require__(/*! ./nonIterableSpread */ \"./node_modules/@babel/runtime/helpers/nonIterableSpread.js\");\n\nfunction _toConsumableArray(arr) {\n  return arrayWithoutHoles(arr) || iterableToArray(arr) || unsupportedIterableToArray(arr) || nonIterableSpread();\n}\n\nmodule.exports = _toConsumableArray;\n\n//# sourceURL=webpack://hopes/./node_modules/@babel/runtime/helpers/toConsumableArray.js?");

/***/ }),

/***/ "./node_modules/@babel/runtime/helpers/unsupportedIterableToArray.js":
/*!***************************************************************************!*\
  !*** ./node_modules/@babel/runtime/helpers/unsupportedIterableToArray.js ***!
  \***************************************************************************/
/***/ (function(module, __unused_webpack_exports, __webpack_require__) {

eval("var arrayLikeToArray = __webpack_require__(/*! ./arrayLikeToArray */ \"./node_modules/@babel/runtime/helpers/arrayLikeToArray.js\");\n\nfunction _unsupportedIterableToArray(o, minLen) {\n  if (!o) return;\n  if (typeof o === \"string\") return arrayLikeToArray(o, minLen);\n  var n = Object.prototype.toString.call(o).slice(8, -1);\n  if (n === \"Object\" && o.constructor) n = o.constructor.name;\n  if (n === \"Map\" || n === \"Set\") return Array.from(o);\n  if (n === \"Arguments\" || /^(?:Ui|I)nt(?:8|16|32)(?:Clamped)?Array$/.test(n)) return arrayLikeToArray(o, minLen);\n}\n\nmodule.exports = _unsupportedIterableToArray;\n\n//# sourceURL=webpack://hopes/./node_modules/@babel/runtime/helpers/unsupportedIterableToArray.js?");

/***/ }),

/***/ "./src/donation-form.js":
/*!******************************!*\
  !*** ./src/donation-form.js ***!
  \******************************/
/***/ (function(module, __unused_webpack_exports, __webpack_require__) {

"use strict";
eval("\n\nvar _interopRequireDefault = __webpack_require__(/*! @babel/runtime/helpers/interopRequireDefault */ \"./node_modules/@babel/runtime/helpers/interopRequireDefault.js\");\n\nvar _classCallCheck2 = _interopRequireDefault(__webpack_require__(/*! @babel/runtime/helpers/classCallCheck */ \"./node_modules/@babel/runtime/helpers/classCallCheck.js\"));\n\nvar _createClass2 = _interopRequireDefault(__webpack_require__(/*! @babel/runtime/helpers/createClass */ \"./node_modules/@babel/runtime/helpers/createClass.js\"));\n\nvar _defineProperty2 = _interopRequireDefault(__webpack_require__(/*! @babel/runtime/helpers/defineProperty */ \"./node_modules/@babel/runtime/helpers/defineProperty.js\"));\n\nvar _helpers = __webpack_require__(/*! ./helpers */ \"./src/helpers.js\");\n\nvar _fieldValidate = _interopRequireDefault(__webpack_require__(/*! ./libs/field-validate */ \"./src/libs/field-validate.js\"));\n\n/**\r\n * Donation form \r\n * \r\n */\nvar HopesDonationForm_Default = /*#__PURE__*/function () {\n  function HopesDonationForm_Default($form) {\n    (0, _classCallCheck2[\"default\"])(this, HopesDonationForm_Default);\n    (0, _defineProperty2[\"default\"])(this, \"loggedIn\", false);\n    (0, _defineProperty2[\"default\"])(this, \"causeId\", 0);\n    (0, _defineProperty2[\"default\"])(this, \"currentAmount\", null);\n    (0, _defineProperty2[\"default\"])(this, \"currentStep\", 0);\n    (0, _defineProperty2[\"default\"])(this, \"paymentMethod\", {});\n    (0, _defineProperty2[\"default\"])(this, \"donorInfomation\", {\n      firstName: '',\n      lastName: '',\n      email: ''\n    });\n    this.$form = $form;\n    this.$amountField = $form.find('input[name=donation-amount]');\n    this.loggedIn = parseInt($form.find('input[name=donor-logged-in]').val());\n    this.causeId = $form.find('input[name=cause-id]').val();\n    this.amountFieldTriggerOnChange();\n    this.pickAmountHandle();\n    this.nextStepHandle();\n  }\n\n  (0, _createClass2[\"default\"])(HopesDonationForm_Default, [{\n    key: \"amountFieldTriggerOnChange\",\n    value: function amountFieldTriggerOnChange() {\n      var _this = this;\n\n      this.$amountField.on('change', function (e) {\n        var currentValue = e.target.value;\n\n        _this.$amountField.val((0, _helpers.hopes_price_format)(currentValue)); // set amount\n\n\n        _this.currentAmount = parseFloat(currentValue);\n      });\n    }\n  }, {\n    key: \"pickAmountHandle\",\n    value: function pickAmountHandle() {\n      var self = this;\n      var customEventChange = new CustomEvent('change');\n      this.$form.on('change', 'input[name=donation-amount-select]', function (e) {\n        var value = e.target.value;\n\n        if (value == 'custom-amount') {\n          self.$amountField.val((0, _helpers.hopes_price_format)('')).focus();\n        } else {\n          self.$amountField.val(value).trigger('change');\n          self.$amountField[0].dispatchEvent(customEventChange);\n        }\n      });\n    }\n  }, {\n    key: \"stepValidate\",\n    value: function stepValidate() {\n      var self = this;\n      return [// Step 1 (donor infomation)\n      function () {\n        var pass = [];\n        self.$form.find('.hopes-form--first-step *[data-validate]').each(function (index, field) {\n          var _pass = (0, _fieldValidate[\"default\"])(field);\n\n          if (_pass != true) {\n            pass.push(_pass);\n          }\n        });\n        return pass.length ? pass : true;\n      }, // Step 2 (select payment method)\n      function () {}];\n    }\n  }, {\n    key: \"activeStepHandle\",\n    value: function activeStepHandle() {\n      var activeStep = this.currentStep;\n      this.$form.find(\".hopes-form--step-\".concat(activeStep)).addClass('hopes-form__step--active').siblings().removeClass('hopes-form__step--active');\n    }\n  }, {\n    key: \"nextStepHandle\",\n    value: function nextStepHandle() {\n      var self = this;\n      var $nextStepButton = this.$form.find('.donation-button-continue');\n      $nextStepButton.on('click', function (e) {\n        e.preventDefault();\n        var pass = self.stepValidate()[self.currentStep].call();\n\n        if (pass == true) {\n          self.currentStep += 1;\n          self.activeStepHandle();\n        }\n      });\n    }\n  }]);\n  return HopesDonationForm_Default;\n}();\n\n;\n\n(function (w, $) {\n  'use strict';\n\n  w.donationFormsAvailable = [];\n  $(function () {\n    $('form.donation-form.donation-form__default-handle').each(function (index, form) {\n      var donationForm = new HopesDonationForm_Default($(form));\n      w.donationFormsAvailable.push(donationForm);\n    });\n  });\n})(window, jQuery);\n\nmodule.exports = {};\n\n//# sourceURL=webpack://hopes/./src/donation-form.js?");

/***/ }),

/***/ "./src/helpers.js":
/*!************************!*\
  !*** ./src/helpers.js ***!
  \************************/
/***/ (function(__unused_webpack_module, exports, __webpack_require__) {

"use strict";
eval("\n\nvar _interopRequireDefault = __webpack_require__(/*! @babel/runtime/helpers/interopRequireDefault */ \"./node_modules/@babel/runtime/helpers/interopRequireDefault.js\");\n\nObject.defineProperty(exports, \"__esModule\", ({\n  value: true\n}));\nexports.hopes_pagination_render = hopes_pagination_render;\nexports.hopes_price_format = hopes_price_format;\n\nvar _toConsumableArray2 = _interopRequireDefault(__webpack_require__(/*! @babel/runtime/helpers/toConsumableArray */ \"./node_modules/@babel/runtime/helpers/toConsumableArray.js\"));\n\n/**\r\n * Helpers \r\n * \r\n */\nfunction hopes_pagination_render(el, params, _callback) {\n  var $wrap = jQuery(el);\n  if ($wrap.length <= 0) return;\n  var args = {\n    dataSource: (0, _toConsumableArray2[\"default\"])(Array(params.total).keys()),\n    pageSize: params.items_per_page,\n    pageNumber: params.current_page,\n    autoHidePrevious: true,\n    autoHideNext: true,\n    callback: function callback(data, pagination) {\n      // console.log( pagination )\n      if (_callback) _callback.call(null, {\n        data: data,\n        pagination: pagination\n      });\n    }\n  };\n  $wrap.empty();\n  $wrap.pagination(args);\n}\n\nfunction hopes_price_format() {\n  var num = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : 0;\n  var digits = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : 2;\n  return Number.parseFloat(num).toFixed(digits);\n}\n\n//# sourceURL=webpack://hopes/./src/helpers.js?");

/***/ }),

/***/ "./src/libs/field-validate.js":
/*!************************************!*\
  !*** ./src/libs/field-validate.js ***!
  \************************************/
/***/ (function(__unused_webpack_module, exports) {

"use strict";
eval("\n\nObject.defineProperty(exports, \"__esModule\", ({\n  value: true\n}));\nexports.default = HopesFieldValidate;\n\nfunction HopesFieldValidate(field) {\n  var value = field.value;\n  var validateTypes = field.dataset.validate.split(',');\n  var invalid = [];\n  var actions = {};\n  var wrapper = document.createElement('DIV');\n  wrapper.classList.add('hopes-validate-field');\n  field.parentNode.insertBefore(wrapper, field);\n  wrapper.appendChild(field);\n\n  var validateEmail = function validateEmail(email) {\n    var re = /^(([^<>()[\\]\\\\.,;:\\s@\\\"]+(\\.[^<>()[\\]\\\\.,;:\\s@\\\"]+)*)|(\\\".+\\\"))@((\\[[0-9]{1,3}\\.[0-9]{1,3}\\.[0-9]{1,3}\\.[0-9]{1,3}\\])|(([a-zA-Z\\-0-9]+\\.)+[a-zA-Z]{2,}))$/;\n    return re.test(email);\n  };\n\n  validateTypes.forEach(function (type) {\n    switch (type) {\n      case 'not-empty':\n        if (!value.trim()) {\n          invalid.push({\n            type: type,\n            message: 'This field is required.'\n          });\n        }\n\n        break;\n\n      case 'number':\n        if (typeof (value - 0) !== 'number') {\n          invalid.push({\n            type: type,\n            message: 'This field is number format.'\n          });\n        }\n\n        break;\n\n      case 'email':\n        if (!validateEmail(value)) {\n          invalid.push({\n            type: type,\n            message: 'This field is email format.'\n          });\n        }\n\n        break;\n\n      default:\n        pass = true;\n    }\n  });\n\n  actions.isInvalid = function () {\n    return invalid.length ? true : false;\n  };\n\n  if (actions.isInvalid()) {\n    wrapper.classList.add('__invalid');\n  } else {\n    wrapper.classList.remove('__invalid');\n  }\n\n  field.addEventListener('change', function (e) {\n    wrapper.classList.remove('__invalid');\n  });\n  var isInvalid = invalid.length > 0 ? true : false;\n  return isInvalid ? {\n    pass: false,\n    field: field,\n    wrapper: wrapper,\n    invalid: invalid,\n    actions: actions\n  } : true;\n}\n\n//# sourceURL=webpack://hopes/./src/libs/field-validate.js?");

/***/ }),

/***/ "./src/scss/main.scss":
/*!****************************!*\
  !*** ./src/scss/main.scss ***!
  \****************************/
/***/ (function(__unused_webpack_module, __webpack_exports__, __webpack_require__) {

"use strict";
eval("__webpack_require__.r(__webpack_exports__);\n// extracted by mini-css-extract-plugin\n\n\n//# sourceURL=webpack://hopes/./src/scss/main.scss?");

/***/ })

/******/ 	});
/************************************************************************/
/******/ 	// The module cache
/******/ 	var __webpack_module_cache__ = {};
/******/ 	
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/ 		// Check if module is in cache
/******/ 		if(__webpack_module_cache__[moduleId]) {
/******/ 			return __webpack_module_cache__[moduleId].exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = __webpack_module_cache__[moduleId] = {
/******/ 			// no module.id needed
/******/ 			// no module.loaded needed
/******/ 			exports: {}
/******/ 		};
/******/ 	
/******/ 		// Execute the module function
/******/ 		__webpack_modules__[moduleId](module, module.exports, __webpack_require__);
/******/ 	
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/ 	
/************************************************************************/
/******/ 	/* webpack/runtime/make namespace object */
/******/ 	!function() {
/******/ 		// define __esModule on exports
/******/ 		__webpack_require__.r = function(exports) {
/******/ 			if(typeof Symbol !== 'undefined' && Symbol.toStringTag) {
/******/ 				Object.defineProperty(exports, Symbol.toStringTag, { value: 'Module' });
/******/ 			}
/******/ 			Object.defineProperty(exports, '__esModule', { value: true });
/******/ 		};
/******/ 	}();
/******/ 	
/************************************************************************/
!function() {
"use strict";
/*!*********************!*\
  !*** ./src/main.js ***!
  \*********************/
eval("\n\n__webpack_require__(/*! ./scss/main.scss */ \"./src/scss/main.scss\");\n\n__webpack_require__(/*! ./donation-form */ \"./src/donation-form.js\");\n\n/**\r\n * Hopes main javascript\r\n * \r\n * @version 1.0.0\r\n * @package Hopes\r\n */\n;\n\n(function (w, $) {\n  'use strict';\n\n  var Ready = function Ready() {};\n  /**\r\n   * DOM Ready\r\n   */\n\n\n  $(Ready);\n})(window, jQuery);\n\n//# sourceURL=webpack://hopes/./src/main.js?");
}();
/******/ })()
;