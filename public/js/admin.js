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
/******/ 	return __webpack_require__(__webpack_require__.s = 41);
/******/ })
/************************************************************************/
/******/ ({

/***/ 41:
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(42);


/***/ }),

/***/ 42:
/***/ (function(module, exports) {

$(document).ready(function () {

    $('#sync').click(function (event) {
        event.preventDefault();

        var title = $('#title').text();

        if ($("#title").val().replace(/^\s+|\s+$/g, "").length == 0) {
            alert('The field must not be empty or contain only spaces.');
        } else {
            $.ajax({
                url: "http://www.omdbapi.com/",
                type: "GET",
                data: {
                    'apikey': '8dd0eb03',
                    't': $('#title').val(),
                    'plot': 'full',
                    'r': 'json'
                },
                success: function success(response) {

                    if (response.Response === "True") {
                        syncData(response);
                    } else {
                        alert(response.Error);
                    }
                }

            });
        }
    });

    $('#movieToEdit').on('change', function () {
        var optionSelected = $("option:selected", this);
        var valueSelected = this.value;

        $('#editMovieLink').attr('href', 'movie/' + valueSelected + '/edit');
    });

    $('#editUsers').on('change', function () {
        var optionSelected = $("option:selected", this);
        var valueSelected = this.value;

        $('#editUsersLink').attr('href', 'user/' + valueSelected + '/edit');
    });

    $('#editActor').on('change', function () {
        var optionSelected = $("option:selected", this);
        var valueSelected = this.value;

        $('#editActorLink').attr('href', 'actor/' + valueSelected + '/edit');
    });

    $('#editGenre').on('change', function () {
        var optionSelected = $("option:selected", this);
        var valueSelected = this.value;

        $('#editGenreLink').attr('href', 'genre/' + valueSelected + '/edit');
    });
});

function syncData(data) {
    $.ajax({
        url: "/admin/sync",
        type: "POST",
        data: data,
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function success(response) {
            alert('Movie has been syncronized');
        },
        error: function error(_error) {
            console.log(_error);
        }
    });
}

/***/ })

/******/ });