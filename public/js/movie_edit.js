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
/******/ 			Object.defineProperty(exports, name, {
/******/ 				configurable: false,
/******/ 				enumerable: true,
/******/ 				get: getter
/******/ 			});
/******/ 		}
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
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = 43);
/******/ })
/************************************************************************/
/******/ ({

/***/ 43:
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(44);


/***/ }),

/***/ 44:
/***/ (function(module, exports) {

$(document).ready(function () {
    //remove current actors from all actors select
    $("#current_actors option").each(function () {
        var $this = $(this);
        var val = $this.val();

        $("#actors option").each(function () {
            var $this = $(this);
            if ($this.val() == val) {
                $this.remove();
            }
        });
    });
    //remove current genres from all genres select
    $("#current_genres option").each(function () {
        var $this = $(this);
        var val = $this.val();

        $("#genres option").each(function () {
            var $this = $(this);
            if ($this.val() == val) {
                $this.remove();
            }
        });
    });

    $("#remove_current_actor").click(function (event) {
        event.preventDefault();

        $("#current_actors option:selected").each(function () {
            var $this = $(this);

            $("#actors").append($('<option>', { value: $this.val(), text: $this.text() }));
        });

        $('#current_actors option:selected').remove();
    });

    $("#add_current_actor").click(function (event) {
        event.preventDefault();

        $("#actors option:selected").each(function () {
            var $this = $(this);

            $("#current_actors").append($('<option>', { value: $this.val(), text: $this.text() }));
        });

        $('#actors option:selected').remove();
    });

    $("#remove_current_genre").click(function (event) {
        event.preventDefault();

        $("#current_genres option:selected").each(function () {
            var $this = $(this);

            $("#genres").append($('<option>', { value: $this.val(), text: $this.text() }));
        });

        $('#current_genres option:selected').remove();
    });

    $("#add_current_genre").click(function (event) {
        event.preventDefault();

        $("#genres option:selected").each(function () {
            var $this = $(this);

            $("#current_genres").append($('<option>', { value: $this.val(), text: $this.text() }));
        });

        $('#genres option:selected').remove();
    });

    $("form").submit(function () {
        $("#current_actors option").each(function () {
            var $this = $(this);

            $this.prop('selected', true);
        });

        $("#current_genres option").each(function () {
            var $this = $(this);

            $this.prop('selected', true);
        });
    });
});

/***/ })

/******/ });