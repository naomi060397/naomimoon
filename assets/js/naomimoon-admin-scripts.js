/******/ (function(modules) { // webpackBootstrap
/******/ 	// The module cache
/******/ 	var installedModules = {};
/******/
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/
/******/ 		// Check if module is in cache
/******/ 		if(installedModules[moduleId]) {
/******/ 			return installedModules[moduleId].exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = installedModules[moduleId] = {
/******/ 			i: moduleId,
/******/ 			l: false,
/******/ 			exports: {}
/******/ 		};
/******/
/******/ 		// Execute the module function
/******/ 		modules[moduleId].call(module.exports, module, module.exports, __webpack_require__);
/******/
/******/ 		// Flag the module as loaded
/******/ 		module.l = true;
/******/
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/
/******/
/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = modules;
/******/
/******/ 	// expose the module cache
/******/ 	__webpack_require__.c = installedModules;
/******/
/******/ 	// define getter function for harmony exports
/******/ 	__webpack_require__.d = function(exports, name, getter) {
/******/ 		if(!__webpack_require__.o(exports, name)) {
/******/ 			Object.defineProperty(exports, name, { enumerable: true, get: getter });
/******/ 		}
/******/ 	};
/******/
/******/ 	// define __esModule on exports
/******/ 	__webpack_require__.r = function(exports) {
/******/ 		if(typeof Symbol !== 'undefined' && Symbol.toStringTag) {
/******/ 			Object.defineProperty(exports, Symbol.toStringTag, { value: 'Module' });
/******/ 		}
/******/ 		Object.defineProperty(exports, '__esModule', { value: true });
/******/ 	};
/******/
/******/ 	// create a fake namespace object
/******/ 	// mode & 1: value is a module id, require it
/******/ 	// mode & 2: merge all properties of value into the ns
/******/ 	// mode & 4: return value when already ns object
/******/ 	// mode & 8|1: behave like require
/******/ 	__webpack_require__.t = function(value, mode) {
/******/ 		if(mode & 1) value = __webpack_require__(value);
/******/ 		if(mode & 8) return value;
/******/ 		if((mode & 4) && typeof value === 'object' && value && value.__esModule) return value;
/******/ 		var ns = Object.create(null);
/******/ 		__webpack_require__.r(ns);
/******/ 		Object.defineProperty(ns, 'default', { enumerable: true, value: value });
/******/ 		if(mode & 2 && typeof value != 'string') for(var key in value) __webpack_require__.d(ns, key, function(key) { return value[key]; }.bind(null, key));
/******/ 		return ns;
/******/ 	};
/******/
/******/ 	// getDefaultExport function for compatibility with non-harmony modules
/******/ 	__webpack_require__.n = function(module) {
/******/ 		var getter = module && module.__esModule ?
/******/ 			function getDefault() { return module['default']; } :
/******/ 			function getModuleExports() { return module; };
/******/ 		__webpack_require__.d(getter, 'a', getter);
/******/ 		return getter;
/******/ 	};
/******/
/******/ 	// Object.prototype.hasOwnProperty.call
/******/ 	__webpack_require__.o = function(object, property) { return Object.prototype.hasOwnProperty.call(object, property); };
/******/
/******/ 	// __webpack_public_path__
/******/ 	__webpack_require__.p = "";
/******/
/******/
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = "./src/js/naomimoon-admin-scripts.js");
/******/ })
/************************************************************************/
/******/ ({

/***/ "./src/js/naomimoon-admin-scripts.js":
/*!*******************************************!*\
  !*** ./src/js/naomimoon-admin-scripts.js ***!
  \*******************************************/
/*! no static exports found */
/***/ (function(module, exports) {

jQuery(document).ready(function ($) {
  $('.color-picker').wpColorPicker();
  var rows = document.querySelectorAll('tr');
  rows.forEach(function (row) {
    var label = $(row).find('th').text();
    $(row).find('.wp-color-result-text').text(label);
  });
  $('.myCheckbox').prop('checked', true);
  $(document).on("click", ".options-tab", function () {
    var id = $(this).attr('id');
    $('.options-page').removeClass('active');
    $('.options-tab').removeClass('active');
    $(this).toggleClass('active');
    $('.' + id).toggleClass('active');
  });
  $(document).on("click", "#reset-color-options", function () {
    if (confirm("Are you sure you want to reset to the default color scheme?") == true) {
      $('.color-picker.wp-color-picker').val('');
    } else {
      return false;
    }
  });
  $('.iris-picker-inner').on("mouseover", function () {
    $('.iris-picker-inner').on("mousemove", function () {
      var grad1 = $('.gradient-1').find('.wp-color-result').css("background-color");
      var grad2 = $('.gradient-2').find('.wp-color-result').css("background-color");
      $('.gradient-preview').find('.preview').css('background', 'linear-gradient(90deg, ' + grad1 + ',' + grad2);
    });
  });
  $('.gradient-1').find('input.color-picker').on("input", function () {
    var grad1 = $(this).val();
    var grad2 = $('.gradient-2').find('.wp-color-result').css("background-color");
    $('.gradient-preview').find('.preview').css('background', 'linear-gradient(90deg, ' + grad1 + ',' + grad2);
  });
  $('.gradient-2').find('input.color-picker').on("input", function () {
    var grad2 = $(this).val();
    var grad1 = $('.gradient-1').find('.wp-color-result').css("background-color");
    $('.gradient-preview').find('.preview').css('background', 'linear-gradient(90deg, ' + grad1 + ',' + grad2);
  });
});

/***/ })

/******/ });
//# sourceMappingURL=naomimoon-admin-scripts.js.map