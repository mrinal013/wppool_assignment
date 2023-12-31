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
/******/ 	return __webpack_require__(__webpack_require__.s = "./admin/assets/js/projects.js");
/******/ })
/************************************************************************/
/******/ ({

/***/ "./admin/assets/js/projects.js":
/*!*************************************!*\
  !*** ./admin/assets/js/projects.js ***!
  \*************************************/
/*! no static exports found */
/***/ (function(module, exports) {

eval("jQuery(document).ready(function ($) {\n  $(document).on('click', '#add_gallery_single_row .add', function (e) {\n    let media_uploader = wp.media({\n      frame: \"post\",\n      state: \"insert\",\n      library: {\n        type: 'image'\n      },\n      multiple: true,\n      editable: false,\n      allowLocalEdits: true,\n      displaySettings: true,\n      displayUserSettings: true\n    });\n    media_uploader.on(\"insert\", function () {\n      let length = media_uploader.state().get(\"selection\").length;\n      let images = media_uploader.state().get(\"selection\").models;\n      for (let i = 0; i < length; i++) {\n        let image_url = images[i].changed.url;\n        let box = $('#master_box').html();\n        $(box).appendTo('#img_box_container');\n        let element = jQuery('#img_box_container .gallery_single_row:last-child').find('.image_container');\n        let html = '<img class=\"gallery_img_img\" src=\"' + image_url + '\" height=\"auto\" width=\"100%\" />';\n        element.append(html);\n        element.find('.meta_image_url').val(image_url);\n      }\n    });\n    // media_uploader.open();\n    media_uploader.on('open', function () {\n      var selection = media_uploader.state().get('selection');\n      var ids = [];\n      $('#gallery_wrapper #img_box_container .gallery_single_row').each(function (i, obj) {\n        let id = $(this).find('.meta_image_url').val();\n        // console.log(id)\n        ids.push(id);\n        // let attachment = wp.media.attachment(id);\n        // attachment.fetch();\n        // selection.add( id ? [ id ] : [] );\n      });\n      // var selected = $('#image-id').val(); // the id of the image\n      // if (selected) {\n      //     selection.add(wp.media.attachment(selected));\n      // }\n      if (ids) {\n        // idsArray = ids.split(',');\n        ids.forEach(function (id) {\n          attachment = wp.media.attachment(id);\n          attachment.fetch();\n          // selection.add( attachment ? [ attachment ] : [] );\n          selection.add(wp.media.attachment(id));\n        });\n      }\n      // }\n    });\n\n    media_uploader.open();\n  }).on('click', '.gallery_area .remove', function () {\n    let parent = $(this).parent().parent();\n    parent.remove();\n  });\n});\n\n//# sourceURL=webpack:///./admin/assets/js/projects.js?");

/***/ })

/******/ });