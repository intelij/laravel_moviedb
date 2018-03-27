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
/******/ 	return __webpack_require__(__webpack_require__.s = 39);
/******/ })
/************************************************************************/
/******/ ({

/***/ 39:
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(40);


/***/ }),

/***/ 40:
/***/ (function(module, exports) {

$(document).ready(function () {
    var vidId;
    $.ajax({
        url: "https://www.googleapis.com/youtube/v3/search?part=snippet" + "&type=video" + "&q=" + $('#title').text() + " " + $('#year').text() + " trailer" + "&maxResults=1" + "&key=AIzaSyDlprtuZ3JC6UD5C8vnzRosF2XIRnQ5d8E",
        type: "GET",
        async: false,
        success: function success(response) {
            vidId = response['items'][0]['id'].videoId;

            $('#player').attr('src', 'http://www.youtube.com/embed/' + vidId);
        },
        error: function error(_error) {
            console.log(_error);
        }
    });

    set_votes($('.rate_widget'));

    $('.ratings_stars').hover(function () {
        $(this).prevAll().addBack().addClass('ratings_vote');
        $(this).nextAll().removeClass('rating_vote');
    }, function () {
        $(this).nextAll().addBack().removeClass('ratings_vote');
    });

    $('.ratings_stars').click(function () {
        var mid = location.pathname.split("/");

        axios.post('/user/rate', {
            'mid': mid[2],
            'rating': $(this).attr('id')
        }).then(function (response) {
            window.location.reload();
        }).catch(function (error) {
            console.log(error);
        });
    });
});

function set_votes(widget) {

    var mid = location.pathname.split("/");

    axios.post('/user/rating', {
        'mid': mid[2]
    }).then(function (response) {
        $(widget).find('#' + response.data).prevAll().addBack().addClass('ratings_vote');
        $(widget).find('#' + response.data).nextAll().removeClass('rating_vote');
    }).catch(function (error) {
        console.log(error);
    });
}

/***/ })

/******/ });