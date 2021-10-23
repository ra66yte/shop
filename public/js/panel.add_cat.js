/*
 * ATTENTION: An "eval-source-map" devtool has been used.
 * This devtool is neither made for production nor for readable output files.
 * It uses "eval()" calls to create a separate source file with attached SourceMaps in the browser devtools.
 * If you are trying to read the output file, select a different devtool (https://webpack.js.org/configuration/devtool/)
 * or disable the default devtool with "devtool: false".
 * If you are looking for production-ready output files, see mode: "production" (https://webpack.js.org/configuration/mode/).
 */
/******/ (() => { // webpackBootstrap
/******/ 	var __webpack_modules__ = ({

/***/ "./resources/js/panel.add_cat.js":
/*!***************************************!*\
  !*** ./resources/js/panel.add_cat.js ***!
  \***************************************/
/***/ (() => {

eval("document.addEventListener('DOMContentLoaded', function () {\n  var title = document.getElementById('title');\n  var alias = document.getElementById('alias');\n  title.addEventListener('input', function () {\n    if (title.value === '') alias.value = '';\n    axios.post(alias.dataset.action, {\n      str: {\n        'alias': title.value\n      }\n    }).then(function (response) {\n      if (response.data.alias) alias.value = (response.data.parent ? response.data.parent + '-' : '') + response.data.alias;\n    });\n  });\n});//# sourceURL=[module]\n//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJzb3VyY2VzIjpbIndlYnBhY2s6Ly8vLi9yZXNvdXJjZXMvanMvcGFuZWwuYWRkX2NhdC5qcz8zNGI2Il0sIm5hbWVzIjpbImRvY3VtZW50IiwiYWRkRXZlbnRMaXN0ZW5lciIsInRpdGxlIiwiZ2V0RWxlbWVudEJ5SWQiLCJhbGlhcyIsInZhbHVlIiwiYXhpb3MiLCJwb3N0IiwiZGF0YXNldCIsImFjdGlvbiIsInN0ciIsInRoZW4iLCJyZXNwb25zZSIsImRhdGEiLCJwYXJlbnQiXSwibWFwcGluZ3MiOiJBQUFBQSxRQUFRLENBQUNDLGdCQUFULENBQTBCLGtCQUExQixFQUE4QyxZQUFZO0FBQ3RELE1BQUlDLEtBQUssR0FBR0YsUUFBUSxDQUFDRyxjQUFULENBQXdCLE9BQXhCLENBQVo7QUFDQSxNQUFJQyxLQUFLLEdBQUdKLFFBQVEsQ0FBQ0csY0FBVCxDQUF3QixPQUF4QixDQUFaO0FBRUFELEVBQUFBLEtBQUssQ0FBQ0QsZ0JBQU4sQ0FBdUIsT0FBdkIsRUFBZ0MsWUFBWTtBQUN4QyxRQUFJQyxLQUFLLENBQUNHLEtBQU4sS0FBZ0IsRUFBcEIsRUFBd0JELEtBQUssQ0FBQ0MsS0FBTixHQUFjLEVBQWQ7QUFFeEJDLElBQUFBLEtBQUssQ0FDQUMsSUFETCxDQUNVSCxLQUFLLENBQUNJLE9BQU4sQ0FBY0MsTUFEeEIsRUFDZ0M7QUFBQ0MsTUFBQUEsR0FBRyxFQUFFO0FBQUMsaUJBQVNSLEtBQUssQ0FBQ0c7QUFBaEI7QUFBTixLQURoQyxFQUVLTSxJQUZMLENBRVUsVUFBQUMsUUFBUSxFQUFJO0FBQ2QsVUFBSUEsUUFBUSxDQUFDQyxJQUFULENBQWNULEtBQWxCLEVBQXlCQSxLQUFLLENBQUNDLEtBQU4sR0FBYyxDQUFDTyxRQUFRLENBQUNDLElBQVQsQ0FBY0MsTUFBZCxHQUF3QkYsUUFBUSxDQUFDQyxJQUFULENBQWNDLE1BQWQsR0FBdUIsR0FBL0MsR0FBb0QsRUFBckQsSUFBMkRGLFFBQVEsQ0FBQ0MsSUFBVCxDQUFjVCxLQUF2RjtBQUM1QixLQUpMO0FBS0gsR0FSRDtBQVNILENBYkQiLCJzb3VyY2VzQ29udGVudCI6WyJkb2N1bWVudC5hZGRFdmVudExpc3RlbmVyKCdET01Db250ZW50TG9hZGVkJywgZnVuY3Rpb24gKCkge1xuICAgIGxldCB0aXRsZSA9IGRvY3VtZW50LmdldEVsZW1lbnRCeUlkKCd0aXRsZScpO1xuICAgIGxldCBhbGlhcyA9IGRvY3VtZW50LmdldEVsZW1lbnRCeUlkKCdhbGlhcycpO1xuXG4gICAgdGl0bGUuYWRkRXZlbnRMaXN0ZW5lcignaW5wdXQnLCBmdW5jdGlvbiAoKSB7XG4gICAgICAgIGlmICh0aXRsZS52YWx1ZSA9PT0gJycpIGFsaWFzLnZhbHVlID0gJyc7XG5cbiAgICAgICAgYXhpb3NcbiAgICAgICAgICAgIC5wb3N0KGFsaWFzLmRhdGFzZXQuYWN0aW9uLCB7c3RyOiB7J2FsaWFzJzogdGl0bGUudmFsdWV9IH0pXG4gICAgICAgICAgICAudGhlbihyZXNwb25zZSA9PiB7XG4gICAgICAgICAgICAgICAgaWYgKHJlc3BvbnNlLmRhdGEuYWxpYXMpIGFsaWFzLnZhbHVlID0gKHJlc3BvbnNlLmRhdGEucGFyZW50ID8gIHJlc3BvbnNlLmRhdGEucGFyZW50ICsgJy0nOiAnJykgKyByZXNwb25zZS5kYXRhLmFsaWFzO1xuICAgICAgICAgICAgfSk7XG4gICAgfSk7XG59KTtcbiJdLCJmaWxlIjoiLi9yZXNvdXJjZXMvanMvcGFuZWwuYWRkX2NhdC5qcy5qcyIsInNvdXJjZVJvb3QiOiIifQ==\n//# sourceURL=webpack-internal:///./resources/js/panel.add_cat.js\n");

/***/ })

/******/ 	});
/************************************************************************/
/******/ 	
/******/ 	// startup
/******/ 	// Load entry module and return exports
/******/ 	// This entry module can't be inlined because the eval-source-map devtool is used.
/******/ 	var __webpack_exports__ = {};
/******/ 	__webpack_modules__["./resources/js/panel.add_cat.js"]();
/******/ 	
/******/ })()
;